<?php

namespace App\Repositories\Factory;

use App\Repositories\Contract\Repository;

class RepositoryFactory
{
    /**
     * @param string $modelName
     * @return Repository|null
     */
    public static function make(string $modelName): ?Repository
    {
        $classNamespace = explode('\\', $modelName);
        $className = end($classNamespace);

        $repositoryName = 'App\Repositories\\' . $className . 'Repository';

        try {
            $repository = new $repositoryName($modelName);
        } catch (\Exception $e) {
            return null;
        }

        return $repository;
    }
}