@extends('layouts.app')
@section('title', 'Employee Detail')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3 border-bottom">
                        <p class="mb-1"><i class="fab fa-gg mr-1"></i> Employee ID</p>
                        <p class="text-muted">{{$employee->employee_id}}</p>
                    </div>
                    <div class="mb-3 border-bottom">
                        <p class="mb-1"><i class="fab fa-gg mr-1"></i> Name</p>
                        <p class="text-muted">{{$employee->name}}</p>
                    </div>
                    <div class="mb-3 border-bottom">
                        <p class="mb-1"><i class="fab fa-gg mr-1"></i> Email</p>
                        <p class="text-muted">{{$employee->email}}</p>
                    </div>
                    <div class="mb-3 border-bottom">
                        <p class="mb-1"><i class="fab fa-gg mr-1"></i> Phone</p>
                        <p class="text-muted">{{$employee->phone}}</p>
                    </div>
                    <div class="mb-3 border-bottom">
                        <p class="mb-1"><i class="fab fa-gg mr-1"></i> NRC Number</p>
                        <p class="text-muted">{{$employee->nrc_number}}</p>
                    </div>
                    <div class="mb-3">
                        <p class="mb-1"><i class="fab fa-gg mr-1"></i> Is Present?</p>
                        <p class="text-muted">
                            @if ($employee->is_present === 1)
                                <span class="badge badge-pill badge-success">Present</span>
                            @else
                                <span class="badge badge-pill badge-danger">Leave</span>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3 border-bottom">
                        <p class="mb-1"><i class="fab fa-gg mr-1"></i> Gender</p>
                        <p class="text-muted">{{ucfirst($employee->gender)}}</p>
                    </div>
                    <div class="mb-3 border-bottom">
                        <p class="mb-1"><i class="fab fa-gg mr-1"></i> Birthday</p>
                        <p class="text-muted">{{ucfirst($employee->birthday)}}</p>
                    </div>
                    <div class="mb-3 border-bottom">
                        <p class="mb-1"><i class="fab fa-gg mr-1"></i> Department</p>
                        <p class="text-muted">{{$employee->department ? $employee->department->title : ' - '}}</p>
                    </div>
                    <div class="mb-3 border-bottom">
                        <p class="mb-1"><i class="fab fa-gg mr-1"></i> Date Of Join</p>
                        <p class="text-muted">{{$employee->date_of_join}}</p>
                    </div>
                    <div class="mb-3 border-bottom">
                        <p class="mb-1"><i class="fab fa-gg mr-1"></i> Address</p>
                        <p class="text-muted">{{$employee->address}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
