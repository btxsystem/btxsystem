<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>
            @section('title')
             | Bitrexgo
            @show
        </title>
        <!-- for css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/tree/Treant.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/tree/basic-example.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}" />
        <link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="/assets/vendors/sweetalert/css/sweetalert.css">
        <link href="{{asset('assets3/fonts/stroke/style.css')}}" rel="stylesheet">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
        <link href="{{ asset('assets/css/chart.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/chart.min.css') }}" rel="stylesheet" type="text/css" />


        <!-- meta -->
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- for js library -->

        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

        <!-- Datatable Export -->


        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

        @yield('header_styles')
        <body class="skin-josh">
            <header class="header">

                <a href="" class="logo">
                    <!-- <img src="http://ebook.bitrexgo.id/assetsebook/v2/img/logo-white.png" alt="logo" style="height:40px;float:left;margin-top:12px"> -->
                    <img src="{{ URL::to('/') }}/img/logo.png" alt="logo" style="height:40px;float:left;margin-top:12px; margin-left:12px;">
                </a>

                <div class="clearfxix"></div>

                <nav class="navbar navbar-static-top" role="navigation">

                    <div>
                        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                            <div class="responsive_nav"></div>
                        </a>
                    </div>

                    <div class="navbar-right">
                        <ul class="nav navbar-nav">
                           {{-- @include('admin.layouts._messages') --}}
                            {{--@include('admin.layouts._notifications') --}}
                            <li>
                                <a onclick="document.getElementById('logout-form').submit();" style="cursor:pointer">
                                    <i class="fa fa-sign-out" style="color: #6CC66C"><br><i style="color: #6CC66C">Logout</i></i>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @method('POST')
                                    @csrf
                                </form>
                            </li>
                            {{--<li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="livicon" data-name="gear" data-loop="true" data-color="#e9573f" data-hovercolor="#e9573f" data-size="28"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header bg-light-blue">
                                        abcd<p class="topprofiletext"></p>
                                    </li>
                                    <li>
                                        <a href="">
                                            <i class="livicon" data-name="user" data-s="18"></i>
                                            My Profile
                                        </a>
                                    </li>
                                    <li role="presentation"></li>
                                    <li>
                                        <a href="">
                                            <i class="livicon" data-name="gears" data-s="18"></i>
                                            Account Settings
                                        </a>
                                    </li>

                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="">
                                            <i class="livicon" data-name="lock" data-size="16" data-c="#555555" data-hc="#555555" data-loop="true"></i>
                                            Lock
                                        </a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="">
                                            <i class="livicon" data-name="sign-out" data-s="15"></i>
                                            Logout
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>--}}
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper ">
            <aside class="left-side ">
                <section class="sidebar ">
                    <div class="page-sidebar  sidebar-nav">
                        <!-- <div class="nav_icons">
                            <ul class="sidebar_threeicons">
                                <li>
                                    <a href="">
                                        <i class="livicon" data-name="table" title="Advanced tables" data-loop="true"
                                        data-color="#418BCA" data-hc="#418BCA" data-s="25"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <i class="livicon" data-name="list-ul" title="Tasks" data-loop="true"
                                        data-color="#e9573f" data-hc="#e9573f" data-s="25"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <i class="livicon" data-name="image" title="Gallery" data-loop="true"
                                        data-color="#F89A14" data-hc="#F89A14" data-s="25"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="">
                                        <i class="livicon" data-name="user" title="Users" data-loop="true"
                                        data-color="#6CC66C" data-hc="#6CC66C" data-s="25"></i>
                                    </a>
                                </li>
                            </ul>
                        </div> -->
                        <br/><br/>
                        <div class="clearfix"></div>
                        @include('admin.layouts._left')
                    </div>
                </section>
            </aside>
            <aside class="right-side">

                @yield('content')

            </aside>
        </div>
        <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Return to top"
        data-toggle="tooltip" data-placement="left">
            <i class="livicon" data-name="plane-up" data-size="18" data-loop="true" data-c="#fff" data-hc="white"></i>
        </a>



        <script src="{{ asset('assets/js/app.js') }}" type="text/javascript"></script>
        <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}" ></script>
        <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.js') }}" ></script>
        <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.responsive.js') }}" ></script>
        <script type="text/javascript" src="{{ asset('assets/js/pages/table-responsive.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
        <script type="text/javascript" src="{{ asset('assets/js/chart.bundle.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/chart.bundle.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/chart.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/chart.min.js') }}"></script>
        <script src="{{asset('assets2/js/number.js')}}"></script>
        <script>
            $('.notifications-menu').click(function(){

                $.ajax({
                    type: 'GET', //THIS NEEDS TO BE GET
                    url: '{{route("notification.read")}}',
                    success: function (data) {
                        $('.notifications-menu').addClass('open');
                    }
                })
            })
        </script>
        <script>
        const BASE_URL = '{{url("/")}}'
        </script>


        @yield('footer_scripts')
        @include('sweet::alert')
    </body>
</html>
