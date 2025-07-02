<?php

namespace App\Http\Controllers;

use App\Models\Attempt;
use App\Models\Test;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentTestController extends Controller
{
public function start(Test $test)
{
    $user = Auth::user();

    $attempt = Attempt::where('user_id', $user->id)
        ->where('test_id', $test->id)
        ->first();

    if (!$attempt) {
        $attempt = Attempt::create([
            'user_id' => $user->id,
            'test_id' => $test->id,
            'started_at' => Carbon::now(),
        ]);
    }

    $questions = $test->questions()->inRandomOrder()->get();

    return view('tests.start', compact('test', 'questions', 'attempt'));
}


public function endAttempt(Attempt $attempt)
{
    $attempt->update([
        'ended_at' => now(),
    ]);

    return response()->json(['message' => 'Attempt ended']);
}
}
