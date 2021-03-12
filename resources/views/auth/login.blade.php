<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="icon" type="image/png" sizes="32x32" href="https://laravel.com/img/favicon/favicon-32x32.png">
        <title>{{config('app.name'). ' Login'}}</title>

        <link rel="stylesheet" href="{{asset("css/app.css")}}">
        <link rel="stylesheet" href="{{asset("css/auth-login.css")}}">

    </head>

    <body class="text-center">
        <div class="container">
            <div class="row">
                <form method="POST" action="{{route('login')}}" class="form-signin">
                    @csrf
                    <h1 class="h3 mb-3 font-weight-normal">Please Sign In</h1>
                    <label for="email" class="sr-only">Email address</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email address"
                        required autofocus value="{{old("name")}}">


                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password"
                        required>
                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block mb-2" type="submit">Sign in</button>

                    @error('email')
                    <small class="text-danger">{{$message}}</small>

                    @enderror

                    @error('password')
                    <small class="text-danger">{{$message}}</small>

                    @enderror
                </form>
            </div>
            <div class="row mb-3">
                <div class="container pt-5">
                    <p class=" d-inline mt-2 mb-3 text-sm">
                        <a class=" text-muted" href="https://github.com/madeabinawa/laravel_booking_services">Web Source
                            Code</a> |
                        <a class=" text-muted" href="https://github.com/madeabinawa/flutter_booking_services">Mobile
                            Source
                            Code</a> |
                        <a class=" text-muted" href="https://github.com/madeabinawa?tab=repositories">Portfolio
                            Lainnya</a> </p>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="container">
                    <small class=" d-inline mt-2 mb-3 text-sm"><strong>Admin:</strong> </small>
                    <div class="d-inline">
                        <small>admin@mail.com | </small>
                        <small>12345678</small>
                    </div>
                </div>

                <div class="container">
                    <small class=" d-inline mt-2 mb-3 text-sm"><strong>Assistant:</strong> </small>
                    <div class="d-inline">
                        <small>assistant0@mail.com / assistant1@mail.com | </small>
                        <small>12345678 </small>
                    </div>
                </div>

                <div class="container">
                    <small class=" d-inline mt-2 mb-3 text-sm"><strong>Assistant:</strong> </small>
                    <div class="d-inline">
                        <small>customer1@mail.com / customer2@mail.com | </small>
                        <small>12345678 </small>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="{{asset("js/app.js")}}"></script>

</html>
