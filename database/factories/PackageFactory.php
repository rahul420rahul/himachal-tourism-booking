<?php

namespace Database\Factories;

use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\Factory;

class PackageFactory extends Factory
{
    protected $model = Package::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'slug' => $this->faker->slug,
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 1000, 10000),
            'duration' => $this->faker->numberBetween(30, 120),
            'max_participants' => $this->faker->numberBetween(1, 10),
            'is_active' => true,
            'featured' => $this->faker->boolean(30),
        ];
    }
}
