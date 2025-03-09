<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;



Auth::routes();
// Route::get('/', 'BlogController@index');
Route::get('/', [BlogController::class, 'index']);
Route::get('/detail-post/{slug}', [BlogController::class,'isi_post'])->name('blog.isi');
Route::get('/list-post/{slug}', [BlogController::class,'list_post'])->name('blog.list');
Route::get('/list-category/{category}', [BlogController::class,'list_category'])->name('blog.category');
// Route::get('/', [BlogController::class,'index'])->name('blog');

// Route::get('/isi_post', function () {
//     return view('blog.isi_post');
// });

Route::group(['middleware' => 'auth'], function() {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/category', CategoryController::class);
    Route::resource('/tag', TagController::class);
    // Route::get('/post/tampil_hapus', 'PostController@tampil_hapus')->name('post.tampil_hapus');
    Route::get('/post/trashed', [PostController::class, 'trashed'])->name('post.trashed');
    Route::get('/post/restore/{id}', [PostController::class, 'restore'])->name('post.restore');
    Route::delete('/post/delete/{id}', [PostController::class, 'delete'])->name('post.delete');
    Route::resource('/post', PostController::class);
    Route::resource('/user', UserController::class);

});




