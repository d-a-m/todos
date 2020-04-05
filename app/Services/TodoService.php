<?php

namespace App\Services;

use App\Models\Todo;
use App\Servives\Contract\Service;

class TodoService extends Service {

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