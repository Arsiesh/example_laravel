<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/sample', function () {
    return response()->json([
        'email'
    ],200);
});

use Illuminate\Http\Request;
 
Route::get('/', [UserController::class, 'store']);
