@extends('layouts.form')
@section('content')
<body class="registerbc dashboard">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="form">
                    <form action="{{url('storeDoctor')}}" class="actualform" method="post">
                        @csrf
                        <h5>Register Form</h5>
                            <div class="form-group">
                                     <label for="doctorname" class="form-label">Doctor Name</label>
                                     <input type="text" name="doctorname" id="doctorname" class="form-control @error('doctorname') is-invalid @enderror" value="{{old('doctorname') ? : ''}}">
                                       @error('doctorname')
                                       <span class="text-danger">{{$message}}</span>
                                       @enderror
                                    </div>
                            <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                     <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"  value="{{old('email') ? : ''}}">
                                     @error('email')
                                       <span class="text-danger">{{$message}}</span>
                                       @enderror
                                    </div>
                     
                        <div class="form-group">
                            <label for="mobile" class="form-label">Mobile</label>
                            <input type="number" name="mobile" id="mobile" class="form-control  @error('mobile') is-invalid @enderror"  value="{{old('mobile') ? : ''}}">
                            @error('mobile')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="specilization" class="form-label">Specilization</label>
                            <select name="specilization" id="specilization" class="form-select">
                            <option>Choose...</option>
                            <option value="Anesthesiology">Anesthesiology</option>
                            <option value="Cardiology">Cardiology</option>
                            <option value="Dermatology">Dermatology</option>
                            <option value="Neurologist">Neurologist</option>
                            <option value="Dermatologist">Dermatologist</option>
                            <option value="Neurosurgery">Neurosurgery</option>
                            <option value="Psychiatry">Psychiatry</option>
                            <option value="Endocrinologist">Endocrinologist</option>
                            <option value="Accident and emergency medicine">Accident and emergency medicine</option>
                            <option value="Dentist">Dentist</option>
                            <option value="Immunology">Immunology</option>
                            </select>
                            
                            @error('specilization')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="mobile" class="form-label"> Fee </label>
                            <input type="number" name="fee" id="fee"  class="form-control  @error('fee') is-invalid @enderror"  value="{{old('fee') ? : ''}}">
                            @error('fee')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                            <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control  @error('password') is-invalid @enderror"  value="{{old('password') ? : ''}}">
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
</body>
@endsection