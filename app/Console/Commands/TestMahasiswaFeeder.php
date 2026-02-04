<?php

namespace App\Console\Commands;

use App\Services\Feeder\MahasiswaService;
use Illuminate\Console\Command;

class TestMahasiswaFeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:mahasiswa-feeder {--limit=10 : Number of records to fetch}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test fetching Mahasiswa biodata from Feeder API';

    /**
     * Execute the console command.
     */
    public function handle(MahasiswaService $mahasiswaService)
    {
        $limit = (int) $this->option('limit');
        $this->info("Fetching {$limit} Mahasiswa records via MahasiswaService...");

        try {
            $response = $mahasiswaService->getBiodata([], $limit);

            // Check if response has error_code syntax common in Feeder
            if (isset($response['error_code'])) {
                if ($response['error_code'] === 0) {
                    $data = $response['data'] ?? [];
                    $count = count($data);
                    
                    $this->info("SUCCESS: Retrieved {$count} records.");
                    
                    if ($count > 0) {
                        $this->table(
                            ['Attribute', 'Value (First Record)'],
                            collect($data[0])->map(function($value, $key) {
                                if (is_array($value)) $value = json_encode($value);
                                return ['key' => $key, 'value' => substr($value, 0, 50)];
                            })->toArray()
                        );
                    } else {
                        $this->warn("Data is empty.");
                    }

                } else {
                    $this->error("API ERROR ({$response['error_code']}): " . ($response['error_desc'] ?? 'Unknown error'));
                    if (isset($response['data'])) {
                        $this->line(print_r($response['data'], true));
                    }
                }
            } else {
                // Unknown format, just dump it
                $this->warn("Unknown response format:");
                $this->line(print_r($response, true));
            }

        } catch (\Exception $e) {
            $this->error("EXCEPTION: " . $e->getMessage());
            $this->line($e->getTraceAsString());
        }
    }
}
