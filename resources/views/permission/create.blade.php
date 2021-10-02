@extends('layouts.app')
@section('title', 'Permission Create')

@section('content')
<div class="card create_form">
    <div class="card-body">

        @include('layouts.flash')

        <form action="{{route('permission.store')}}" method="POST" id="permission_create" autocomplete="off">
            @csrf
            <div class="md-form">
                <label>Permission Name</label>
                <input type="text" name="name" class="form-control">
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
    {!! JsValidator::formRequest('App\Http\Requests\StorePermissionRequest', '#permission_create') !!}
@endsection
