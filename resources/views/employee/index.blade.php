@extends('layouts.app')
@section('title', 'Employees')

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered" id="datatable">
                <thead>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Phone</th>
                </thead>
            </table>
        </div>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#datatable').DataTable( {
            processing: true,
            serverSide: true,
            ajax: "/employee/datatable/ssd",
            columns : [
                {data: 'name', name: 'name', class: 'text-center'},
                {data: 'email', name: 'email', class: 'text-center'},
                {data: 'phone', name: 'phone', class: 'text-center'},
            ]
        } );
    } );
</script>
@endsection
