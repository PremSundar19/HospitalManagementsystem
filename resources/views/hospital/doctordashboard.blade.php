@extends('layouts.form')
@section('content')
<body class="dashboard doctordashboard">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top ">
<div class="row anchor"><h5>Doctor DashBoard</h5></div>
  <div class="container">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link anchor" aria-current="page" href="#">Patient status</a>
        </li>
        <li class="nav-item">
          <a class="nav-link anchor" href="#">Hospital-info</a>
        </li>
        <li class="nav-item">
          <a class="nav-link anchor" href="#">availability</a>
        </li>

        <li class="nav-item">
          <a class="nav-link anchor" href="#">patient-record</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle anchor" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            More
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><a class="dropdown-item" href="#">Edit Profile</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- card -->
<div class="container">
    <h1 class="mt-4">Welcome to Beta Hospital</h1>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card bg-warning" >
                <div class="card-body">
                    <h5 class="card-title">View appointments</h5>
                    <p class="card-text">Total Patients: 200</p>
                    <button type="button" class="btn btn-primary appointments" data-bs-toggle="modal" data-bs-target=".patients">View Details</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card  bg-success" >
                <div class="card-body">
                    <h5 class="card-title">Doctors</h5>
                    <p class="card-text">Total Doctors: 30</p>
                    <button type="button" class="btn btn-primary ListOfDoctors" data-bs-toggle="modal" data-bs-target=".doctors">View Details</button>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card  bg-info" >
                <div class="card-body">
                    <h5 class="card-title">Appointments</h5>
                    <p class="card-text">Upcoming Appointments: 50</p>
                    <button type="button" class="btn btn-primary ListOfAppointments" data-bs-toggle="modal" data-bs-target=".appointments">View Details</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4 ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text"> </p>
                    <a href="#" class="btn btn-primary"></a>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- modal for appointment table -->
<div class="modal fade">
  <div class="modal-dailog">
    <div class="modal-content">
       <div class="modal-haeder">
            <h5 class="modal-title black" id="appointmentFormModal">Appointment Form</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
          <div class="modal-body">
             <table class="table-bordered table-stripted table-hover">
                <thead class="table-dark">
                   <tr>
                    <th>Patient_First_Name</th>
                    <th>Patient_last_Name</th>
                    <th>Patient_dob</th>
                    <th>Patient_age</th>
                    <th>Patient_mobile</th>
                    <th>Doctor_name</th>
                    <th>Appointment_date</th>
                    <th>Appointment_time</th>
                    <th>Appointment_status</th>
                   </tr>
                </thead>
                <tbody class="appointments_data"></tbody>
             </table>
          </div>
       </div>
    </div>
  </div>
</div>


<!-- Page Content -->
<div class="container mt-5">
  <h1 class="mt-5">Beta Hospital</h1>
  <p>Beta Hospital in Chennai has a supportive and friendly staff, and the latest medical know-how to help patients. The clinic abides by all the necessary safety protocols, including Covid-19 precautionary measures. The doctor and team offer world-class care and guidance, always putting their patients first.</p>
</div>
<?php
use Illuminate\Support\Facades\Session;
 $doctorId = Session::get('doctor_id');
?>
<script>
  // var id = @json($doctorId);
  $('.appointments').click(()=>{
    
       $.ajax({
         url:"url('fetchAppointmentRelatedDoctor')/"+id,
         type:"get",
         success:function(response){
           $('.appointments_data').empty();
           var tr = '';
          $.each(response,function(index,appointment){
              tr += '<tr>';
              tr += '<td>'+ appointment.patient_first_name +'</td>';
              if(appointment.patient_last_name === null){
                tr += '<td>'+ " " +'</td>';
              }else{
                tr += '<td>'+ appointment.patient_last_name +'</td>';
              }
              tr += '<td>'+ appointment.patient_dob +'</td>';
              tr += '<td>'+ appointment.patient_age  +'</td>';
              tr += '<td>'+ appointment.patient_mobile  +'</td>';
              tr += '<td>'+ appointment.doctor_name +'</td>';
              tr += '<td>'+ appointment.appointment_date  +'</td>';
              tr += '<td>'+ appointment.appointment_time+'</td>';
              tr += '<td>'+ '<a class="btn btn-primary btn-xs py-1">Accept</a>'
              '<a class="btn btn-primary btn-xs py-1">Accept</a>'+'</td>';
              tr += '</tr>';
           });
           $('.appointments_data').append();
         }
       });
  });
</script>
</body>
@endsection