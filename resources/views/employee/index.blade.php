@extends('layouts.app')
@section('title', 'Employees')

@section('content')
<div>
    <a href="{{route("employee.create")}}" class="btn btn-theme btn-sm"><i class="fas fa-plus-circle"></i> CREATE EMPLOYEE</a>
</div>
    <div class="card main-content">
        <div class="card-body">
            <table class="table table-bordered" id="datatable" style="width:100%;">
                <thead>
                    <th class="text-center no_sort no_search"></th>
                    <th class="text-center no_sort">Profile</th>
                    <th class="text-center">Employee ID</th>
                    <th class="text-center no_sort">Phone</th>
                    <th class="text-center no_sort">Email</th>
                    <th class="text-center">Department</th>
                    <th class="text-center no_sort no_search">Is Present?</th>
                    <th class="text-center no_sort no_search">Action</th>
                    <th class="text-center hidden no_search">Updated At</th>
                </thead>
            </table>
        </div>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        let table = $('#datatable').DataTable( {
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "/employee/datatable/ssd",
            columns : [
                {data: 'plus-icon', name: 'plus-icon', class: 'text-center'},
                {data: 'profile_img', name: 'profile_img', class: 'text-center'},
                {data: 'employee_id', name: 'employee_id', class: 'text-center'},
                {data: 'phone', name: 'phone', class: 'text-center'},
                {data: 'email', name: 'email', class: 'text-center'},
                {data: 'department_name', name: 'department_name', class: 'text-center'},
                {data: 'is_present', name: 'is_present', class: 'text-center'},
                {data: 'action', name: 'action', class: 'text-center'},
                {data: 'updated_at', name: 'updated_at', class: 'text-center'},
            ],
            order : [[ 8 , "desc"]],
            language: {
                "paginate": {
                    "previous": "<i class='fas fa-caret-left'> </i>",
                    "next": "<i class='fas fa-caret-right'> </i>",
                    },
                "info": "Showing page _PAGE_ of _PAGES_",
                "processing": "<img src='/images/loading.gif' style='width:50px'><p class='my-3'>Loading...</p>",
            },
            columnDefs: [
                {
                    targets: 'hidden',
                    visible : false
                },
                {
                    targets: 'no_sort',
                    sortable : false,
                },
                {
                    targets: 'no_search',
                    searchable : false,
                },
                {
                    targets: [0],
                    class : "control"
                },
            ],
        } );

        $(document).on('click', '.delete_btn', function(e) {
            e.preventDefault();
            swal({
                title: "Are you sure?",
                text: "Are you sure you want to delete this employee!",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    let id = $(this).data('id');
                    $.ajax({
                        method : 'DELETE',
                        url : `/employee/${id}`,
                    }).done(function(res) {
                        table.ajax.reload();
                    })
                }
            });
        })
    } );
</script>
@endsection
