<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    Auth\AuthenticatedSessionController,
    HomeController
};
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[AuthenticatedSessionController::class, 'create'])->middleware(['auth']);

Route::get('/dashboard',[HomeController::class,"index"])
->middleware(['auth'])
->name('dashboard');

Route::get('/dashboard/entry',[HomeController::class,"entryPoint"])
->middleware(['auth'])
->name('entry');

Route::get('/dashboard/new',[HomeController::class,"createDocument"])
->middleware(['auth'])
->name('create');

Route::post('/dashboard/create',[HomeController::class,"updateDocument"])
->middleware(['auth'])
->name('update');

Route::post('/dashboard/send',[HomeController::class,"store"])
->middleware(['auth'])
->name('sendDocument');

Route::post('/dashboard/search',[HomeController::class,"searchFrom"])
->middleware(['auth'])
->name('search');

Route::post('/dashboard/acept',[HomeController::class,"aceptDocument"])
->middleware(['auth'])
->name('acept');

require __DIR__.'/auth.php';
