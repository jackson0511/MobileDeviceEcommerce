<div class="topbar-main">
    <div class="container">

        <!-- Logo container-->
        <div class="logo">
            <a href="index.html" class="logo"><span>Appl<i
                        class="md md-explicit"></i></span></a>
        </div>
        <!-- End Logo container-->


        <div class="menu-extras">

            <ul class="nav navbar-nav navbar-right pull-right">

                @if(Auth::guard('QuanTri')->check())
                <li class="dropdown navbar-c-items">
                    <a href="" class="dropdown-toggle waves-effect waves-light profile" data-toggle="dropdown" aria-expanded="true"><img src="admin/assets/images/users/avatar-1.jpg" alt="user-img" class="img-circle"> </a>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:void(0)"><i class="ti-user text-custom m-r-10"></i> {{Auth::guard('QuanTri')->user()->HoTen}}</a></li>
                        <li><a href="javascript:void(0)"><i class="ti-user text-custom m-r-10"></i> Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="admin/logout"><i class="ti-power-off text-danger m-r-10"></i> Logout</a></li>
                    </ul>
                </li>
                 @endif
            </ul>
            <div class="menu-item">
                <!-- Mobile menu toggle-->
                <a class="navbar-toggle">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </div>
        </div>

    </div>
</div>

<div class="navbar-custom">
    <div class="container">
       @include('admin.layouts.menu')
    </div> <!-- end container -->
</div> <!-- end navbar-custom -->
