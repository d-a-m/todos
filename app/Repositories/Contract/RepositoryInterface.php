<?php

namespace App\Repositories\Contract;


interface RepositoryInterface
{
    /**
     * @param int $id
     * @param array $fields
     * @return mixed
     */
    public function getById(int $id, array $fields=[]);

    /**
     * @param array $fields
     * @return mixed
     */
    public function getAll(array $fields=[]);

    /**
     * @param int $id
     * @param string $cacheKey
     * @return mixed
     */
    public function getCachedById(int $id, string $cacheKey);

    /**
     * @param string $cacheKey
     * @param string $orderField
     * @param string $orderType
     * @return mixed
     */
    public function getAllCached(string $cacheKey, string $orderField = 'rating', string $orderType = 'desc');
}