<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Todo extends Model
{
    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Массив с дежурными сообщениями о результате выполненной операции
     * @var array
     */
    public static $alerts = [
        'success_create' => 'Задача успешно добавлена!',
        'error_create' => 'Задача не была добавлена!',
        'success_update' => 'Задача успешно отредактирована!',
        'error_update' => 'Задача не была отредактирована!',
        'success_destroy' => 'Задача успешно удалёна!',
        'error_destroy' => 'Задача не была удалёна!',
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function transferredScope()
    {
        return DB::table('transferred_todo')
            ->where('todo_id', '=', $this->id)
            ->get();
    }
}
