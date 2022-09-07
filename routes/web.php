<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

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
//     return view('auth.login');
// });
Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function () {

        Route::get('/', [HomeController::class, 'viewHome'])->name('viewHome');
        Route::get('/all-staffs', [StaffController::class, 'viewStaffs'])->name('viewStaffs');
        Route::post('/add-staff', [StaffController::class, 'addStaff'])->name('addStaff');
        Route::post('/edit-staff', [StaffController::class, 'editStaff'])->name('editStaff');
        Route::get('/delete-staff/{id}', [StaffController::class, 'deleteStaff'])->name('deleteStaff');
        Route::get('/view-reports', [ReportController::class, 'viewReportPage'])->name('viewReportPage');
        Route::get('/get-reports-data', [ReportController::class, 'getReportData'])->name('getReportData');
    });
    Route::get('/staff-dashboard', [HomeController::class, 'viewStaffHome'])->name('viewStaffHome');
});
require __DIR__ . '/auth.php';
