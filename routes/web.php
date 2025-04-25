<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UpgradeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\FearGreedController;
use App\Http\Controllers\CryptoNewsController;
use App\Http\Controllers\BitcoinNewsController;
use App\Http\Controllers\MemberTradeController;
use App\Http\Controllers\SignalTradeController;
use App\Http\Controllers\TopHoldingsController;
use App\Http\Controllers\PaymentAdminController;
use App\Http\Controllers\CryptoCalendarController;
use App\Http\Controllers\TrendingCryptoController;
use App\Http\Controllers\ExchangeInsightController;

// 🔹 Route untuk autentikasi
Auth::routes();

// 🔹 Route untuk halaman utama (tanpa login)
// Route::get('/', 'BlogController@index');
Route::get('/', [BlogController::class, 'index']);
// Route::get('/', function () {
//     return view('frontend');
// });

Route::get('/tentang-kami', function () {
    return view('blog.tentang');
});
Route::get('/kontak', function () {
    return view('blog.kontak');
});

Route::get('/list-artikel', [BlogController::class, 'list_artikel'])->name('blog.artikel');
Route::get('/detail-post/{slug}', [BlogController::class, 'isi_post'])->name('blog.isi');
Route::get('/list-post/{slug}', [BlogController::class, 'list_post'])->name('blog.list');
Route::get('/list-category/{category}', [BlogController::class, 'list_category'])->name('blog.category');
Route::get('/tag/{tag:slug}', [BlogController::class, 'list_tag'])->name('blog.tag');
Route::get('/produk-kriptonesia', [ProductController::class, 'showProducts'])->name('produk');

// 🔹 Route untuk pembayaran (semua user)
Route::get('/payment/confirm', [PaymentController::class, 'showConfirmationForm'])->name('payment.confirm');
Route::post('/payment/confirm', [PaymentController::class, 'processConfirmation'])->name('payment.confirm.process');

Route::middleware(['auth'])->group(function () {
    Route::get('/upgrade', [UpgradeController::class, 'showForm'])->name('member.upgrade');
    Route::post('/upgrade/process', [UpgradeController::class, 'processUpgrade'])->name('member.upgrade.process');
    Route::get('/payment/history', [PaymentController::class, 'showHistory'])->name('payment.history');
});

// ==================================================
// 🔥 ROUTE UNTUK ADMIN (HANYA ADMIN)
// ==================================================

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Manajemen Products
    Route::resource('/products', ProductController::class);
    // 🔹 Manajemen Konten
    Route::resource('/category', CategoryController::class);
    Route::resource('/tag', TagController::class);
    // Route::get('/post/tampil_hapus', 'PostController@tampil_hapus')->name('post.tampil_hapus');
    Route::get('/post/trashed', [PostController::class, 'trashed'])->name('post.trashed');
    Route::get('/post/restore/{id}', [PostController::class, 'restore'])->name('post.restore');
    Route::delete('/post/delete/{id}', [PostController::class, 'delete'])->name('post.delete');
    Route::resource('/post', PostController::class);

    // 🔹 Manajemen User
    Route::resource('/user', UserController::class);
    Route::get('/user/detail/{id}', [UserController::class, 'show'])->name('admin.user.detail');

    // 🔹 Manajemen Trading Signals
    Route::resource('/signal-trade', SignalTradeController::class);

    // 🔹 Manajemen Pembayaran
    Route::get('/payments', [PaymentAdminController::class, 'index'])->name('admin.payments');
    Route::post('/payments/update/{id}', [PaymentAdminController::class, 'updateStatus'])->name('admin.payments.update');
    Route::get('/payments/{id}/expired', [PaymentAdminController::class, 'setExpired'])->name('admin.payment.expired');
});

// ==================================================
// 🚀 ROUTE UNTUK MEMBER (HANYA USER DENGAN MEMBERSHIP)
// ==================================================
Route::group(['middleware' => ['auth', 'member'], 'prefix' => 'member'], function () {
    Route::get('/home', [App\Http\Controllers\MemberController::class, 'index'])->name('member.home');
    Route::get('/news', [App\Http\Controllers\MemberController::class, 'news'])->name('member.news');
    Route::get('/news/search', [MemberController::class, 'search'])->name('member.search');
    Route::get('/signal-trade', [MemberTradeController::class, 'index'])->name('trade.index');
    Route::get('/detail-trade/{id}', [MemberTradeController::class, 'show'])->name('trade.show');
    Route::get('/community', [MemberTradeController::class, 'community'])->name('member.community');
    Route::get('/crypto-calendar', [CryptoCalendarController::class, 'index'])->name('member.calendar');
    Route::get('/fear-greed-index', [FearGreedController::class, 'index'])->name('member.fear');
    Route::get('/fear-greed-index/data', [FearGreedController::class, 'getData'])->name('member.data');
    Route::get('/api/fear-greed', [FearGreedController::class, 'index'])->name('api.feargreed');
    Route::get('/top-holdings/{coin_id}', [TopHoldingsController::class, 'index'])->name('top.holdings');
    Route::get('/crypto-insight', [ExchangeInsightController::class, 'index'])->name('crypto-insight');
    Route::get('/crypto/{id}', [ExchangeInsightController::class, 'show'])->name('crypto.show');
    Route::get('/trending-crypto', [TrendingCryptoController::class, 'index'])->name('trending.crypto');
    Route::get('/bitcoin-news', [BitcoinNewsController::class, 'index'])->name('bitcoin-news.index');
    Route::post('/bitcoin-news/fetch', [BitcoinNewsController::class, 'fetchLatest'])->name('bitcoin-news.fetch');
    Route::get('/crypto-news', [CryptoNewsController::class, 'index'])->name('crypto-news.index');
    Route::post('/crypto-news/fetch', [CryptoNewsController::class, 'fetchLatest'])->name('crypto-news.fetch');

    // Route::get('/profile', [App\Http\Controllers\MemberController::class, 'profile'])->name('member.profile');
});
