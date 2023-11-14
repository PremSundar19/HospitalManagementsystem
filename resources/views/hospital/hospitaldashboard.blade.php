@extends('layouts.form')
@section('content')
<body class="hospitaldashboard dashboard">
    <div class="container">
    <h1 class="mt-4 black">Welcome To Our Hospital</h1>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card black">
                <div class="card-body">
                    <h5 class="card-title">Patients</h5>
                    <p class="card-text">Total Patients: 200</p>
                    <a href="#" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card black">
                <div class="card-body">
                    <h5 class="card-title">Doctors</h5>
                    <p class="card-text">Total Doctors: 30</p>
                    <a href="#" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card black">
                <div class="card-body">
                    <h5 class="card-title">Appointments</h5>
                    <p class="card-text">Upcoming Appointments: 50</p>
                    <a href="#" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4 ">
        <div class="col-md-12">
            <div class="card black">
                <div class="card-body">
                    <h5 class="card-title">Hospital Statistics</h5>
                    <p class="card-text">Add charts and statistics here.</p>
                    <a href="#" class="btn btn-primary">View Statistics</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
@endsection