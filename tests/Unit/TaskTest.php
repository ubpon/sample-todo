<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use App\Services\TaskService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_a_task()
    {
        $category = Category::factory()->state(['user_id' => auth()->id()])->create();

        $taskService = new TaskService();

        $task = $taskService->create(
            [
                'description' => 'sample task',
                'category_id' => $category->id,
            ]
        );

        $this->assertEquals('sample task', $task->description);
    }

    public function test_it_can_update_a_task()
    {
        $task = Task::factory()->state(['user_id' => auth()->id()])->create();

        $taskService = new TaskService();

        $taskService->update(
            $task,
            [
                'description' => 'sample task',
            ]
        );

        $this->assertEquals('sample task', $task->fresh()->description);
    }

    public function test_it_can_finish_a_task()
    {
        $task = Task::factory()->state(['user_id' => auth()->id()])->create();

        $taskService = new TaskService();

        $taskService->update(
            $task,
            [
                'description' => 'sample task',
                'completed' => 1
            ]
        );

        $this->assertNotEmpty($task->fresh()->completed_at);
    }
}
