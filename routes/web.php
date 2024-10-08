<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminInquiryController;
//
use App\Http\Controllers\ExamFormController;
use App\Http\Controllers\ExamDbController;


/* 管理画面 */
Route::prefix('/admin')->group(function() {
    Route::get('', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login');

    // 認可が必要な機能
    Route::middleware(['auth'])->group(function () {
        Route::get('/top', [AdminController::class, 'top'])->name('admin.top');

        // 問い合わせ機能
        Route::prefix('/inquiry')->group(function() {
            Route::get('', [AdminInquiryController::class, 'index'])->name('admin.inquiry.index');
            Route::get('/{id}', [AdminInquiryController::class, 'detail'])->whereNumber('id')->name('admin.inquiry.detail');
            Route::post('/reply', [AdminInquiryController::class, 'reply'])->name('admin.inquiry.reply');
        });

    });
});

/* front画面 */
// Route::get('/', function () {
    // return view('index');
// });
Route::get('/', [HomeController::class, 'index']);
Route::get('/second', [HomeController::class, 'second']);

// 問い合わせ
// Route::get('/inquiry', [InquiryController::class, 'index']);
// Route::post('/inquiry', [InquiryController::class, 'store']);
// Route::get('/inquiry/fin', [InquiryController::class, 'fin']);

Route::prefix('/inquiry')->group(function() {
    Route::get('', [InquiryController::class, 'index'])->name('inquiry.index');
    Route::post('', [InquiryController::class, 'store'])->name('inquiry.store');
    Route::get('/fin', [InquiryController::class, 'fin'])->name('inquiry.fin');
    Route::get('/error', [InquiryController::class, 'error'])->name('inquiry.error');
});

// 前期期末用
Route::prefix('/exam/form')->group(function() {
    Route::get('/input', [ExamFormController::class, 'index']); // 入力画面
    Route::post('/fin', [ExamFormController::class, 'fin']); // 入力完了画面
});

//
// Route::prefix('/exam')->group(function() {
    // Route::prefix('/form')->group(function() {
        // Route::get('/input', [ExamFormController::class, 'index']); // 入力画面
        // Route::post('/fin', [ExamFormController::class, 'fin']); // 入力完了画面
    // });
    // Route::prefix('/db')->group(function() {
        // Route::get('/input', [ExamFormController::class, 'index']); // 入力画面
        // Route::post('/fin', [ExamFormController::class, 'fin']); // 入力完了画面
    // });
// });

// typoしたルーティング
Route::get('/exam/db/input', [ExamDbController::class, 'index']); // 入力画面
Route::post('/db/form/fin', [ExamDbController::class, 'fin']); // 入力完了画面

