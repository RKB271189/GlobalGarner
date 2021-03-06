<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{asset('images/our_logo.png')}}" alt="NPL ADBlue" style="opacity: .8;border-radius:8px;">
        <span class="brand-text relcon-main-logo">Laravel</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('images/user_icon.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    Welcome
                    <span style="color: #0cbdbd;font-weight:600;padding-left:8px;">
                        @if(auth()->guard('admin')->check())
                        {{Auth::guard('admin')->user()->name}}
                        @elseif(auth('vendor')->check())
                        {{Auth::guard('vendor')->user()->name}}
                        @else
                        Guest
                        @endif
                    </span>
                </a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if(!auth()->guard('admin')->check() && !auth()->guard('vendor')->check())
                <li class="nav-item has-treeview menu-open">
                    <a href="{{route('dashboard')}}" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @endif
                @if(auth()->guard('admin')->check())
                <li class="nav-item has-treeview">
                    <a href="{{route('products.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>Product</p>
                    </a>
                </li>
                @endif
                @if(auth()->guard('vendor')->check())
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Operation
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('product.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('product.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Product</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                @if(auth()->guard('admin')->check() || auth()->guard('vendor')->check())
                <li class="nav-item has-treeview">
                    <a href="{{route('logout')}}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>