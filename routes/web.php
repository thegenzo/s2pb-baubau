<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\ScanBarcodeController;
use App\Http\Controllers\Web\CriminalPerpetratorController;
use App\Http\Controllers\Web\CriteriaController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\EvidenceController;
use App\Http\Controllers\Web\EvidencePhotoController;
use App\Http\Controllers\Web\EvidenceTransactionController;
use App\Http\Controllers\Web\UserController;
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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {

    Route::group(['prefix' => 'admin-panel'], function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::group(['middleware' => ['auth', 'ceklevel:admin']], function () {
            Route::get('/user/{id}/activity', [UserController::class, 'userActivity'])->name('admin-panel.user.activity');
            Route::resource('user', UserController::class, ['as' => 'admin-panel']);
    
            Route::controller(EvidencePhotoController::class)->group(function () {
                Route::get('/evidence/photos/{id}', 'index')->name('admin-panel.photos.index');
                Route::post('/evidence/photos/{id}', 'store')->name('admin-panel.photos.store');
                Route::delete('/evidence/photos/{id}', 'destroy')->name('admin-panel.photos.destroy');
            });
    
            Route::put('/evidence/terminate/{id}', [EvidenceController::class, 'terminateEvidence'])->name('admin-panel.evidence.terminate');
            Route::put('/evidence/return/{id}', [EvidenceController::class, 'returnEvidence'])->name('admin-panel.evidence.return');


        });

        Route::group(['middleware' => ['auth', 'ceklevel:admin,user']], function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin-panel.dashboard');
            Route::get('/criminal/print/{id}', [CriminalPerpetratorController::class, 'print'])->name('admin-panel.criminal.print');
            Route::resource('criminal', CriminalPerpetratorController::class, ['as' => 'admin-panel']);
            Route::resource('criteria', CriteriaController::class, ['as' => 'admin-panel']);

            Route::get('/evidence/returned', [EvidenceController::class, 'returned'])->name('admin-panel.evidence.returned');
            Route::get('/evidence/terminated', [EvidenceController::class, 'terminated'])->name('admin-panel.evidence.terminated');
            Route::get('/evidence/print/{id}', [EvidenceController::class, 'print'])->name('admin-panel.evidence.print');
            Route::resource('evidence', EvidenceController::class, ['as' => 'admin-panel']);

            Route::controller(EvidenceTransactionController::class)->group(function () {
                Route::get('/evidence/transaction/{id}', 'index')->name('admin-panel.transaction.index');
                Route::post('/evidence/transaction/{id}/in', 'evidenceIn')->name('admin-panel.transaction.in');
                Route::post('/evidence/transaction/{id}/out', 'evidenceOut')->name('admin-panel.transaction.out');
                Route::delete('/evidence/transaction/{id}', 'destroy')->name('admin-panel.transaction.destroy');
            });

            Route::get('/scan', [ScanBarcodeController::class, 'index'])->name('admin-panel.scan-barcode.index');
            Route::get('/scan/{register}', [ScanBarcodeController::class, 'show'])->name('admin-panel.scan-barcode.show');
        });
    });
});

require __DIR__.'/auth.php';
