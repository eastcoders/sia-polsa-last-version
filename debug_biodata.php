<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Services\Feeder\ReferencesServices;

try {
    $api = app(ReferencesServices::class);
    $methods = [
        'getAgama' => 'Agama',
        'getAlatTransportasi' => 'Alat Transportasi',
        'getPekerjaan' => 'Pekerjaan',
        'getPenghasilan' => 'Penghasilan',
        'getKebutuhanKhusus' => 'Kebutuhan Khusus',
        'getJenisTinggal' => 'Jenis Tinggal',
        'getStatusKepegawaian' => 'Status Kepegawaian',
        'getIkatanKerjaSdm' => 'Ikatan Kerja SDM',
        'getJenisKeluar' => 'Jenis Keluar'
    ];

    foreach ($methods as $method => $label) {
        echo "\nTesting $label API...\n";
        $response = $api->$method([], 1, 0);
        // Print only data keys if available to keep output short
        if (isset($response['data'][0])) {
            print_r(array_keys($response['data'][0]));
            // Also print one full item to see types
            print_r($response['data'][0]);
        } else {
            echo "No data or Error.\n";
            print_r($response);
        }
        echo "--------------------------------------------------\n";
    }

} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
