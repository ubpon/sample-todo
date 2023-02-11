<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveTaskRequest;
use App\Models\Task;
use App\Services\CategoryService;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    private TaskService $taskService;

    private CategoryService $categoryService;

    public function __construct(
        TaskService $taskService,
        CategoryService $categoryService
    ) {
        $this->taskService = $taskService;
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $tasks = $this->taskService->list();
        $categories = $this->categoryService->list();

        return Inertia::render('Task/Index', [
            'categories' => $categories,
            'tasks' => $tasks,
        ]);
    }

    public function store(SaveTaskRequest $request)
    {
        $this->taskService->create($request->validated());

        return redirect()->back();
    }

    public function update(SaveTaskRequest $request, Task $task)
    {
        $this->taskService->update($task, $request->validated());

        return redirect()->back();
    }
}
