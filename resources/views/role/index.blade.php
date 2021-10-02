@extends('layouts.app')
@section('title', 'Role')

@section('content')
<div>
    <a href="{{route("role.create")}}" class="btn btn-theme btn-sm"><i class="fas fa-plus-circle"></i> CREATE Role</a>
</div>
    <div class="card main-content">
        <div class="card-body">
            <table class="table table-bordered" id="datatable" style="width:100%;">
                <thead>
                    <th class="text-center no_sort no_search"></th>
                    <th class="text-center">Role Name</th>
                    <th class="text-center">Permissions</th>
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
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "/role/datatable/ssd",
            columns : [
                {data: 'plus-icon', name: 'plus-icon', class: 'text-center'},
                {data: 'name', name: 'name', class: 'text-center'},
                {data: 'permissions', name: 'permissions', class: 'text-center'},
                {data: 'action', name: 'action', class: 'text-center'},
                {data: 'updated_at', name: 'updated_at'},
            ],
            language: {
                processing: "<img src='{{url('images/loading.gif')}}' width='50px'/> <p>Loading...</p>",
                paginate : {
                    "previous": "<i class='fas fa-caret-left'> </i>",
                    "next": "<i class='fas fa-caret-right'> </i>",
                },
            },
            order : [[ 4 , "desc"]],
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
                    console.log(id);
                    $.ajax({
                        method : 'DELETE',
                        url : `/role/${id}`,
                    }).done(function(res) {
                        table.ajax.reload();
                    })
                }
            });
        })
    } );
</script>
@endsection
