<?php


namespace App\Services\Models;


use App\Http\Traits\ApiResponseTrait;
use App\Models\Todo;

class TodoService
{
    use ApiResponseTrait;

    /**
     * @param array $data
     * @return bool
     */
    public function store(array $data): bool
    {
        return (bool)Todo::create($data);
    }

    /**
     * @param array $data
     * @param Todo $todo
     * @return bool
     */
    public function update(array $data, Todo $todo): bool
    {
        return (bool)$todo->update($data);
    }

    /**
     * @param Todo $todo
     * @return bool
     * @throws \Exception
     */
    public function delete(Todo $todo)
    {
        return (bool)$todo->delete();
    }
}