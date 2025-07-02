<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(){
        $this->authorize('isAdmin');  //use gate to check if the user is an admin

        $users = User::latest()->paginate(5);

        return view('admin.users.index',compact('users'));
    }
}
