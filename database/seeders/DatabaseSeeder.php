<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
   public function run(): void
    {
        \App\Models\User::factory(5)->has(
            \App\Models\Test::factory(3)->has(
                \App\Models\Question::factory(5)
            )
        )->create();

        \App\Models\User::factory(10)->create()->each(function ($student) {
            \App\Models\Test::inRandomOrder()->take(2)->get()->each(function ($test) use ($student) {
                $attempt = \App\Models\Attempt::factory()->create([
                    'user_id' => $student->id,
                    'test_id' => $test->id,
                ]);

                $test->questions->each(function ($question) use ($attempt) {
                    \App\Models\Answer::factory()->create([
                        'attempt_id' => $attempt->id,
                        'question_id' => $question->id,
                    ]);
                });

                \App\Models\Result::factory()->create([
                    'attempt_id' => $attempt->id,
                ]);
            });
        });


        // Call the RoleSeeder to create roles and permissions
        $this->call(RoleSeeder::class);
    }
}
