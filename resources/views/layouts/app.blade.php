<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Enlace al archivo CSS compilado de Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Otros enlaces CSS, scripts, etc. -->
</head>
<body>
    @yield('content')

    <!-- Script de Bootstrap (jQuery y Popper.js deben incluirse antes) -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Otros elementos comunes de la página -->
</body>
</html>
