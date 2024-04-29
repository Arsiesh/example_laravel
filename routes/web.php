<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sample', function () {
    return response()->json([
        'email'
    ],200);
});

use Illuminate\Http\Request;

Route::group(['prefix'=>'customers'], function(){
    Route::post('/create-new', [UserController::class, 'store']);
    Route::put('/update', [UserController::class, 'update']);
    Route::delete('/delete', [UserController::class, 'destroy']);
    Route::get('/show-id', [UserController::class, 'show']);
    Route::get('/show-all', [UserController::class, 'showall']);
});


// Route::prefix('customers')->group(function () {
//     Route::post('/create-new', [UserController::class, 'store']);
//     Route::put('/update', [UserController::class, 'update']);
//     Route::delete('/delete', [UserController::class, 'delete']);
//     Route::get('/show-id', [UserController::class, 'show']);
//     Route::get('/show-all', [UserController::class, 'showall']);
// });