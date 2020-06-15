<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
        
            html, body {
                background-color: #F5F5F5;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
          
            nav ul {
                display:flex;
                justify-content: space-around;
                list-style-type: none;
                margin: 0;
                padding: 0;
                overflow: hidden;
                background-color: #3A3A3A;
                position: fixed;
                bottom: 0;
            }

            nav li {
                flex:1
            }

            nav li a {
                display: block;
                color: white;
                text-align: center;
                padding: 10px;
                text-decoration: none;
                font-weight:bold;
            }

            nav li a:hover:not(.active) {
                background-color: #111111;
            }

            i {
                margin:0 30px;
                font-size: 22px;
            }

            .active {
                background-color: #FF841C;
            }

            section{
                display:flex;
                flex-direction: column;
                align-items:center;
            }
            section h1{
                color:#FF841C;
                font-weight:bold;
                margin:5px;
            }

            section p{
                font-weight:bold;
                margin:5px;
            }

            section.categories{
                
            }

            section.categories ul{
                display:flex;
                flex-direction: column;
                width: 90%;
                list-style-type: none;
                margin: 0;
                padding: 0;
            }

            section.categories ul li{
                display:flex;
                height:80px;
                margin:2px;
                background-color: #3A3A3A;
                font-size:22px;
                font-weight:bold;
                color: white;
                text-align:center;
                align-items:center;
                justify-content:center;
                text-shadow: 0 0 10px black;
            }
            section.categories ul li.cat-1{
                background: url(https://media.gazetadopovo.com.br/bomgourmet/2019/09/pastel-de-camarao-10-pasteis-c5f12cc0.jpg) center;
                background-size: cover;
            }

            section.categories ul li.cat-2{
                background: url(https://www.selecoes.com.br/wp-content/uploads/2019/05/hamburguer-760x450.jpg) center;
                background-size: cover;
            }

            section.categories ul li.cat-3{
                background: url(https://i1.wp.com/spcity.com.br/wp-content/uploads/2018/06/naom_5a8e98d9bb34a.jpg?resize=1170%2C658&ssl=1) center;
                background-size: cover;
            }

            section.categories ul li.cat-4{
                background: url(https://www.vozdobico.com.br/wp-content/uploads/2019/10/refrigerantes.jpg) center;
                background-size: cover;
            }


            header{
                display:flex;
                flex-direction: column;
                color: white;
                height:200px;
                background: url(https://media.gazetadopovo.com.br/bomgourmet/2019/09/pastel-de-camarao-10-pasteis-c5f12cc0.jpg) center;
                background-size: cover;
                padding: 15px;
                align-items:center;
                justify-content:center;
                text-shadow: 2px 2px 5px black;
            }

            @media screen and (min-width: 480px) {
                nav ul {
                    position: fixed;
                    top: 0;
                    height: 45px;
                    width: 100%;
                }
                i {
                    margin:0 10px;
                    font-size: 22px;
                }
                footer{
                    display:block !important;
                    text-align: center;
                    padding: 3px;
                    background-color: #3A3A3A;
                    color: white;
                }
                header{
                    margin-top:45px !important;
                }
            }
            
            
            
            footer{
                display:none
            }
            
                
            

        </style>
    </head>
    <body>
        <div class="container">
            <nav>
                <ul>
                    <li>
                        
                        <a class="active" href="/cardapio">
                            <i class="fas fa-utensils"></i>
                            Cardapio
                        </a>
                    </li>
                    <li>
                        <a href="/cardapio">
                            <i class="fas fa-user"></i>
                            Cadastro
                        </a>
                    </li>
                    <li>
                        <a href="/cardapio">
                            <i class="fas fa-shopping-cart"></i>
                            Carrinho
                        </a>
                    </li>
                </ul>
            </nav>
            <header class="section-header">
                <img src="https://logo.criativoon.com/wp-content/uploads/2016/07/logotipo-lanchonete.png" alt="Stickman"  height="125">
                <h3>Faça seu pedido que eviamos até você!</h3>
            </header>

            <section class="tittles">
                <h1>Cardápio Digital</h1>
                <p>Escolha uma categotia</p>
            </section>
            <section class="categories">
                <ul>
                    <li class="cat-1">Categoria 1</li>
                    <li class="cat-2">Categoria 2</li>
                    <li class="cat-3">Categoria 3</li>
                    <li class="cat-4">Categoria 4</li>
                </ul>
            </section>
            <footer>
                <p>Footer</p>
            </footer>
            
        </div>
    </body>
</html>
