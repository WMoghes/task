<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
    @yield('style')
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ route('homepage', 1) }}" onclick="getHomepage(event, this.href)">
                    Laravel
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}" id="login" onclick="loginPage(event, this.href)">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        @if (Auth::user()->permission_id === 2)
                            <li><a href="{{ route('get_shopping_cart') }}" onclick="shoppingCart(event, this.href)">
                                    My Shopping Cart
                                    @if (getCountOfCart('cart_' . Auth::user()->id))
                                        <span class="badge" id="items-count">
                                            {{ getCountOfCart('cart_' . Auth::user()->id) }}
                                        </span>
                                    @endif
                                </a>
                            </li>
                            <li><a href="{{ route('all_orders') }}" onclick="allOrders(event, this.href)">All Orders</a></li>
                        @endif
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Hi, {{ Auth::user()->username }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                @if (Auth::user()->permission_id === 1)
                                    <li>
                                        <a href="{{ url('/admin') }}">
                                            <i class="fa fa-btn fa-sign-out"></i>Admin Panel
                                        </a>
                                    </li>
                                @endif
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    <script>
        function loginPage(event, url)
        {
            event.preventDefault();
            var page = $('body');
            page.html('<h1>Loading....</h1>');
            $.ajax({
                url: url,
                type: 'get',
                success: function (data) {
                    page.html(data);
                },
                error: function () {

                }
            });
        }
        function shoppingCart(event, url)
        {
            event.preventDefault();
            var page = $('#client-content');
            page.html('<h1>Loading....</h1>');
            $.ajax({
                url: url,
                type: 'get',
                success: function (data) {
                    page.html(data);
                },
                error: function () {

                }
            });
        }
        function allOrders(event, url)
        {
            event.preventDefault();
            var page = $('#client-content');
            page.html('<h1>Loading....</h1>');
            $.ajax({
                url: url,
                type: 'get',
                success: function (data) {
                    page.html(data);
                },
                error: function () {

                }
            });
        }
        function getHomepage(event, url)
        {
            event.preventDefault();
            var page = $('body');
            page.html('<h1>Loading....</h1>');
            $.ajax({
                url: url,
                type: 'get',
                success: function (data) {
                    page.html(data);
                }
            });
        }
    </script>
@yield('script')
</body>
</html>
