<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'task_name' => $faker->sentence,
        'task_body' => $faker->text,
        'status' => 'new',
    ];
});
