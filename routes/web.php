<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\loginController;

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Models\Employee;
use App\Models\Company;

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

Route::get('/login', function () {
    return view('login');
})->name('login')->middleware('guest');

Route::post('/login', [loginController::class, 'login'])->name('login.post');

// Middleware group for routes that require session data
Route::middleware('auth')->group(function () {

    Route::get('/', [loginController::class, 'dashboard'])->name('dashboard');

    Route::get('/logout', [loginController::class, 'logout'])->name('logout');

    Route::resource('company', CompanyController::class);
    Route::resource('employee', EmployeeController::class);

    Route::get('/trace_data', [CompanyController::class, 'traceData'])->name('trace_data');
    Route::patch('/restore/{id}', [CompanyController::class, 'restore'])->name('restore');
    Route::delete('/delete/{id}', [CompanyController::class, 'delete'])->name('delete');
    
    Route::get('/search-companies', [CompanyController::class, 'search'])->name('companies.search');
});

