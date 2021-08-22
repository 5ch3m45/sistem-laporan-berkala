<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="/vendor/treetable/css/jquery.treetable.css">
  <link rel="stylesheet" href="/vendor/treetable/css/jquery.treetable.theme.default.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <title>@yield('title') | Excelyssa</title>
  <style>
    body{
      font-size: .9rem
    }
    a, li > a{
      text-decoration: underline;
      text-decoration-style: dotted;
      color: #333
    }
    .disabled {
      pointer-events: none;
    }
  </style>
  @yield('css')
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.0/dist/chart.min.js"></script>
</head>

<body>
  @yield('content')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="/vendor/treetable/js/jquery.treetable.js"></script>
  @yield('js')
</body>

</html>