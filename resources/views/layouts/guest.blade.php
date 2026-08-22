<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ config('app.name', 'Food Waste Donation Platform') }}
    </title>

    <!-- Fonts -->

    <link rel="preconnect" href="https://fonts.bunny.net">

    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap"
          rel="stylesheet" />

    <!-- Scripts -->

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body class="font-sans text-gray-900 antialiased">


    <div class="min-h-screen
                bg-gradient-to-br
                from-emerald-100
                via-teal-50
                to-cyan-100
                flex
                items-center
                justify-center
                px-4
                py-10
                relative
                overflow-hidden">


        {{-- ==========================================
             DECORATIVE BACKGROUND
        =========================================== --}}

        <div class="absolute
                    -top-24
                    -right-24
                    w-80
                    h-80
                    rounded-full
                    bg-emerald-300/20
                    blur-3xl">
        </div>


        <div class="absolute
                    -bottom-32
                    -left-24
                    w-96
                    h-96
                    rounded-full
                    bg-cyan-300/20
                    blur-3xl">
        </div>



        {{-- ==========================================
             MAIN AUTH CONTAINER
        =========================================== --}}

        <div class="relative
                    w-full
                    max-w-md">


            {{-- ======================================
                 BRAND
            ======================================= --}}

            <div class="text-center mb-7">


                <a href="/"
                   class="inline-flex
                          items-center
                          justify-center
                          w-16
                          h-16
                          rounded-2xl
                          bg-emerald-600
                          text-white
                          shadow-lg
                          shadow-emerald-600/25
                          hover:bg-emerald-700
                          hover:-translate-y-1
                          transition-all
                          duration-300">


                    <span class="text-3xl">
                        🍱
                    </span>


                </a>


                <h1 class="mt-4
                           text-2xl
                           font-bold
                           text-gray-800">

                    Food Waste Donation Platform

                </h1>


                <p class="mt-1
                          text-sm
                          text-gray-500">

                    Share surplus food. Reduce waste. Help others.

                </p>

            </div>



            {{-- ======================================
                 AUTH CARD
            ======================================= --}}

            <div class="bg-white
                        rounded-3xl
                        border
                        border-white/70
                        shadow-2xl
                        shadow-emerald-900/10
                        overflow-hidden">


                {{-- Top Accent --}}

                <div class="h-1.5
                            bg-gradient-to-r
                            from-emerald-500
                            via-teal-500
                            to-cyan-500">
                </div>


                <div class="px-7
                            py-8
                            sm:px-9
                            sm:py-9">


                    {{ $slot }}


                </div>


            </div>



            {{-- ======================================
                 FOOTER
            ======================================= --}}

            <p class="text-center
                      text-xs
                      text-gray-500
                      mt-6">

                🌱 Together we can make a difference.

            </p>


        </div>


    </div>

</body>

</html>