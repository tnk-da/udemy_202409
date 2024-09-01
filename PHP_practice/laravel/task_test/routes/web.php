<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\ShopController;

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

Route::get('tests/test', [TestController::class, 'index']);

Route::get('shops', [ ShopController::class,'index']);

// RESTful 7つのアクションをまとめて作成
// Route::resource('contacts', ContactFormController::class);

// 1つずつ指定して作成する場合
Route::get('contacts', [ContactFormController::class, 'index'])->name('contacts.index');

// グループ化
Route::prefix('contacts') // 頭に contacts をつける
  ->middleware(['auth']) // 認証(要ログイン)
  ->name('contacts.') // ルート名
  ->controller(ContactFormController::class) // コントローラ指定(laravel9から)
  ->group(function(){ // グループ化
    Route::get('/', 'index')->name('index'); // 名前つきルート
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/{id}', 'show')->name('show');
    Route::get('/{id}/edit', 'edit')->name('edit');
    Route::post('/{id}', 'update')->name('update');
    Route::post('/{id}/destroy', 'destroy')->name('destroy'); 
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
