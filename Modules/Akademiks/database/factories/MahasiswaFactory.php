<?php

namespace Modules\Akademiks\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Akademiks\Models\Mahasiswa;

class MahasiswaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Mahasiswa::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id_mahasiswa' => $this->faker->uuid,
            'nama_lengkap' => $this->faker->name,
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'email' => $this->faker->unique()->safeEmail,
            'no_telp' => $this->faker->phoneNumber,
            'nik' => $this->faker->unique()->numerify('################'),
            'nisn' => $this->faker->unique()->numerify('##########'),
            'tempat_lahir' => $this->faker->city,
            'tanggal_lahir' => $this->faker->date,
            'id_agamaa' => $this->faker->numberBetween(1, 6),
            'id_server' => $this->faker->uuid,
        ];
    }
}
