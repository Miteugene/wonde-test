<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LessonsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware(['visit'])
    ->group(function () {
        Route::get('employees', [EmployeeController::class, 'index'])
            ->name('employees.index');

        Route::get('lessons', [LessonsController::class, 'show'])
            ->name('lessons.show');

        Route::get('classes/{classId}', [ClassController::class, 'show'])
            ->name('classes.show');


        Route::get('test', function (Request $request) {
            return 'test';
        });
    });
