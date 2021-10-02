@extends('layouts.app')
@section('title', 'Department')

@section('content')
<div>
    <a href="{{route("department.create")}}" class="btn btn-theme btn-sm"><i class="fas fa-plus-circle"></i> CREATE Department</a>
</div>
    <div class="card main-content">
        <div class="card-body">
            <table class="table table-bordered" id="datatable" style="width:100%;">
                <thead>
                    <th class="text-center no_sort no_search"></th>
                    <th class="text-center">Department Name</th>
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
            ajax: "/department/datatable/ssd",
            columns : [
                {data: 'plus-icon', name: 'plus-icon', class: 'text-center'},
                {data: 'title', name: 'title', class: 'text-center'},
                {data: 'action', name: 'action', class: 'text-center'},
                {data: 'updated_at', name: 'updated_at'},
            ],
            language: {
                "paginate": {
                    "previous": "<i class='fas fa-caret-left'> </i>",
                    "next": "<i class='fas fa-caret-right'> </i>",
                },
                "info": "Showing page _PAGE_ of _PAGES_",
                "processing": "<img src='/images/loading.gif' style='width:50px'><p class='my-3'>Loading...</p>",
            },
            order : [[ 3 , "desc"]],
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
                        url : `/department/${id}`,
                    }).done(function(res) {
                        table.ajax.reload();
                    })
                }
            });
        })
    } );
</script>
@endsection
