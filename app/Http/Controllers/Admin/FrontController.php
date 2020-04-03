<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    public function index()
    {
        $params = [
            'meta' => [
                'title' => 'Администрация'
            ]
        ];

        return view('admin.front.index', $params);
    }
}
