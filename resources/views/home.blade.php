@extends('layout.layout')
@section('title', 'Home')

@section('content')
    <div class="container-fluid m-auto">
        <div class="row m-5 mt-2">
            <div class="col-md-4 col-sm-2"></div>
            <div class="col-md-4 col-sm-8">
                @if (auth()->user()->profile->count() > 0)
                    <h4 class="mt-3 text-center">Existing profiles</h4>
                    <table class="table table-bordered table-striped table-responsive">
                        <tbody>
                            @foreach (auth()->user()->profile as $profile)
                                <tr>
                                    <td scope="row" class="fw-bold"><a class="me-5 text-decoration-none"
                                            href="{{ route('level', $profile->profile_id) }}">
                                            {{ $profile->profile_name }}
                                        </a></td>
                                    <td> <a href="{{ route('delete_profile', $profile->profile_id) }}"
                                            class="text-decoration-none"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                <path fill-rule="evenodd"
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                            </svg></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                <div class="mt-5">
                    <h5 class="text-center">Add profile</h5>
                    <form class="row gx-3 gy-2" action="{{ route('add_profile') }}" method="POST">
                        @csrf
                        <input class="form-control my-2 shadow-none" type="text" name="profile_name" id="" required
                            autocomplete="off">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gp_type" id="flexRadioDefault1" value="4">
                            <label class="form-check-label fw-bold" for="gp_type1">
                                4-points
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gp_type" id="flexRadioDefault2" value="5"
                                checked>
                            <label class="form-check-label fw-bold" for="gp_type2">
                                5-points
                            </label>
                        </div>
                        {{-- <input type="radio" name="" id=""> --}}
                        <button type="submit" class="btn btn-info shadow-none">Add</button>
                        @if (session()->get('info'))
                            <p class="text-info text-center">Only a minimum of two profiles is allowed</p>
                        @endif
                    </form>
                </div>
            </div>
            <div class="col-md-4 col-sm-2"></div>
        </div>
    </div>

@endsection
