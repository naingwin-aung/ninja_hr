@extends('layouts.app_plain')

@section('title', 'Login')

@section('extra_css')
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh">
            <div class="col-md-6 mb-5">
                <div class="text-center">
                    <img src="{{asset('images/logo.jpg')}}" alt="Ninja HR" style="width: 120px" height="110px">
                </div>
                <div class="card p-4">
                    <div class="card-body">
                        <div class="text-center">
                            <h5>Login</h5>
                            <p class="text-muted">Please Fill the login form</p>
                        </div>

                        <form class="text-center" style="color: #757575;" method="POST" action="{{ route('login') }}">
                            @csrf
                            <!-- Email -->
                            <div class="md-form">
                                <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{old('phone')}}" required autofocus autocomplete="off">
                                <label for="materialLoginFormphone">Phone Number</label>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                    
                            <!-- Password -->
                            <div class="md-form">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                <label for="materialLoginFormPassword">Password</label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                    
                            <div class="d-flex justify-content-start">
                                <div>
                                    <!-- Remember me -->
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="materialLoginFormRemember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="materialLoginFormRemember">Remember me</label>
                                    </div>
                                </div>
                            </div>
                    
                            <!-- Sign in button -->
                            <button class="btn btn-theme btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
