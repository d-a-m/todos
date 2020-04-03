<?php

namespace App\Services\Contract;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Interface ServiceInterface
 * @package App\Services\Contract
 */
interface ServiceInterface
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request);

    /**
     * @param $request
     * @param Model $model
     * @return mixed
     */
    public function update(Request $request, Model $model);

    /**
     * @param Model $model
     * @return mixed
     */
    public function delete(Model $model);
}