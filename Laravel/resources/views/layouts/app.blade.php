<!doctype html>
<html lang="hu">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Számoltasd ki egyszerűen a béredet!">
    <meta name="keywords"
        content="hu, HU, bér, Bér, kalkulátor, számoló, számolás, fizetés, óradíj">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bérkalkulátor</title>
    <link rel="icon" type="image/x-icon" href="/img/logo.png">
    @include('layouts.styles')
</head>

<body>
    <div class="bg-image"></div>

    <header>
        @include('layouts.navigation')

        @include('layouts.header')
    </header>

    <main style="min-height: 55vh;">
        @yield('content')
    </main>

    @include('layouts.footer')
    @include('layouts.scripts')
</body>

</html>
