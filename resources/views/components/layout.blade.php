<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Home' }} | La Burguesia</title>

    <!-- Bootstrap (local) -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- Estilos propios -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body class="d-flex flex-column min-vh-100 "
    style="background-image: url({{ asset('img/fondo.png') }});  background-size: cover; background-position: center; background-attachment: fixed;">

    <x-navbar />
    <main class="container py-4 ">
        {{ $slot }}
    </main>
    <x-footer />

    <!-- Bootstrap JS (local) -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
