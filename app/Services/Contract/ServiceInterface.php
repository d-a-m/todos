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
     * @param  array  $data
     * @return mixed
     */
    public function create(array $data);

     /**
     * @param  array  $data
     * @param $model
     * @return mixed
     */
    public function update(array $data, $model);

    /**
     * @param $model
     * @return mixed
     */
    public function delete($model);
}