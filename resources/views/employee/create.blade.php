@extends('layouts.app')
@section('title', 'Employee Create')

@section('content')
<div class="card create_form">
    <div class="card-body">

        @include('layouts.flash')

        <form action="{{route('employee.store')}}" method="POST" id="employee_create" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="md-form">
                <label>Employee ID</label>
                <input type="text" name="employee_id" class="form-control">
            </div>
            <div class="md-form">
                <label>Name</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="md-form">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control">
            </div>
            <div class="md-form">
                <label>Email</label>
                <input type="text" name="email" class="form-control">
            </div>
            <div class="md-form">
                <label>Nrc Number</label>
                <input type="text" name="nrc_number" class="form-control">
            </div>
            <div class="md-form">
                <div class="mb-3">
                    <label>Gender</label><br/>
                </div>
                <div class="px-4">
                    <div class="custom-control custom-radio mb-2">
                        <input type="radio" class="custom-control-input form-control" id="defaultGroupExample1" name="gender" value="male" checked>
                        <label class="custom-control-label" for="defaultGroupExample1">Male</label>
                    </div>

                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="defaultGroupExample2" name="gender" value="female">
                        <label class="custom-control-label" for="defaultGroupExample2">Female</label>
                    </div>
                </div>
            </div>
            <div class="md-form">
                <div class="mb-4">
                    <label>Date of Birth</label><br/>
                </div>
                <input type="text" name="birthday" id="birthday" class="form-control">
            </div>
            <div class="md-form">
                <textarea id="form7" class="md-textarea form-control" rows="3" name="address"></textarea>
                <label for="form7">Address</label>
            </div>
            <div class="md-form">
                <div class="mb-4">
                    <label>Department</label><br/>
                </div>
                <select name="department_id" class="form-control">
                    @foreach ($departments as $department)
                    <option value="{{$department->id}}">{{$department->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="md-form">
                <div class="mb-4">
                    <label>Date of Join</label><br/>
                </div>
                <input type="text" name="date_of_join" id="date_of_join" class="form-control">
            </div>
            <div class="md-form">
                <div class="mb-4">
                    <label>Is Present?</label><br/>
                </div>
                <select name="is_present" class="form-control">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div class="form-group">
                <label>Profile Images</label>
                <div class="input-group mb-3">
                    <div class="custom-file">
                      <input type="file" class="form-control p-1" name="profile_img" id="profile_img">
                    </div>
                </div>
                <div class="preview_img">

                </div>
            </div>
            <div class="md-form">
                <label>Password</label>
                <input type="text" name="password" class="form-control">
            </div>

            <div class="d-flex justify-content-center">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-theme btn-block">Confirm</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\StoreEmployeeRequest', '#employee_create') !!}
<script>
        $(document).ready(function() {
            $('#birthday').daterangepicker({
                "singleDatePicker": true,
                "locale": {
                    "format": "YYYY-MM-DD",
                },
                "autoApply": true,
                "maxDate" : moment(),
                "showDropdowns": true,
                "drops": "up"
            });

            $('#date_of_join').daterangepicker({
                "singleDatePicker": true,
                "locale": {
                    "format": "YYYY-MM-DD",
                },
                "autoApply": true,
                "showDropdowns": true,
            });

            $('#profile_img').on('change', function() {
                let file_length = document.getElementById('profile_img').files.length;
                $('.preview_img').html('');
                for(let i = 0; i < file_length ; i++) {
                    $('.preview_img').append(`<img src="${URL.createObjectURL(event.target.files[i])}" />`)
                }
            })
        })
    </script>
@endsection
