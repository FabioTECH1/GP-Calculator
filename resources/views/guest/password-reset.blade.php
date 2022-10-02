@extends('layout.layout')
@section('title', 'Password Reset')

@section('content')



    <div class="row my-5">
        <div class="col-sm-4"></div>
        <div class="col-sm-4 text-center">
            <h4 class="my-3 text-secondary">Password Reset</h4>
            <form action="{{ route('resetLink.mail') }}" method="post">
                @csrf
                <input class="form-control my-2 shadow-none @error('email') border-danger @enderror" type="email"
                    name="email" placeholder="Enter your email">
                <input class="btn btn-primary btn-sm shadow-none" type="submit" value="Submit">
            </form>
        </div>
        @if (session('msge'))
            <p class="text-secondary text-center my-3">{{ session('msge') }} </p>
        @endif
        <div class="col-sm-4"></div>
    </div>

@endsection
