<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeasController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|max:240|min:4',
        ]);

        $idea = Idea::create([
            'content' => $request->input('content'),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Idea created successfully!');
    }

    public function destroy($id)
    {
        $idea = Idea::findOrFail($id);

        // Check if the logged-in user is the owner
        // if (auth()->id() !== $idea->user_id) {
        //     return redirect()->route('dashboard')->with('error', 'You are not authorized to delete this idea.');
        // }

        $this->authorize('delete', $idea);

        $idea->delete();
        return redirect()->route('dashboard')->with('success', 'Idea deleted successfully!');
    }

    public function show(Idea $idea)
    {
        return view('ideas.show', compact('idea'));
    }

    public function edit(Idea $idea)
    {
        // if (auth()->id() !== $idea->user_id) {
        //     return redirect()->route('dashboard', $idea->id)->with('error', 'You are not authorized to edit this idea.');
        // }
        $this->authorize('update', $idea);

        $editing = true;
        return view('ideas.show', compact('idea', 'editing'));
    }

    public function update(Idea $idea)
    {
        // if (auth()->id() !== $idea->user_id) {
        //     return redirect()->route('dashboard', $idea->id)->with('error', 'You are not authorized to update this idea.');
        // }
        $this->authorize('update', $idea);
        request()->validate([
            'content' => 'required|max:240|min:4',
        ]);

        $idea->update([
            'content' => request('content'),
        ]);

        $idea->save();
        return redirect()->route('ideas.show', $idea->id)->with('success', 'Idea updated successfully!');
    }

    public function like(Idea $idea)
    {
        $liker = auth()->user();
        $liker->likes()->attach($idea);
        return redirect()->route('ideas.show', $idea->id)->with('success', 'Idea liked successfully!');
    }
    public function unlike(Idea $idea)
    {
        $liker = auth()->user();
        $liker->likes()->detach($idea);
        return redirect()->route('ideas.show', $idea->id)->with('success', 'Idea unliked successfully!');
    }
}
