@extends('layouts.form')
@section('content')

<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-5">
        @if(Session::has('message'))
        <div class="alert alert-{{Session::get('class')}} justify-content-justify" role="alert">
          {{ Session::get('message') }}
        </div>
        <script>
          setTimeout(function() {
            var alert = document.querySelector('.alert');
            alert.style.display = 'none';
            var status = "{{session::get('status')}}";
            if (status) {
              window.location.href = '/admindashboard';
            }
          }, 4000);
        </script>
        @endif
        <form action="{{url('bookAppointment')}}" class="appointmentform black" method="post">
          @csrf
          <h5 class="Appointmenttitle">New Patient Appointment Form</h5>
          <div class="row">
            <input type="hidden" name="doctor_id" id="doctor_id">
            <div class="col-md-6">
              <label for="first_name" class="form-label"> First Name </label>
              <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{old('first_name')}}">
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
              <span id="appointment_dateError" class="text-danger"></span>
              @error('appointment_date')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            <div class="col-md-6">
              <label for="appointment_time" class="form-label">Appointment Time</label>
              <input type="time" name="appointment_time" id="appointment_time" class="form-control  @error('appointment_time') is-invalid @enderror" value="{{old('appointment_time') ? : ''}}">
              <span id="appointment_timeError" class="text-danger"></span>
              @error('appointment_time')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label for="Specialists">Specialists</label>
              <select name="Specialists" id="Specialists" class="form-select">
                <option>Choose...</option>
                <option value="Cardiology">Cardiology</option>
                <option value="Dermatology">Dermatology</option>
                <option value="Neurologist">Neurologist</option>
                <option value="Dermatologist">Dermatologist</option>
                <option value="Psychiatry">Psychiatry</option>
                <option value="Endocrinologist">Endocrinologist</option>
                <option value="Accident and emergency medicine">Accident and emergency medicine</option>
                <option value="Dentist">Dentist</option>
                <option value="Immunology">Immunology</option>
              </select>
            </div>
            <div class="col-md-6 d" style="display: none;">
              <label for="doctor_name">Doctor name</label>
              <select name="doctor_name" id="doctor_name" class="form-select displayDoctors">
              </select>
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
    </div>
  </div>
  <script>
    $(document).ready(() => {
      $('#appointment_date').on('change', () => {
        var appointmentDate = new Date($('#appointment_date').val());
        var today = new Date();
        if ((appointmentDate.getMonth() === today.getMonth() && appointmentDate.getDate() < today.getDate()) || (appointmentDate.getFullYear() === today.getFullYear() && appointmentDate.getMonth() < today.getMonth()) || (appointmentDate.getFullYear() < today.getFullYear())) {
          $('#appointment_date').val('');
          $('#appointment_dateError').text('* Please select proper date');
        } else {
          $('#appointment_dateError').text('');
        }

      });
      $('#dob').on('change', () => {
        calculateAge('#dob', '#age', '#dobError');
      });
      $('#doctor_name').on('change', function() {
        var doctorname = $('select#doctor_name option:selected').text();
        $.ajax({
          url: "{{url('fetchDoctorFee')}}/" + doctorname,
          type: 'get',
          success: function(response) {
            $('#doctor_id').val(response.doctor_id);
          }
        });
      });
      $('#Specialists').on('change', function() {
        var specilization = $('select#Specialists option:selected').text();
        console.log(specilization);
        $.ajax({
          url: '/fetchDoctorBasedOnSpecilization/' + specilization,
          type: 'GET',
          dataType: 'json',
          success: function(response) {
            $('.displayDoctors').empty();
            var option = '';
            option += '<option>Choose..</option>';
            $.each(response, function(index, doctor) {
              option += '<option value=' + doctor.doctor_name + '>' + doctor.doctor_name + '</option>';
            });

            $('.displayDoctors').append(option);
            $('.d').show();
          }
        });
      });
      $('#doctor_name').click(() => {
        var now = new Date($('#appointment_date').val());
        var m = now.getMonth() + 1;
        var date = now.getFullYear() + '-' + m + '-' + now.getDate();
        $.ajax({
          url: '/fetchdoctorName/' + date,
          type: 'GET',
          dataType: 'json',
          success: function(response) {
            $('#doctor_name option').each(function() {
              var doctorName = $(this).val();
              var matchingDoctor = response.find(doctor => doctorName === doctor.doctor_name && doctor.status === 1);
              if (matchingDoctor) {
                $(this).addClass("red");
              } else {
                $(this).addClass("green");
              }
            });
          }
        });
      });


    //   $('#appointment_time').on('change', () => {
    //     var selectedTime = $('#appointment_time').val();
    //     var selectedDate = new Date($('#appointment_date').val());
    //     var now = new Date();
    //     var hours = now.getHours().toString().padStart(2, '0');
    //     var minutes = now.getMinutes().toString().padStart(2, '0');
    //     var currentTime = hours + ':' + minutes;
    //     if ((selectedTime < currentTime) && now.getDate() === selectedDate.getDate()) {
    //       $('#appointment_timeError').text('* Please select proper time');
    //       $('#appointment_time').val('');
    //     } else {
    //       $('#appointment_timeError').text('');
    //     }
    //   });
    });
  </script>
</body>
@endsection