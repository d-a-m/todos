<?php

namespace App\Http\Controllers\Api;

use App\Api\Transformers\FactoryTransformers;
use App\Models\Todo;
use App\Models\User;
use App\Repositories\Contract\Repository;
use App\Repositories\Factory\RepositoryFactory;
use App\Services\TodoService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class WordController
 * @package App\Http\Controllers\Api
 */
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
    private $todoService;

    /**
     * TodoController constructor.
     */
    public function __construct()
    {
        $this->userRepo = RepositoryFactory::make(User::class);
        $this->todoRepo = RepositoryFactory::make(Todo::class);

        $this->todoService = new TodoService(Todo::class, $this->todoRepo);
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     * @throws Exception
     */
    public function getByUser(Request $request)
    {
        $input = $request->all();

        if (!$input) {
            return $this->respondBadRequest();
        }

        $page = (int) filter_var($input['page'], FILTER_SANITIZE_NUMBER_INT);
        $perPage = (int) filter_var($input['perPage'], FILTER_SANITIZE_NUMBER_INT);
        $token = filter_var($input['api_token'], FILTER_SANITIZE_STRING);

        if (!$token) {
            return $this->respondUnauthorized();
        }

        $user = $this->userRepo->getByField('api_token', $token);

        if (!$user) {
            return $this->respondNotFound('User has not been found!');
        }

        $todos = $user->todos();
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
     * @param  Request  $request
     * @return JsonResponse
     */
    public function delegateTodo(Request $request)
    {
        $input = $request->all();

        if (!$input) {
            return $this->respondBadRequest();
        }

        $userToId = (int) filter_var($input['user_to'], FILTER_SANITIZE_NUMBER_INT);
        $todoId = (int) filter_var($input['todo_id'], FILTER_SANITIZE_NUMBER_INT);
        $token = filter_var($input['api_token'], FILTER_SANITIZE_STRING);

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

        $isDelegated = $this->todoService->_update($todo, [
            'user_id' => $userToId,
        ]);

        return $this->respond([
            'response' => [
                'is_delegated' => $isDelegated,
            ]
        ]);
    }


}
