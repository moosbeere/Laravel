<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link @linkactive('/')" href="/">Главная</a>
                        <a class="nav-link" href="/articles">Статьи</a>
                        @can('moderator')
                        <a class="nav-link" href="/articles/create">Создать</a>
                        @yield('comment')
                        <a class="nav-link" href="/comment">Комментарии</a>
                        @endcan
                        <a class="nav-link" href="/about">О нас</a>
                    </div>
                </div>
            </div>
            <div class="navbar-nav d-flex justify-content-end">
            @if(Auth::guest())
                            <a class="nav-link" href="/registration">Регистрация</a>
                            <a class="nav-link" href="/login">Вход</a>
                        @else
                        <div id="app"> 
                            <template>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                 <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                   <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Уведомления <span class="badge bg-info text-dark">{{auth()->user()->unreadNotifications->count()}}</span>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            @foreach(auth()->user()->unreadNotifications as $notification)
                                            <li><a class="dropdown-item" href="#">
                                                Добавлена статья "{{$notification->data['article']['name']}}"
                                            </a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            </template>
                        </div>
                            <a class="nav-link" href="/logout">Выход</a>
                        @endif
            </div>
        </nav>
        <div class="container">
            @yield('content')
        </div>
        <script src="{{ asset('js/app.js' )}}"></script>
    </body>
</html>
