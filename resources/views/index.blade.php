<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full font-sans antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=1280">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel Bi</title>

    <link rel="stylesheet" href="{{ asset('vendor/bi/css/app.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

</head>

<body class="bg-gray-200 min-h-full font-lato">

    <div  id="laravel-bi">
        <div class="flex flex-col min-h-screen">

            <div class="bg-gray-900 text-white p-4 font-semibold w-full" id="header">
                Laravel Bi
            </div>

            <div class="flex flex-grow">

                <bi-nav-bar :class="{ 'open': nav }" @close="nav = false"></bi-nav-bar>

                <router-view :key="$route.fullPath"></router-view>

            </div>

        </div>

        <div class="absolute bottom-0 right-0 bg-red-600 rounded mb-4 mr-4 text-white px-4 py-2 text-sm" v-cloak v-if="toast">
            @{{ toast.message }}
        </div>
    </div>

    <script>
        window.bi = @json($serverData);
    </script>
    <script src="{{ asset('vendor/bi/js/app.js') }}"></script>

    
</body>
</html>