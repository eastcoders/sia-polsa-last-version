<?php

namespace App\Console\Commands;

use App\Services\PolsaApiService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class TestPolsaConnection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:polsa-connection {--clear : Clear cache before starting}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the connection and token logic of PolsaApiService';

    /**
     * Execute the console command.
     */
    public function handle(PolsaApiService $polsaService)
    {
        $this->info('Starting Polsa API Connection Test...');

        if ($this->option('clear')) {
            $this->info('Clearing Polsa Token Cache...');
            Cache::forget('polsa_api_token');
        }

        try {
            // Test 1: Authenticate (Get Token)
            $this->info('Attempting Authentication...');
            $token = $polsaService->authenticate();
            
            if ($token) {
                $this->info('SUCCESS: Token retrieved.');
                $this->line('Token: ' . substr($token, 0, 20) . '...');
            } else {
                $this->error('FAILURE: Token is null.');
                return 1;
            }

            // Test 2: Check Cache
            $this->info('Verifying Cache...');
            if (Cache::has('polsa_api_token')) {
                 $this->info('SUCCESS: Token is cached.');
            } else {
                $this->warn('WARNING: Token does not appear to be cached.');
            }

            // Test 3: Re-use Token (Simulate Request)
            // Note: We don't have a real second endpoint to call, but we can call 'GetToken' again via request() 
            // or just rely on the fact that authenticate() didn't throw.
            // Let's try to call 'authenticate' again to verify it hits cache.
            // We can't see internal logs easily here, but we can check speed or if logic works.
            
            $this->info('Requesting Token again (should be fast/cached)...');
            $startTime = microtime(true);
            $token2 = $polsaService->authenticate();
            $duration = microtime(true) - $startTime;
            
            if ($token === $token2) {
                $this->info("SUCCESS: Token matches cached token. (Duration: " . number_format($duration, 4) . "s)");
            } else {
                $this->warn("WARNING: Token verification mismatch or refreshed unexpectedly.");
            }
            
            $this->info('Test Complete.');
            return 0;

        } catch (\Exception $e) {
            $this->error('EXCEPTION: ' . $e->getMessage());
            return 1;
        }
    }
}
