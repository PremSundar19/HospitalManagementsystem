<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    public function storeDoctor(Request $request)
    {
        $request->validate([
            'doctorname' => 'required|string|max:255|regex:/^[a-zA-Z.\s]+$/',
            'email' => 'required|unique:doctor,email',
            'mobile' => 'required',
            'specilization' => 'required',
            'password' => 'required',
        ]);
        $data = $request->input();
        $doctor = new Doctor();
        $doctor->doctor_name = $data['doctorname'];
        $doctor->email     = $data['email'];
        $doctor->mobile = $data['mobile'];
        $doctor->specilization = $data['specilization'];
        $doctor->password = Hash::make($data['password']);
        $doctor->save();
        return redirect('register')->with('message', 'Registration successfully!');
    }

    public function fetchDoctor()
    {
        return Doctor::all();
    }
    public function countOfDoctor()
    {
        return Doctor::count();
    }
    public function fetchDoctorFee($doctorname)
    {
        return  Doctor::where('doctor_name', $doctorname)->first();
    }

    public function updateAvailability(Request $request){
        $doctorId = $request->doctor_id;
        $date = $request->date;
        $rowAffected = DB::update('UPDATE doctor SET availability=?,not_availability=? WHERE doctor_id=?',['not available',$date,$doctorId]);
        return redirect('doctordashboard')->with('message', 'Availability Updated Successfully');
    }

    public function fetchDoctorBasedOnSpecilization($specilization) {
        return DB::select('SELECT doctor_name FROM doctor WHERE specilization=?',[$specilization]);
    }
    public  function fetchdoctorNameStatus($date)
    {
        return DB::select('SELECT doctor_name,status FROM doctor WHERE appoinmentDate=?',[$date]);
    }
    public function updateDoctorStatus($appointmentId){
        $appointment = DB::select('SELECT appointment_date, doctor_id FROM appointment WHERE appointment_id=?',[$appointmentId]);
        $appoinmentDate  = $appointment[0]->appointment_date;
        $doctorId  = $appointment[0]->doctor_id;
        $status = 1;
        DB::update('UPDATE doctor SET appoinmentDate=?, status=? WHERE doctor_id=?',[$appoinmentDate,$status,$doctorId]);

    }
}