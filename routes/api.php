<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\GuestController as GuestController;
use App\Http\Controllers\Api\PostController as PostController;

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

Route::get('/hello', [GuestController::class, 'hello'])->name('guest_home');

Route::get('/posts', [PostController::class, 'index'])->name('posts');

Route::get('/posts/{slug}', [PostController::class, 'show'])->name('post');


// Route::get('/test', function () {
//     return response()->json([
//         'name' => 'endriu',
//         'surname' => 'kaskija'
//     ]);
// })->name('test_api');
