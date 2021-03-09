<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{config('app.name')}} | @yield('title')</title>

        {{-- stylesheet assets --}}
        <link rel="stylesheet" href="{{asset("css/app.css")}}">
        <link rel="stylesheet" href="{{asset("css/dashboard.css")}}">
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
            integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
            integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
            crossorigin="anonymous" />
    </head>

    <body>

        <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3 text-center text-xl text-uppercase"
                href="#">{{config("app.name")}}</a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
                data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
            <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap">
                    <form id="logout" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <a href="{{route('logout')}}" class="nav-link" onclick="event.preventDefault();
                            document.getElementById('logout').submit()">Sign Out</a>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="sidebar-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{Request::is('dashboard')? 'active': ''}}" href="{{url('/')}}">
                                    <span data-feather="home"></span>
                                    Dashboard
                                </a>
                            </li>
                            {{-- Admin Menus --}}
                            @auth

                            @endauth
                            @if (Auth::user()->profile_type == 'App\Models\Admin')
                            <li class="nav-item">
                                <a class="nav-link {{Request::is('admins')? 'active' : ''}}"
                                    href="{{route('admins.index')}}">
                                    <span data-feather="users"></span>
                                    Admins
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{Request::is('managers')? 'active' : ''}}"
                                    href="{{route('managers.index')}}">
                                    <span data-feather="users"></span>
                                    Managers
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{Request::is('assistants')? 'active': ''}}"
                                    href="{{route('assistants.index')}}">
                                    <span data-feather="users"></span>
                                    Assistants
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{Request::is('customers')? 'active': ''}}"
                                    href="{{route('customers.index')}}">
                                    <span data-feather="users"></span>
                                    Customers
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{Request::is('appointments')? 'active' : ''}}"
                                    href="{{route('appointments.index')}}">
                                    <span data-feather="layers"></span>
                                    Appointments
                                </a>
                            </li>
                            @endif
                            {{--End Admin Menus --}}

                            {{-- Manager Menus --}}
                            @if (Auth::user()->profile_type == 'App\Models\Manager')
                            <li class="nav-item">
                                <a class="nav-link {{Request::is('assistants')? 'active': ''}}"
                                    href="{{route('assistants.index')}}">
                                    <span data-feather="users"></span>
                                    Assistants
                                </a>
                            </li>
                            @endif
                            {{--End Manager Menus --}}

                            {{-- Assistant Menus --}}
                            @if (Auth::user()->profile_type == 'App\Models\Assistant')
                            <li class="nav-item">
                                <a class="nav-link {{Request::is('customers')? 'active': ''}}"
                                    href="{{route('customers.index')}}">
                                    <span data-feather="users"></span>
                                    Customers
                                </a>
                            </li>
                            @endif
                            {{--End Assistant Menus --}}
                        </ul>
                    </div>
                </nav>

                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                    @yield('dashboard-content')
                </main>


            </div>
        </div>

        {{-- javascript --}}
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>

        <script>
            window.jQuery || document.write('<script src="/docs/4.6/assets/js/vendor/jquery.slim.min.js"><\/script>')
        </script>

        <script src="/docs/4.6/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
        </script>

        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>

        <script src="{{asset("js/dashboard.js")}}"></script>

        <script src="{{asset("js/app.js")}}"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
            integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
            crossorigin="anonymous"></script>

        <script>
            $( document ).ready(function() {
                $('select').selectpicker();
            });
        </script>
        <script>
            $(document).ready(function() {
                $("#datepicker-group").datepicker({
                    format: "d/m/yyyy",
                    todayHighlight: true,
                    autoclose: true,
                    clearBtn: true
                });
            });
        </script>
    </body>

</html>



</html>
