<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

    <!-- Importar Archivos de Estilos y Scripts -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body class="min-h-screen flex flex-col">
    <div id="app" class="flex-grow">
        <!-- Aquí es donde se montará Vue -->
        <home></home>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
