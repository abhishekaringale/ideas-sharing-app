<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $ideas = Idea::with('user', 'comments.user')->orderBy('created_at', 'desc');

        if ($request->has('search')) {
            $ideas = $ideas->where('content', 'like', '%' . $request->input('search') . '%');
        }

        // $topUsers = User::withCount('ideas')->orderBy('ideas_count', 'desc')->limit(5)->get();
        return view('dashboard', ['ideas' => $ideas->paginate(5)]);
    }
}
