<?php

namespace Database\Factories;

use App\Models\Characterlevel;
use Illuminate\Database\Eloquent\Factories\Factory;

class CharacterlevelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Characterlevel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'points_upgrade' => $this->faker->numberBetween(0, 100),
            'video_state' => $this->faker->url(),
            'video_upgrade' => $this->faker->url(),
        ];
    }
}
