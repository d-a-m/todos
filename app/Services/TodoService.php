<?php

namespace App\Services;

use App\Models\Todo;
use App\Servives\Contract\Service;

class TodoService extends Service {

    /**
     * @param  array  $data
     * @return bool
     */
    public function _create(array $data)
    {
        $model = $this->model::create($data);

        if ($model) {
            return $model;
        }

        return false;
    }

    /**
     * @param  Todo  $todo
     * @param  array  $data
     * @return bool
     */
    public function _update(Todo $todo, array $data)
    {
        $model = $todo->update($data);

        if ($model) {
            return $model;
        }

        return false;
    }
}