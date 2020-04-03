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
        $this->model = $model;
    }

    /**
     * @param int $id
     * @param array $fields
     * @return mixed|null
     */
    public function getById(int $id, array $fields = [])
    {
        if (! $id) {
            return null;
        }

        if (! empty($fields)) {
            return $this->model::find($id)->get($fields);
        }

        return $this->model::find($id);
    }

    /**
     * @param array $id
     * @param array $fields
     * @return |null
     */
    public function getByIds(array $ids, array $fields = [])
    {
        if (! $ids) {
            return null;
        }

        if (! empty($fields)) {
            return $this->model::find($ids)->get($fields);
        }

        return $this->model::find($ids);
    }

    /**
     * @param array $fields
     * @param string $orderField
     * @param string $orderType
     * @param array $where
     * @return mixed
     */
    public function getAll(array $fields = [], string $orderField = 'id', string $orderType = 'desc', array $where = [])
    {
        $data = !empty($fields) ?
            $this->model::orderBy($orderField, $orderType)->where($where)->get($fields) :
            $this->model::orderBy($orderField, $orderType)->where($where);

        return $data;
    }

    /**
     * @param int $id
     * @param string $cacheKey
     * @return mixed
     * @throws \Exception
     */
    public function getCachedById(int $id, string $cacheKey)
    {
        return \cache()->remember($cacheKey . '.models.' . $id, now()->addMonth(1), function () use ($id) {

            $model = self::getById($id) or abort(404);
            if (!$model->is_active) {
                abort(404);
            }

            return $model;
        });
    }

    /**
     * @param string $cacheKey
     * @param string $orderField
     * @param string $orderType
     * @return mixed
     * @throws \Exception
     */
    public function getAllCached(string $cacheKey, string $orderField = 'rating', string $orderType = 'desc')
    {
        return \cache()->remember($cacheKey . '.models', now()->addMonth(1), function () use ($orderField, $orderType) {
            return self::getAll([], $orderField, $orderType)->get();
        });
    }

    /**
     * @param string $cacheKey
     * @param string $orderField
     * @param string $orderType
     * @return mixed
     * @throws \Exception
     */
    public function getAllActiveCached(string $cacheKey, string $orderField = 'rating', string $orderType = 'desc')
    {
        return \cache()->remember($cacheKey . '.models.active', now()->addMonth(1), function () use ($orderField, $orderType) {
            return self::getAll([], $orderField, $orderType)->active()->get();
        });
    }
}