<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(): View
    {
        $tasks = Task::query()
            ->orderByRaw("CASE WHEN status = 'Pending' THEN 0 ELSE 1 END")
            ->orderBy('due_date')
            ->latest()
            ->get();

        return view('tasks.index', [
            'tasks' => $tasks,
            'pendingCount' => $tasks->where('status', 'Pending')->count(),
            'completedCount' => $tasks->where('status', 'Completed')->count(),
            'overdueCount' => $tasks->where('status', 'Pending')
                ->filter(fn (Task $task) => $task->due_date?->isPast())
                ->count(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Task::create($this->validatedData($request));

        return to_route('tasks.index')->with('success', 'Task added to your list.');
    }

    public function edit(Task $task): View
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        $task->update($this->validatedData($request));

        return to_route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return to_route('tasks.index')->with('success', 'Task removed.');
    }

    public function toggle(Task $task): RedirectResponse
    {
        $task->update([
            'status' => $task->status === 'Completed' ? 'Pending' : 'Completed',
        ]);

        return to_route('tasks.index')->with('success', $task->status === 'Completed'
            ? 'Task marked as complete.'
            : 'Task moved back to pending.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'task_name' => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:1000'],
            'status' => ['required', 'in:Pending,Completed'],
            'due_date' => ['nullable', 'date'],
        ]);
    }

}
