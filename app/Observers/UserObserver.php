<?php

namespace App\Observers;

use App\Helpers\TokenHelper;
use App\Models\Todo;
use App\Models\User;
use App\Repositories\Factory\RepositoryFactory;
use App\Repositories\TodoRepository;
use App\Repositories\UserRepository;

class UserObserver
{
    /**
     * @var TodoRepository
     */
    private $todoRepo;
    /**
     * @var UserRepository
     */
    private $userRepo;

    /**
     * UserObserver constructor.
     */
    public function __construct()
    {
        $this->todoRepo = RepositoryFactory::make(Todo::class);
        $this->userRepo = RepositoryFactory::make(User::class);
    }

    /**
     * @param  User  $model
     */
    public function creating(User $model)
    {
        $this->api_token = TokenHelper::generateToken();
    }

    /**
     * @param  User  $user
     */
    public function deleting(User $user)
    {
        $todos = $user->todos()->delete();
    }

}
