<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @php
        // $settings = App\Models\Setting::latest()->get();
        $settings = App\Models\Setting::join('users', 'settings.added_by', '=', 'users.id')
                    ->where('users.role', 'admin')
                    ->select('settings.*') // Select the columns you need from the settings table
                    ->get();
    @endphp

    @foreach ($settings as $item)
      <link rel="icon" href="{{ asset($item->favicon)}}" type="image/png" />
    @endforeach
    <!--plugins-->
    <link href="{{ asset('adminbackend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link href="{{ asset('adminbackend/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('adminbackend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('adminbackend/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('adminbackend/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('adminbackend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('adminbackend/assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('adminbackend/assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('adminbackend/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('adminbackend/assets/css/app.css') }}" rel="stylesheet" />
    <link href="{{ asset('adminbackend/assets/css/icons.css') }}" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

    <title>لوحه تحكم المشتركين</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
            @include('subscriber.body.sidebar')
        <!--end sidebar wrapper -->

        <!--start header -->
            @include('subscriber.body.header')
        <!--end header -->

        <!--start page wrapper -->
        <div class="page-wrapper">
            @yield('subscriber')
        </div>
        <!--end page wrapper -->


        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class="bx bxs-up-arrow-alt"></i></a>
        <!--End Back To Top Button-->

        {{-- start footer --}}

            @include('subscriber.body.footer')
        {{-- end footer --}}


    </div>
    <!--end wrapper-->

    <!-- Bootstrap JS -->
    <script src="{{ asset('adminbackend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('adminbackend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('adminbackend/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('adminbackend/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('adminbackend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    {{-- <script src="{{ asset('adminbackend/assets/plugins/chartjs/js/Chart.min.js') }}"></script> --}}
    <script src="{{ asset('adminbackend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('adminbackend/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    {{-- <script src="{{ asset('adminbackend/assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('adminbackend/assets/plugins/sparkline-charts/jquery.sparkline.min.js') }}"></script> --}}
    <script src="{{ asset('adminbackend/assets/plugins/jquery-knob/excanvas.js') }}"></script>
    <script src="{{ asset('adminbackend/assets/plugins/jquery-knob/jquery.knob.js') }}"></script>
    <script src="{{ asset('adminbackend/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminbackend/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    {{-- <script src="{{ asset('adminbackend/assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('adminbackend/assets/plugins/apexcharts-bundle/js/apex-custom.js') }}"></script> --}}
    <!-- Vector map JavaScript -->
    <script src="{{ asset('adminbackend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('adminbackend/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('adminbackend/assets/plugins/vectormap/jquery-jvectormap-in-mill.js') }}"></script>
    <script src="{{ asset('adminbackend/assets/plugins/vectormap/jquery-jvectormap-us-aea-en.js') }}"></script>
    <script src="{{ asset('adminbackend/assets/plugins/vectormap/jquery-jvectormap-uk-mill-en.js') }}"></script>
    <script src="{{ asset('adminbackend/assets/plugins/vectormap/jquery-jvectormap-au-mill.js') }}"></script>
    <script src="{{ asset('adminbackend/assets/plugins/vectormap/jvectormap.custom.js') }}"></script>


    <script>
        $(function() {
            $(".knob").knob();
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#example").DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            var table = $("#example2").DataTable({
                lengthChange: false,
                buttons: ["copy", "excel", "pdf", "print"],
            });

            table
                .buttons()
                .container()
                .appendTo("#example2_wrapper .col-md-6:eq(0)");
        });
    </script>

    <script src="{{ asset('adminbackend/assets/js/index.js') }}"></script>


    <script src="{{ asset('adminbackend/assets/js/validate.min.js') }}"></script>


    {{-- <script src="{{ asset('adminbackend/assets/plugins/chartjs/js/Chart.min.js') }}"></script>
    <script src="{{ asset('adminbackend/assets/plugins/chartjs/js/chartjs-custom.js') }}"></script> --}}



    <!--app JS-->
    <script src="{{ asset('adminbackend/assets/js/app.js') }}"></script>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
 @if(Session::has('message'))
 var type = "{{ Session::get('alert-type','info') }}"
 switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;
    case 'success':
    toastr.success(" {{ Session::get('message') }} ");
    break;
    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ");
    break;
    case 'error':
    toastr.error(" {{ Session::get('message') }} ");
    break;
 }
 @endif
</script>



    <script>
        $(document).ready(function() {
            $('.switcher-parent a').click(function() {
                // Remove 'active' class from all paragraphs
                $('.switcher-parent a').removeClass('active');
                // Add 'active' class to the clicked paragraph
                $(this).addClass('active');
            });
        });
    </script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('adminbackend/assets/js/code.js') }}"></script>


</body>

</html>
