<?php

namespace Database\Factories;

use App\Models\Character;
use App\Models\Characterlevel;
use App\Models\Charactertype;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CharacterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Character::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'current_storypoints' => $this->faker->numberBetween(0, 100),
            'charactertype_id' => Charactertype::all()->random()->id,
            'characterlevel_id' => Characterlevel::all()->random()->id,
        ];
    }
}
