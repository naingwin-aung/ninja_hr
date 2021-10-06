@extends('layouts.app')
@section('title', 'Company Setting Edit')

@section('extra_css')
    <style>
        .daterangepicker.single .drp-calendar.left {
            margin-right: 8px!important;
        }
    </style>
@endsection
@section('content')
<div class="card create_form">
    <div class="card-body">

        @include('layouts.flash')

        <form action="{{route('company-setting.update', $company_setting->id)}}" method="POST" id="setting_update" autocomplete="off">
            @csrf
            @method('PUT')

            <div class="md-form">
                <label>Name</label>
                <input type="text" name="company_name" class="form-control" value="{{$company_setting->company_name}}">
            </div>

            <div class="md-form">
                <label>Email</label>
                <input type="email" name="company_email" class="form-control" value="{{$company_setting->company_email}}">
            </div>

            <div class="md-form">
                <label>Phone</label>
                <input type="number" name="company_phone" class="form-control" value="{{$company_setting->company_phone}}">
            </div>

            <div class="md-form">
                <label>Address</label>
                <textarea name="company_address" id="" cols="30" rows="10" class="md-textarea form-control pt-3">{{$company_setting->company_address}}</textarea>
            </div>

            <div class="md-form">
                <label>Office Start Time</label>
                <input type="text" name="office_start_time" class="form-control timepicker" value="{{$company_setting->office_start_time}}">
            </div>

            <div class="md-form">
                <label>Office End Time</label>
                <input type="text" name="office_end_time" class="form-control timepicker" value="{{$company_setting->office_end_time}}">
            </div>

            <div class="md-form">
                <label>Break Start Time</label>
                <input type="text" name="break_start_time" class="form-control timepicker" value="{{$company_setting->break_start_time}}">
            </div>

            <div class="md-form">
                <label>Break End Time</label>
                <input type="text" name="break_end_time" class="form-control timepicker" value="{{$company_setting->break_end_time}}">
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
    {!! JsValidator::formRequest('App\Http\Requests\UpdateCompanySettingRequest', '#setting_update') !!}
    <script>
        $(document).ready(function() {
            $('.timepicker').daterangepicker({
                "singleDatePicker": true,
                "timePicker" : true,
                "timePicker24Hour": true,
                "timePickerSeconds": true,
                "locale": {
                    "format": "HH:mm:ss",
                },
                "autoApply": true,
                "showDropdowns": true,
            }).on('show.daterangepicker', function(ev, picker) {
                $('.calendar-table').hide();
            });
        })
    </script>
@endsection
