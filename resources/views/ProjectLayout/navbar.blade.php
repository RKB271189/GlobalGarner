<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <!--Extra navigation menu like home and contact can be included here -->
    </ul>

    <!-- SEARCH FORM from admin-lte can be included here -->


    <!-- Right navbar links -->
    @if(auth()->guard('admin')->check() || auth()->guard('vendor')->check())
    @else
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="{{route('login')}}">Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('register')}}">Register</a>
        </li>
    </ul>
    @endif
    <!--Message Notifications and Other-->
</nav>