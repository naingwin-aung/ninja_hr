@extends('layouts.app')
@section('title', 'Employee Detail')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row mb-4 justify-content-center align-items-center" style="width: 100%">
                <div class="col-md-6 col-sm-12">
                    <div class="d-flex justify-content-center">
                        <img src="{{$employee->profile_img_path()}}" alt="employee_img" class="profile_img shadow">
                        <div class="py-3 px-3">
                            <div>
                                <h4>{{$employee->name}}</h4>
                                <p class="text-muted mb-1">{{$employee->employee_id}}</p>
                                <p class="text-muted">{{$employee->department ? $employee->department->title : ' - '}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 dash-border col-sm-12">
                    <p class="mb-1"><b>Name</b>: <span class="text-muted">{{$employee->name}}</span></p>
                    <p class="mb-1"><b>Phone</b>: <span class="text-muted">{{$employee->phone}}</span></p>
                    <p class="mb-1"><b>email</b>: <span class="text-muted">{{$employee->email}}</span></p>
                    <p class="mb-1"><b>Nrc</b>: <span class="text-muted">{{$employee->nrc_number}}</span></p>
                    <p class="mb-1"><b>Gender</b>: <span class="text-muted">{{ucfirst($employee->gender)}}</span></p>
                    <p class="mb-1"><b>Birthday</b>: <span class="text-muted">{{$employee->birthday}}</span></p>
                    <p class="mb-1"><b>Address</b>: <span class="text-muted">{{$employee->address}}</span></p>
                    <p class="mb-1"><b>Date Of Join</b>: <span class="text-muted">{{$employee->date_of_join}}</span></p>
                    <p class="mb-1"><b>Is Present?</b>: <span class="text-muted">
                        @if ($employee->is_present === 1)
                            <span class="badge badge-pill badge-success">Present</span>
                        @else
                            <span class="badge badge-pill badge-danger">Leave</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
