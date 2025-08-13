<!-- ====================================
          ——— LEFT SIDEBAR WITH OUT FOOTER
        ===================================== -->
<aside class="left-sidebar sidebar-dark" id="left-sidebar">
    <div id="sidebar" class="sidebar sidebar-with-footer">
        <!-- Aplication Brand -->
        <div class="app-brand">
            <a href="/index.html">
                <img src="images/logo.png" alt="Mono">
                <span class="brand-name">Buku Tamu</span>
            </a>
        </div>
        <!-- begin sidebar scrollbar -->
        <div class="sidebar-left" data-simplebar style="height: 100%;">
            <!-- sidebar menu -->
            <ul class="nav sidebar-inner" id="sidebar-menu">
                <li class="{{ request()->routeIs('admin') ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="{{ route('admin') }}">
                        <i class="mdi mdi-chart-line"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>

                <li
                    class="has-sub {{ request()->routeIs('internal', 'eksternal', 'mahasiswa') ? 'active expand' : '' }}">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#email"
                        aria-expanded="{{ request()->routeIs('internal', 'eksternal', 'mahasiswa') ? 'true' : 'false' }}"
                        aria-controls="email">
                        <i class="mdi mdi-account-multiple"></i>
                        <span class="nav-text">Tamu</span> <b class="caret"></b>
                    </a>
                    <ul class="collapse {{ request()->routeIs('internal', 'eksternal', 'mahasiswa') ? 'show' : '' }}"
                        id="email" data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            <li class="{{ request()->routeIs('internal') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('internal') }}">
                                    <span class="nav-text">Tamu Internal</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('eksternal') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('eksternal') }}">
                                    <span class="nav-text">Tamu Eksternal</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('mahasiswa') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('mahasiswa') }}">
                                    <span class="nav-text">Tamu Mahasiswa</span>
                                </a>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>


        </div>
    </div>
</aside>
