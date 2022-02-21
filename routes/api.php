<?php

use App\Http\Controllers\CandidateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('candidates', CandidateController::class);
Route::post('candidates/{candidate}/timeline', [CandidateController::class, 'getTimeline']);
Route::post('candidates/statuses/{status}', [CandidateController::class, 'getByStatus']);
Route::post('candidates/{candidate}/skills/{skill}', [CandidateController::class, 'attachSkill']);
Route::delete('candidates/{candidate}/skills/{skill}', [CandidateController::class, 'detachSkill']);


Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found.'
    ], 404);
});
