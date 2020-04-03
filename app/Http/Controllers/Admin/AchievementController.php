<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AchievementRequest;
use App\Models\Achievement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class AchievementController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new Achievement(), [
            'index' => 'Все достижения',
            'create' => 'Создать достижение',
            'edit' => 'Отредактировать достижение',
        ], 'achievements');
    }

    /**
     * @param AchievementRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(AchievementRequest $request)
    {
        return parent::_store($request);
    }

    /**
     * @param AchievementRequest $request
     * @param int $id
     * @return RedirectResponse|Redirector
     */
    public function update(AchievementRequest $request, int $id)
    {
        return parent::_update($request, $id);
    }
}
