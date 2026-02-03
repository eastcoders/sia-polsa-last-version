<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PolsaApiService
{
    protected string $baseUrl;
    protected string $username;
    protected string $password;
    protected $tokenCacheKey = 'polsa_api_token';

    public function __construct()
    {
        $this->baseUrl = config('services.polsa.base_url');
        $this->username = config('services.polsa.username');
        $this->password = config('services.polsa.password');
    }

    /**
     * Get a valid token from cache or request a new one.
     *
     * @param bool $forceRefresh
     * @return string|null
     * @throws \Exception
     */
    public function authenticate(bool $forceRefresh = false): ?string
    {
        if (!$forceRefresh && Cache::has($this->tokenCacheKey)) {
            return Cache::get($this->tokenCacheKey);
        }

        try {
            $response = Http::asForm()->post($this->baseUrl, [
                'act' => 'GetToken',
                'username' => $this->username,
                'password' => $this->password,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['data']['token'])) {
                    $token = $data['data']['token'];
                    
                    // Parse Token to find expiration if it's a JWT
                    $expiresIn = 3600; // Default 1 hour
                    try {
                        $tokenParts = explode('.', $token);
                        if (count($tokenParts) >= 2) {
                            $payload = json_decode(base64_decode(str_replace(['-', '_'], ['+', '/'], $tokenParts[1])), true);
                            if (isset($payload['exp'])) {
                                // Set cache TTL to expire slightly before the token does (e.g., -60 seconds)
                                $expiresIn = $payload['exp'] - time() - 60;
                                if ($expiresIn < 0) $expiresIn = 0; // Already expired
                            }
                        }
                    } catch (\Exception $e) {
                         // Fallback to default
                         Log::warning('Failed to parse Polsa JWT expiration: ' . $e->getMessage());
                    }

                    if ($expiresIn > 0) {
                        Cache::put($this->tokenCacheKey, $token, $expiresIn);
                        return $token;
                    } else {
                        throw new \Exception('Received an expired token from Polsa API.');
                    }
                }
            }

            Log::error('Failed to get Polsa Token', ['response' => $response->body()]);
            throw new \Exception('Failed to retrieve token from Polsa API: ' . $response->body());

        } catch (\Exception $e) {
            Log::error('Polsa API Auth Exception: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Send a request to the Polsa API with automatic token management.
     *
     * @param array $payload The body of the request (excluding token)
     * @return array
     * @throws \Exception
     */
    public function request(array $payload)
    {
        // Ensure we have a token
        $token = $this->authenticate();

        // Prepare full payload
        // Note: The prompt implies using the token for other requests. 
        // Assuming the token is sent in the body as 'token' or similar? 
        // Since the prompt example didn't show where the token goes in subsequent requests,
        // we will assume `token` field in body based on typical patterns for this style of API (act param).
        // OR Authorization header. 
        // Given the 'act' body style, it's often 'token' => $token in body.
        // I will add it to the body. If it fails, I might need to adjust.
        // Re-reading prompt: "disimpan untuk digunakan ke method API lainnya" "Response ... data: { token: ... }"
        // It doesn't explicitly say how to use it. I'll default to Bearer header AND body, just to be safe or just Body?
        // Let's try Bearer header first as it's standard. But "Post Body ... act: GetToken" looks like a custom RPC.
        // Custom RPCs usually put everything in body. I'll add 'token' to body.
        
        $requestPayload = array_merge($payload, ['token' => $token]);

        $response = Http::asForm()->post($this->baseUrl, $requestPayload);
        
        // Check for specific errors indicating expiration
        // User said: "error_code": 0 is success.
        // If error_code != 0, we check description.
        // Or if HTTP 401.
        
        $data = $response->json();
        
        // Pseudo-check for expiry. Since I don't know the exact error code for expiry.
        // I will assume if 'error_code' is present and NOT 0, and msg mentions 'token' or 'expired', we retry.
        // Or if response is null/invalid json.
        
        $isExpired = false;
        if ($response->successful() && isset($data['error_code']) && $data['error_code'] != 0) {
             $desc = strtolower($data['error_desc'] ?? '');
             if (str_contains($desc, 'expired') || str_contains($desc, 'token') || str_contains($desc, 'invalid') || str_contains($desc, 'auth')) {
                 $isExpired = true;
             }
        }
        
        // If HTTP 401/403
        if ($response->status() === 401 || $response->status() === 403) {
            $isExpired = true;
        }

        if ($isExpired) {
            Log::info('Polsa API Token expired or invalid. Retrying...');
            // Force refresh token
            $token = $this->authenticate(true);
            
            // Replay request
            $requestPayload = array_merge($payload, ['token' => $token]);
            $response = Http::asForm()->post($this->baseUrl, $requestPayload);
            $data = $response->json();
        }

        return $data;
    }
}
