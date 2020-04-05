<?php

namespace App\Repositories\Contract;

abstract class Repository implements RepositoryInterface
{
    /**
     * @var
     */
    protected $model;

    /**
     * Repository constructor.
     * @param $model
     */
    public function __construct($model)
    {
        $this->model = new $model();
    }

    /**
     * @param array|int $id
     * @param array|null $fields
     * @return mixed|null
     */
    public function getById($id, ?array $fields = [])
    {
        if (! $id) {
            return null;
        }

        $result = $this->model::find($id);

        if ($fields) {
            $result = $result->pluck(...$fields);
        }

        return $result;
    }

    /**
     * @param  string  $field
     * @param  string  $value
     * @return |null
     */
    public function getByField(string $field, string $value)
    {
        if (! $field) {
            return null;
        }

        $model = $this->model::where($field, '=', $value)->first();

        return $model;
    }


    /**
     * @param string $orderField
     * @param string $orderType
     * @param array $where
     * @return mixed
     */
    public function getAll(string $orderField = 'id', string $orderType = 'desc', array $where = [])
    {
        $data = !empty($fields) ?
            $this->model::orderBy($orderField, $orderType)->where($where)->get($fields) :
            $this->model::orderBy($orderField, $orderType)->where($where);

        return $data;
    }
}