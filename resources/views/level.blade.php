@extends('layout.layout')
@section('title', 'Result')

@section('content')
    <div class="container-fluid m-auto">
        <div class="row m-5 mt-2">
            <div class="col-md-4 col-sm-2"></div>

            <div class="col-md-4 col-sm-8 text-center">
                @if ($profile->level->count() > 0)
                    <h5 class="m-3">Level(s)</h5>
                    <table class="table table-bordered table-striped table-responsive">
                        <tbody>
                            <tr>
                                @foreach ($profile->level as $level)
                                    <td scope="row" class="fw-bold">
                                        <a class='text-decoration-none'
                                            href="{{ route('result', [$profile->profile_id, $level->id]) }}">{{ $level->level }}</a>
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                @endif
                <div class="m-5">
                    <h5 class="mb-3">Add Level</h5>
                    <form class="row gx-3 gy-2 align-items-center" action="{{ route('add_level', $profile->profile_id) }}"
                        id="myform" method="POST">
                        @csrf
                        <select class="form-control shadow-none" name="level" id="" required>
                            <option value="100">100 Level</option>
                            <option value="200">200 Level</option>
                            <option value="300">300 Level</option>
                            <option value="400">400 Level</option>
                            <option value="500">500 Level</option>
                            <option value="500">600 Level</option>
                        </select>
                        <button type="submit" class="btn btn-info shadow-none">Add</button>
                    </form>
                    <div class="m-5">
                        <h5>{{ $profile->profile_name }} Total CGPA</h5>
                        @if ($profile->gp_type == 5)
                            <h5
                                class="@if ($cgpa >= 4.5) text-success
                        @elseif($cgpa >= 3.5)text-primary
                        @elseif($cgpa >= 2.5)text-warning
                        @else text-danger @endif">
                                {{ $cgpa }}</h5>
                        @else
                            <h5
                                class="@if ($cgpa >= 3.5) text-success
                        @elseif($cgpa >= 3)text-primary
                        @elseif($cgpa >= 2)text-warning
                        @else text-danger @endif">
                                {{ $cgpa }}</h5>
                        @endif
                    </div>
                </div>
                <a href="{{ route('home') }}" class="fw-bold text-decoration-none text-secondary">Back</a>
            </div>
            <div class="col-md-4 col-sm-2"></div>

        </div>
    </div>

@endsection
