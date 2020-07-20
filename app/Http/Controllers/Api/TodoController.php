<?php

namespace App\Http\Controllers\Api;

use App\Api\Transformers\FactoryTransformers;
use App\Http\Requests\Api\TodoAddRequest;
use App\Http\Requests\Api\TodoDeleteRequest;
use App\Http\Requests\Api\TodoEditRequest;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use App\Models\User;
use App\Repositories\Contract\Repository;
use App\Repositories\Factory\RepositoryFactory;
use App\Services\Admin\CRUDService;
use App\Services\Models\TodoService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends ApiController
{
    /**
     * @var Repository
     */
    private $userRepo;

    /**
     * @var Repository
     */
    private $todoRepo;

    /**
     * @var TodoService
     */
    protected $service;

    /**
     * TodoController constructor.
     */
    public function __construct()
    {
        $this->userRepo = RepositoryFactory::make(User::class);
        $this->todoRepo = RepositoryFactory::make(Todo::class);

        $this->service = new TodoService();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function getByUser(Request $request)
    {
        $input = $request->all();

        if (!$input) {
            return $this->respondBadRequest();
        }

        $page = (int)filter_var($input['page'] ?? '', FILTER_SANITIZE_NUMBER_INT);
        $perPage = (int)filter_var($input['perPage'] ?? '', FILTER_SANITIZE_NUMBER_INT);
        $token = filter_var($input['api_token'] ?? '', FILTER_SANITIZE_STRING);

        if (!$token) {
            return $this->respondUnauthorized();
        }

        $user = $this->userRepo->getByField('api_token', $token);

        if (!$user) {
            return $this->respondNotFound('User has not been found!');
        }

        $todos = $user->todos()->orderBy('id', 'desc');
        $page = $page ?: 1;
        $skip = $page ? $perPage * ($page - 1) : 0;
        $rawItems = $todos->take($perPage)->skip($skip)->get()->toArray();

        $items = FactoryTransformers::make('todo')->transformCollection($rawItems);

        return $this->respond([
            'response' => [
                'items' => $items,
                'count' => $user->todos()->count()
            ]
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function delegateTodo(Request $request)
    {
        $input = $request->all();

        if (!$input) {
            return $this->respondBadRequest();
        }

        $userToId = (int)filter_var($input['user_to'] ?? '', FILTER_SANITIZE_NUMBER_INT);
        $todoId = (int)filter_var($input['todo_id'] ?? '', FILTER_SANITIZE_NUMBER_INT);
        $token = filter_var($input['api_token'] ?? '', FILTER_SANITIZE_STRING);

        if (!$token) {
            return $this->respondUnauthorized();
        }

        $user = $this->userRepo->getByField('api_token', $token);
        $userTo = $this->userRepo->getById($userToId);

        if (!$user || !$userTo) {
            return $this->respondNotFound('User has not been found!');
        }

        $todo = $this->todoRepo->getById($todoId);

        if (!$todo) {
            return $this->respondNotFound('Todo has not been found!');
        }

        if ($user->cannot('update', $todo)) {
            return $this->respondBadRequest();
        }

        $isDelegated = $this->service->update([
            'user_id' => $userToId,
        ], $todo);

        return $this->respond([
            'response' => [
                'is_delegated' => $isDelegated,
            ]
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function addTodo(TodoAddRequest $request)
    {
        $title = filter_var($request->get('title') ?? '', FILTER_SANITIZE_STRING);
        $description = filter_var($request->get('description') ?? '', FILTER_SANITIZE_STRING);
        $token = filter_var($request->get('api_token') ?? '', FILTER_SANITIZE_STRING);

        if (! $token) {
            return $this->respondUnauthorized();
        }

        $user = $this->userRepo->getByField('api_token', $token);

        if (! $user) {
            return $this->respondNotFound('User has not been found!');
        }

        $params = [
            'title' => $title,
            'description' => $description,
            'user_id' => $user->id,
        ];

        $isAdded = $this->service->store($params);

        return $this->setStatusCode(201)->respond([
            'response' => [
                'is_added' => $isAdded,
            ]
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function editTodo(TodoEditRequest $request)
    {
        $todoId = (int)filter_var($request->get('todo_id') ?? 0, FILTER_SANITIZE_NUMBER_INT);
        $title = filter_var($request->get('title') ?? '', FILTER_SANITIZE_STRING);
        $description = filter_var($request->get('description') ?? '', FILTER_SANITIZE_STRING);
        $token = filter_var($request->get('api_token') ?? '', FILTER_SANITIZE_STRING);

        if (!$token) {
            return $this->respondUnauthorized();
        }

        $user = $this->userRepo->getByField('api_token', $token);

        if (!$user) {
            return $this->respondNotFound('User has not been found!');
        }

        $todo = $this->todoRepo->getById($todoId);

        if (!$todo) {
            return $this->respondNotFound('Todo has not been found!');
        }

        if ($user->cannot('update', $todo)) {
            return $this->respondBadRequest();
        }

        $params = [
            'title' => $title,
            'description' => $description,
        ];
        $isEdited = $this->service->update($params, $todo);

        return $this->respond([
            'response' => [
                'is_edited' => $isEdited,
            ]
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function deleteTodo(TodoDeleteRequest $request)
    {
        $todoId = (int)filter_var($request->get('todo_id') ?? 0, FILTER_SANITIZE_NUMBER_INT);
        $token = filter_var($request->get('api_token') ?? '', FILTER_SANITIZE_STRING);

        if (!$token) {
            return $this->respondUnauthorized();
        }

        $user = $this->userRepo->getByField('api_token', $token);

        if (!$user) {
            return $this->respondNotFound('User has not been found!');
        }

        $todo = $this->todoRepo->getById($todoId);

        if (!$todo) {
            return $this->respondNotFound('Todo has not been found!');
        }

        if ($user->cannot('update', $todo)) {
            return $this->respondBadRequest();
        }

        return $this->respond([
            'response' => [
                'is_deleted' => $this->service->delete($todo),
            ]
        ]);
    }
}
