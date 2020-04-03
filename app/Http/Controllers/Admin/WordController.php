<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\WordRequest;
use App\Models\Category;
use App\Models\Word;
use App\Repositories\Factory\RepositoryFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class WordController extends BaseController
{
    private $categoryRepo;

    public function __construct()
    {
        parent::__construct(new Word(), [
            'index' => 'Все слова',
            'create' => 'Создать слово',
            'edit' => 'Отредактировать слово',
        ], 'words');

        $this->categoryRepo = RepositoryFactory::make(new Category());
    }

    /**
     * @param array $additionalParams
     * @return View
     */
    public function create(array $additionalParams = [])
    {
        $categories = $this->categoryRepo->getAll()->get();
        $params = [
            'categories' => $categories,
        ];

        return parent::create($params);
    }

    /**
     * @param int $id
     * @param array $additionalParams
     * @return Factory|View
     */
    public function edit(int $id, array $additionalParams = [])
    {
        $categories = $categories = $this->categoryRepo->getAll()->get();
        $params = [
            'categories' => $categories,
        ];

        return parent::edit($id, $params);
    }

    /**
     * @param WordRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(WordRequest $request)
    {
        return parent::_store($request);
    }

    /**
     * @param WordRequest $request
     * @param int $id
     * @return RedirectResponse|Redirector
     */
    public function update(WordRequest $request, int $id)
    {
        return parent::_update($request, $id);
    }
}
