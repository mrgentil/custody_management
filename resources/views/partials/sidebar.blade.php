<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{url('/')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="22">
                    </span>
            <span class="logo-lg">
                        <img src="{{asset('assets/images/logo-dark.png')}}" alt="" height="17">
                    </span>
        </a>
        <!-- Light Logo-->
        <a href="{{url('/')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="22">
                    </span>
            <span class="logo-lg">
                        <img src="{{asset('assets/images/logo-light.png')}}" alt="" height="17">
                    </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{url('/')}}">
                        <i class="mdi mdi-speedometer"></i> <span data-key="t-dashboards">Tableaux de bord</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('users.index')}}">
                        <i class="mdi mdi-account-circle-outline"></i> <span data-key="t-dashboards">Utilisateurs</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('guards.index')}}">
                        <i class="mdi mdi-account-circle-outline"></i> <span data-key="t-dashboards">Gardes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="">
                        <i class="mdi mdi-timer-sand-complete"></i> <span data-key="t-dashboards">Armes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="">
                        <i class="mdi mdi-human-dolly"></i> <span data-key="t-dashboards">Activités Journalière</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="">
                        <i class="mdi mdi-bookmark-box-multiple"></i> <span data-key="t-dashboards">Rapport</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="javascript:void(0)" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span data-key="t-dashboards">Se deconnecter</span>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </a>
                </li>
                <!-- end Dashboard Menu -->
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
