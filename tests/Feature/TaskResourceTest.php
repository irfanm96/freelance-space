<?php

namespace Tests\Feature;

use App\Project;
use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\NovaTestCase;

class TaskResourceTest extends NovaTestCase
{
    use RefreshDatabase;

    public function setUp() :void
    {
        parent::setUp();
        $this->user->assignRole('super-admin');
        factory(Project::class, 5)->create();
    }

    /** @test **/
    public function task_can_be_retrieved_with_correct_resource_elements()
    {
        $task = factory(Task::class)->create();
        $response = $this->get('/nova-api/tasks/1');

        $response->assertJson([
            'resource' => [
                'id' => [
                    'value' => $task->id,
                ],
            ],
        ]);
    }

    /** @test **/
    public function tasks_can_be_retrieved_with_latest_first()
    {
        $task = factory(Task::class)->create();
        $task2 = factory(Task::class)->create();

        $response = $this->get('/nova-api/tasks');

        $response->assertJson([
            'resources' => [
                [
                    'id' => [
                        'value' => $task2->id,
                    ],
                ],
                [
                    'id' => [
                        'value' => $task->id,
                    ],
                ],
            ],
        ]);
    }

    /** @test **/
    public function name_is_required_on_create()
    {
        $this->post('/nova-api/tasks/', ['name' => null])
              ->assertRedirect()
             ->assertSessionHasErrors([
                 'name' => 'The name field is required.',
             ]);
    }

    /** @test **/
    public function name_must_be_over_3_chars_on_create()
    {
        $task = factory(Task::class)->make([
            'name' => str_repeat('J', 2),
        ]);
        $this->post('/nova-api/tasks/', $task->getAttributes())
        ->assertRedirect()
        ->assertSessionHasErrors([
            'name',
        ]);
    }

    /** @test **/
    public function type_is_required_on_create()
    {
        $task = factory(Task::class)->make([
            'type' => null,
        ]);
        $this->post('/nova-api/tasks/', $task->getAttributes())
        ->assertRedirect()
        ->assertSessionHasErrors([
            'type' => 'The type field is required.',
        ]);
    }

    /** @test **/
    public function project_is_required_on_create()
    {
        $task = factory(Task::class)->make([
            'project_id' => null,
        ]);
        $this->post('/nova-api/tasks/', $task->getAttributes())
        ->assertRedirect()
        ->assertSessionHasErrors([
            'project' => 'The project field is required.',
        ]);
    }

    /** @test **/
    public function hours_must_be_numeric_on_create()
    {
        $task = factory(Task::class)->make([
            'hours' => 'asas',
        ]);
        $this->post('/nova-api/tasks/', $task->getAttributes())
        ->assertRedirect()
        ->assertSessionHasErrors([
            'hours' => 'The hours must be a number.',
        ]);
    }
}
