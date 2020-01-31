<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Str;

class ViewTodosTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test that a user can see Tasks
     *
     * @return void
     */
    public function testUserCanSeeTheirTasks()
    {
        $this->withoutExceptionHandling();
        list($user, $token) = $this->setupApiUser();
        $task = factory(\App\Task::class)->make();
        $user->tasks()->save($task);
        $response = $this->actingAsViaApi($token)->json('GET', '/api/todos');

        $response->assertStatus(200);
        $content = json_decode($response->getContent(), true);
        $this->assertCount(1, $content['data'], "It returns all todos that belong to a user");
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserCanSeeOnlyTheirOwnTasks()
    {
        $this->withoutExceptionHandling();
        $this->withoutExceptionHandling();
        list($user1, $token) = $this->setupApiUser();
        list($user2, $token) = $this->setupApiUser();
        $task1 = factory(\App\Task::class)->make();
        $task2 = factory(\App\Task::class)->make();
        $user1->tasks()->save($task1);
        $user2->tasks()->save($task2);
        $response = $this->actingAsViaApi($token)->json('GET', '/api/todos');

        $response->assertStatus(200);
        $content = json_decode($response->getContent());
        $response->assertStatus(200);
        $content = json_decode($response->getContent(), true);
        $this->assertCount(1, $content['data']);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserCanSeeOnlyTheTasksForTheDay()
    {
        $this->withoutExceptionHandling();
        $this->withoutExceptionHandling();
        list($user1, $token) = $this->setupApiUser();
        list($user2, $token) = $this->setupApiUser();
        $task1 = factory(\App\Task::class)->make(['due_at' => \Carbon\Carbon::now()->addDay()]);
        $task2 = factory(\App\Task::class)->make();
        $user1->tasks()->save($task1);
        $user2->tasks()->save($task2);
        $response = $this->actingAsViaApi($token)->json('GET', '/api/todos');

        $response->assertStatus(200);
        $content = json_decode($response->getContent());
        $response->assertStatus(200);
        $content = json_decode($response->getContent(), true);
        $this->assertCount(1, $content['data']);
    }
    private function setupApiUser($data = []){
        $token = Str::random(60);
        if(!isset($data['token'])){
            $data['api_token'] =  hash('sha256', $token);
        }
        $user = factory(\App\User::class)->create($data);
        return [$user, $token];
    }
    private function getToken(){
        return Str::random(60);
    }
}
