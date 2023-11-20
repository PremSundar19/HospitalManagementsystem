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
            'specilization' => 'required|not_in:Choose...',
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
    public function fetchDoctorById($doctorId){
        return DB::select('SELECT * FROM doctor WHERE doctor_id=?',[$doctorId]);
    }
    public function updateDoctor(Request $request){
        $data = $request->input();
        $doctor_name = $data['doctorname'];
        $email = $data['email'];
        $mobile = $data['mobile'];
        $specilization = $data['specilization'];
        $doctor_id = $data['drId'];
        DB::update('UPDATE doctor SET doctor_name=?, email=?, mobile=?, specilization=? WHERE doctor_id=?',[$doctor_name,$email,$mobile,$specilization,$doctor_id]);
        return redirect('doctordashboard')->with('message', 'Profile Updated Successfully');
    }
}