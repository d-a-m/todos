<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class UserController extends BaseController
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        parent::__construct(User::class, [
            'index' => 'Все пользователи',
            'create' => 'Создать пользователя',
            'edit' => 'Отредактировать пользователя',
        ], 'user');
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
        return parent::edit($id, $additionalParams);
    }

    /**
     * @param  UserRequest  $request
     * @return RedirectResponse|Redirector
     */
    public function store(UserRequest $request)
    {
        return parent::_store($request);
    }

    /**
     * @param  UserRequest  $request
     * @param  int  $id
     * @return RedirectResponse|Redirector
     */
    public function update(UserRequest $request, int $id)
    {
        return parent::_update($request, $id);
    }
}
