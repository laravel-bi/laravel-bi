<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full font-sans antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=1280">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel Bi</title>

    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC&display=swap" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('app.css', 'vendor/bi') }}">
</head>
<body class="text-black h-full bg-gray-200 font-noto">

    <div id="laravel-bi" class="h-full flex flex-col">
        <div class="p-4 w-full bg-gray-800 text-white text-xl uppercase">
            Laravel bi
        </div>

        <div class="flex flex-grow">
            <bi-nav class="bg-gray-800 text-white"></bi-nav>
            <div class="flex-grow p-4">
                <router-view></router-view>
            </div>
        </div>

        <bi-toast></bi-toast>
    </div>

    <script>
        window.bi = @json($serverData);
    </script>
    <script src="{{ mix('app.js', 'vendor/bi') }}"></script>
</body>
</html>