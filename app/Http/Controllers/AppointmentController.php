<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


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

        $docId = $data['doctor_id'];
        $date =  $data['appointment_date'];

        $doctor =  DB::select('SELECT * FROM doctor where doctor_id=?', [$docId]);
        if ($doctor[0]->date_of_not_availability === $date) {
            return redirect('appointment')->with('message', 'Sorry, Doctor are not available,please select another date.');
        }
        $userTime = Carbon::parse($appointmentTime);
        if (($userTime->gte($morgBreakStartTime) && $userTime->lt($morgBreakEndTime)) || ($userTime->gte($afternoonBreakStartTime) && $userTime->lt($afternoonBreakEndTime))) {
            return redirect('appointment')->with('message', 'Sorry, appointments are not available during break time.');
        } else if ($userTime->gte($hospitalOutTime) || $userTime->lt($hospitalInTime)) {
            return redirect('appointment')->with('message', 'Sorry, appointments are not available before or after hospital time.');
        } else if (($userTime->gte($lunchStartTime) && $userTime->lt($lunchEndTime))) {
            return redirect('appointment')->with('message', 'Sorry, appointments are not available during lunch time.');
        } else {

            $appointment = [
                'patient_first_name' => $data['first_name'],
                'patient_last_name' => $data['last_name'],
                'patient_dob' => $data['dob'],
                'patient_age' => $data['age'],
                'appointment_date' => $data['appointment_date'],
                'appointment_time' => $appointmentTime,
                'doctor_id' => $data['doctor_id'],
                'doctor_name' => $data['doctor'],
                'doctor_fee' => $data['doctor_fee'],
                'patient_mobile' => $data['patient_mobile'],
            ];

            DB::table('appointment')->insert($appointment);

            // $appointment = new Appointment();
            // $appointment->patient_first_name = $data['first_name'];
            // $appointment->patient_last_name = $data['last_name'];
            // $appointment->patient_dob = $data['dob'];
            // $appointment->patient_age = $data['age'];
            // $appointment->appointment_date = $data['appointment_date'];
            // $appointment->appointment_time = $appointmentTime;
            // $appointment->doctor_id = $data['doctor_id'];
            // $appointment->doctor_name = $data['doctor'];
            // $appointment->doctor_fee = $data['doctor_fee'];
            // $appointment->patient_mobile = $data['patient_mobile'];
            // $appointment->save();
            return redirect('appointment')->with('message', 'Appointment Booked Successfully');
        }
    }

    public function getAppointments($doctorId)
    {
        return Appointment::where('doctor_id', $doctorId)->get();
    }
    public function updateAppointment(Request $request)
    {
        $appointmentId = $request->appointmentId;
        $status = $request->status;
        $rowAffeted = DB::update('UPDATE appointment SET appointment_status=? WHERE appointment_id=?', [$status, $appointmentId]);
        if ($rowAffeted > 0) {
            return response()->json(array('done' => true));
        } else {
            return response()->json(array('done' => false));
        }
    }
    public function fetchAppointment()
    {
        return Appointment::all();
    }

    public function countOfAppointment()
    {
        return Appointment::count();
    }
    public function updateFeedback(Request $request, $appointmentId, $feedback)
    {
        $rowAffected = DB::update('UPDATE appointment SET feedback=? WHERE appointment_id=?', [$feedback, $appointmentId]);
        if ($rowAffected > 0) {
            return response()->json(array('done' => true));
        } else {
            return response()->json(array('done' => false));
        }
    }
    public function fetchdoctorName($date){
        return DB::select('SELECT doctor_name FROM appointment WHERE appointment_date=?',[$date]);
     }
}
