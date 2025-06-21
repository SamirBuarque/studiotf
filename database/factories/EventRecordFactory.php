<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventRecord>
 */
class EventRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => $this->faker->sentence(3),
            "city" => $this->faker->city,
            "state" => $this->faker->stateAbbr,
            "date" => $this->faker->date(),
            "status" => $this->faker->randomElement(["Planejamento", "Produção Fábrica", "Produção Local", "Entrega"])
        ];
    }
}
