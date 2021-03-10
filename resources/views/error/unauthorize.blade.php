<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <link rel="icon" type="image/png" sizes="32x32" href="https://laravel.com/img/favicon/favicon-32x32.png">
        <title>{{config('app.name') .' | Unauthorized'}}</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="{{asset("css/app.css")}}">
        <link rel="stylesheet" href="{{asset("css/cover.css")}}">

        <style>
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                    font-size: 3.5rem;
                }
            }
        </style>


        <!-- Custom styles for this template -->
        <link href="cover.css" rel="stylesheet">
    </head>

    <body class="text-center">
        <div class="cover-container  d-flex w-100 h-auto p-3 mx-auto flex-column" style="margin-top: 18%;">
            <main role="main" class="inner cover">
                <h1 class="cover-heading">Sorry Unauthorized User</h1>
                <p class="lead">You have no permission to access the page</p>
                <p class="lead">
                    @guest
                    <a href="{{route('login')}}" class="btn btn-lg btn-secondary">Login</a>
                    @endguest

                    @auth
                    @if (Auth::user()->profile_type == 'App\Models\Manager')
                    <a href="{{route('assistants.index')}}" class="btn btn-lg btn-secondary">Back Home</a>
                    @else
                    <a href="{{route('customers.index')}}" class="btn btn-lg btn-secondary">Back Home</a>
                    @endif
                    @endauth
                </p>
            </main>
        </div>
    </body>

</html>
