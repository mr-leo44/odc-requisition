<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pdf>
 */
class PdfFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'designation'=>$this->faker->word,
            'quantite_demandee'=>$this->faker->randomNumber(),
            'quantite_livre'=>$this->faker->randomNumber(),
            'utilisateur'=>$this->faker->word,

        ];
    }
}

