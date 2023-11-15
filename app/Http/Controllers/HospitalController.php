<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\HospitalUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Hash;

class HospitalController extends Controller
{
    public function adminDashboard()
    {
        return view('hospital.admindashboard');
    }

    public function userDashboard()
    {
        return view('hospital.userdashboard');
    }

    public function doctorDashboard()
    {
        return view('hospital.doctordashboard');
    }
    public function hospitalDashboard()
    {
        return view('hospital.hospitaldashboard');
    }
    public function register()
    {
        return view('hospital.register');
    }
    public function login()
    {
        return view('hospital.login');
    }
    public function doctor(Request $request)
    {
        return view('hospital.doctorRegister');
    }
    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $email = $request->email;
        $password = $request->password;
        $type = $request->type;
        if ($type === "Choose..") {
            return redirect('login')->with('message', 'Choose valid type');
        }

        if ($type === "Admin" && $email === "admin123@gmail.com" && $password === "Admin@123") {
            return $this->adminDashboard();
        }
        if ($type === "Doctor") {
            $doctor = Doctor::where("email", $email)->first();
            if ($doctor) {
                if (hash::check($password, $doctor->password)) {
                    Session::put('doctor_id', $doctor->doctor_id);
                    return $this->doctorDashboard();
                }
            }
        }
        if ($type === "User") {
            $user = HospitalUser::where("email", $email)->first();
            if ($user) {
                if (hash::check($password, $user->password)) {
                    Session::put('user_id', $user->user_id);
                    return $this->userDashboard();
                    
                }
            }
        }
        return redirect('login')->with('message', 'Login credentials Wrong');
    }

    public function logout(){
        Session::flush();
        return redirect('login');
    }
}
