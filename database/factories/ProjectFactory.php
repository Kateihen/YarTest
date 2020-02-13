<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\{Project, Task};
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
	return [
		'project_name' => $faker->sentence,
		'description' => $faker->text,
	];
});

$factory->afterCreating(Project::class, function ($project, Faker $faker) {
	$project->tasks()->save(factory(Task::class)->make());
});
