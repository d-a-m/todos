<?php

namespace App\Services\Factory;

use App\Repositories\Contract\Repository;
use App\Servives\Contract\Service;
use Illuminate\Database\Eloquent\Model;

class ServiceFactory
{
    /**
     * @param Model $model
     * @param Repository $repository
     * @return Service
     */
    public static function make(Model $model, Repository $repository): Service
    {
        $modelName = get_class($model);

        $classNamespace = explode('\\', $modelName);
        $className = end($classNamespace);

        $serviceName = 'App\Services\\' . $className . 'Service';
        $service = new $serviceName($model, $repository);

        return $service;
    }
}