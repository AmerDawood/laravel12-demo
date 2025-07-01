<?php
namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(Test $test)
    {
        $questions = $test->questions;
        return view('questions.index', compact('test', 'questions'));
    }

    public function create(Test $test)
    {
        return view('questions.create', compact('test'));
    }

    public function store(Request $request, Test $test)
    {
        $request->validate([
            'type' => 'required|in:mcq,written,coding,true_false',
            'question_text' => 'required|string',
            'options' => 'nullable|array',
            'correct_answer' => 'nullable|string',
        ]);

        $question = new Question([
            'type' => $request->type,
            'question_text' => $request->question_text,
            'correct_answer' => $request->correct_answer,
            'options' => $request->filled('options') ? json_encode($request->options) : null,
        ]);

        $test->questions()->save($question);

        return redirect()->route('questions.index', $test)->with('msg', '✅ Question added successfully');
    }

    // Show edit form
public function edit(Test $test, Question $question)
{
    return view('questions.edit', compact('test', 'question'));
}

// Update question
public function update(Request $request, Test $test, Question $question)
{
    $request->validate([
        'type' => 'required|in:mcq,written,coding,true_false',
        'question_text' => 'required|string',
        'options' => 'nullable|array',
        'correct_answer' => 'nullable|string',
    ]);

    $question->update([
        'type' => $request->type,
        'question_text' => $request->question_text,
        'correct_answer' => $request->correct_answer,
        'options' => $request->filled('options') ? json_encode($request->options) : null,
    ]);

    return redirect()->route('tests.questions.index', $test)->with('msg', '🔄 Question updated successfully');
}

// Soft delete
public function destroy(Test $test, Question $question)
{
    $question->delete();

    return redirect()->route('tests.questions.index', $test)->with('msg', '🗑️ Question deleted');
}

// Show trashed
public function trashed(Test $test)
{
    $questions = $test->questions()->onlyTrashed()->get();
    return view('questions.trashed', compact('test', 'questions'));
}

// Restore
public function restore(Test $test, $question_id)
{
    $question = $test->questions()->onlyTrashed()->where('id', $question_id)->firstOrFail();
    $question->restore();

    return redirect()->route('tests.questions.index', $test)->with('msg', '♻️ Question restored successfully');
}

}
