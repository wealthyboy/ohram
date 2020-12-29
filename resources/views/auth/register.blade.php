@extends('layouts.auth')
 
@section('content')
<section class="sec-padding bg--gray">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8  bg--light p-4">
                    <div class=" mt-4 mb-4">
                        <form method="POST" class="pl-4 pr-4" action="/register">
                            @if ($errors->any() )
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all()  as $error)
                                           <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="text-center">
                                <h1>Register</h1>
                                <p class=""> Have access to your order history ,track your orders .e.t.c</p>
                                    <!-- <a href="/login/facebook" class="btn btn-facebook btn-round">
                                        <i class="fab fa-facebook-f"></i> Sign up with Facebook 
                                    </a>  -->
                                </div>
                            <div class="row ">
                                @csrf
                                <p class="form-group p-1 col-6">
                                    <label for="first_name">First Name</label>
                                    <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>
                                </p>
                                <p class="form-group  p-1 col-6">
                                    <label for="last_name">Last Name</label>
                                    <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>
                                </p>
                                <div class="clearfix"></div>

                                <p class="form-group p-1 col-6">
                                    <label for="email">Email address</label>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                </p>
                                <p class="form-group p-1 col-6">
                                    <label for="phone_number">Phone Number</label>
                                    <input id="phone_number" type="text" class="form-control" name="phone_number" value="{{ old('phone_number') }}" required autofocus>
                                </p>
                                <div class="clearfix"></div>

                                <p class="form-group p-1 col-6">
                                    <label for="password">Password</label>
                                    <input id="password" type="password" class="form-control" name="password" required>
                                </p>
                                <p class="form-group p-1 col-6">
                                    <label for="password">Confirm Password</label>
                                    <input id="password" type="password" class="form-control" name="password_confirmation" required>
                                </p>
                                <div class="clearfix"></div>
                                <p class="form-group flex-grow-1 col-6 mt-2">
                                    Already have account?<a  class="bold color--primary" href="/login"> Login</a>
                                </p>
                                <p class="form-group text-right col-6 mt-2">
                                    <button type="submit" class="btn btn--lg btn--primary ml-1 bold" name="register" value="Log in">Submit</button>
                                </p>
                            
                            </div>
                            <p class="text-center border-top pt-5"> By registering your details, you agree with our <a class="color--primary bold" href="https://ohram.org/pages/terms-conditions">Terms & Conditions</a> , and <a class="color--primary bold" href="https://ohram.org/pages/privacy-policy">Privacy and Cookie Policy.</a> </p>

                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <!--End Content-->
@endsection
