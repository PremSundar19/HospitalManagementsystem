@extends('layouts.form')
@section('content')
<body class="loginbc dashboard">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
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
                    <form action="{{url('loginUser')}}" class="actualform" method="post">
                        @csrf
                        <h5>Login Form</h5>
                        <div class="form-group">
                            <label for="email" class="form-label"> Email </label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label"> Password </label>
                            <input type="password" name="password" id="password" class="form-control  @error('password') is-invalid @enderror">
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
                                <option value="User">User</option>
                            </select>
                            @error('type')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <br>
                        <div class="form-group">
                            <input type="submit" value="Login" class="btn btn-primary btn-xs py-1">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection