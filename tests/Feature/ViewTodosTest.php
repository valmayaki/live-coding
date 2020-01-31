<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewTodosTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserCanSeeTheirTasksForTheDay()
    {
        $response = $this->get('/api/todos');

        $response->assertStatus(200);
    }
}
