<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full font-sans antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=1280">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel Bi</title>

    <link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('app.css', 'vendor/bi') }}">
</head>
<body class="text-text h-full bg-background font-muli">

    <div id="laravel-bi" class="h-full flex flex-col" :class="{ 'overflow-hidden' : nav }">

        <div class="flex flex-grow flex-col">

            <div class="h-head-box bg-head">
                <h1 class="p-20 text-25 text-white ">
                    <i class="fas fa-bars mr-10 cursor-pointer" @click.prevent="nav = true"></i> Laravel Bi <span v-cloak v-if="dashboardName" v-text="'>> ' + dashboardName"></span>
                </h1>
            </div>

            <bi-nav class="nav" :class="{ 'open': nav }" @close="nav = false"></bi-nav>
            <div class="flex-grow">
                <router-view :filters="filters" :filters-flag="filtersFlag"></router-view>
            </div>

            <div v-if="nav" class="h-full w-full z-10 bg-gray-100-alpha absolute" @click.prevent="nav = false"></div>
        </div>

        <bi-toast></bi-toast>
    </div>

    <script>
        window.bi = @json($serverData);
    </script>
    <script src="{{ mix('app.js', 'vendor/bi') }}"></script>
</body>
</html>