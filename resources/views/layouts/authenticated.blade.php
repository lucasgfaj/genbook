<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>@yield('title', 'GenBook')</title>
</head>

<body class="bg-gray-100 text-gray-800 font-sans">

 <header class="bg-blue-700 text-white shadow-md">
    <h1>GenBook</h1>
</header>

    <main>
        @yield('content')
        </main>

        @stack('scripts')

</body>

</html>