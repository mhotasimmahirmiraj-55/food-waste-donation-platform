<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <title>
        {{ config('app.name', 'Food Donation Platform') }}
    </title>


    <!-- Fonts -->

    <link rel="preconnect"
          href="https://fonts.bunny.net">

    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700"
          rel="stylesheet" />


    <!-- Scripts -->

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body class="font-sans antialiased
             text-gray-800
             bg-gradient-to-br
             from-emerald-50
             via-teal-50
             to-sky-100">


    {{-- =====================================================
         MAIN APPLICATION WRAPPER
    ====================================================== --}}

    <div class="min-h-screen
                bg-gradient-to-br
                from-emerald-50
                via-teal-50
                to-sky-100">


        {{-- =================================================
             NAVIGATION
        ================================================== --}}

        @include('layouts.navigation')


        {{-- =================================================
             PAGE HEADING
        ================================================== --}}

        @isset($header)

            <header class="bg-white/80
                           backdrop-blur-xl
                           border-b
                           border-white/60
                           shadow-sm">

                <div class="max-w-7xl
                            mx-auto
                            py-6
                            px-8">

                    {{ $header }}

                </div>

            </header>

        @endisset


        {{-- =================================================
             PAGE CONTENT
        ================================================== --}}

        <main>

            {{ $slot }}

        </main>


    </div>

</body>

</html>