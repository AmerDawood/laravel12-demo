<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
          $types = ['mcq', 'true_false', 'written', 'coding'];
        $type = $this->faker->randomElement($types);

        return [
            'test_id' => \App\Models\Test::factory(),
            'type' => $type,
            'question_text' => $this->faker->sentence,
            'options' => $type === 'mcq' || $type === 'true_false' ? json_encode(['A', 'B', 'C', 'D']) : null,
            'correct_answer' => $type !== 'written' ? 'A' : null,
        ];
    }
}
