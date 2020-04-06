<?php

namespace App\Http\Controllers\Api;

use App\Api\Transformers\FactoryTransformers;
use App\Models\User;
use App\Repositories\Contract\Repository;
use App\Repositories\Factory\RepositoryFactory;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class UserController
 * @package App\Http\Controllers\Api
 */
class UserController extends ApiController
{

    /**
     * @var Repository
     */
    private $userRepo;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->userRepo = RepositoryFactory::make(User::class);
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     * @throws Exception
     */
    public function getAll(Request $request)
    {
        $input = $request->all();

        if (!$input) {
            return $this->respondBadRequest();
        }

        $token = filter_var($input['api_token'] ?? '', FILTER_SANITIZE_STRING);

        if (!$token) {
            return $this->respondUnauthorized();
        }

        $users = $this->userRepo->getAll()->get()->toArray();

        if (!$users) {
            return $this->respondNotFound('User has not been found!');
        }

        $items = FactoryTransformers::make('user')->transformCollection($users);

        return $this->respond([
            'response' => [
                'items' => $items,
                'count' => count($users)
            ]
        ]);
    }
}
