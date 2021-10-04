@extends('layouts.app')
@section('title', 'Ninja HR')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="col-md-12 text-center">
                <div class="text-center">
                    <img src="{{$employee->profile_img_path()}}" alt="employee_img" class="profile_img shadow">
                    <div class="py-3 px-3">
                        <div>
                            <h4 class="mb-2">{{$employee->name}}</h4>
                            <p class="mb-2"><span class="text-muted"># {{$employee->employee_id}}</span> | <span class="text-theme">{{$employee->phone}}</span></p>
                            <p class="text-muted badge badge-pill badge-light">{{$employee->department ? $employee->department->title : ' - '}}</p>
                            <p class="text-muted mb-0 mt-2">
                                @foreach ($employee->roles as $role)
                                    <span class="badge badge-pill badge-primary">
                                        {{$role->name}}
                                    </span>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
