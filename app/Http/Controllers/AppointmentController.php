<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AppointmentController extends Controller
{
    public function storeAppointment(Request $request)
    {
        $validateData = $request->validate([
            "first_name" => 'required',
            'dob' => 'required',
            'age' => 'required',
            'appointment_date' => 'required',
            'appointment_time' => 'required',
            'doctor' => 'required',
            'doctor_fee' => 'required',
            'patient_mobile' => 'required',
        ]);
        $data = $request->input();
        $lunchStartTime = Carbon::createFromFormat('H:i:s', '13:30:00');
        $lunchEndTime = Carbon::createFromFormat('H:i:s', '14:30:00');

        $morgBreakStartTime = Carbon::createFromFormat('H:i:s', '11:00:00');
        $morgBreakEndTime = Carbon::createFromFormat('H:i:s', '11:30:00');

        $afternoonBreakStartTime = Carbon::createFromFormat('H:i:s', '16:30:00');
        $afternoonBreakEndTime = Carbon::createFromFormat('H:i:s', '17:00:00');

        $hospitalInTime = Carbon::createFromFormat('H:i:s', '09:00:00');
        $hospitalOutTime =  Carbon::createFromFormat('H:i:s', '19:00:00');

        $appointmentTime = $data['appointment_time'];

        $userTime = Carbon::parse($appointmentTime);
        if (($userTime->gte($morgBreakStartTime) && $userTime->lt($morgBreakEndTime)) || ($userTime->gte($afternoonBreakStartTime) && $userTime->lt($afternoonBreakEndTime))) {
            return redirect('admindashboard')->with('message', 'Sorry, appointments are not available during break time.');
        }
        else if ($userTime->gte($hospitalOutTime) || $userTime->lt($hospitalInTime)) {
            return redirect('admindashboard')->with('message', 'Sorry, appointments are not available before or after hospital time.');
        }
       else if (($userTime->gte($lunchStartTime) && $userTime->lt($lunchEndTime))) {
            return redirect('admindashboard')->with('message', 'Sorry, appointments are not available during lunch time.');
        }else{
            $appointment = new Appointment();
            $appointment->patient_first_name =$data['first_name'];
            $appointment->patient_last_name = $data['last_name'];
            $appointment->patient_dob = $data['dob'];
            $appointment->patient_age = $data['age'];
            $appointment->appointment_date = $data['appointment_date'];
            $appointment->appointment_time = $appointmentTime;
            $appointment->doctor_id = $data['doctor_id'];
            $appointment->doctor_name = $data['doctor_name'];
            $appointment->doctor_fee = $data['doctor_fee'];
            $appointment->patient_mobile = $data['patient_mobile'];
            $appointment->save();
            return redirect('admindashboard')->with('message', 'Appointment Booked Successfully');
        }
    }

    public function fetchAppointmentRelatedDoctor($doctor_id){
            return Appointment::where('doctor_id',$doctor_id);
    }
    public function fetchAppointment()
    {
        return Appointment::all();
    }

    public function countOfAppointment()
    {
        return Appointment::count();
    }
}