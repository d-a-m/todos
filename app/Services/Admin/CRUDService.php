<?php

namespace App\Services\Admin;

use App\Models\SEO;
use App\Repositories\Contract\Repository;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\View;

class CRUDService
{
    /**
     * @var Repository
     */
    protected $repository;

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var array
     */
    private $titles;

    /**
     * @var string
     */
    private $view;

    /**
     * Service constructor.
     * @param array $params
     */
    public function __construct(array $params)
    {
        $this->model = new $params['model']();
        $this->titles = $params['titles'];
        $this->view = $params['view'];
        $this->repository = $params['repository'];
    }

    /**
     * @return View
     */
    public function index()
    {
        $models = $this->repository->getAll()->paginate(200);

        $params = [
            'data' => $models,
            'meta' => SEO::getEmptyMeta($this->titles['index'])
        ];

        return view("admin.{$this->view}.index", $params);
    }

    /**
     * @param array $additionalParams
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function create(array $additionalParams = [])
    {
        $params = [
            'meta' => SEO::getEmptyMeta($this->titles['create']),
        ];

        return view("admin.{$this->view}.create", array_merge($params, $additionalParams));
    }

    /**
     * @param array $data
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
     */
    public function store(array $data)
    {
        $model = $this->model::create($data);

        if ($model) {
            return redirect("admin/{$this->view}")
                ->with('success', $this->model->alerts['success_create']);
        }

        return back()->with('error', $this->model->alerts['error_create']);
    }

    /**
     * @param array $additionalParams
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function edit(array $additionalParams = [])
    {
        $params = [
            'meta' => SEO::getEmptyMeta($this->titles['edit']),
        ];

        return view("admin.{$this->view}.create", array_merge($params, $additionalParams));
    }

    /**
     * @param array $data
     * @param $model
     * @return bool|mixed
     */
    public function update(array $data, $model)
    {
        $model = $model->update($data);

        if ($model) {
            return redirect("admin/{$this->view}")
                ->with('success', $this->model->alerts['success_update']);
        }

        return back()->with('error', $this->model->alerts['error_update']);
    }

    /**
     * @param $model
     * @return mixed
     */
    public function destroy($model)
    {
        try {
            if ($model->delete($model)) {
                return redirect("admin/{$this->view}")
                    ->with('success', $this->model->alerts['success_destroy']);
            }

        } catch (Exception $e) {
            logs()->info('[' . $this->model .  '] с id #' . $model->id . ' не был удалён.' . $e->getMessage());
        }

        return back()->with('error', $this->model->alerts['error_destroy']);
    }
}