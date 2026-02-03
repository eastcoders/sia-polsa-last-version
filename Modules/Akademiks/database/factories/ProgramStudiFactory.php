<?php

namespace Modules\Akademiks\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Akademiks\Models\ProgramStudi;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Akademiks\Models\ProgramStudi>
 */
class ProgramStudiFactory extends Factory
{
    protected $model = ProgramStudi::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_prodi' => $this->faker->uuid(),
            'kode_program_studi' => $this->faker->unique()->numerify('#####'),
            'nama_program_studi' => $this->faker->randomElement(['Teknik Informatika', 'Sistem Informasi', 'Manajemen Informatika', 'Komputerisasi Akuntansi']),
            'status' => 'A',
            'nama_jenjang_pendidikan' => $this->faker->randomElement(['S1', 'D3', 'D4']),
            'id_perguruan_tinggi' => $this->faker->uuid(),
        ];
    }
}
