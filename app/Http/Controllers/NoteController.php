<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    // শুধু লগইন করা ইউজারের জন্য
    public function __construct()
    {
        $this->middleware('auth');
    }

    // নোট তালিকা দেখাবে
    public function index()
    {
        $notes = Auth::user()->notes()->latest()->get();
        return inertia('Notes/Index', compact('notes'));
    }

    // নোট তৈরি করার ফর্ম দেখাবে (Optional)
    public function create()
    {
        return inertia('Notes/Create');
    }

    // নতুন নোট সংরক্ষণ করবে
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);

        Auth::user()->notes()->create($request->only('title', 'content'));

        return redirect()->route('notes.index')->with('success', 'Note created successfully.');
    }

    // একটি নোট দেখাবে (Optional)
    public function show(Note $note)
    {
        $this->authorize('view', $note);
        return inertia('Notes/Show', compact('note'));
    }

    // নোট সম্পাদনার ফর্ম দেখাবে
    public function edit(Note $note)
    {
        $this->authorize('update', $note);
        return inertia('Notes/Edit', compact('note'));
    }

    // নোট আপডেট করবে
    public function update(Request $request, Note $note)
    {
        $this->authorize('update', $note);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);

        $note->update($request->only('title', 'content'));

        return redirect()->route('notes.index')->with('success', 'Note updated successfully.');
    }

public function delete($id)
{
    $note = Note::findOrFail($id);
    return Inertia::render('Notes/Delete', compact('note'));
}

public function destroy($id)
{
    $note = Note::findOrFail($id);
    $note->delete();
    return redirect()->route('notes.index')->with('success', 'Note deleted successfully.');
}
}
