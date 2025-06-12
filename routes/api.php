
<?php
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use App\Http\Controllers\AIController;
use App\Http\Controllers\TagController;


Route::post('/ai/summarize', [AIController::class, 'summarize']);

Route::post('/ai/tags', [TagController::class, 'generateTags']);
