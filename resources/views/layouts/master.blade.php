<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../../../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../../assets/img/favicon.png">
    <title>
        Argon Dashboard 2 PRO by Creative Tim
    </title>


    <link rel="canonical" href="https://www.creative-tim.com/product/argon-dashboard" />
    <meta name="keywords"
        content="creative tim, html dashboard, html css dashboard, web dashboard, bootstrap 5 dashboard, bootstrap 5, css3 dashboard, bootstrap 5 admin, Argon Dashboard bootstrap 5 dashboard, frontend, responsive bootstrap 5 dashboard, soft design, soft dashboard bootstrap 5 dashboard">
    <meta name="description"
        content="Argon Dashboard PRO is a beautiful Bootstrap 5 admin dashboard with a large number of components, designed to look beautiful, clean and organized. If you are looking for a tool to manage dates about your business, this dashboard is the thing for you.">

    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@creativetim">
    <meta name="twitter:title" content="Argon Dashboard PRO by Creative Tim">
    <meta name="twitter:description"
        content="Argon Dashboard PRO is a beautiful Bootstrap 5 admin dashboard with a large number of components, designed to look beautiful, clean and organized. If you are looking for a tool to manage dates about your business, this dashboard is the thing for you.">
    <meta name="twitter:creator" content="@creativetim">
    <meta name="twitter:image"
        content="https://s3.amazonaws.com/creativetim_bucket/products/137/original/argon-dashboard-pro.jpg">

    <meta property="fb:app_id" content="655968634437471">
    <meta property="og:title" content="Argon Dashboard PRO by Creative Tim" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="https://demos.creative-tim.com/argon-dashboard-pro/pages/dashboards/landing" />
    <meta property="og:image"
        content="https://s3.amazonaws.com/creativetim_bucket/products/137/original/argon-dashboard-pro.jpg" />
    <meta property="og:description"
        content="Argon Dashboard PRO is a beautiful Bootstrap 5 admin dashboard with a large number of components, designed to look beautiful, clean and organized. If you are looking for a tool to manage dates about your business, this dashboard is the thing for you." />
    <meta property="og:site_name" content="Creative Tim" />

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />


    <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet" />

    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet" />

    <link href="{{ asset('font/nucleo-icons.woff2') }}" rel='stylesheet' type='text/css'>
    <link id="pagestyle" href="{{ asset('css/argon-dashboard.min.css?v=2.0.5') }}" rel="stylesheet" />

    <style>
        .async-hide {
            opacity: 0 !important
        }
    </style>

</head>

<body class="g-sidenav-show   bg-gray-100">
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    @include('layouts.siderbar')
    <main class="main-content position-relative border-radius-lg ">
        @include('layouts.navbar')
        <div class="container-fluid py-4">
            @yield('content')
            @include('layouts.footer')
        </div>
    </main>


    <script src="{{ asset('js/popper.min.js') }} "></script>
    <script src="{{ asset('js/bootstrap.min.js') }} "></script>
    <script src="{{ asset('js/perfect-scrollbar.min.js') }} "></script>
    <script src="{{ asset('js/smooth-scrollbar.min.js') }} "></script>

    <script src="{{ asset('js/chartjs.min.js') }} "></script>
    <script src="{{ asset('js/dragula.min.js') }} "></script>
    <script src="{{ asset('js/jkanban.js') }} "></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>

    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script src="{{ asset('js/argon-dashboard.min.js?v=2.0.5') }} "></script>

    @section('scripts')
    @show
</body>

</html>
