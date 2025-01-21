<?php
namespace App\Http\Controllers;
use App\Models\Task;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Display tasks
    public function index()
    {
        $tasks = Task::orderBy('order')->get();
        return view('tasks.index', compact('tasks'));
    }

    // Store a new task
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $lastOrder = Task::max('order') ?? 0;
        $validated['order'] = $lastOrder + 1;

        Task::create($validated);
        return redirect()->back();
    }

    // Update a task
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task->update($validated);
        return redirect()->back();
    }

    // Delete a task
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->back();
    }

    // Toggle task completion
    public function toggleComplete(Task $task)
    {
        $task->update(['is_completed' => !$task->is_completed]);
        return redirect()->back();
    }

    // Reorder tasks
    public function reorder(Request $request)
    {
        $taskOrder = $request->order; // Expects an array of IDs in the new order
        foreach ($taskOrder as $index => $taskId) {
            Task::where('id', $taskId)->update(['order' => $index + 1]);
        }
        return response()->json(['success' => true]);
    }

}
