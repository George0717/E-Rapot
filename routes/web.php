<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::resource('students', StudentController::class)
        ->only(['index', 'store', 'update', 'destroy']);

    Route::post(
        '/students/{id}/restore',
        [StudentController::class, 'restore']
    )
        ->name('students.restore');

    Route::prefix('reports')->name('reports.')->group(function () {

        // ===== HISTORY HARUS DI ATAS =====
        Route::get('/history', [ReportController::class, 'history'])
            ->name('history');

        Route::get('/history/{history}', [ReportController::class, 'historyDetail'])
            ->name('history.detail');

        // ===== ROUTE NORMAL =====
        Route::get('/', [ReportController::class, 'index'])->name('index');
        Route::get('/create', [ReportController::class, 'create'])->name('create');
        Route::post('/', [ReportController::class, 'store'])->name('store');
        Route::patch('/{report}', [ReportController::class, 'update'])->name('update');

        Route::get('/approval', [ReportController::class, 'approvalList'])->name('approval');
        Route::patch('/{report}/approve', [ReportController::class, 'approve'])->name('approve');
        Route::patch('/{report}/reject', [ReportController::class, 'reject'])->name('reject');
        Route::delete('/{report}', [ReportController::class, 'destroy'])->name('destroy');

        Route::get('/{report}/detail', [ReportController::class, 'show'])->name('detail');
        Route::get('/{report}/pdf', [ReportController::class, 'pdf'])->name('pdf');
    });

    Route::post(
        '/reports/{id}/restore',
        [ReportController::class, 'restore']
    )
        ->name('reports.restore');

});


require __DIR__ . '/auth.php';
