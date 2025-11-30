<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - LibraGo</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col">
    @if (!in_array(Route::currentRouteName(), ['login', 'register']))
        @include('partials.navbar')
    @endif

    <main class="grow container mx-auto px-4 py-6">
        @include('partials.alerts')
        @yield('content')
    </main>

    @include('partials.footer')
</body>
</html>