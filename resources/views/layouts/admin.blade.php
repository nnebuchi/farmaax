<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta-tags')
    <title>@yield('title', 'Farmaax Administrator')</title>
    <link href="{{ asset('dist/css/styles.css') }}" rel="stylesheet" />
     <script src="{{ asset('js/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">

    <script>
           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

  @php
    $root =(isset($_SERVER['HTTPS'])?"https://":"http://").$_SERVER['HTTP_HOST'];
    $root.=str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
  @endphp
    <script>
        var universal_token= '<?php echo csrf_token();?>';
        var url="<?php echo  url('/') ?>";
        var admin_url='<?php echo url('dashboard/admin/'); ?>';
    </script>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
</head>


<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ route('home') }}">Farmaax Administrator</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search"
                    aria-describedby="basic-addon2" />
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">Settings</a>
                    <a class="dropdown-item" href="#">Activity Log</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="return confirm('You will be logged out!')">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="{{ route('home') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts"
                            aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Users
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('users') }}">All Users</a>
                                <a class="nav-link" href="{{ route('realtors') }}">Realtors</a>
                                <a class="nav-link" href="{{ route('marketers') }}">Marketers</a>
                                <a class="nav-link" href="{{ route('lawyers') }}">Lawyers</a>
                                <a class="nav-link" href="{{ route('farmManagers') }}">Farm Managers</a>
                            </nav>
                        </div>
                        {{-- farms --}}
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFarms"
                            aria-expanded="false" aria-controls="collapseFarms">
                            <div class="sb-nav-link-icon"><i class="fas fa-building"></i></div>
                            Farms
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseFarms" aria-labelledby="headingTwo"
                            data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('farms.index') }}">All Farms</a>
                                <a class="nav-link" href="{{ route('farms.create') }}">Add a Farm</a>
                                <a class="nav-link" href="{{ route('addcategory') }}">Add farm category</a>
                                <a class="nav-link" href="{{ route('addfarmtype') }}">Add farm type</a>
                                <a class="nav-link" href="{{ route('farms.awaiting.approval') }}">Farms Awaiting
                                    Approval</a>
                            </nav>
                        </div>
                        {{-- endfarms --}}
                        {{-- Lands --}}
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLands"
                            aria-expanded="false" aria-controls="collapseLands">
                            <div class="sb-nav-link-icon"><i class="fas fa-building"></i></div>
                            Lands
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLands" aria-labelledby="headingTwo"
                            data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('lands') }}">All Lands</a>
                                <a class="nav-link" href="{{ route('soldLands') }}">Sold Lands</a>
                                <a class="nav-link" href="{{ route('availableLands') }}">Available Lands</a>
                                <a class="nav-link" href="{{ route('sellLands') }}">Sell a Land</a>

                            </nav>
                        </div>
                        {{-- endLands --}}


                        {{-- Products --}}
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts"
                            aria-expanded="false" aria-controls="collapseProducts">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                            Store
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseProducts" aria-labelledby="headingTwo"
                            data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionProducts">
                                <a class="nav-link" href="{{ route('add-product') }}">Add Products</a>
                                <a class="nav-link" href="password.html">Legumes</a>
                                <a class="nav-link" href="password.html">Maizes</a>

                            </nav>
                        </div>
                        {{-- endProducts --}}

                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSettings"
                            aria-expanded="false" aria-controls="collapseProducts">
                            <div class="sb-nav-link-icon"><i class="fas fa-cog"></i></div>
                            Settings
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseSettings" aria-labelledby="headingTwo"
                            data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionProducts">
                                <a class="nav-link" href="{{ route('settings') }}">Site Settings</a>


                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePopups"
                            aria-expanded="false" aria-controls="collapsePopups">
                            <div class="sb-nav-link-icon"><i class="fa fa-window-restore "></i></div>
                            Pop-Ups
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePopups" aria-labelledby="headingTwo"
                            data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionProducts">
                                <a class="nav-link" href="{{ route('pop-us.index') }}">All Pop-ups</a>
                                <a class="nav-link" href="{{ route('pop-us.create') }}">Add Pop-up</a>


                            </nav>
                        </div>

                        {{-- pages --}}
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                            aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Site Pages
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                            data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link" href="password.html">About Us</a>
                                <a class="nav-link" href="password.html">Contact Us</a>
                                <a class="nav-link" href="password.html">Privacy Policy</a>
                                <a class="nav-link" href="password.html">Terms and Conditions</a>

                            </nav>
                        </div>
                        {{-- endPages --}}
                        <div class="sb-sidenav-menu-heading">Addons</div>
                        <a class="nav-link" href="charts.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Charts
                        </a>
                        <a class="nav-link" href="tables.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Tables
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small text-white text-center">Logged in as: <br>
                        {{ ucfirst(Auth::user()->username) }}
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Dashboard</h1>
                    @include('layouts.messages')
                    <hr>

                    @yield('content')
                </div>
            </main>
            <footer class="py-4 bg-light mt-5">
                <div class="container-fluid">
                    <div class="text-center">
                        <div class="text-center">Copyright &copy; Farmaax 2020</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    @yield('scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('dist/js/scripts.js') }}"></script>
    <script src="{{ asset('dist/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('src/assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('src/assets/demo/chart-bar-demo.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('src/assets/demo/datatables-demo.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
<script>let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function(html) {
        let switchery = new Switchery(html,  { size: 'small' });
    });</script>
</body>

</html>
