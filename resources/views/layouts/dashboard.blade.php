<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - LibraGo</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 min-h-screen flex flex-col">
    <div class="grow container mx-auto px-4 py-6 flex gap-6">
        
        <aside class="hidden md:block w-64 shrink-0">
            @include('partials.sidebar')
        </aside>

        <main class="grow min-w-0">
            @include('partials.alerts')
            @yield('content')
        </main>

    </div>

    @include('partials.footer')
</body>
</html>