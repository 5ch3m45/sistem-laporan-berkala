<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
    <!-- Generated: 2018-04-16 09:29:05 +0200 -->
    <title>Homepage - tabler.github.io - a responsive, flat and full featured admin template</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <!-- Dashboard Core -->
    <link href="/assets/css/dashboard.css" rel="stylesheet" />
    {{-- <script src="/assets/js/core.js"></script> --}}
    <!-- c3.js Charts Plugin -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/c3@0.7.20/c3.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/7.0.1/d3.min.js" integrity="sha512-1e0JvdNhUkvFbAURPPlFKcX0mWu/b6GT9e0uve7BW4MFxJ15q4ZCd/Llz+B7/oh+qhw7/l6Q1ObPt6aAuR01+Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/c3@0.7.20/c3.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.1.2/dist/echarts.min.js" integrity="sha256-TI0rIaxop+pDlHNVI6kDCFvmpxNYUnVH/SMjknZ/W0Y=" crossorigin="anonymous"></script>
    <!-- Google Maps Plugin -->
    {{-- <link href="/assets/plugins/maps-google/plugin.css" rel="stylesheet" />
    <script src="/assets/plugins/maps-google/plugin.js"></script> --}}
    {{-- <link rel="stylesheet" href="/vendor/treetable/css/jquery.treetable.css">
    <link rel="stylesheet" href="/vendor/treetable/css/jquery.treetable.theme.default.css"> --}}
    <!-- Input Mask Plugin -->
    {{-- <script src="/assets/plugins/input-mask/plugin.js"></script> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <style>
        html,
        body {
            font-family: "Inter", -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
            font-size: .9rem;
            font-weight: 400;
            color: #232e3c
        }
    </style>
    @yield('head-js')
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @yield('content')
    @yield('foot-js')
</body>
</html>