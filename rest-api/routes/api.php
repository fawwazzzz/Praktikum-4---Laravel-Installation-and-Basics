<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

# Get All Resource
Route::get("/students", [StudentController::class, 'index']);

# Add Resource
Route::post("/students", [StudentController::class, 'store']);

# Get Detail resource
Route::get("/students/{id}", [StudentController::class, 'show']);

# Update data
Route::put("/students/{id}", [StudentController::class, 'update']);

# Delete Data
Route::delete("/students/{id}", [StudentController::class, 'destroy']);

# Route Student
# Method POST, route /students
Route::get('/students', [StudentController::class, 'index']);

# Method GET, route /students
Route::post('/students', [StudentController::class, 'store']);

# Mehod GET, route /students
Route::get('students/{id}', [StudentController::class, 'show']);

# Method PUT, route/ students
Route::put('/student/{id}', [StudentController::class, 'update']);

# Method Delete, route /students
Route::delete('/student/{id}', [StudentController::class, 'destroy']);

# Route register and login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
