<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->paginate(10);

        return view('admin.users.index',[
            'users' => $users,
        ]);
    }
}
