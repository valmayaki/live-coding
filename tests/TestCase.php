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

}
