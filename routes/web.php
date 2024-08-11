<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('/lang/{locale}', [\App\Http\Controllers\LanguageController::class, 'changeLanguage'])->name('lang.switch');

Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', '\App\Http\Controllers\TenantController@dashboard')->name('tenant.dashboard');
        Route::get('/tiktok', '\App\Http\Controllers\TenantController@dashboard')->name('tiktok');
        Route::get('/instagram', '\App\Http\Controllers\TenantController@dashboard')->name('instagram');
        Route::get('/facebook', '\App\Http\Controllers\TenantController@dashboard')->name('facebook');
        Route::get('/youtube', '\App\Http\Controllers\TenantController@dashboard')->name('youtube');
        Route::get('/linkedin', '\App\Http\Controllers\TenantController@dashboard')->name('linkedin');
        Route::get('/whatsapp', '\App\Http\Controllers\TenantController@dashboard')->name('whatsapp');
        Route::get('/sms', '\App\Http\Controllers\TenantController@dashboard')->name('sms');
        Route::get('/openai', [\App\Http\Controllers\OpenAIController::class, 'index'])->name('openai.index');
        Route::post('/openai/message', [\App\Http\Controllers\AI\OpenAIController::class, 'sendMessage'])->name('openai.message');
        Route::post('/groq-chat-completion', [\App\Http\Controllers\AI\GroqApiController::class, 'sendChatCompletion'])->name('groq.message');
        Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
        Route::get('/profile/edit', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.dashboard.edit');
        Route::patch('/profile/avatar-update', '\App\Http\Controllers\ProfileController@updateAvatar')->name('dashboard.avatar.update');
        Route::post('/profile/update', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile-dash-update');
        Route::post('/profile/destroy', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.dashboard.destroy');
        Route::patch('/profile/settings', [\App\Http\Controllers\ProfileController::class, 'updateSettings'])->name('profile.settings.update');
        Route::get('/api-limits', [\App\Http\Controllers\ApiLimitController::class, 'index']);
        Route::post('/api-limits/update', [\App\Http\Controllers\ApiLimitController::class, 'update']);
        Route::get('/api-limits/statistics', [\App\Http\Controllers\ApiLimitController::class, 'getRateLimitStats'])->name('api-limits.statistics');

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/telegram.php';
Route::group(['prefix' => 'admin'], function () {    Voyager::routes();});
