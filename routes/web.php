<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JyunbunController;
use App\Http\Controllers\LikeController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [JyunbunController::class, 'index'])->name('index');
Route::get('/index', [JyunbunController::class, 'index'])->name('index');

Route::get('/login', [JyunbunController::class, 'logincheck'])->name('logincheck');

Route::get('/user_register', function () {
    return view('Jyunbun.user_register');
});

Route::get('/password_reset', function () {
    return view('Jyunbun.password_reset');
});

Route::post('/user_confirm', [JyunbunController::class, 'user_register']);

Route::post('/user_complete', [JyunbunController::class, 'user_complete']);

Route::get('/admin_login', function () {
    return view('Jyunbun.admin_login');
});

Route::post('/mypage', [JyunbunController::class, 'mypage'])->name('mypage');

Route::get('/works', [JyunbunController::class, 'works']);

Route::get('/works_detail/{id}', [JyunbunController::class, 'works_detail']);

Route::group(['middleware' => 'auth'], function () {

    Route::get('/mypage', function () {
        return view('Jyunbun.mypage');
    });

    Route::get('/logout', [JyunbunController::class, 'logout'])->name('logout');

    Route::get('/user_edit', function () {
        return view('Jyunbun.user_edit');
    });
    
    Route::post('/user_edit', [JyunbunController::class, 'user_edit'])->name('user_edit');

    Route::get('/works_register', [JyunbunController::class, 'novels_format']);
    Route::post('/works_register', [JyunbunController::class, 'works_register'])->name('works_register');

    Route::get('/works_user', [JyunbunController::class, 'works_user']);

    Route::get('/works_edit/{id}', [JyunbunController::class, 'works_edit']);

    Route::post('/works_update/{id}', [JyunbunController::class, 'works_update']);

    Route::get('/works_delete/{id}', [JyunbunController::class, 'works_delete']);

    Route::get('/admin_works', [JyunbunController::class, 'admin_works']);

    Route::post('/like/{postId}',[LikeController::class,'store']);
    Route::post('/unlike/{postId}',[LikeController::class,'destroy']);

    Route::get('/works_like', [JyunbunController::class, 'works_like']);

});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
