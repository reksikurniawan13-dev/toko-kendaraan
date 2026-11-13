<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-4">
    <h1 class="text-2xl font-bold mb-2">{{ config('app.name') }}</h1>
    <p class="mb-5">Aplikasi jual beli kendaraan dengan Laravel {{ app()->version() }}.</p>
    <a href="{{ url('/vehicles') }}" class="bg-blue-500 text-white px-4 py-2 rounded-2xl">Lihat Tabel Kendaraan</a>
</body>
</html>
