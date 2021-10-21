@include('commons.header')

<body class="animsition site-navbar-small dashboard">
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    
    @include('commons.topnav')
    @include('commons.sidenav')

    <!-- Page -->
    <div class="page">
        <div class="page-header">
        <h1 class="page-title">@yield('page-title')</h1>
        <ol class="breadcrumb breadcrumb-arrow">
            @yield('breadcrumbs')
        </ol>
        <div class="page-header-actions">
            @yield('page-header-actions')
        </div>
        </div>
        <div class="page-content container-fluid">
            @include('commons.alerts')
            @yield('page-content')
        </div>
    </div>
    <!-- End Page -->


@include('commons.footer')

