<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href=" {{ mix('css/style.css') }}">
    <title>Series</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-2">
        <div class="container-fluid">
            <a class="ml-3 navbar-brand" href="{{route('series_list')}}">Início</a>
            @auth
            <a href="/signout" class="text-danger">Sair</a>
            @endauth
            @guest
            <a href="/signin">Entrar</a>
            @endguest

        </div>
    </nav>

    <div class="container">
        <div class="h-100 p-5 text-white bg-dark rounded-3 mt-2 mb-4">
            <h1>@yield('header')</h1>
        </div>
        @yield('content')
    </div>
</body>

</html>
