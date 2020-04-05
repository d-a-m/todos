<?php

namespace App\Servives\Contract;

use App\Repositories\Contract\Repository;
use App\Services\Contract\ServiceInterface;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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
     * @param  Request  $request
     * @return bool|mixed
     */
    public function create(Request $request)
    {
        $model = $this->model::create($request->all());

        if ($model) {
            return $model;
        }

        return false;
    }

    /**
     * @param  Request  $request
     * @param  Model  $model
     * @return bool|Model|mixed
     */
    public function update(Request $request, Model $model)
    {
        $model = $model->update($request->all());

        if ($model) {
            return $model;
        }

        return false;
    }

    /**
     * @param  Model  $model
     * @return bool|mixed|null
     * @throws Exception
     */
    public function delete(Model $model)
    {
        return $model->delete();
    }
}