<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!--Databale -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    {{-- Responsive Datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    {{-- Select 2 --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css"> --}}
    <link href="https://cdn.jsdelivr.net/gh/djibe/material@4.5.3-rc3/css/material-plugins.min.css" rel="stylesheet">

    @yield('extra_css')
</head>
<body>
    <div class="page-wrapper chiller-theme">
        <nav id="sidebar" class="sidebar-wrapper">
          <div class="sidebar-content">
            <div class="sidebar-brand">
              <a href="#">Ninja HR</a>
              <div id="close-sidebar">
                <i class="fas fa-times"></i>
              </div>
            </div>
            <div class="sidebar-header">
              <div class="user-pic">
                <img class="img-responsive img-rounded" src="{{auth()->user()->profile_img_path()}}"
                  alt="User picture">
              </div>
              <div class="user-info">
                <span class="user-name">
                  {{auth()->user()->name}}
                </span>
                <span class="user-role">{{auth()->user()->department ? auth()->user()->department->title : 'No Deparment'}}</span>
                <span class="user-status">
                  <i class="fa fa-circle"></i>
                  <span>Online</span>
                </span>
              </div>
            </div>
            <div class="sidebar-menu">
              <ul>
                <li class="header-menu">
                  <span>Menu</span>
                </li>
                <li>
                  <a href="{{route('home')}}">
                    <i class="fa fa-home"></i>
                    <span>Home</span>
                  </a>
                </li>

                @can('view_company_setting')
                  <li>
                    <a href="{{route('company-setting.show', 1)}}">
                      <i class="fa fa-building"></i>
                      <span>Company Setting</span>
                    </a>
                  </li>
                @endcan

                @can('view_employee')
                  <li>
                    <a href="{{route('employee.index')}}">
                      <i class="fa fa-user"></i>
                      <span>Employees</span>
                    </a>
                  </li>
                @endcan

                @can('view_department')
                <li>
                  <a href="{{route('department.index')}}">
                    <i class="fa fa-sitemap"></i>
                    <span>Department</span>
                  </a>
                </li>
                @endcan
                
                @can('view_role')
                <li>
                  <a href="{{route('role.index')}}">
                    <i class="fa fa-shield-alt"></i>
                    <span>Role</span>
                  </a>
                </li>
                <li>
                @endcan
                
                @can('view_permission') 
                  <a href="{{route('permission.index')}}">
                    <i class="fa fa-user-shield"></i>
                    <span>Permission</span>
                  </a>
                </li>
                @endcan
                {{-- <li class="sidebar-dropdown">
                  <a href="#">
                    <i class="fa fa-shopping-cart"></i>
                    <span>E-commerce</span>
                    <span class="badge badge-pill badge-danger">3</span>
                  </a>
                  <div class="sidebar-submenu">
                    <ul>
                      <li>
                        <a href="#">Products
      
                        </a>
                      </li>
                      <li>
                        <a href="#">Orders</a>
                      </li>
                      <li>
                        <a href="#">Credit cart</a>
                      </li>
                    </ul>
                  </div>
                </li> --}}
              </ul>
            </div>
            <!-- sidebar-menu  -->
          </div>
          <!-- sidebar-content  -->
        </nav>
        <!-- sidebar-wrapper  -->
        <div class="app_bar">
            <div class="d-flex justify-content-center">
                <div class="col-md-8">
                   <div class="d-flex justify-content-between">
                    @if (request()->is('/'))
                      <a id="show-sidebar" href="#">
                          <i class="fas fa-bars"></i>
                      </a>
                    @else
                      <a id="back-btn" href="#">
                        <i class="fas fa-chevron-left"></i>
                      </a>
                    @endif
                    <h4 class="mb-0">@yield('title')</h4>
                    <a href=""></a>
                   </div>
                </div>
            </div>
        </div>
        <main class="py-4">
            <div class="d-flex justify-content-center">
                <div class="col-md-8">
                    @yield('content')
                </div>
            </div>
        </main>
        <div class="bottom_bar">
            <div class="d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="d-flex justify-content-between">
                        <a href="{{route('home')}}">
                            <i class="fas fa-home"></i>
                            <p class="mb-0">Home</p>
                        </a>
                        <a href="">
                            <i class="fas fa-home"></i>
                            <p class="mb-0">Home</p>
                        </a>
                        <a href="">
                            <i class="fas fa-home"></i>
                            <p class="mb-0">Home</p>
                        </a>
                        <a href="{{route("employee.profile")}}">
                            <i class="fas fa-user"></i>
                            <p class="mb-0">Profile</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- page-content" -->
      </div>
   <!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
{{-- Select 2 --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>

<!--Datatable-->
<script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.2/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/g/mark.js(jquery.mark.min.js)"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.13/features/mark.js/datatables.mark.js"></script>

{{-- DateRange Picker --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{{-- Sweet Alert 2 --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- Sweet Alert 1 --}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
{{-- Responsive DataTable --}}
<script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
@yield('script')
<script>
    jQuery(function ($) {
      let token = document.head.querySelector("meta[name='csrf-token']");

        if(token) {
            $.ajaxSetup({
                headers : {
                    'X-CSRF-TOKEN' : token.content
                }
            })
        }else {
          console.log('CSRF token not found');
        }

      $(".sidebar-dropdown > a").click(function() {
          $(".sidebar-submenu").slideUp(200);
          if (
              $(this)
              .parent()
              .hasClass("active")
              ) {
              $(".sidebar-dropdown").removeClass("active");
              $(this)
              .parent()
              .removeClass("active");
          } else {
              $(".sidebar-dropdown").removeClass("active");
              $(this)
              .next(".sidebar-submenu")
              .slideDown(200);
              $(this)
              .parent()
              .addClass("active");
          }
      });

      $("#close-sidebar").click(function(e) {
          e.preventDefault();
          $(".page-wrapper").removeClass("toggled");
          $("#show-sidebar").removeClass('hide_sidebar');
          document.body.style.backgroundColor = '#edf2f6';
      });

      $("#show-sidebar").click(function(e) {
          e.preventDefault();
          $(".page-wrapper").addClass("toggled");
          $(this).addClass('hide_sidebar');
      });

      document.addEventListener('click', function(event) {
          if(document.getElementById('show-sidebar') && document.getElementById('show-sidebar').contains(event.target)) {
            $(".page-wrapper").addClass("toggled");
            $("show-sidebar").addClass('hide_sidebar');
            document.body.style.backgroundColor = '#eee';
          }else if(!document.getElementById('sidebar').contains(event.target)) {
            $(".page-wrapper").removeClass("toggled");
            $("#show-sidebar").removeClass('hide_sidebar');
            document.body.style.backgroundColor = '#edf2f6';
          }
      });
      

      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        width : '30em',
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })
      
      @if(session('create')) 
        Toast.fire({
          icon: 'success',
          title: '{{session('create')}}'
        })
      @endif

      @if(session('update')) 
        Toast.fire({
          icon: 'success',
          title: '{{session('update')}}'
        })
      @endif

      $("#back-btn").click(function(e) {
        e.preventDefault();
        window.history.go(-1);
        return false;
      })

      $.extend(true, $.fn.dataTable.defaults, {
          mark: true,
      });

        $('.select_ninja').select2({
        });
    });
</script>
</body>
</html>
