<?php

namespace Modules\Akademiks\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Akademiks\Models\Wilayah;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Akademiks\Models\Wilayah>
 */
class WilayahFactory extends Factory
{
    protected $model = Wilayah::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_wilayah' => $this->faker->unique()->numerify('######'),
            'id_level_wilayah' => '1',
            'id_induk_wilayah' => null,
            'nama_wilayah' => $this->faker->city(),
            'id_negara' => 'ID',
        ];
    }

    public function provinsi()
    {
        return $this->state(function (array $attributes) {
            return [
                'id_level_wilayah' => '1',
                'id_induk_wilayah' => null,
                'nama_wilayah' => $this->faker->state(),
            ];
        });
    }

    public function kabupaten()
    {
        return $this->state(function (array $attributes) {
            return [
                'id_level_wilayah' => '2',
                'id_induk_wilayah' => Wilayah::factory()->provinsi(),
                'nama_wilayah' => $this->faker->city(),
            ];
        });
    }

    public function kecamatan()
    {
        return $this->state(function (array $attributes) {
            return [
                'id_level_wilayah' => '3',
                'id_induk_wilayah' => Wilayah::factory()->kabupaten(),
                'nama_wilayah' => $this->faker->streetName(), // Approximate for kecamatan
            ];
        });
    }
}
