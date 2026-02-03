<?php

namespace Modules\Akademiks\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Akademiks\Models\Mahasiswa;
use Modules\Akademiks\Models\RiwayatPendidikan;

class MahasiswaDummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mahasiswa::factory()
            ->count(50)
            ->create()
            ->each(function ($mahasiswa) {
                RiwayatPendidikan::factory()->create([
                    'id_mahasiswa' => $mahasiswa->id_mahasiswa,
                ]);
            });
    }
}
