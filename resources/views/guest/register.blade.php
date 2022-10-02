@extends('layout.layout')
@section('title', 'Register')

@section('content')

    <div class="container-fluid bg-white text-center">
        <div class="row">
            <div class="col-1 col-md-4"></div>
            <div class="col-10 col-md-4">
                <div>
                    <h1 class="text-center text-primary">GP Calculator</h1>
                </div>
                <form action="{{ route('user.register') }}" method="post" class="row gx-3 gy-2 align-items-center p-3">
                    @csrf
                    <input type="text" name="fname"
                        class="form-control my-2 shadow-none @error('fname') border-danger @enderror" id=""
                        placeholder="First Name" value="{{ old('fname') }}">
                    <input type="text" name="mname" class="form-control my-2 shadow-none" id=""
                        placeholder="Middle Name (Optional)" value="{{ old('mname') }}">
                    <input type="text" name="lname"
                        class="form-control my-2 shadow-none @error('lname') border-danger @enderror" id=""
                        placeholder="Last Name" value="{{ old('lname') }}">
                    <input type="email" name="email"
                        class="form-control my-2 shadow-none @error('email') border-danger @enderror" id=""
                        placeholder="Email" value="{{ old('email') }}">
                    <input type="password" name="password"
                        class="form-control my-2 shadow-none @error('password') border-danger @enderror" id=""
                        placeholder="@error('password') {{ $message }} @else Password @enderror">
                    <input type="password" name="password_confirmation"
                        class="form-control my-2 shadow-none @error('password') border-danger @enderror" id=""
                        placeholder="@error('password') {{ $message }} @else Repeat Password @enderror">

                    <button type="submit" class="btn btn-primary shadow-none">Sign Up</button>
                </form>
                @if (session('msg-4'))
                    <p class="text-danger text-center my-3">Email address already in use!</p>
                @endif
                <div class="container-fluid text-center ">
                    <p>Already have an account? <a class="text-decoration-none" href="{{ route('login') }}">Sign In<a></p>
                </div>
            </div>
            <div class="col-1 col-md-4"></div>
        </div>
    </div>
@endsection
