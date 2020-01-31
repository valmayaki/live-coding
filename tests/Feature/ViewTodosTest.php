<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Str;
use App\User;

class ViewTodosTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserCanSeeTheirTasksForTheDay()
    {
        $this->withoutExceptionHandling();
        list($user, $token) = $this->setupApiUser();
        $response = $this->actingAsViaApi($token)->json('GET', '/api/todos');

        $response->assertStatus(200);
    }
    public function setupApiUser($data = []){
        $token = Str::random(60);
        if(!isset($data['token'])){
            $data['api_token'] =  hash('sha256', $token);
        }
        $user = factory(User::class)->create($data);
        return [$user, $token];
    }
    public function getToken(){
        return Str::random(60);
    }
}
