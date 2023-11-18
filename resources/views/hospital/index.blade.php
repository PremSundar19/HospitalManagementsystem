@extends('layouts.form')
@section('content')

<body class="hospitaldashboard dashboard">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
        <div class="row">
            <h5>Beta - Hospital </h5>
        </div>
        <div class="container">
            <a class="navbar-brand" href="#">
                <!-- <img src="https://placeholder.pics/svg/150x50/888888/EEE/Logo" alt="..." height="36"> -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('aboutus')}}">aboutus</a>
                    </li>
                    <li class="nav-item dropdown">
                        <!-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> -->
                        <!-- More -->
                        <!-- </a> -->
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
    <div class="container mt-5">
        <h1 class="mt-4 black">Welcome to Beta Hospital</h1>
    </div>
    <div class="container ">
        <div class="row">
            <div class="col-lg-4">
                @if(Session::has('message'))
                <div class="alert alert-danger justify-content-justify" role="alert">
                    {{ Session::get('message') }}
                </div>
                <script>
                    setTimeout(function() {
                        var alert = document.querySelector('.alert');
                        alert.style.display = 'none';
                    }, 4000);
                </script>
                @endif
                <div class="form">
                    <form action="{{url('loginUser')}}" class="actualform anchor" method="post">

                        @csrf
                        <h5>Login Form</h5>
                        <div class="form-group">
                            <label for="email" class="form-label"> Email </label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email') ? : ''}}">
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label"> Password </label>
                            <input type="password" name="password" id="password" class="form-control  @error('password') is-invalid @enderror" value="{{old('password') ? : ''}}">
                            @error('password')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="type" class="form-label"> Type </label>
                            <select name="type" id="type" class="form-select  @error('type') is-invalid @enderror">
                                <option>Choose..</option>
                                <option value="Admin">Admin</option>
                                <option value="Doctor">Doctor</option>
                            </select>
                            @error('type')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="submit" value="Login" class="btn btn-primary btn-xs py-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span style="left: 50px;">Not a member? <a href="{{url('register')}}">Sign up </a></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="container mt-5">
        <div class="col-md-7">
            <div class="card black">
                <div class="card-body">
                    <h5 class="card-title">Beta Hospital</h5>
                    <p class="card-text">Beta Hospital in Chennai has a supportive and friendly staff, and the latest medical know-how to help patients. The clinic abides by all the necessary safety protocols, including Covid-19 precautionary measures. The doctor and team offer world-class care and guidance, always putting their patients first.</p>
                </div>
            </div>
        </div>
    </div> -->

</body>
@endsection