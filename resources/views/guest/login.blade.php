@extends('layout.layout')
@section('title', 'Login | GP Calculator')

@section('content')

    <div class="container-fluid bg-white text-center">
        <div class="row">
            <div class="col-1 col-md-4"></div>
            <div class="col-10 col-md-4">
                <div>
                    <h1 class="text-center text-primary">GP Calculator</h1>
                </div>
                @if (session('msg-3'))
                    <p class="text-danger text-center">Invalid login details</p>
                @endif
                <form action="{{ route('user.login') }}" method="post" class="row gx-3 gy-2 align-items-center p-3">
                    @csrf
                    <input type="email" name="email"
                        class="form-control my-2 shadow-none @error('email') border-danger @enderror" id=""
                        placeholder="Email" value="{{ old('email') }}">
                    <input type="password" name="password"
                        class="form-control my-2 shadow-none @error('password') border-danger @enderror" id=""
                        placeholder="Password">
                    <button type="submit" class="btn btn-primary shadow-none">Sign In</button>
                </form>
                @if (session('msg-1'))
                    <p class="text-info text-center my-3">Please verify your email to continue</p>
                @endif
                @if (session('msg-5'))
                    <p class="text-info text-center my-3">Almost there, check your email for verification to complete
                        your
                        registration</p>
                @endif
                @if (session('msg-6'))
                    <p class="text-info text-center my-3">Email verification successfull, Sign In</p>
                @endif
                @if (session('msg-7'))
                    <p class="text-info text-center my-3">Your email has already been verified</p>
                @endif
                @if (session('msg-8'))
                    <p class="text-danger text-center my-3">Something went wrong, Try again</p>
                @endif
                @if (session('msg-11'))
                    <p class="text-Info text-center my-3">Password reset successfull</p>
                @endif
                <div class="container-fluid text-center ">
                    <a href="{{ route('forgetpassword') }}" class="text-decoration-none">Forgot Password ?</a>
                    <p>Don't have an account? <a class="text-decoration-none" href="{{ route('register') }}">
                            Register<a></p>
                </div>

            </div>
            <div class="col-1 col-md-4"></div>
        </div>
    </div>


@endsection
