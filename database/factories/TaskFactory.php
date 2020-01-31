<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Task::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'description' => $faker->text,
        'due_at' => \Carbon\Carbon::now(),
    ];
});
