
<?php
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use App\Http\Controllers\AIController;


Route::post('/ai/summarize', [AIController::class, 'summarize']);

