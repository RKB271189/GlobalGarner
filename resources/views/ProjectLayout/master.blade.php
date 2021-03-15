<html lang="en">
<!--<header>-->
@include('ProjectLayout.header')
<!--</header>-->

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!--<navbar>-->
        @include('ProjectLayout.navbar')
        <!--</navbar>-->
        <!--<sidebar>-->
        @include('ProjectLayout.sidebar')
        <!--</sidebar>-->
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <!-- <h1 class="m-0 text-dark">Dashboard</h1> -->
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                @yield('header_content')
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    @yield('page_content')
                </div>
            </section>
        </div>
        <!--<footer>-->
        @include('ProjectLayout.footer')
        <!--</footer>-->

        <!--<script>-->
        @include('ProjectLayout.script')
        <!--</script>-->

        @if(Session::has('page-access-error'))
        <script>
            toastr.error('Contact Administrator : Access to page not granted yet')
        </script>
        @endif
    </div>
</body>

</html>