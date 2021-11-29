<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Passport\Bridge\UserRepository;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->text(10);
        $finalTitle = rtrim($title, '.');
        return [
            'title' => $finalTitle,
            'description' => $this->faker->text(),
            'storypoints' => $this->faker->numberBetween(0, 100),
            'status' => $this->faker->randomElement(['open', 'progress', 'done']),
            'sort_index' => $this->faker->numberBetween(0, 10),
            'assigne_id' => function () {
                return User::factory()->create()->id;
            },
        ];
    }
}
