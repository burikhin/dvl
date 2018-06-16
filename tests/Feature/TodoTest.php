<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_get_all_todos()
    {
        $todos = factory('App\Todo', 3)->create();

        $this->get('/api/todo')
            ->assertStatus(200)
            ->assertJson($todos->toArray());
    }

    /** @test */
    public function can_create_todo()
    {
        $todo = factory('App\Todo')->make()->toArray();

        $this->post('/api/todo', $todo)
            ->assertStatus(201)
            ->assertJson($todo);

        $this->assertDatabaseHas('todos', $todo);
    }

    /** @test */
    public function can_get_a_validation_error_when_trying_to_create_an_empty_todo()
    {
        $this->post('/api/todo', [])
            ->assertStatus(302);
    }
}
