<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    </head>
    <body>
        <div class="container">
            <nav>
                <ul>
                    <li>
                        <a @yield('cardapio') href="/">
                            <i class="fas fa-utensils"></i>
                            Cardapio
                        </a>
                    </li>
                    <li>
                        <a @yield('cadastro') href="/user">
                            <i class="fas fa-user"></i>
                            Cadastro
                        </a>
                    </li>
                    <li>
                        <a @yield('carrinho') href="/cart">
                            <i class="fas fa-shopping-cart"></i>
                            Carrinho
                        </a>
                    </li>
                </ul>
            </nav>
            
            @yield('content')

            <footer>
                <p>Footer</p>
            </footer>
            
        </div>

    <script type="text/javascript" src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/script.js')}}"></script>
    </body>
</html>
