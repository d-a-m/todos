<?php

namespace App\Repositories\Factory;

use App\Repositories\Contract\Repository;
use Illuminate\Database\Eloquent\Model;

class RepositoryFactory
{
    /**
     * @param Model $model
     * @return Repository
     */
    public static function make(Model $model): Repository
    {
        $model = get_class($model);

        $classNamespace = explode('\\', $model);
        $className = end($classNamespace);

        $repositoryName = 'App\Repositories\\' . $className . 'Repository';
        $repository = new $repositoryName($model);

        return $repository;
    }
}