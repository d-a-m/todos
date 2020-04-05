<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Массив с дежурными сообщениями о результате выполненной операции
     * @var array
     */
    public static $alerts = [
        'success_create' => 'Пользователь успешно добавлен!',
        'error_create' => 'Пользователь не был добавлен!',
        'success_update' => 'Пользователь успешно отредактирован!',
        'error_update' => 'Пользователь не был отредактирован!',
        'success_destroy' => 'Пользователь успешно удалён!',
        'error_destroy' => 'Пользователь не был удалён!',
    ];

    /**
     * @return HasMany
     */
    public function todos()
    {
        return $this->hasMany(Todo::class);
    }
}
