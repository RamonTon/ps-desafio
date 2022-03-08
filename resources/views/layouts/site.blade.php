<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('main.css')}}">
    <title>@yield('title') | Categorias</title>
</head>
    <body>  
        <header class = "header"> 
            <nav>
                <ul>
                    <li><a href="{{route('site.produtos')}}"><img class = "imgLogo" src="/content/logo.png" alt=""></a> </li>
                    <li><a target = "_blank" href= "https://www.adapti.info/"> Adapti Soluções WEB</a> </li>
                    <li><a target = "_blank" href="{{route('dashboard')}}"> Dashboard </a></li>
                </ul> 
            </nav>
        </header>
            <nav>
                <ul>
                    <li><img class = "imgLogo2" src="/content/Logo2.png" alt=""> </li>
                </ul>
            </nav>
            <nav>
                <ul class = "primeiraBox">
                    <li > Categorias</li>
                    <li>
                        @foreach ($categorias as $categoria)
                            <spam class ="categoria">|{{ $categoria->categoria }}|</spam>
                        @endforeach
                    </li>
                </ul>
            </nav>
    <main>
        @yield('content')
    </main>
        <footer>
            <p class = "texto"> Feito a base de tentativa e erro por Ramon Ton</p>
            <li><img class = "imgRodaPe" src="/content/RodaPe.jpg" alt=""> </li>
        </footer>
    </body>
</html>