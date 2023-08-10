<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href={{asset("/images/logo/favicon.png")}}>

    <!-- page css -->
    <link href="{{asset('vendors/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet">

    @yield('css')
    <!-- Core css -->
    <link href="{{asset("/css/app.min.css")}}" rel="stylesheet">

    <script src="{{asset('js/vendors.min.js')}}"></script>

    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }

        /* Firefox */
        input[type=number] {
        -moz-appearance: textfield;
        }
    </style>

</head>

<body>
    <div class="app">
        <div class="layout">
            <!-- Header START -->
            <div class="header">
                <div class="logo logo-dark">
                    <a href="index.html">
                        <img src="{{asset('images/logo/logo-invoice.png')}}" alt="Logo">
                        <img class="logo-fold" src="{{asset('/images/logo/logo-fold.png')}}" alt="Logo">
                    </a>
                </div>
                <div class="logo logo-white">
                    <a href="index.html">
                        <img src="{{asset('images/logo/logo-white.png')}}" alt="Logo">
                        <img class="logo-fold" src="{{asset('images/logo/logo-fold-white.png')}}" alt="Logo">
                    </a>
                </div>
                <div class="nav-wrap">
                    <ul class="nav-left">
                        <li class="desktop-toggle">
                            <a href="javascript:void(0);">
                                <i class="anticon"></i>
                            </a>
                        </li>
                        <li class="mobile-toggle">
                            <a href="javascript:void(0);">
                                <i class="anticon"></i>
                            </a>
                        </li>
                        {{-- <li>
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#search-drawer">
                                <i class="anticon anticon-search"></i>
                            </a>
                        </li> --}}
                    </ul>
                    <ul class="nav-right">
                        <li class="dropdown dropdown-animated scale-left" >
                            <a href="javascript:void(0);" data-toggle="dropdown" id="noti">
                                <i class="anticon anticon-bell notification-badge"></i>
                            </a>
                            <div class="dropdown-menu pop-notification">
                                <div class="p-v-15 p-h-25 border-bottom d-flex justify-content-between align-items-center">
                                    <p class="text-dark font-weight-semibold m-b-0">
                                        <i class="anticon anticon-bell"></i>
                                        <span class="m-l-11">Notification</span>
                                    </p>
                                </div>
                                <div class="relative">
                                    <div class="overflow-y-auto relative scrollable" style="max-height: 300px" id="notiData" >
                                        {{-- <a href="javascript:void(0);" class="dropdown-item d-block p-15 border-bottom">
                                            <div class="d-flex">
                                                <div class="avatar avatar-blue avatar-icon">
                                                    <i class="anticon anticon-mail"></i>
                                                </div>
                                                <div class="m-l-15">
                                                    <p class="m-b-0 text-dark">You received a new message</p>
                                                    <p class="m-b-0"><small>8 min ago</small></p>
                                                </div>
                                            </div>
                                        </a> --}}
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown dropdown-animated scale-left">
                            <div class="pointer" data-toggle="dropdown">
                                <div class="avatar avatar-image  m-h-10 m-r-15">
                                    <img src="{{ asset('profiles/admins/'.Auth::user()->logo) }}"  alt="me">
                                </div>
                            </div>
                            <div class="p-b-15 p-t-20 dropdown-menu pop-profile">
                                <div class="p-h-20 p-b-15 m-b-10 border-bottom">
                                    <div class="d-flex m-r-50">
                                        <div class="avatar avatar-lg avatar-image">
                                            <img src="{{ asset('profiles/admins/'.Auth::user()->logo) }} " alt="me">
                                        </div>
                                        <div class="m-l-10">
                                            <p class="m-b-0 text-dark font-weight-semibold">{{\Auth::user()->name}}</p>
                                            <p class="m-b-0 opacity-07">Admin</p>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{route('editProfile')}}" class="dropdown-item d-block p-h-15 p-v-10">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="anticon opacity-04 font-size-16 anticon-user"></i>
                                            <span class="m-l-10">Edit Profile</span>
                                        </div>
                                        <i class="anticon font-size-10 anticon-right"></i>
                                    </div>
                                </a>
                                {{-- <a href="javascript:void(0);" class="dropdown-item d-block p-h-15 p-v-10">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="anticon opacity-04 font-size-16 anticon-lock"></i>
                                            <span class="m-l-10">Account Setting</span>
                                        </div>
                                        <i class="anticon font-size-10 anticon-right"></i>
                                    </div>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item d-block p-h-15 p-v-10">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="anticon opacity-04 font-size-16 anticon-project"></i>
                                            <span class="m-l-10">Projects</span>
                                        </div>
                                        <i class="anticon font-size-10 anticon-right"></i>
                                    </div>
                                </a> --}}
                                <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item d-block p-h-15 p-v-10">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="anticon opacity-04 font-size-16 anticon-logout"></i>
                                            <span class="m-l-10">Logout</span>
                                        </div>
                                        {{-- <i class="anticon font-size-10 anticon-right"></i> --}}
                                    </div>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </a>
                            </div>
                        </li>
                        {{-- <li>
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#quick-view">
                                <i class="anticon anticon-appstore"></i>
                            </a>
                        </li> --}}
                    </ul>
                </div>
            </div>
            <!-- Header END -->

            <!-- Side Nav START -->
            <div class="side-nav">
                <div class="side-nav-inner">
                    <ul class="side-nav-menu scrollable">
                        <li class="nav-item dropdown open">
                            <a class="dropdown-toggle" href="{{route('home')}}">
                                <span class="icon-holder">
                                    <i class="anticon anticon-line-chart"></i>
                                </span>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="{{route('owners.index')}}">
                                <span class="icon-holder">
                                    <i class="anticon anticon-team"></i>
                                </span>
                                <span class="title">Owner</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-schedule"></i>
                                </span>
                                <span class="title">Requests</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-toggle" href="{{route('branch-request')}}">
                                        {{-- <span class="icon-holder">
                                            <i class="anticon anticon-bank"></i>
                                        </span> --}}
                                        <span class="title">Branch Requests</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-toggle" href="{{route('recharge-request')}}">
                                        {{-- <span class="icon-holder">
                                            <i class="anticon anticon-bank"></i>
                                        </span> --}}
                                        <span class="title">Payment Requests</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-credit-card"></i>
                                </span>
                                <span class="title">Subscription</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="accordion.html">Accordion</a>
                                </li>
                                <li>
                                    <a href="carousel.html">Carousel</a>
                                </li>
                                <li>
                                    <a href="dropdown.html">Dropdown</a>
                                </li>
                                <li>
                                    <a href="modals.html">Modals</a>
                                </li>
                                <li>
                                    <a href="toasts.html">Toasts</a>
                                </li>
                                <li>
                                    <a href="popover.html">Popover</a>
                                </li>
                                <li>
                                    <a href="slider-progress.html">Slider & Progress</a>
                                </li>
                                <li>
                                    <a href="tabs.html">Tabs</a>
                                </li>
                                <li>
                                    <a href="tooltips.html">Tooltips</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-credit-card"></i>
                                </span>
                                <span class="title">Cupon</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="form-elements.html">Form Elements</a>
                                </li>
                                <li>
                                    <a href="form-layouts.html">Form Layouts</a>
                                </li>
                                <li>
                                    <a href="form-validation.html">Form Validation</a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="{{route('invoice-list')}}">
                                <span class="icon-holder">
                                    <i class="anticon anticon-profile"></i>
                                </span>
                                <span class="title">Invoice</span>

                            </a>

                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="{{route('admins.index')}}">
                                <span class="icon-holder">
                                    <i class="anticon anticon-user"></i>
                                </span>
                                <span class="title">Admin</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Side Nav END -->

            @yield('contents')

        </div>
    </div>
    <script src="{{asset('vendors/select2/select2.min.js')}}"></script>
    <!-- page js -->
    <script src="{{asset('vendors/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendors/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('js/pages/datatables.js')}}"></script>
    <script>
        $(document).ready(function(){

            $('#noti').click(function(){
                // console.log("1");
                    $.ajax({
                    url: "{{ route('noti') }}",
                    type: "GET",

                    success: function (data) {
                        //console.log("1");
                        var table = $('#notiData');
                        table.empty();
                        $.each(data, function(idx, elem){

                            table.append('<a href="javascript:void(0);" class="dropdown-item d-block p-15 border-bottom">'+
                                                '<div class="d-flex">'+
                                                    '<div class="avatar avatar-blue avatar-icon">'+
                                                        '<img src="{{ asset('profiles/admins/') }}/'+elem.notifier_photo+'"  alt="me">'+
                                                    '</div>'+
                                                    '<div class="m-l-15">'+
                                                        '<p class="m-b-0 text-dark">'+elem.name+' '+elem.action+' '+elem.type+'</p>'+
                                                        '<p class="m-b-0"><small>'+elem.time+'</small></p>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</a>'+
                                        '</div>');
                        });
                    },
                    error: function (response) {
                        alert("Something Wrong")
                    }
                });

            });
        });
    </script>
    @yield('scripts')
    <!-- Core Vendors JS -->



</body>

</html>
