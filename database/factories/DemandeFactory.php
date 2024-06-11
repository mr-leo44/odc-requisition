<?php

namespace Database\Factories;

use App\Models\Demande;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Service;

class DemandeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Demande::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'numero' => '020' . $this->faker->randomNumber(3) . '/' . now()->year,
            'user_id' =>  $this->faker->randomDigit,//User::factory(),
            'service_id' =>Service::factory(),//$this->faker->randomDigit Service::factory(),
        ];
    }
}
