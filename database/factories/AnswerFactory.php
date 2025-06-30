<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         return [
            'attempt_id' => \App\Models\Attempt::factory(),
            'question_id' => \App\Models\Question::factory(),
            'answer_text' => $this->faker->randomElement(['A', 'B', 'C', 'D']),
        ];
    }
}
