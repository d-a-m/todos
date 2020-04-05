<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class TodoController extends BaseController
{
    /**
     * TodoController constructor.
     */
    public function __construct()
    {
        parent::__construct(Todo::class, [
            'index' => 'Все задачи',
            'edit' => 'Отредактировать задачу',
        ], 'todo');
    }

    /**
     * @param  array  $additionalParams
     * @return View
     */
    public function create(array $additionalParams = [])
    {
        return parent::create();
    }

    /**
     * @param  int  $id
     * @param  array|null  $additionalParams
     * @return Factory|View
     */
    public function edit(int $id, ?array $additionalParams = [])
    {
        if (!$id) {
            abort(404);
        }

        $model = $this->repository->getById($id);
        $additionalParams['author'] = $model->author;

        return parent::edit($id, $additionalParams);
    }


    /**
     * @param  TodoRequest  $request
     * @return RedirectResponse|Redirector
     */
    public function store(TodoRequest $request)
    {
        return parent::_store($request);
    }

    /**
     * @param  TodoRequest  $request
     * @param  int  $id
     * @return RedirectResponse|Redirector
     */
    public function update(TodoRequest $request, int $id)
    {
        return parent::_update($request, $id);
    }
}
