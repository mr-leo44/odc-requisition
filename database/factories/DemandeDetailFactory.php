<?php

namespace Database\Factories;

use App\Models\DemandeDetail;
use App\Models\Demande;
use Illuminate\Database\Eloquent\Factories\Factory;

class DemandeDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DemandeDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'demande_id' =>$this->faker->randomDigit, //Demande::factory(),
            'designation' => $this->faker->word,
            'qte_demandee' => $this->faker->randomNumber(2, 1, 100),
            'qte_livree' => $this->faker->randomNumber(2, 0, 100),
        ];
    }
}
