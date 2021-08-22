<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@yield("title") | TradeSoft</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

        @yield('styles')
        <!-- Bootstrap Css -->
        <link href="{{ asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/app.css')}}" id="app-style" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
        <link href="{{ asset('soft/assets/css/style.css')}}" id="app-style" rel="stylesheet" type="text/css" />


    </head>

    <body data-sidebar="dark" >
        <div id="app">
            <div id="layout-wrapper">


                <header id="page-topbar">
                    <div class="navbar-header">
                        <div class="d-flex">
                            <div class="navbar-brand-box">
                                <a href="index.html" class="logo logo-dark">
                                    <span class="logo-sm">
                                        <img src="{{ asset('assets/images/logo.svg') }}" alt="" height="22">
                                    </span>
                                    <span class="logo-lg">
                                        <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="17">
                                    </span>
                                </a>

                                <a href="index.html" class="logo logo-light">
                                    <span class="logo-sm">
                                        <img src="{{ asset('assets/images/logo-light.svg') }}" alt="" height="22">
                                    </span>
                                    <span class="logo-lg">
                                        <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="19">
                                    </span>
                                </a>
                            </div>

                            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                                <i class="fa fa-fw fa-bars"></i>
                            </button>

                            <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                                <span key="t-megamenu"><strong class="text-uppercase">WELCOME, {{ auth()->user()->name }}</strong></span>
                            </button>

                        </div>

                        <div class="d-flex">



                            <div class="dropdown d-inline-block">
                                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-bell bx-tada"></i>
                                    @if (auth()->user()->unReadNotifications)
                                        <span class="badge bg-danger rounded-pill">{{ auth()->user()->unReadNotifications->count() }}</span>
                                    @endif
                                </button>
                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                    aria-labelledby="page-header-notifications-dropdown">
                                    <div class="p-3">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h6 class="m-0" key="t-notifications"> Notifications </h6>
                                            </div>
                                            <div class="col-auto">
                                                <a href="#!" class="small" key="t-view-all"> View All</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div data-simplebar style="max-height: 230px;">
                                        @forelse (auth()->user()->unReadNotifications as $notification)
                                            @if ($notification->type == 'App\Notifications\RecipientNotification')
                                                <a href="javascript: void(0);" class="text-reset notification-item">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1">
                                                            <h6 class="mb-1" key="t-your-order">Receipant</h6>
                                                            <div class="font-size-12 text-muted">
                                                                <p class="mb-1" key="t-grammer">{{ $notification->data['action'] }}</p>
                                                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-min-ago"><timeago time="{{ $notification->created_at }}"></timeago></span></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endif

                                            @if ($notification->type == 'App\Notifications\TransactionNotification')
                                                <a href="javascript: void(0);" class="text-reset notification-item">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1">
                                                            <h6 class="mb-1" key="t-your-order">New Transaction Initiated</h6>
                                                            <div class="font-size-12 text-muted">
                                                                <p class="mb-1" key="t-grammer">{{ $notification->data['action'] }}</p>
                                                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-min-ago"><timeago time="{{ $notification->created_at }}"></timeago></span></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endif
                                        @empty
                                            <h4>No Notification</h4>
                                        @endforelse
                                    </div>
                                    <div class="p-2 border-top d-grid">
                                        <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                            <i class="mdi mdi-arrow-right-circle me-1"></i> <span key="t-view-more">View More..</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="dropdown d-inline-block">
                                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img class="rounded-circle header-profile-user" src="{{ asset('assets/images/users/avatar-1.jpg') }}"
                                        alt="Header Avatar">
                                    <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{ auth()->user()->name }}</span>
                                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    <a class="dropdown-item text-danger" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"
                                        href="#"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </header>

                <div class="vertical-menu">
                    <div data-simplebar class="h-100">

                        <div id="sidebar-menu" style="font-weight:700">
                            <!-- Left Menu Start -->
                            <ul class="metismenu list-unstyled" id="side-menu">
                                <li class="menu-title" key="t-menu">Menu</li>

                                <li>
                                    <a href="{{ route('dashboard') }}" class="waves-effect">
                                        <i class="bx bx-home-circle"></i>
                                        <span key="t-dashboards">Dashboards</span>
                                    </a>
                                </li>


                                <li class="menu-title" key="t-apps">Apps</li>

                                <li>
                                    <a href="{{ route('transaction.index')}}" class="waves-effect">
                                        <i class="bx bx-purchase-tag-alt"></i>
                                        <span key="t-calendar">Send Money</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('recipient.index') }}" class="waves-effect">
                                        <i class="bx bx-chat"></i>
                                        <span key="t-chat">Recipients</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('transaction.h') }}" class="waves-effect">
                                        <i class="bx bx-archive-in"></i>
                                        <span key="t-file-manager">Transfer history</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('referal.index') }}" class="waves-effect">
                                        <i class="bx bx-file"></i>
                                        <span key="t-file-manager">Refer a friend</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" class="waves-effect">
                                        <i class="bx bx-power-off"></i>
                                        <span key="t-file-manager">Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="main-content">

                    <div class="page-content">
                        <div class="container-fluid">
                            @yield("content")
                        </div>
                    </div>

                    <footer class="footer">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-6">
                                    {{ date('Y') }} © TradeSoft.
                                </div>
                                <div class="col-sm-6">
                                    <div class="text-sm-end d-none d-sm-block">
                                        {{--  Design & Develop by Themesbrand  --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>
                <!-- end main content-->

            </div>

        </div>


        <!-- JAVASCRIPT -->
        <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('assets/js/app.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        @yield('javascript')
    </body>
</html>
