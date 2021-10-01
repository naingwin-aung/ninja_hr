@extends('layouts.app')
@section('title', 'Department Edit')

@section('content')
<div class="card create_form">
    <div class="card-body">

        @include('layouts.flash')

        <form action="{{route('department.update', $department->id)}}" method="POST" id="department_update" autocomplete="off">
            @csrf
            @method('PUT')

            <div class="md-form">
                <label>title</label>
                <input type="text" name="title" class="form-control" value="{{$department->title}}">
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
    {!! JsValidator::formRequest('App\Http\Requests\UpdateDepartmentRequest', '#department_update') !!}
@endsection
