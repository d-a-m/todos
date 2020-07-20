<?php

namespace App\Services\Admin\Factory;

use App\Services\Admin\CRUDService;

class ServiceFactory
{
    /**
     * @param array $params
     * @return CRUDService
     */
    public static function make(array $params): CRUDService
    {
        $classNamespace = explode('\\', $params['model']);
        $className = end($classNamespace);

        $serviceName = 'App\Services\Admin\\' . $className . 'Service';
        $service = new $serviceName($params);

        return $service;
    }
}