@extends('layout.layout')
@section('title', 'Result')

@section('content')
    <div class="container-fluid m-auto">
        <div class="row m-5 mt-2">
            <div class="col-md-2 col-sm-1"></div>
            <div class="col-md-8 col-sm-10 text-center">
                {{-- <h6 class="text-capitalize text-primary">{{ $profile->profile_name }} Profile</h6> --}}
                <a href="{{ route('level', session()->get('prof_id')) }}"
                    class="fw-bold text-decoration-none text-secondary">Back</a>
                {{-- @if ($results->count() > 0) --}}
                <div class="container-fluid m-auto">
                    <div class="row mt-2">
                        <div class="col-md-6 col-sm-12">
                            <h5 class="text-capitalize m-2">First Semester</h5>
                            <table class="table table-bordered table-striped table-responsive">
                                <thead>
                                    <th>Course</th>
                                    <th>Unit</th>
                                    <th>Grade</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody class="tbody_first">
                                    @foreach ($results as $mykey => $result)
                                        @if ($result->semester == 'first')
                                            @foreach ($result->course as $key => $unit)
                                                <tr>
                                                    <td scope="row" class="fw-bold text-uppercase">
                                                        {{ $result->course[$key] }}
                                                    </td>
                                                    <td>{{ $result->unit[$key] }}</td>
                                                    <td>
                                                        {{ $result->grade_alpha[$key] }}
                                                    </td>
                                                    <td>
                                                        <form
                                                            action="{{ route('remove_course', [$profile->profile_id, $result->semester, $key, $level_id]) }}"
                                                            method="post" class="delete_course">
                                                            @csrf
                                                            <button class='delete btn btn-link shadow-none'><svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor" class="bi bi-trash"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                                    <path fill-rule="evenodd"
                                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                                </svg></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endforeach
                                    <tr>
                                        <div class="m-4 mt-0">
                                            <h6>
                                                GP - <span class="text-info" id="gp1">{{ $cgpa[0] }}</span>
                                            </h6>
                                        </div>
                                    </tr>
                                    {{-- add course --}}
                                    @include('add_course.add_course_first')

                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <h5 class="text-capitalize m-2">Second Semester</h5>
                            <table class="table table-bordered table-striped table-responsive">
                                <thead>
                                    <th>Course</th>
                                    <th>Unit</th>
                                    <th>Grade</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody class="tbody_second">
                                    @foreach ($results as $mykey => $result)
                                        @if ($result->semester == 'second')
                                            @foreach ($result->course as $key => $unit)
                                                <tr>
                                                    <td scope="row" class="fw-bold text-uppercase">
                                                        {{ $result->course[$key] }}
                                                    </td>
                                                    <td>{{ $result->unit[$key] }}</td>
                                                    <td>
                                                        {{ $result->grade_alpha[$key] }}
                                                    </td>
                                                    <td>
                                                        <form
                                                            action="{{ route('remove_course', [$profile->profile_id, $result->semester, $key, $level_id]) }}"
                                                            method="post" class="delete_course">
                                                            @csrf
                                                            <button class='delete btn btn-link shadow-none'><svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor" class="bi bi-trash"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                                    <path fill-rule="evenodd"
                                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    @endforeach
                                    <tr>
                                        <div class="m-4 mt-0">
                                            <h6>
                                                GP - <span class="text-info" id="gp2">{{ $cgpa[1] }}</span>
                                            </h6>
                                        </div>
                                    </tr>
                                    {{-- add course --}}
                                    @include('add_course.add_course_second')
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div>
                    <h5 class="text-primary m-2">{{ $level }} LEVEL</h5>
                    <h5>Level CGPA -
                        @if ($fs_cgpa == '')
                            <span class="text-info" id="fsgp">X.XX</span>
                        @else
                            <span class="text-info" id="fsgp">{{ $fs_cgpa }}</span>
                        @endif
                    </h5>
                </div>
            </div>
            <div class="col-md-2 col-sm-1"></div>

        </div>
    </div>

    <script src="{{ asset('js/ajax/add_course.js') }}"></script>

@endsection
