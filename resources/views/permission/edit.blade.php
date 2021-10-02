@extends('layouts.app')
@section('title', 'Permission Edit')

@section('content')
<div class="card create_form">
    <div class="card-body">

        @include('layouts.flash')

        <form action="{{route('permission.update', $permission->id)}}" method="POST" id="permission_update" autocomplete="off">
            @csrf
            @method('PUT')

            <div class="md-form">
                <label>Permission Name</label>
                <input type="text" name="name" class="form-control" value="{{$permission->name}}">
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
    {!! JsValidator::formRequest('App\Http\Requests\UpdatePermissionRequest', '#permission_update') !!}
@endsection
