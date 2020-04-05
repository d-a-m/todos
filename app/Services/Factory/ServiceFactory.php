<?php

namespace App\Services\Factory;

use App\Repositories\Contract\Repository;
use App\Servives\Contract\Service;
use Illuminate\Database\Eloquent\Model;

class ServiceFactory
{
    /**
     * @param string $modelName
     * @param Repository $repository
     * @return Service
     */
    public static function make(string $modelName, Repository $repository): Service
    {
        $classNamespace = explode('\\', $modelName);
        $className = end($classNamespace);

        $serviceName = 'App\Services\\' . $className . 'Service';
        $service = new $serviceName($modelName, $repository);

        return $service;
    }
}