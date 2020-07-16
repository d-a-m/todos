<?php

namespace Tests\Unit;

use App\Models\Todo;
use Tests\TestCase;

class TodoTest extends TestCase
{
    public function test_can_add_todo_without_token()
    {

        $data = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
        ];

        $this->post(route('todo.add'), $data)
            ->assertStatus(401);
    }

    public function test_can_add_todo_with_token()
    {

        $data = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'api_token' => 'teuqO69FT8P86pgktdDS9v9PUFLwSFBt7NXKFRyC104WkfFJDGvPJV7Uq3uc'
        ];

        $this->post(route('todo.add'), $data)
            ->assertStatus(201);
    }


    public function test_can_edit_todo_without_token()
    {
        $todo = factory(Todo::class)->create();

        $data = [
            'todo_id' => $todo->id,
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
        ];

        $this->patch(route('todo.edit', $todo->id), $data)
            ->assertStatus(401);
    }

    public function test_can_edit_todo_with_token()
    {
        $todo = factory(Todo::class)->create();

        $data = [
            'todo_id' => $todo->id,
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'api_token' => 'teuqO69FT8P86pgktdDS9v9PUFLwSFBt7NXKFRyC104WkfFJDGvPJV7Uq3uc'
        ];

        $this->patch(route('todo.edit', $todo->id), $data)
            ->assertStatus(200);
    }

    public function test_can_delete_todo_without_token() {

        $todo = factory(Todo::class)->create();

        $this->delete(route('todo.delete', $todo->id))
            ->assertStatus(401);
    }

    public function test_can_delete_todo_with_token() {

        $todo = factory(Todo::class)->create();

        $data = [
            'todo_id' => $todo->id,
            'api_token' => 'teuqO69FT8P86pgktdDS9v9PUFLwSFBt7NXKFRyC104WkfFJDGvPJV7Uq3uc'
        ];

        $this->delete(route('todo.delete', $todo->id), $data)
            ->assertStatus(200);
    }


    public function test_can_list_todo_by_user_without_token() {
        $todos = factory(Todo::class, 2)->create()->map(function ($todo) {
            return $todo->only(['id', 'title', 'content']);
        });

        $data = [
            'page' => 1,
            'perPage' => 2,
            'api_token' => 'teuqO69FT8P86pgktdDS9v9PUFLwSFBt7NXKFRyC104WkfFJDGvPJV7Uq3uc'
        ];

        $this->call('GET', '/api/todos/get-by-user', $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'response' => [
                    'items' => [
                        [
                            'id',
                            'title',
                            'description',
                            'user_id',
                            'created_at',
                            'updated_at'
                        ]
                    ],
                    'count'
                ]
            ]);
    }
}
