<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UsersController extends Controller
{
    public function index () {
        return view('admin.users.index', [
            'users' => User::all()
        ]);
    }
}
