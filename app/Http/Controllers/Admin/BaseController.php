<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\SEO;
use App\Repositories\Contract\Repository;
use App\Repositories\Factory\RepositoryFactory;
use App\Services\Factory\ServiceFactory;
use App\Servives\Contract\Service;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class BaseController extends Controller
{
    /**
     * @var Repository
     */
    protected $repository;

    /**
     * @var Service
     */
    protected $service;

    /**
     * @var Model
     */
    private $model;

    /**
     * @var array
     */
    private $titles;

    /**
     * @var string
     */
    private $view;

    /**
     * BaseController constructor.
     * @param string $modelName
     * @param array $titles
     * @param string $view
     */
    public function __construct(string $modelName, array $titles, string $view)
    {
        $this->model = new $modelName();
        $this->titles = $titles;
        $this->view = $view;
        $this->repository = RepositoryFactory::make($modelName);
        $this->service = ServiceFactory::make($modelName, $this->repository);
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
     * @return View
     */
    public function create(array $additionalParams = [])
    {
        $params = [
            'meta' => SEO::getEmptyMeta($this->titles['create'])
        ];

        return view("admin.{$this->view}.create", array_merge($params, $additionalParams));
    }

    /**
     * @param $request
     * @return RedirectResponse|Redirector
     */
    public function _store($request)
    {
        $created = $this->service->create($request->all());

        if ($created) {
            return redirect("admin/{$this->view}")
                ->with('success', $this->model::$alerts['success_create']);
        }

        return back()->with('error', $this->model::$alerts['error_create']);
    }

    /**
     * @param int $id
     * @param array|null $additionalParams
     * @return Factory|View
     */
    public function edit(int $id, ?array $additionalParams = [])
    {
        if (!$id) {
            abort(404);
        }

        $model = $this->repository->getById($id);

        $params = [
            'data' => $model,
            'meta' => SEO::getEmptyMeta($this->titles['edit'])
        ];

        return view("admin.{$this->view}.create", array_merge($params, $additionalParams));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Redirector
     */
    public function _update($request, int $id)
    {
        if (!$id) {
            abort(404);
        }

        $model = $this->repository->getById($id);
        $updates = $this->service->update($request->all(), $model);

        if ($updates) {
            return redirect("admin/{$this->view}")
                ->with('success', $this->model::$alerts['success_update']);
        }

        return back()->with('error', $this->model::$alerts['error_update']);
    }

    /**
     * @param int $id
     * @return RedirectResponse|Redirector
     */
    public function destroy(int $id)
    {
        if (!$id) {
            abort(404);
        }

        $model = $this->repository->getById($id);
        try {
            $destroyed = $this->service->delete($model);

            if ($destroyed) {
                return redirect("admin/{$this->view}")
                    ->with('success', $this->model::$alerts['success_destroy']);
            }

        } catch (Exception $e) {
            logs()->info('[] с id #' . $model->id . ' не был удалён.' . $e->getMessage());
        }

        return back()->with('error', $this->model::$alerts['error_destroy']);
    }
}