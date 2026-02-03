<?php

namespace Modules\Akademiks\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Akademiks\Models\PerguruanTinggi;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Akademiks\Models\PerguruanTinggi>
 */
class PerguruanTinggiFactory extends Factory
{
    protected $model = PerguruanTinggi::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_perguruan_tinggi' => $this->faker->uuid(),
            'nama_perguruan_tinggi' => $this->faker->company() . ' University',
            'kode_perguruan_tinggi' => $this->faker->numerify('PT###'),
            'nama_singkat' => $this->faker->lexify('???'),
        ];
    }
}
