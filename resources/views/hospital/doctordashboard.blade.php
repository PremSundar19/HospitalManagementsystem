@extends('layouts.form')
@section('content')

<body class="dashboard doctordashboard">
  @csrf
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top ">
    <div class="row anchor">
      <h5>Doctor DashBoard</h5>
    </div>
    <div class="container">
      <div class="row justify-content-center">
        @if(Session::has('message'))
        <div class="alert alert-success justify-content-center" role="alert">
          {{ Session::get('message') }}
        </div>
        <script>
          setTimeout(function() {
            var alert = document.querySelector('.alert');
            alert.style.display = 'none';
          }, 5000);
        </script>
        @endif
      </div>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link anchor" aria-current="page" href="#">Patient status</a>
          </li>
          <li class="nav-item">
            <a class="nav-link anchor" href="#">Hospital-info</a>
          </li>
          <li class="nav-item">
            <a class="nav-link anchor" data-bs-target="#availabilityModal" data-bs-toggle="modal">availability</a>
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
              <li><a class="dropdown-item" href="logout">Logout</a></li>
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
        <div class="card bg-warning">
          <div class="card-body">
            <h5 class="card-title">View appointments</h5>
            <p class="card-text">Total appointments :<span id="totalAppointments"></span> </p>
            <button type="button" class="btn btn-primary" id="ListOfAppointments" data-bs-toggle="modal" data-bs-target="#appointmentModal">View Details</button>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card  bg-success">
          <div class="card-body">
            <h5 class="card-title">Patients</h5>
            <p class="card-text">Total Patients: <span id="totalPatients"></span></p>
            <button type="button" class="btn btn-primary ListOfDoctors" data-bs-toggle="modal" data-bs-target="#patientModal">View Details</button>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card  bg-info">
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
  <!-- patientmodal -->
  <div class="modal fade modal-lg" id="patientModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title black" id="patientmodal">Patient records</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <table class="table table-stripted table-hover table-bordered">
              <thead class="table-dark">
                <tr>
                  <th>Patient_First_Name</th>
                  <th>Patient_last_Name</th>
                  <th>Patient_dob</th>
                  <th>Patient_age</th>
                  <th>Patient_mobile</th>
                  <th>Appointment_date</th>
                  <th>Appointment_time</th>
                  <th>Feed Back</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="patients_data"></tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>

  <!-- appointmentModal -->
  <div class="modal fade modal-lg" id="appointmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title black" id="exampleModalLabel">Appointments</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <table class="table table-stripted table-hover table-bordered">
              <thead class="table-dark">
                <tr>
                  <th>Patient_First_Name</th>
                  <th>Patient_last_Name</th>
                  <th>Appointment_date</th>
                  <th>Appointment_time</th>
                  <th>Appointment_status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="appointments_data"></tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  <!-- doctor Availability -->
  <div class="modal fade" id="availabilityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title black" id="doctorModal"> update doctor Availability</h5>
          <button type="button" class="close updateClose" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Doctor name</th>
                <th>not available date</th>
                <th>action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <form action="{{url('updateAvailability')}}" method="post">
                  @csrf
                  <input type="hidden" name="doctor_id" id="doctor_id">
                  <td>
                    <div class="form-group">
                      <input type="text" name="doctor_name" id="doctor_name" class="form-control" readonly>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <input type="date" name="date" id="date" class="form-control" required>
                    </div>
                  </td>
                  <td>
                    <div class="form-group">
                      <input type="submit" value="submit" class="btn btn-primary btn-xs py-0 m-2">
                    </div>
                  </td>
                </form>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer"></div>
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

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script>
    var doctorId = "<?php echo $doctorId; ?>";
    $('.updateClose').click(() => {
      $('#date').val('');
      $('#notavailable').val('Choose...');
    });
    $(document).ready(() => {
      listOfAppointments();
    });

    function listOfAppointments() {
      $.ajax({
        url: '/getAppointments/' + doctorId,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
          console.log(response);
          displayAppointment(response);
          displayPatients(response);
        }
      });
    }

    function displayAppointment(appointments) {
      $('.appointments_data').empty();
      $('#totalAppointments, #totalPatients').text(appointments.length);
      var tr = '';
      $.each(appointments, function(index, appointment) {
        $('#doctor_name').val(appointment.doctor_name);
        $('#doctor_id').val(appointment.doctor_id);
        tr += '<tr>';
        tr += '<td>' + appointment.patient_first_name + '</td>';
        if (appointment.patient_last_name === null) {
          tr += '<td>' + " " + '</td>';
        } else {
          tr += '<td>' + appointment.patient_last_name + '</td>';
        }
        tr += '<td>' + appointment.appointment_date + '</td>';
        tr += '<td>' + appointment.appointment_time + '</td>';
        tr += '<td>' + appointment.appointment_status + '</td>';
        if (appointment.appointment_status === "pending") {
          tr += '<td><div class="d-flex">';
          tr += '<a class="btn btn-success btn-xs py-1" onclick="updateAppointment(' + "'" + appointment.appointment_id + "','" + 'accepted' + "'" + ')">Accept</a> &nbsp;&nbsp;';
          tr += '<a class="btn btn-danger  btn-xs py-1"   onclick="updateAppointment(' + "'" + appointment.appointment_id + "','" + 'rejected' + "'" + ')">Reject</a>';
          tr += '</div></td>';
        }
        tr += '</tr>';
      });
      $('.appointments_data').append(tr);
    }

    function updateReason(appointmentId) {
      var feedbackSelector = 'input[appointmentId="' + appointmentId + '"]';
      var feedback = $(feedbackSelector).val();
      $.ajax({
        url: "{{url('updateFeedback')}}",
        type: 'POST',
        data: {
          appointmentId: appointmentId,
          feedback: feedback
        }
      })
    }

    function displayPatients(appointments) {
      $('.patients_data').empty();
      var tr = '';
      $.each(appointments, function(index, appointment) {
        tr += '<tr>';
        tr += '<td>' + appointment.patient_first_name + '</td>';
        if (appointment.patient_last_name === null) {
          tr += '<td>' + " " + '</td>';
        } else {
          tr += '<td>' + appointment.patient_last_name + '</td>';
        }
        tr += '<td>' + appointment.patient_dob + '</td>';
        tr += '<td>' + appointment.patient_age + '</td>';
        tr += '<td>' + appointment.patient_mobile + '</td>';
        tr += '<td>' + appointment.appointment_date + '</td>';
        tr += '<td>' + appointment.appointment_time + '</td>';
        tr += '<td>' + '<input type="text" name="feedback" appointmentId="' + appointment.appointment_id + '" required>' + '</td>';
        tr += '<td><div class="d-flex">';
        tr += '<a class="btn btn-success  btn-xs py-0" onclick=updateReason("' + appointment.appointment_id + '")>submit</a>';
        tr += '</div></td>';
        tr += '</tr>';
      });
      $('.patients_data').append(tr);
    }

    function updateAppointment(appointmentId, status) {
      $.ajax({
        url: "{{url('updateAppointment')}}",
        type: 'GET',
        data: {
          appointmentId: appointmentId,
          status: status
        },
        dataType: 'json',
        success: function(response) {
          if (response.done) {
            listOfAppointments();
          }
        }
      });
    }
  </script>
</body>
@endsection