<?php

namespace Database\Factories;

use App\Models\Character;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'character_id' => function () {
                return Character::factory()->create()->id;
            },
            'character_name' => $this->faker->firstName(),
            'tag_color' => $this->faker->randomElement(['#99154E', '#FFB319', '#49A6AA', '#0A474A']),
            'storypoints' => $this->faker->numberBetween(0, 100)
        ];
    }
}
