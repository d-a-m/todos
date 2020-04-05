<?php

namespace App\Repositories\Contract;


interface RepositoryInterface
{
    /**
     * @param $id
     * @param array|null $fields
     * @return mixed
     */
    public function getById($id, ?array $fields = []);


    /**
     * @return mixed
     */
    public function getAll();

}