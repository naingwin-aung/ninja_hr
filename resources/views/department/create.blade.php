@extends('layouts.app')
@section('title', 'Department Create')

@section('content')
<div class="card create_form">
    <div class="card-body">

        @include('layouts.flash')

        <form action="{{route('department.store')}}" method="POST" id="department_create" autocomplete="off">
            @csrf
            <div class="md-form">
                <label>Department Title</label>
                <input type="text" name="title" class="form-control">
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
    {!! JsValidator::formRequest('App\Http\Requests\StoreDepartmentRequest', '#department_create') !!}
@endsection
