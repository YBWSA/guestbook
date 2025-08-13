    <!-- Header -->
    <header class="main-header" id="header">
        <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
            <!-- Sidebar toggle button -->
            <button id="sidebar-toggler" class="sidebar-toggle">
                <span class="sr-only">Toggle navigation</span>
            </button>

            <div class="navbar-right ">
                <ul class="nav navbar-nav">

                    <!-- User Account -->
                    <li class="dropdown user-menu">
                        <button class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <img src="images/user/user-xs-01.jpg" class="user-image rounded-circle" alt="User Image" />
                            <span class="d-none d-lg-inline-block">
                                {{ Auth::user()->username ? Auth::user()->username : 'tidak ada username' }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-footer">
                                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                    @csrf
                                    <a href="{{ route('logout') }}" class="dropdown-link-item"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        <i class="mdi mdi-logout"></i> Log Out
                                    </a>
                                </form>
                            </li>

                        </ul>
                    </li>
                </ul>
            </div>
        </nav>


    </header>
