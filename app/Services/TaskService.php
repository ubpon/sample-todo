<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    public function list()
    {
        return Task::with('category')
            ->where([
                'user_id' => auth()->user()->id,
            ])
            ->get();
    }

    public function create(array $data)
    {
        return auth()->user()->tasks()->create($data);
    }

    public function update(Task $task, array $data)
    {
        return $task->update($data);
    }
}
