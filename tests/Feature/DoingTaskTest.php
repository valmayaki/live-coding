<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DoingTaskTest extends TestCase
{
    /**
     *
     *
     * @return void
     */
    public function testUserCanSetATaskAsDone()
    {
        $this->withoutExceptionHandling();
        list($user, $token) = $this->setupApiUser();
        $task = factory(\App\Task::class)->make();
        $savedTask = $user->tasks()->save($task);
        $data = [
            'isDone' => true,
        ];
        $response =
                $this->actingAsViaApi($token)
                    ->json('PATCH', "/api/tasks/{$savedTask->getKey()}", $data);

        $response->assertStatus(200);
        $content = json_decode($response->getContent(), true);
        $this->assertNotNull($content['data']['done_at'], "Task should be marked as done");
    }
    /**
     *
     *
     * @return void
     */
    public function testUserCanSetATaskAsNotDone()
    {
        $this->withoutExceptionHandling();
        list($user, $token) = $this->setupApiUser();
        $task = factory(\App\Task::class)->make();
        $savedTask = $user->tasks()->save($task);
        $data = [
            'isDone' => false,
        ];
        $response =
                $this->actingAsViaApi($token)
                    ->json('PATCH', "/api/tasks/{$savedTask->getKey()}", $data);

        $response->assertStatus(200);
        $content = json_decode($response->getContent(), true);
        $this->assertNull($content['data']['done_at'], "Task should be marked as done");
    }
}
