<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Idea;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $this->authorize('isAdmin');  //use gate to check if the user is an admin

        $totalUsers=User::count(); //get total number of users
        $totalIdeas=Idea::count(); //get total number of ideas
        $totalComments=Comment::count(); //get total number of comments

        return view('admin.dashboard', compact('totalUsers', 'totalIdeas', 'totalComments'));
    }
}
