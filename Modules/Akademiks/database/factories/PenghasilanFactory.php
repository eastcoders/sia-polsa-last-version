<?php

namespace Modules\Akademiks\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Akademiks\Models\Penghasilan;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Akademiks\Models\Penghasilan>
 */
class PenghasilanFactory extends Factory
{
    protected $model = Penghasilan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_penghasilan' => $this->faker->randomElement(['< 1 Juta', '1 - 5 Juta', '5 - 10 Juta', '> 10 Juta']),
        ];
    }
}
