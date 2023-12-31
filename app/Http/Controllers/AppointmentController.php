<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AppointmentController extends Controller
{
    public function showAppointment()
    {
        return session('admin_id') ? view('hospital.appointment') : redirect('index');
    }
    public function storeAppointment(Request $request)
    {

        $validateData = $request->validate([
            'first_name' => 'required',
            'dob' => 'required',
            'age' => 'required',
            'appointment_date' => 'required',
            'gender' => 'required|not_in:choose',
            'doctor_name' => 'required',
            'patient_mobile' => 'required',
            'Specialists' => 'required|not_in:Choose...',
        ]);

        $data = $request->input();
        $docId = $data['doctor_id'];
        $date = $data['appointment_date'];

        $appointmentData = DB::select('SELECT * FROM appointment WHERE doctor_id=? and appointment_date=?', [$docId,$date]);
            if ($appointmentData && $appointmentData && $appointmentData[0]->status === 1) {
                Session::flash('message', 'Sorry, Doctor are not available');
                Session::flash('class', 'danger');
                return redirect()->back();
            }


        $doctorData = DB::select('SELECT * FROM doctor WHERE doctor_id=?', [$docId]);
            if ($doctorData && $doctorData[0]->not_availability === $date) {
                Session::flash('message', 'Sorry, Doctor are not available,please select another date.');
                Session::flash('class', 'danger');
                return redirect()->back();
            }

        $appointment = [
            'patient_first_name' => strtolower($data['first_name']),
            'patient_last_name' => strtolower( $data['last_name']),
            'patient_dob' => $data['dob'],
            'patient_age' => $data['age'],
            'appointment_date' => $data['appointment_date'],
            'patient_gender' => $data['gender'],
            'doctor_id' => $data['doctor_id'],
            'doctor_name' => $data['doctor_name'],
            'patient_mobile' => $data['patient_mobile'],
        ];

        DB::table('appointment')->insert($appointment);
        Session::flash('message', 'Appointment Booked Successfully');
        Session::flash('class', 'success');
        Session::flash('status', true);
        return redirect()->back();
    }
    
    public function getAppointments($doctorId)
    {
        return Appointment::where('doctor_id', $doctorId)->get();
    }
    public function updateAppointment(Request $request)
    {
        $appointmentId = $request->appointmentId;
        $appointmentStatus = $request->appointmentStatus;
        $status = 0;
        if ($appointmentStatus === "accepted") {
            $status = 1;
        }
        $rowAffeted = DB::update('UPDATE appointment SET status=?, appointment_status=? WHERE appointment_id=?', [$status, $appointmentStatus, $appointmentId]);
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
    public function fetchdoctorName($date)
    {
        return  DB::select('SELECT doctor_name,status FROM appointment WHERE appointment_date=?', [$date]);
    }
}
