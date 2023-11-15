<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    public function storeDoctor(Request $request)
    {
        $validateData = $request->validate([
            'doctorname' => 'required|string|max:255|regex:/^[a-zA-Z.\s]+$/',
            'email' => 'required|unique:doctor,email',
            'mobile' => 'required',
            'specilization' => 'required',
            'fee' => 'required',
            'password' => 'required',
        ]);
        $data = $request->input();
        $doctor = new Doctor();
        $doctor->doctor_name = $data['doctorname'];
        $doctor->email     = $data['email'];
        $doctor->mobile = $data['mobile'];
        $doctor->fee = $data['fee'];
        $doctor->specilization = $data['specilization'];
        $doctor->password = Hash::make($data['password']);
        $doctor->save();
        return redirect('login');
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
        $rowAffected = DB::update('UPDATE doctor SET availability=?,date_of_not_availability=? WHERE doctor_id=?',['not available',$date,$doctorId]);
        return redirect('doctordashboard')->with('message', 'Availability Updated Successfully');
    }
}
