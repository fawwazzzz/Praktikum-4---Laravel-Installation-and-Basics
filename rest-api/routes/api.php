<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\StatusController;

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
# Autentikasi
Route::middleware(['auth:sanctum'])->group(function() {
# Get All Patient
Route::get("/patients", [PatientController::class, 'index']);
# Get Detail Patient
Route::get("/patients/{id}", [PatientController::class, 'show']);
# Add Patient
Route::post("/patients", [PatientController::class, 'store']);
# Update patient
Route::put("/patients", [PatientController::class, 'update']);
# Delete Patient
Route::delete("/patients", [PatientController::class, 'destroy']);

# Get Patient by Name
Route::get("/patients/search/{name}", [PatientController::class, 'search']);
# Get Patient Positive
Route::get("/patients/status/positive", [PatientController::class, 'positive']);
# Get Patient Recovered
Route::get("/patients/status/recovered", [PatientController::class, 'recovered']);
# Get Patient Dead
Route::get("/patients/status/dead", [PatientController::class, 'dead']);

# Get Status
Route::get("/status", [StatusController::class, 'status']);


# Endpoint Register n Login
Route::post ('/register', [AuthController::class, 'register']);
Route::post ('/login', [AuthController::class, 'login']);
});



