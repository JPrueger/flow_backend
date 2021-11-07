<?php

namespace Database\Factories;

use App\Models\Charactertype;
use Illuminate\Database\Eloquent\Factories\Factory;

class CharactertypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Charactertype::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['Dragon', 'Ghost']),
            'video_start' => $this->faker->url(),
        ];
    }
}
