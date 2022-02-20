<?php

namespace Database\Factories;

use App\Models\Position;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class CandidateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'position_id' => Position::inRandomOrder()->first()->id,
            'status_id' => Status::where('name', 'Initial')->first()->id,
            'min_salary' => $this->faker->numberBetween(0, 500),
            'max_salary' => $this->faker->numberBetween(4000, 15000),
            'linkedin_url' => $this->faker->url,
            'cv' => $this->faker->imageUrl
        ];
    }
}
