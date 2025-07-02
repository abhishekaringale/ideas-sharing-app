<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {

        $ideas = $user->ideas()->paginate(5);
        return view('users.show', compact('user', 'ideas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        $ideas = $user->ideas()->paginate(5);
        $editing = true;
        return view('users.show', compact('user', 'editing', 'ideas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $this->authorize('update', $user);

        $validate = $request->validate([
            'name' => 'required|max:255',
            'bio' => 'nullable|string|max:255',
            'image' => 'image',
        ]);


        if ($request->hasFile('image')) {
            $validate['image'] = $request->file('image')->store('profile', 'public');

            // Delete old image if exists
            Storage::disk('public')->delete($user->image ?? '');
        }
        $user->update($validate);
        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }

    public function profile()
    {
        return $this->show(auth()->user());
    }


    public function follow(User $user){
        $follower = auth()->user();

        $follower->following()->attach($user->id);
        return redirect()->route('users.show', $user->id)->with('success', 'You are now following ' . $user->name);
    }
    public function unfollow(User $user){
        $follower = auth()->user();

        $follower->following()->detach($user->id);
        return redirect()->route('users.show', $user->id)->with('success', 'You are no longer following ' . $user->name);
    }
}
