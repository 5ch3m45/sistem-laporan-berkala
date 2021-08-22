<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="/images/favicon.ico" type="image/ico" />

  <title>Excelyssa | </title>

  <!-- Bootstrap -->
  <link href="/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="/vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

  <!-- bootstrap-progressbar -->
  <link href="/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
  <!-- JQVMap -->
  <link href="/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
  <!-- bootstrap-daterangepicker -->
  <link href="/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
  <link rel="stylesheet" href="/vendor/treetable/css/jquery.treetable.css">
  <link rel="stylesheet" href="/vendor/treetable/css/jquery.treetable.theme.default.css">
  <!-- Custom Theme Style -->
  <link href="/build/css/custom.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.0/dist/chart.min.js"></script>

</head>

<body class="nav-md">
  <div class="container body">
    @yield('content')
  </div>

  <!-- jQuery -->
  {{-- <script src="/vendors/jquery/dist/jquery.min.js"></script> --}}
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Bootstrap -->
  <script src="/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}
  <!-- FastClick -->
  <script src="/vendors/fastclick/lib/fastclick.js"></script>
  <!-- NProgress -->
  <script src="/vendors/nprogress/nprogress.js"></script>
  <!-- Chart.js -->
  {{-- <script src="/vendors/Chart.js/dist/Chart.min.js"></script> --}}
  <!-- gauge.js -->
  <script src="/vendors/gauge.js/dist/gauge.min.js"></script>
  <!-- bootstrap-progressbar -->
  <script src="/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
  <!-- iCheck -->
  <script src="/vendors/iCheck/icheck.min.js"></script>
  <!-- Skycons -->
  <script src="/vendors/skycons/skycons.js"></script>
  <!-- Flot -->
  <script src="/vendors/Flot/jquery.flot.js"></script>
  <script src="/vendors/Flot/jquery.flot.pie.js"></script>
  <script src="/vendors/Flot/jquery.flot.time.js"></script>
  <script src="/vendors/Flot/jquery.flot.stack.js"></script>
  <script src="/vendors/Flot/jquery.flot.resize.js"></script>
  <!-- Flot plugins -->
  <script src="/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
  <script src="/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
  <script src="/vendors/flot.curvedlines/curvedLines.js"></script>
  <!-- DateJS -->
  <script src="/vendors/DateJS/build/date.js"></script>
  <!-- JQVMap -->
  <script src="/vendors/jqvmap/dist/jquery.vmap.js"></script>
  <script src="/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
  <script src="/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
  <!-- bootstrap-daterangepicker -->
  <script src="/vendors/moment/min/moment.min.js"></script>
  <script src="/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

  <!-- Custom Theme Scripts -->
  <script src="/build/js/custom.min.js"></script>

  <script src="/vendor/treetable/js/jquery.treetable.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

  @yield('js')

</body>

</html>
