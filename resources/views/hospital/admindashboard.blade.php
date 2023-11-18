@extends('layouts.form')
@section('content')

<body class="admindashboard dashboard">
  <!-- nav bars -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="row">
      <h5>Admin DashBoard</h5>
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
            <a class="nav-link anchor bookappointment" aria-current="page" href="{{url('appointment')}}">Book-Appointment</a>
          </li>
          <li><a class="nav-link anchor" href="logout">Logout</a></li>
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
            <h5 class="card-title">Patients</h5>
            <p class="card-text">Total Patients: <span id="totalPatients"></span></p>
            <button type="button" class="btn btn-primary ListOfPatients" data-bs-toggle="modal" data-bs-target=".patients">View Details</button>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card  bg-success">
          <div class="card-body">
            <h5 class="card-title">Doctors</h5>
            <p class="card-text">Total Doctors: <span id="totalDoctors"></span></p>
            <button type="button" class="btn btn-primary ListOfDoctors" data-bs-toggle="modal" data-bs-target=".doctors">View Details</button>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card  bg-info">
          <div class="card-body">
            <h5 class="card-title">Appointments</h5>
            <p class="card-text">Total Appointments: <span id="totalAppointment"></span></p>
            <button type="button" class="btn btn-primary ListOfAppointments" data-bs-toggle="modal" data-bs-target=".appointments">View Details</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- <div class="graph-container">
    <h2>Hospital Management System - Daily Patient Count</h2>
    <div class="graph-bar">
      <div class="bar" style="height: 100px;"></div> 
      <div class="bar" style="height: 120px;"></div>
      <div class="bar" style="height: 80px;"></div>
      <div class="bar" style="height: 90px;"></div>
      <div class="bar" style="height: 110px;"></div>
    </div>
    <p class="black">Day 1</p>
  </div> -->

  <!-- patients details -->
  <div class="modal fade patients modal-lg">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title black" id="patientsModal">Patient List</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body table-responsive">
          <table class="table table-stripted table-hover table-bordered">
            <thead class="table-dark">
              <tr>
                <th>first_name</th>
                <th>last_name</th>
                <th>patient_dob</th>
                <th>patient_age</th>
                <th>doctor_name</th>
                <th>status</th>
              </tr>
            </thead>
            <tbody class="patient_data">
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  <!-- doctor details -->
  <div class="modal fade doctors modal-lg">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title black" id="doctorsModal">Doctor List</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="doctor_data">
          </div>
          <br>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  <!-- Appointments form -->
  <div class="modal fade appointmentForm modal-md">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title black" id="appointmentFormModal">Appointment Form</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @if(Session::has('appointmentMessage'))
          <div class="alert alert-danger justify-content-justify" role="alert">
            {{ Session::get('appointmentMessage') }}
          </div>
          <script>
            setTimeout(function() {
              var alert = document.querySelector('.alert');
              alert.style.display = 'none';
            }, 4000);
          </script>
          @endif
          <form action="{{url('bookAppointment')}}" class="black" method="post">
            @csrf
            <div class="row">
              <input type="hidden" name="doctor_id" id="doctor_id">
              <div class="col-md-6">
                <label for="first_name" class="form-label"> First Name </label>
                <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{old('first_name') ? : ''}}">
                @error('first_name')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="last_name" class="form-label"> Last Name </label>
                <input type="text" name="last_name" id="last_name" class="form-control" value="{{old('last_name') ? : ''}}">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label for="dob" class="form-label"> Date Of Birth </label>
                <input type="date" name="dob" id="dob" class="form-control  @error('dob') is-invalid @enderror" value="{{old('dob') ? : ''}}">
                @error('dob')
                <span class="text-danger">{{$message}}</span>
                @enderror
                <span class="text-danger" id="dobError"></span>
              </div>
              <div class="col-md-6">
                <label for="age" class="form-label"> Age </label>
                <input type="number" name="age" id="age" class="form-control  @error('age') is-invalid @enderror" value="{{old('age') ? : ''}}" readonly>
                @error('age')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label for="appointment_date" class="form-label">Appointment date</label>
                <input type="date" name="appointment_date" id="appointment_date" class="form-control  @error('appointment_date') is-invalid @enderror" value="{{old('appointment_date') ? : ''}}">
                @error('appointment_date')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="appointment_time" class="form-label">Appointment Time</label>
                <input type="time" name="appointment_time" id="appointment_time" class="form-control  @error('appointment_time') is-invalid @enderror" value="{{old('appointment_time') ? : ''}}">
                @error('appointment_time')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label for="doctor" class="form-label">Doctor</label>
                <select name="doctor" id="dr" class="form-select doctorContent  @error('doctor') is-invalid @enderror" value="{{old('doctor') ? : ''}}">

                </select>
                @error('doctor')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="doctor_fee" class="form-label">Doctor Fee</label>
                <input type="text" name="doctor_fee" id="doctor_fee" class="form-control  @error('doctor_fee') is-invalid @enderror" value="{{old('doctor_fee') ? : ''}}" readonly>
                @error('doctor_fee')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
            </div>
            <div class="form-group">
              <label for="patient_mobile" class="form-label"> Mobile </label>
              <input type="text" name="patient_mobile" id="patient_mobile" class="form-control  @error('patient_mobile') is-invalid @enderror" value="{{old('patient_mobile') ? : ''}}">
              @error('patient_mobile')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            <br>
            <div class="form-group">
              <input type="submit" value="Book-Appointment" class="btn btn-primary btn-xs py-0">
              <button type="button" class="btn btn-secondary btn-xs py-0 close" data-bs-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  <!-- Appointments details -->
  <div class="modal fade appointments modal-lg">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title black" id="appointmentModal">Appointment List</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body table-responsive">
          <table class="table table-stripted table-hover table-bordered">
            <thead class="table-dark">
              <tr>
                <th>First_Name</th>
                <th>Last_Name</th>
                <th>Patient_dob</th>
                <th>Patient_age</th>
                <th>Patient_mobile</th>
                <th>Doctor_name</th>
                <th>Appointment_date</th>
                <!-- <th>Appointment_time</th> -->
                <th>Appointment_status</th>
              </tr>
            </thead>
            <tbody class="appointment_data">
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  <!-- Page Content -->
  <div class="container">
    <h1 class="mt-4">Beta Hospital</h1>
    <p>Beta Hospital in Chennai has a supportive and friendly staff, and the latest medical know-how to help patients. The clinic abides by all the necessary safety protocols, including Covid-19 precautionary measures. The doctor and team offer world-class care and guidance, always putting their patients first.</p>
  </div>
  <script>
    $(document).ready(() => {
      updateCount_Of_Doctor_Appointments();
    });

    function updateCount_Of_Doctor_Appointments() {
      $.ajax({
        url: "{{url('countOfDoctor')}}",
        type: 'get',
        success: function(response) {
          $('#totalDoctors').text(response);
        }
      });
      $.ajax({
        url: "{{url('countOfAppointment')}}",
        type: 'get',
        success: function(response) {
          $('#totalAppointment, #totalPatients').text(response);
        }
      });
    }

    $('.ListOfPatients').on('click', () => {
      $('.patient_data').empty();
      $.ajax({
        url: "{{url('fetchAppointment')}}",
        type: 'get',
        success: function(response) {
          var tr = '';
          $.each(response, function(index, patient) {
            tr += '<tr>';
            tr += '<td>' + patient.patient_first_name + '</td>';
            if (patient.patient_last_name === null) {
              tr += '<td>' + " " + '</td>';
            } else {
              tr += '<td>' + patient.patient_last_name + '</td>';
            }
            tr += '<td>' + patient.patient_dob + '</td>'
            tr += '<td>' + patient.patient_age + '</td>';
            tr += '<td>' + patient.doctor_name + '</td>';
            if (patient.appointment_status === null) {
              tr += '<td>' + " " + '</td>';
            } else {
              tr += '<td>' + patient.appointment_status + '</td>';
            }
            tr += '</tr>';
          });
          $('.patient_data').append(tr);
        }
      });
    });
    $('.ListOfAppointments').on('click', () => {
      $('.appointment_data').empty();
      $.ajax({
        url: "{{url('fetchAppointment')}}",
        type: 'get',
        success: function(response) {
          var tr = '';
          $.each(response, function(index, appointment) {
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
            tr += '<td>' + appointment.doctor_name + '</td>';
            tr += '<td>' + appointment.appointment_date + '</td>';
            // tr += '<td>' + appointment.appointment_time + '</td>';
            if (appointment.appointment_status === null) {
              tr += '<td>' + " " + '</td>';
            } else {
              tr += '<td>' + appointment.appointment_status + '</td>';
            }
            tr += '</tr>';
          });
          $('.appointment_data').append(tr);
        }

      })
    });
    $('#dob').on('change', () => {
      calculateAge('#dob', '#age', '#dobError');
    });
    $('.bookappointment').on('click', () => {
      $.ajax({
        type: 'get',
        url: "{{url('fetchDoctor')}}",
        success: function(response) {
          $('.doctorContent').empty();
          var option = '';
          option += '<option>Choose..</option>';
          $.each(response, function(index, doctor) {
            option += '<option value=' + doctor.doctor_name + '>' + doctor.doctor_name + '</option>';
          });
          $('.doctorContent').append(option);
        }
      });
    });
    $('#dr').on('change', function() {
      var doctorname = $('select#dr option:selected').text();
      $.ajax({
        url: "{{url('fetchDoctorFee')}}/" + doctorname,
        type: 'get',
        success: function(response) {
          $('#doctor_id').val(response.doctor_id);
          $('#doctor_fee').val(response.fee);

        }
      });
    });

    $('.ListOfDoctors').on('click', () => {
      $.ajax({
        type: 'get',
        url: "{{url('fetchDoctor')}}",
        success: function(response) {
          $('.doctor_data').empty();
          var div = '';
          var counter = 0;

          $.each(response, function(index, doctor) {
            if (counter % 3 === 0) {
              div += '<div class="row">';
            }
            div += '<div class="col-md-4">';
            div += '<div class="card black">';
            div += '<div class="card-body">';
            div += '<img src="img/doctorlogo.png" alt="" width="50" height="50" class="card-image">';
            div += '<h5 class="card-title">' + doctor.doctor_name + '</h5>'
            div += '<p class="card-text">' + doctor.email + '</p>';
            div += '<p class="card-text">' + doctor.mobile + '</p>';
            div += '<p class="card-text">' + doctor.specilization + '</p>';
            div += '</div>';
            div += '</div>';
            div += '</div>';
            if ((counter + 1) % 3 === 0 || (index + 1) === response.length) {
              div += '</div>';
              div += '<br>';
            }
            counter++;
          });

          $('.doctor_data').append(div);
        }
      });
    });
  </script>
</body>
@endsection