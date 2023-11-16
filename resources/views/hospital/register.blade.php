@extends('layouts.form')
@section('content')

<body class="registerbc dashboard">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                @if(Session::has('message'))
                <div class="alert alert-success justify-content-justify" role="alert">
                    {{ Session::get('message') }}
                </div>
                <script>
                    setTimeout(function() {
                        var alert = document.querySelector('.alert');
                        alert.style.display = 'none';
                        window.location.href = '/hospitaldashboard';
                    }, 4000);
                </script>
                @endif

                <div class="form">
                    <form action="{{url('storeUser')}}" class="actualform" method="post">
                        @csrf
                        <h5>Register Form</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="first_name" class="form-label"> First Name </label>
                                <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{old('first_name') ? : ''}}">
                                @error('first_name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="lastname" class="form-label"> Last Name </label>
                                <input type="text" name="lastname" id="lastname" class="form-control" value="{{old('lastname') ? : ''}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dob" class="form-label"> Date Of Birth </label>
                            <input type="date" name="dob" id="dob" class="form-control  @error('dob') is-invalid @enderror" value="{{old('dob') ? : ''}}">
                            @error('dob')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <span class="text-danger" id="dobError"></span>
                        </div>
                        <div class="form-group">
                            <label for="age" class="form-label"> Age </label>
                            <input type="number" name="age" id="age" class="form-control  @error('age') is-invalid @enderror" value="{{old('age') ? : ''}}">
                            @error('age')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label"> Email </label>
                            <input type="email" name="email" id="email" class="form-control  @error('email') is-invalid @enderror" value="{{old('email') ? : ''}}">
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="mobile" class="form-label"> Mobile </label>
                            <input type="number" name="mobile" id="mobile" class="form-control  @error('mobile') is-invalid @enderror" value="{{old('mobile') ? : ''}}">
                            @error('mobile')
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
                        <br>
                        <div class="form-group">
                            <input type="submit" value="Register" class="btn btn-primary btn-xs py-1">
                            <!-- <button type="button" class="btn btn-secondary btn-xs py-1">Close</button> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#dob').on('change', () => {
            calculateAge('#dob', '#age', '#dobError');
        });
    </script>
</body>
@endsection