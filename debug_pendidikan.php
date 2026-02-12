<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Services\Feeder\ReferencesServices;

$feeder = app(ReferencesServices::class);

$methods = [
    'getJenjangPendidikan',
    'getBentukPendidikan',
    'getJalurMasuk',
    'getJenisPendaftaran',
    'getPembiayaan',
    'getJenisEvaluasi',
    'getJenisSubstansi'
];

foreach ($methods as $method) {
    echo "Testing $method...\n";
    try {
        $response = $feeder->$method([], 1, 0);
        if (isset($response['error_code']) && $response['error_code'] != 0) {
            echo "Error: " . $response['error_desc'] . "\n";
        } else {
            $data = $response['data'][0] ?? null;
            if ($data) {
                print_r($data);
            } else {
                echo "No data returned.\n";
            }
        }
    } catch (Exception $e) {
        echo "Exception: " . $e->getMessage() . "\n";
    }
    echo "----------------------------------------\n";
}
