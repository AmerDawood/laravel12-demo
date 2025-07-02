<?php
namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTestRequest;

class TestController extends Controller
{
    public function index()
    {
        $tests = Test::all();
        return view('tests.index', [
            'tests' => $tests,
            // 'tests' => Test::where('user_id', auth()->id())->get(),
        ]);
    }

    public function create()
    {
        $this->authorize('create', Test::class);

        return view('tests.create');
    }

    public function store(StoreTestRequest $request)
    {
        Test::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'duration' => $request->duration,

        ]);

        return redirect()->route('tests.index')
            ->with('msg', '✅ Test Created Successfully')
            ->with('type', 'success');
    }

    public function show(Test $test)
    {
        $this->authorizeTest($test);

        return view('tests.show', compact('test'));
    }

    public function edit(Test $test)
    {
        $this->authorizeTest($test);

        return view('tests.edit', compact('test'));
    }

    public function update(StoreTestRequest $request, Test $test)
    {
            // $this->authorize('update', $test);

        $this->authorizeTest($test);

        $test->update([
            'title' => $request->title,
            'duration' => $request->duration,
        ]);

        return redirect()->route('tests.index')
            ->with('msg', '🔄 Test updated successfully')
            ->with('type', 'info');
    }

    public function destroy(Test $test)
    {
        $this->authorizeTest($test);

        $test->delete();

        return redirect()->route('tests.index')
            ->with('msg', '❌ Test deleted successfully')
            ->with('type', 'danger');
    }


    public function trashed()
{
    $tests = Test::onlyTrashed()->where('user_id', auth()->id())->get();

    return view('tests.trashed', compact('tests'));
}

public function restore($id)
{
    $test = Test::onlyTrashed()->where('id', $id)->where('user_id', auth()->id())->firstOrFail();
    $test->restore();

    return redirect()->route('tests.index')->with('msg', '✅ Test restored successfully')->with('type', 'info');
}


    // Optional helper to restrict ownership
    protected function authorizeTest(Test $test)
    {
        if ($test->user_id !== auth()->user()->id) {
            abort(403, 'You are not authorized to access this test.');
        }
    }
}
