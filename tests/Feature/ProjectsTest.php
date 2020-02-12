<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\{User, Project};

class ProjectsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_visit_index_page()
    {
        $response = $this->get('/');

        $response
            ->assertStatus(200)
            ->assertViewIs('welcome');
    }

    /** @test */
    public function guest_cannot_see_all_projects()
    {
        $response = $this->get('/projects');

        $response
            ->assertStatus(302)
            ->assertRedirect('/login');
    }

    /** @test */
    public function registered_users_can_see_all_projects()
    {
        $testUser = factory(User::class)->create();

        $response = $this
                        ->actingAs($testUser)
                        ->get('/projects');

        $response
            ->assertStatus(200)
            ->assertViewIs('projects.index');
    }

    /** @test */
    public function registered_users_can_reach_create_page()
    {
        $testUser = factory(User::class)->create();

        $response = $this
                        ->actingAs($testUser)
                        ->get('/projects/create');

        $response
            ->assertStatus(200)
            ->assertViewIs('projects.create');
    }

    /** @test */
    public function users_can_creat_projects()
    {
        $testUser = factory(User::class)->create();

        $testProject = factory(Project::class)->make([
            'creator' => $testUser->name,
        ]);

        $response = $this->actingAs($testUser)->post('/projects', [
            'project_name' => $testProject->project_name,
            'creator' => $testProject->creator,
            'description' => $testProject->description,
        ]);   

        $response->assertRedirect('/projects/1');
    }

    /** @test */
    public function users_can_edit_their_projects()
    {
        $testUser = factory(User::class)->create();

        $testProject = factory(Project::class)->make([
            'creator' => $testUser->name,
        ]);

        $this->actingAs($testUser)->post('/projects', [
            'project_name' => $testProject->project_name,
            'creator' => $testProject->creator,
            'description' => $testProject->description,
        ]);
        
        $response = $this->actingAs($testUser)->get('/projects/2/edit');

        $response
            ->assertStatus(200)
            ->assertViewIs('projects.edit');
    }

    /** @test */
    public function users_cannot_edit_other_projects()
    {
        $testUser1 = factory(User::class)->create();
        $testUser2 = factory(User::class)->create();

        $testProject1 = factory(Project::class)->make([
            'creator' => $testUser1->name,
        ]);

        $this->actingAs($testUser1)->post('/projects', [
            'project_name' => $testProject1->project_name,
            'creator' => $testProject1->creator,
            'description' => $testProject1->description,
        ]);

        $response = $this->actingAs($testUser2)->get('/projects/3/edit');

        $response->assertStatus(403);

    }

    /** @test */
    public function users_can_delete_their_projects()
    {
        $testUser = factory(User::class)->create();

        $testProject = factory(Project::class)->make([
            'creator' => $testUser->name,
        ]);

        $this->actingAs($testUser)->post('/projects', [
            'project_name' => $testProject->project_name,
            'creator' => $testProject->creator,
            'description' => $testProject->description,
        ]);
        
        $response = $this->actingAs($testUser)->delete('/projects/4');

        $response->assertRedirect('projects');
    }

    /** @test */
    public function users_cannot_delete_other_projects()
    {
        $testUser1 = factory(User::class)->create();
        $testUser2 = factory(User::class)->create();

        $testProject1 = factory(Project::class)->make([
            'creator' => $testUser1->name,
        ]);

        $this->actingAs($testUser1)->post('/projects', [
            'project_name' => $testProject1->project_name,
            'creator' => $testProject1->creator,
            'description' => $testProject1->description,
        ]);

        $response = $this->actingAs($testUser2)->delete('/projects/5');

        $response->assertStatus(403);

    }
}
