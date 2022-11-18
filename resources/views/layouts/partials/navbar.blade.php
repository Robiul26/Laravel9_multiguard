<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="#uNotice">
                <i class="far fa-bell"></i>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">

                {{ Auth::user()->name }}

                <i class="fas fa-angle-down ml-2"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#myProfile" class="dropdown-item">
                    My Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="#comProfile" class="dropdown-item">
                    Company Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="#aSetting" class="dropdown-item">
                    Change Password
                </a>
                <!-- Authentication -->
                @if (Auth::guard('admin')->user())
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <a href="{{ route('admin.logout') }}"
                            onclick="event.preventDefault();
                                                this.closest('form').submit();"
                            class="dropdown-item">
                            Logout
                        </a>
                    </form>
                @endif

                @if (Auth::guard('web')->user())
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                this.closest('form').submit();"
                            class="dropdown-item">
                            Logout
                        </a>
                    </form>
                @endif

            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
