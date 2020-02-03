<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;

class TaskServiceTest extends TestCase
{
    /**
     *
     *
     * @return void
     */
    public function testItUpdatesStatusOfATaskToDone()
    {
        $taskRepo = Mockery::mock(\App\Repositories\TaskRepository::class);
        $task = new \App\Task([
            'title'=> 'Write TaskService Test',
            'description' => "Write Task Service Test",
            'due_at' => \Carbon\Carbon::now(),
        ]);
        $taskRepo->shouldReceive('update')->with($task, ['isDone' => true])->andReturnUsing(function($task, $data){
            $task->done_at = \Carbon\Carbon::now();
            return $task;
        });
        $taskService = new \App\Services\TaskService($taskRepo);
        $updatedTask = $taskService->updateStatus($task, true);
        $this->assertNotNull($updatedTask, "The Task done_at date should not be null");
    }
    /**
     *
     *
     * @return void
     */
    public function testItUpdatesStatusOfATaskToNotDone()
    {
        $taskRepo = Mockery::mock(\App\Repositories\TaskRepository::class);
        $task = new \App\Task([
            'title'=> 'Write TaskService Test',
            'description' => "Write Task Service Test",
            'due_at' => \Carbon\Carbon::now(),
        ]);
        $taskRepo->shouldReceive('update')->with($task, ['isDone' => false])->andReturnUsing(function($task, $data){
            $task->done_at = \Carbon\Carbon::now();
            return $task;
        });
        $taskService = new \App\Services\TaskService($taskRepo);
        $updatedTask = $taskService->updateStatus($task, false);
        $this->assertNotNull($updatedTask, "The Task done_at date should not be null");
    }

    public function testItCanCreateNewTask()
    {
        $taskRepo = Mockery::mock(\App\Repositories\TaskRepository::class);
        $taskService = new \App\Services\TaskService($taskRepo);
        $data = ['title' => "Create a new Task For me", 'description' => "Task should be done today", "due_at"=> \Carbon\Carbon::now, 'user_id' => 1];
        $taskService->createTask($data);
    }
}
