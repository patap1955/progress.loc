<?php

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

//Route::get('/', function () {
//    return view('app');
//});

Route::get('/get_json/{type}/{meta}', [\App\Http\Controllers\Gospochta\MessagesController::class, 'get_json'])->name('get_json');

Route::get("{any}", fn() => view("app"))->where('any', '.*');
//Route::get("/", [\App\Http\Controllers\HomeController::class, 'index'])->name('index');
//Route::post('/tokens/create', function (Request $request) {
//    $token = $request->user()->createToken($request->token_name);
//    return ['token' => $token->plainTextToken];
//});

Auth::routes();

