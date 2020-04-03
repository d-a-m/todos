<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new Category(), [
            'index' => 'Все категории',
            'create' => 'Создать категорию',
            'edit' => 'Отредактировать категорию',
        ], 'categories');
    }

    /**
     * @param CategoryRequest $request
     * @return mixed
     */
    public function store(CategoryRequest $request)
    {
        return parent::_store($request);
    }

    /**
     * @param CategoryRequest $request
     * @param int $id
     * @return mixed
     */
    public function update(CategoryRequest $request, int $id)
    {
        return parent::_update($request, $id);
    }
}
