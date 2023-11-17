<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\UserController;
use App\Models\Doctor;
use App\Models\HospitalUser;
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

Route::get('/', function () {
    return view('welcome');
});
//form or view related routes
// Route::get('register',[HospitalController::class,'register']);
// Route::get('login',[HospitalController::class,'login']);
Route::get('admindashboard',[HospitalController::class,'adminDashboard']);
Route::get('doctordashboard',[HospitalController::class,'doctorDashboard']);
// Route::get('userdashboard',[HospitalController::class,'userDashboard']);
Route::get('index',[HospitalController::class,'index']);
Route::get('register',[HospitalController::class,'register']);
Route::get('logout',[HospitalController::class,'logout']);


//user-related route
Route::post('storeUser',[UserController::class,'storeUser']);
Route::post('loginUser',[HospitalController::class,'loginUser']);

//appointment related routes
Route::post('bookAppointment',[AppointmentController::class,'storeAppointment']);
Route::get('fetchAppointment',[AppointmentController::class,'fetchAppointment']);
Route::get('countOfAppointment',[AppointmentController::class,'countOfAppointment']);
Route::get('/getAppointments/{doctorId}',[AppointmentController::class,'getAppointments']);
Route::get('/updateAppointment',[AppointmentController::class,'updateAppointment']);
Route::post('/updateFeedback/{appointmentId}/{feedback}', [AppointmentController::class, 'updateFeedback']);

//patient related routes
// Route::get('storePatient',[PatientController::class,'storePatient']);
// Route::get('fetchPatient',[PatientController::class,'fetchPatient']);
Route::get('countOfPatient',[PatientController::class,'countOfPatient']);

//Doctor Related Routes
Route::post('storeDoctor',[DoctorController::class,'storeDoctor']);
Route::get('fetchDoctor',[DoctorController::class,'fetchDoctor']);
Route::post('updateAvailability',[DoctorController::class,'updateAvailability']);
Route::get('countOfDoctor',[DoctorController::class,'countOfDoctor']);
Route::get('fetchDoctorFee/{doctorname}',[DoctorController::class,'fetchDoctorFee']);
Route::get('/fetchDoctorBasedOnSpecilization/{specilization}',[DoctorController::class,'fetchDoctorBasedOnSpecilization']);

Route::get('/aboutus',function(){
    return view('hospital.aboutus');
});

Route::get('/appointment',function(){
    return view('hospital.appointment');
});


// Route::get('/demo',function(){
//    return view('demo');
// });

Route::get('/fetchdoctorName/{date}',[AppointmentController::class,'fetchdoctorName']);
Route::get('/fetchdoctorNameStatus/{date}',[DoctorController::class,'fetchdoctorNameStatus']);
// Route::get('/updateDoctorStatus/{appointmentId}',[DoctorController::class,'updateDoctorStatus']);