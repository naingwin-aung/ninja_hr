@extends('layouts.app')
@section('title', 'Profile')

@section('content')
    <div class="card mb-3">
        <div class="card-body">
            <div class="row mb-4 justify-content-center">
                <div class="col-md-6 col-sm-12 mb-3">
                    <div class="text-center mt-4">
                        <img src="{{$employee->profile_img_path()}}" alt="employee_img" class="profile_img shadow">
                        <div class="pt-3 px-3">
                            <div>
                                <h4 class="mb-2">{{$employee->name}}</h4>
                                <p class="mb-2"><span class="text-muted"># {{$employee->employee_id}}</span> | <span class="text-theme">{{$employee->phone}}</span></p>
                                <p class="text-muted badge badge-pill badge-light mb-0">{{$employee->department ? $employee->department->title : ' - '}}</p>
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
                <div class="col-md-6 dash-border col-sm-12 pl-4">
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
    <div class="card mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <a href="#" class="logout-btn btn btn-theme"><i class="fas fa-sign-out-alt"></i> Logout</a>
                <form action="{{route('logout')}}" method="POST" id="logout_form">
                    @csrf
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.logout-btn').click(function(e) {
                e.preventDefault();
                swal({
                    text: "You want to logout?",
                    icon: "info",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willLogout) => {
                    if (willLogout) {
                        $('#logout_form').submit();
                    }
                });
            })
        })
    </script>
@endsection
