<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Traitement>
 */
class TraitementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'level'=>$this->faker->numberBetween(0,3),
            'status'=>$this->faker->word,
            'observation'=>$this->faker->word,
            'demande_id'=>$this->faker->numberBetween(1,15),
            'approbateur_id'=>$this->faker->numberBetween(1,3)
        ];
    }
}
