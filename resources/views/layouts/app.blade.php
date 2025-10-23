<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('scripts')
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <title>@yield('title', 'GenBook')</title>
</head>

<body>

    @yield('body')

    <script src="https://unpkg.com/lucide@latest"></script>
</body>

</html>
