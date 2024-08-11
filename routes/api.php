<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TelegramClientController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/telegram/webhook', [TelegramClientController::class, 'webhook']);
Route::get('/telegram/get-updates', [TelegramClientController::class, 'getUpdates']);
Route::post('/telegram/send-message', [TelegramClientController::class, 'sendMessage']);
Route::get('/test', function () {
    return response()->json(['status' => 'success']);
});