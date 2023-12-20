<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
 
Route::get('/', function () {
    return view('welcome');
});
 
Route::get('/', [EmployeeController::class, 'index']);
Route::get('export', [EmployeeController::class, 'export']);

Route::post('store', [EmployeeController::class, 'store']);
Route::post('edit', [EmployeeController::class, 'edit']);
Route::post('delete', [EmployeeController::class, 'destroy']);
