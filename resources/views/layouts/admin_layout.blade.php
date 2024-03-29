<?php $category = new \App\Models\Admin\Category();
$subcategory = new \App\Models\Admin\SubCategory();
$product = new \App\Models\Admin\Product();
?>
    <!DOCTYPE html>
<html class="no-js"
      lang="{{ config('settings.locale') }}||{{ str_replace('_', '-', app()->getLocale()) }}" {{-- dir="{{ config('locales.languages')[app()->getLocale()]['rtl_support'] }}" --}}>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">

    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }

    </style>
    @livewireStyles

    {{-- @if (config('locales.languages')[app()->getLocale()]['rtl_support'] == 'rtl')


    <link rel="stylesheet" href="{{ asset('css/bootstrap-rtl.css') }}">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.rtl.min.css" integrity="sha384-trxYGD5BY4TyBTvU5H23FalSCYwpLA0vWEvXXGm5eytyztxb+97WzzY+IWDOSbav" crossorigin="anonymous">

    @endif --}}


</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
            <div class="sidebar-brand-icon rotate-n-15">
                {{-- <i class="fas fa-laugh-wink"></i> --}}
            </div>
            <div class="sidebar-brand-text mx-3">
                {{ __(config('settings.app_name', 'Store App')) }}<sup>{{ __('admin') }}</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>{{ __('dashboard') }}</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('store.home') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>{{ __('Store App') }}</span></a>
        </li>
        @can('settings-list')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('settings.index') }}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>{{ __('settings') }}</span></a>
            </li>
        @endcan


    <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            {{ __('interface') }}
        </div>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#collapseTwo" data-toggle="collapse" data-target="#collapseTwo"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('categories') }}</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('categories.index') }}">{{ __('all') }}</a>
                    @can('category-create')<a class="collapse-item"
                                              href="{{ route('categories.create') }}">{{ __('create') }}</a>@endcan
                    @can('category-trash')
                        <a class="collapse-item" href="{{ route('categories.trash') }}">{{ __('trash') }}</a>@endcan
                </div>
                <div class="bg-white py-2 collapse-inner rounded">
                    <?php $category = new \App\Models\Admin\Category(); ?>
                    <a class="collapse-item"
                       href="{{ route('subcategories.create') }}">{{ __('create subcategory') }}</a>

                    <a class="collapse-item" href="{{ route('subcategories.trash') }}">{{ __('trash') }}</a>

                </div>
            </div>
        </li>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#product" data-toggle="collapse" data-target="#product"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('products') }}</span>
            </a>
            <div id="product" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded"> @can('product-list')
                        <a class="collapse-item" href="{{ route('products.index') }}">{{ __('all') }}</a>@endcan
                    @can('product-create')
                        <a class="collapse-item" href="{{ route('products.create') }}">{{ __('create') }}</a>@endcan
                    @can('product-trash')
                        <a class="collapse-item" href="{{ route('products.trash') }}">{{ __('trash') }}</a>
                    @endcan
                </div>
            </div>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#advert" data-toggle="collapse" data-target="#advert"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('advert') }}</span>
            </a>
            <div id="advert" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded"> @can('product-list')
                        <a class="collapse-item" href="{{ route('adv.index') }}">{{ __('all') }}</a>@endcan
                    @can('advert-create')
                        <a class="collapse-item" href="{{ route('adv.create') }}">{{ __('create') }}</a>@endcan
                </div>
            </div>
        </li>


        @can('user-per')
        <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#user" data-toggle="collapse" data-target="#user"
                   aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>{{ __('users') }}</span>
                </a>
                <div id="user" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('users.index') }}">{{ __('all') }}</a>

                        <a class="collapse-item" href="{{ route('users.create') }}">{{ __('create') }}</a>
                    </div>
                </div>
            </li>
        @endcan


    <!-- Nav Item - Pages Collapse Menu -->
        @can('role-list')


            <li class="nav-item">
                <a class="nav-link collapsed" href="#role" data-toggle="collapse" data-target="#role"
                   aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>{{ __('roles') }}</span>
                </a>
                <div id="role" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded"> @can('role-list')
                            <a class="collapse-item" href="{{ route('roles.index') }}">{{ __('all') }}</a>@endcan
                        @can('role-create')
                            <a class="collapse-item" href="{{ route('roles.create') }}">{{ __('create') }}</a>@endcan

                        {{-- <a class="collapse-item" href="{{ route('roles.trash') }}">{{ __('trash') }}</a> --}}
                    </div>
                </div>
            </li>
        @endcan
        @can('coupon-list')


            <li class="nav-item">
                <a class="nav-link collapsed" href="#coupon" data-toggle="collapse" data-target="#coupon"
                   aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>{{ __('coupon') }}</span>
                </a>
                <div id="coupon" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded"> @can('coupon-list')
                            <a class="collapse-item" href="{{ route('coupons.index') }}">{{ __('all') }}</a>@endcan
                        @can('coupon-create')
                            <a class="collapse-item" href="{{ route('coupons.create') }}">{{ __('create') }}</a>@endcan
                    </div>
                </div>
            </li>
            @can('about-list')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#about" data-toggle="collapse" data-target="#about"
                       aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>{{ __('about') }}</span>
                    </a>
                    <div id="about" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded"> {{-- @can('about-list')  --}}
                            <a class="collapse-item"
                               href="{{ route('about.index') }}">{{ __('all') }}</a>{{-- @endcan  --}}
                            {{-- @can('about-edit')  --}}
                            <a class="collapse-item"
                               href="{{ route('about.edit') }}">{{ __('edit') }}</a>{{-- @endcan  --}}
                        </div>
                    </div>
                </li>
            @endcan

            <li class="nav-item">
                <a class="nav-link collapsed" href="#contacts" data-toggle="collapse" data-target="#contacts"
                   aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>{{ __('contacts') }}</span>
                </a>
                <div id="contacts" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admin.contact.index') }}">{{ __('all') }}</a>
                    </div>
                </div>
            </li>
    @endcan

    <!-- Divider -->
        <hr class="sidebar-divider">


        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                             aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                           placeholder="Search for..." aria-label="Search"
                                           aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="languagesDropdown" data-toggle="dropdown"
                           role="button" aria-expanded="false" aria-haspopup="true">
                            {{ __(config('locales.languages')[app()->getLocale()]['name']) }} <span
                                class="caret"></span><i
                                class="flag-icon flag-icon-{{ __(config('locales.languages')[app()->getLocale()]['icon']) }} mt-1"
                                title="us"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="languagesDropdown">
                            @foreach (config('locales.languages') as $key => $val)
                                @if ($key != app()->getLocale())
                                    <a href="{{ route('change.language', __($key)) }}"
                                       class="dropdown-item">{{ __($val['name']) }} <i
                                            class="flag-icon flag-icon-{{ __($val['icon']) }}" title="{{ $key }}"
                                            id="{{ $key }}"></i></a>
                                @endif
                            @endforeach
                        </div>
                    </li>
                    <!-- Nav Item - Alerts -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Counter - Alerts -->
                            <span class="badge badge-danger badge-counter">3+</span>
                        </a>
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                Alerts Center
                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 12, 2019</div>
                                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-success">
                                        <i class="fas fa-donate text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 7, 2019</div>
                                    $290.29 has been deposited into your account!
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-warning">
                                        <i class="fas fa-exclamation-triangle text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 2, 2019</div>
                                    Spending Alert: We've noticed unusually high spending for your account.
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                        </div>
                    </li>

                    <!-- Nav Item - Messages -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-envelope fa-fw"></i>
                            <!-- Counter - Messages -->
                            <span class="badge badge-danger badge-counter">7</span>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="messagesDropdown">
                            <h6 class="dropdown-header">
                                Message Center
                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="{{ asset('public/img/undraw_profile_1.svg') }}"
                                         alt="...">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                                <div class="font-weight-bold">
                                    <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                        problem I've been having.
                                    </div>
                                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="...">
                                    <div class="status-indicator"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">I have the photos that you ordered last month, how
                                        would you like them sent to you?
                                    </div>
                                    <div class="small text-gray-500">Jae Chun · 1d</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="...">
                                    <div class="status-indicator bg-warning"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">Last month's report looks great, I am very happy with
                                        the progress so far, keep up the good work!
                                    </div>
                                    <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                         alt="...">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                        told me that people say this to all dogs, even if they aren't good...
                                    </div>
                                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                        </div>
                    </li>


                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    @auth()
                        <?php $profile = auth()->user()->profile; ?>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
                                <img class="img-profile rounded-circle" src="@if ($profile->avatar
                                    || $profile->avatar != null) {{ asset('storage/' . $profile->avatar) }}
                                @else
                                    https://ui-avatars.com/api/?name={{ auth()->user()->name }} @endif">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                 aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('profile-user.show', auth()->id()) }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('profile') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('profile-user.edit', auth()->id()) }}">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('settings') }}
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('activity Log') }}
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" data-toggle="modal" onclick="event.preventDefault();
                                                                                                                                                                                                                                                 document.getElementById('logout-form').submit();"
                                   data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('logout') }}
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </a>

                            </div>
                        </li>
                    @endauth
                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0" style="color: #3b401f">@yield('header_page')
                    </h1>
                    <div><a class="btn btn-outline-primary" href="@yield('href')">@yield('name')</a>
                        <a class="btn btn-outline-primary" href="@yield('href2')">@yield('name2')</a>
                    </div>

                </div>
                @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

                @yield('content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                        <span>{{ __('Copyright') }} &copy; {{ __(config('settings.app_name')) }}
                            {{ date('Y') }}</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>
@livewireScripts
{{-- ck editor start --}}
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description[ar]');
    CKEDITOR.replace('description[en]');

</script>
{{-- ckeditor end --}}
<!-- Bootstrap core JavaScript-->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="" {{ asset('vendor
/jquery-easing/jquery.easing.min.js') }}""></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>

</body>

</html>
