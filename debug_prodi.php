<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Services\Feeder\ReferencesServices;
use App\Models\Modules\Akademiks\Models\ProgramStudi;
use Illuminate\Support\Str;

try {
    echo "Testing API...\n";
    $api = app(ReferencesServices::class);
    $response = $api->getAllProdi([], 1, 0);
    print_r($response);

    echo "\nTesting Database Insert...\n";
    $id = Str::uuid();
    $ptId = Str::uuid();
    
    $prodi = ProgramStudi::create([
        'id_prodi' => $id,
        'id_perguruan_tinggi' => $ptId,
        'kode_program_studi' => 'TEST001',
        'nama_program_studi' => 'Test Prodi',
        'status' => 'A'
    ]);
    
    echo "Created Prodi: " . $prodi->id_prodi . "\n";
    
    // Cleanup
    $prodi->delete();
    echo "Deleted Test Prodi.\n";
    
} catch (\Throwable $e) {
    file_put_contents('error.log', "Error: " . $e->getMessage() . "\n" . "File: " . $e->getFile() . " Line: " . $e->getLine());
    echo "Error logged to error.log\n";
}
