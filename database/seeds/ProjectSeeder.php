<?php

use Illuminate\Database\Seeder;
use App\{User, Project};

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class, 10)->create()->each(function ($user) {
            $user->projects()->save(factory(Project::class)->make());
        });

    }
}
