<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Requests\LoginRequest;
use Laravel\Fortify\Fortify;

// ----------------------
// お問い合わせ関連
// ----------------------
// 入力ページ
Route::get('/', [ContactController::class, 'index'])->name('contacts.form');

// 確認ページ
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contacts.post');

// 送信（DB保存）＆ サンクスページ
Route::post('/thanks', [ContactController::class, 'send'])->name('contacts.send');

// ----------------------
// 管理者用ページ（ログイン必須）
// ----------------------
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');
    Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
});

// ----------------------
// Fortify ログイン / 登録画面
// ----------------------

// ログイン画面
Fortify::loginView(function () {
    return view('auth.login'); // resources/views/auth/login.blade.php
});

// 登録画面
Fortify::registerView(function () {
    return view('auth.register'); // resources/views/auth/register.blade.php
});