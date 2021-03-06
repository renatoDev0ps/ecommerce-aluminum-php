<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AluminumLoversBike</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <style>
        .front.row {
            margin-bottom: 40px;
        }
    </style>
    @yield('stylesheets')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom: 40px;">
        <a class="navbar-brand" href="{{route('home')}}">
            AluminumLoversBike
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                @auth
                @if(auth()->user()->role == 'ROLE_OWNER')
                <li class="nav-item @if(request()->is('admin*')) active @endif">
                    <a class="nav-link" href="{{route('admin.products.index')}}">Admin </a>
                </li>
                @endif
                @endauth
                <li class="nav-item @if(request()->is('/')) active @endif">
                    <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
                </li>
                @foreach ($categories as $category)
                    <li class="nav-item @if(request()->is('category/' . $category->slug)) active @endif">
                        <a class="nav-link" href="{{route('category.single', ['slug' => $category->slug])}}">{{$category->name}}</a>
                    </li>
                @endforeach
            </ul>

            <div class="my-2 my-lg-0" style="display:flex;">
                <ul class="navbar-nav mr-auto">
                    @auth
                        <li class="nav-item">
                            <a href="{{route('user.orders')}}" class="nav-link @if(request()->is('my-orders')) active @endif">Meus Pedidos</a>
                        </li>
                    @endauth
                    <li class="nav-item @if(!session()->has('cart')) '' @else active @endif">
                        <a href="{{route('cart.index')}}" class="nav-link">
                            @if(session()->has('cart'))
                                <span class="badge badge-success">{{count(session()->get('cart'))}}</span>
                            @else
                                <span class="badge badge-danger">0</span>
                            @endif
                            <i class="fa fa-shopping-cart"></i>
                        </a>
                    </li>
                </ul>
            @if(auth()->user())
            @auth
                <span class="nav-link" style="color:whitesmoke;">{{auth()->user()->name}}</span>
                <a href="#" onclick="event.preventDefault();
                                                        document.querySelector('form.logout').submit();" class="btn btn-outline-success my-2 my-sm-0">Logout</a>
                <form action="{{route('logout')}}" class="logout" method="POST" style="display:none;">
                    @csrf
                </form>
            @endauth
            @else
                <a href="{{route('login')}}" class="btn btn-outline-success my-2 my-sm-0">Login</a>
            @endif
            </div>
        </div>
    </nav>

    <div class="container">
        @include('flash::message')
        @yield('content')
    </div>
    <!-- <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script> -->
    <script src="{{asset('js/app.js')}}"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
    @yield('scripts')
</body>
</html>
