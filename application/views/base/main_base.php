<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Aplikasi Media -&nbsp@yield('title')</title>
    <!-- Favicon-->
    <link rel="icon" href="{{APP_ASSETS}}/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{APP_ASSETS}}plugins/bootstrap/css/bootstrap.css" rel="stylesheet">


    <!-- Waves Effect Css -->
    <link href="{{APP_ASSETS}}plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{APP_ASSETS}}plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="{{APP_ASSETS}}plugins/morrisjs/morris.css" rel="stylesheet" />
    <link href="{{APP_ASSETS}}plugins/toastr/toastr.min.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="{{APP_ASSETS}}plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="{{APP_ASSETS}}plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="{{APP_ASSETS}}plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{APP_ASSETS}}css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{APP_ASSETS}}css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-indigo">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Mohon tunggu sebentar...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    @include('element.navbar')
    @include('element.sidebar')
    <section class="content">
        @yield('content')
    </section>

    <!-- Jquery Core Js -->
    <script src="{{APP_ASSETS}}plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{APP_ASSETS}}plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="{{APP_ASSETS}}plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{APP_ASSETS}}plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{APP_ASSETS}}plugins/node-waves/waves.js"></script>

    <!-- Input Mask Plugin Js -->
    <script src="{{APP_ASSETS}}plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="{{APP_ASSETS}}plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Morris Plugin Js -->
    <script src="{{APP_ASSETS}}plugins/raphael/raphael.min.js"></script>
    <script src="{{APP_ASSETS}}plugins/morrisjs/morris.js"></script>
    <script src="{{APP_ASSETS}}plugins/toastr/toastr.min.js"></script>

    <!-- ChartJs -->
    <script src="{{APP_ASSETS}}plugins/chartjs/Chart.bundle.js"></script>

    <!-- Moment Plugin Js -->
    <script src="{{APP_ASSETS}}plugins/momentjs/moment.js"></script>

    <!-- Flot Charts Plugin Js 
    <script src="{{APP_ASSETS}}plugins/flot-charts/jquery.flot.js"></script>
    <script src="{{APP_ASSETS}}plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="{{APP_ASSETS}}plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="{{APP_ASSETS}}plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="{{APP_ASSETS}}plugins/flot-charts/jquery.flot.time.js"></script>
    -->
    <!-- Sparkline Chart Plugin Js -->
    <script src="{{APP_ASSETS}}plugins/jquery-sparkline/jquery.sparkline.js"></script>
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{APP_ASSETS}}plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>

    <script src="{{APP_ASSETS}}plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="{{APP_ASSETS}}plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="{{APP_ASSETS}}plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="{{APP_ASSETS}}plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="{{APP_ASSETS}}plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="{{APP_ASSETS}}plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="{{APP_ASSETS}}plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="{{APP_ASSETS}}plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="{{APP_ASSETS}}plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>


    <!-- Custom Js -->
    <script src="{{APP_ASSETS}}js/admin.js"></script>
    <!-- <script src="{{APP_ASSETS}}js/pages/index.js"></script> -->
    <!-- <script src="{{APP_ASSETS}}js/pages/tables/jquery-datatable.js"></script> -->


    <!-- Demo Js -->
    <!-- <script src="{{APP_ASSETS}}js/demo.js"></script> -->

    @yield('js')
</body>

</html>