<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PatientController extends Controller
{
    public function fetchPatient(){
        return Patient::all();
    }
    public function storePatient(Request $request){ 
        $appointment = Session::get('appointment_data');
   
          $patient = new Patient();
         $patient->first_name = $appointment['patient_first_name'];
         $patient->last_name = $appointment['patient_last_name'];
         $patient->patient_dob =  $appointment['patient_dob'];
         $patient->patient_age =  $appointment['patient_age'];
         $patient->doctor_name =  $appointment['doctor_name'];
         $patient->doctor_fee =  $appointment['doctor_fee'];
         $patient->save();
         return redirect('admindashboard')->with('message','Appointment Booked Successfully');
    }

    public function countOfPatient(){
        return Patient::count();
    }
}
