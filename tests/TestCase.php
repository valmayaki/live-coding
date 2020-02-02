<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Contracts\Auth\Authenticatable;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, WithFaker;

    public function actingAsViaApi($token, $driver = null)
    {
        $this->withHeader('Authorization', 'Bearer ' . $token);

        return $this;
    }
    /**
     * This Sets up a User with token access
     *
     * @param array $data optional data to overide fake ones
     *
     * @return array contains user object and token
     */
    protected function setupApiUser($data = []){
        $token = \Str::random(60);
        if(!isset($data['token'])){
            $data['api_token'] =  hash('sha256', $token);
        }
        $user = factory(\App\User::class)->create($data);
        return [$user, $token];
    }

}
