@extends('layouts.form')
@section('content')
<body class="userdashboard">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
<div class="row text-primary"><h5>User DashBoard</h5></div>
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="https://placeholder.pics/svg/150x50/888888/EEE/Logo" alt="..." height="36">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Appointment-status</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Hospital-info</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
<?php
use Illuminate\Support\Facades\Session;
  $userId = Session::get('id');
  echo $userId;
?>
<!-- Page Content -->
<div class="container">
  <h1 class="mt-4">Beta Hospital</h1>
  <p>Beta Hospital in Chennai has a supportive and friendly staff, and the latest medical know-how to help patients. The clinic abides by all the necessary safety protocols, including Covid-19 precautionary measures. The doctor and team offer world-class care and guidance, always putting their patients first.</p>
</div>
</body>
@endsection