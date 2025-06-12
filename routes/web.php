<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\NoteController;
use Illuminate\Http\Request;
use Inertia\Inertia;


Route::get('/', function () {

    if (!auth()->check()) {
        return Inertia::render('Login');
    }

    return redirect()->route('notes.index');
});

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::get('/logout', [GoogleController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::resource('notes', NoteController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');
    Route::get('/notes/{note}', [NoteController::class, 'edit'])->name('notes.edit');
    Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
    Route::put('/notes/{note}', [NoteController::class, 'update'])->name('notes.update');
    Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');
});


Route::get('/test', function () {
    return Inertia::render('Test');
});

Route::get('/tags', function () {
    return Inertia::render('TagGenerator');
});



Route::match(['get', 'post'], '/keyword', function (Request $request) {
    if ($request->isMethod('post')) {
        $text = $request->input('text', '');

        $words = str_word_count(strtolower($text), 1);
        $freq = array_count_values($words);
        arsort($freq);
        $top = array_slice(array_keys($freq), 0, 5);

        return response()->json(['keywords' => $top]);
    }

    return <<<HTML
        <form method="POST" action="/keyword">
            <textarea name="text" rows="5" cols="40" placeholder="Paste your text here..."></textarea><br>
            <button type="submit">Extract Keywords</button>
        </form>
    HTML;
});
