<?php

namespace App\Http\Controllers\Api;

use App\Helpers\TokenHelper;
use App\Models\User;
use App\Repositories\Factory\RepositoryFactory;
use Illuminate\Http\Request;

class TokenController extends ApiController
{
    /**
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateToken(Request $request)
    {
        $oldToken = filter_var($request->get('api_token'), FILTER_SANITIZE_STRING);
        $userRepository = RepositoryFactory::make(User::class);

        $user = $userRepository->getByField('api_token', $oldToken);

        if (!$user) {
            return $this->respondBadRequest();
        }

        $newToken = TokenHelper::generateToken();

        return $this->respond([
            'response' => [
                'api_token' => $newToken
            ]
        ]);
    }
}
