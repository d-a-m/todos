<?php

namespace App\Servives\Contract;

use App\Repositories\Contract\Repository;
use App\Services\Contract\ServiceInterface;
use Illuminate\Database\Eloquent\Model;

abstract class Service implements ServiceInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @var Repository
     */
    protected $repository;

    /**
     * Service constructor.
     * @param  string  $modelName
     * @param  Repository  $repository
     */
    public function __construct(string $modelName, Repository $repository)
    {
        $this->model = new $modelName();
        $this->repository = $repository;
    }

    /**
     * @param  array  $data
     * @return bool|mixed
     */
    public function create(array $data)
    {
        $model = $this->model::create($data);

        if ($model) {
            return $model;
        }

        return false;
    }

    /**
     * @param  array  $data
     * @param $model
     * @return bool|mixed
     */
    public function update(array $data, $model)
    {
        $model = $model->update($data);

        if ($model) {
            return $model;
        }

        return false;
    }

    /**
     * @param $model
     * @return mixed
     */
    public function delete($model)
    {
        return $model->delete();
    }
}