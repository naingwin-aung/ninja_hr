@extends('layouts.app')
@section('title', 'Role Edit')

@section('content')
<div class="card create_form">
    <div class="card-body">

        @include('layouts.flash')

        <form action="{{route('role.update', $role->id)}}" method="POST" id="role_update" autocomplete="off">
            @csrf
            @method('PUT')

            <div class="md-form">
                <label>Role Name</label>
                <input type="text" name="name" class="form-control" value="{{$role->name}}">
            </div>

            <label for="">Permissions</label>
            <div class="row mb-4">
                @foreach ($permissions as $permission)
                    <div class="col-md-3 col-12">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="permissions[]" class="custom-control-input" id="checkbox_{{$permission->id}}" value="{{$permission->name}}" @if (in_array($permission->id, $old_permission))
                                checked
                            @endif>
                            <label class="custom-control-label" for="checkbox_{{$permission->id}}">{{$permission->name}}</label>
                        </div>
                    </div>
                @endforeach
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
    {!! JsValidator::formRequest('App\Http\Requests\UpdateRoleRequest', '#role_update') !!}
@endsection
