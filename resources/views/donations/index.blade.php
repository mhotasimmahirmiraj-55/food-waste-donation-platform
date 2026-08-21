<x-app-layout>

    {{-- =========================================================
         HEADER
    ========================================================== --}}

    <x-slot name="header">

        <div class="flex items-center gap-3">

            <div class="w-1.5 h-9 rounded-full bg-emerald-500"></div>

            <div>

                <h2 class="font-bold text-2xl text-gray-800">
                    My Donations
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Manage and track the food you have donated.
                </p>

            </div>

        </div>

    </x-slot>


    {{-- =========================================================
         PAGE BACKGROUND
    ========================================================== --}}

    <div class="min-h-screen
                bg-gradient-to-br
                from-emerald-100
                via-teal-50
                to-cyan-100
                py-10">


        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- =================================================
                 HERO CARD
            ================================================== --}}

            <div class="relative overflow-hidden
                        bg-gradient-to-r
                        from-emerald-600
                        via-teal-600
                        to-cyan-600
                        rounded-3xl
                        shadow-xl
                        mb-8">

                <div class="absolute -right-16 -top-16
                            w-48 h-48
                            bg-white/10
                            rounded-full">
                </div>

                <div class="absolute -right-8 -bottom-20
                            w-56 h-56
                            bg-white/10
                            rounded-full">
                </div>


                <div class="relative p-8 md:p-10">

                    <div class="max-w-3xl">

                        <div class="inline-flex items-center gap-2
                                    bg-white/15
                                    backdrop-blur-sm
                                    text-white
                                    px-4 py-2
                                    rounded-full
                                    text-sm
                                    font-semibold
                                    mb-4">

                            <span class="text-lg">🍱</span>

                            Donation History

                        </div>


                        <h1 class="text-3xl md:text-4xl
                                   font-bold
                                   text-white">

                            My Food Donations

                        </h1>


                        <p class="mt-3
                                  text-emerald-50
                                  text-base
                                  md:text-lg
                                  leading-relaxed">

                            Keep track of the food you have shared
                            and the impact you are making by reducing
                            food waste.

                        </p>

                    </div>

                </div>

            </div>



            {{-- =================================================
                 SUCCESS MESSAGE
            ================================================== --}}

            @if(session('success'))

                <div class="mb-6
                            flex items-start gap-4
                            bg-emerald-50
                            border border-emerald-200
                            text-emerald-800
                            rounded-2xl
                            p-5
                            shadow-sm">

                    <div class="flex-shrink-0
                                w-10 h-10
                                flex items-center justify-center
                                rounded-full
                                bg-emerald-100
                                text-emerald-600">

                        ✓

                    </div>


                    <div>

                        <p class="font-bold">
                            Success
                        </p>

                        <p class="text-sm mt-1">
                            {{ session('success') }}
                        </p>

                    </div>

                </div>

            @endif



            {{-- =================================================
                 DONATIONS
            ================================================== --}}

            @if($donations->count() > 0)


                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">


                    @foreach($donations as $donation)


                        {{-- =====================================
                             DONATION CARD
                        ====================================== --}}

                        <div class="group
                                    bg-white/95
                                    backdrop-blur-sm
                                    rounded-3xl
                                    shadow-lg
                                    border border-white
                                    overflow-hidden
                                    hover:shadow-2xl
                                    hover:-translate-y-1
                                    transition-all
                                    duration-300">


                            {{-- IMAGE --}}

                            <div class="relative h-52 bg-gray-100 overflow-hidden">


                                @if($donation->food_image)

                                    <img
                                        src="{{ asset('storage/' . $donation->food_image) }}"
                                        alt="{{ $donation->title }}"
                                        class="w-full h-full object-cover
                                               group-hover:scale-105
                                               transition-transform
                                               duration-500">

                                @else

                                    <div class="w-full h-full
                                                flex flex-col
                                                items-center
                                                justify-center
                                                bg-gradient-to-br
                                                from-emerald-50
                                                to-teal-100">

                                        <span class="text-5xl">
                                            🍱
                                        </span>

                                        <p class="text-sm
                                                  text-gray-500
                                                  mt-2">

                                            No image available

                                        </p>

                                    </div>

                                @endif


                                {{-- STATUS BADGE --}}

                                <div class="absolute top-4 right-4">


                                    @if($donation->expiry_time < now())

    <span class="inline-flex
                 items-center gap-1.5
                 px-3 py-1.5
                 rounded-full
                 bg-red-500
                 text-white
                 text-xs
                 font-bold
                 shadow-lg">

        <span class="w-2 h-2
                     rounded-full
                     bg-white">
        </span>

        Expired

    </span>
@if($donation->expiry_time < now())

    <span class="inline-flex
                 items-center gap-1.5
                 px-3 py-1.5
                 rounded-full
                 bg-red-500
                 text-white
                 text-xs
                 font-bold
                 shadow-lg">

        <span class="w-2 h-2
                     rounded-full
                     bg-white">
        </span>

        Expired

    </span>


@elseif($donation->status === 'available')

    <span class="inline-flex
                 items-center gap-1.5
                 px-3 py-1.5
                 rounded-full
                 bg-emerald-500
                 text-white
                 text-xs
                 font-bold
                 shadow-lg">

        <span class="w-2 h-2
                     rounded-full
                     bg-white">
        </span>

        Available

    </span>


@elseif($donation->status === 'claimed')

    <span class="inline-flex
                 items-center gap-1.5
                 px-3 py-1.5
                 rounded-full
                 bg-blue-500
                 text-white
                 text-xs
                 font-bold
                 shadow-lg">

        Claimed

    </span>


@elseif($donation->status === 'delivered')

    <span class="inline-flex
                 items-center gap-1.5
                 px-3 py-1.5
                 rounded-full
                 bg-purple-500
                 text-white
                 text-xs
                 font-bold
                 shadow-lg">

        Delivered

    </span>


@else

    <span class="inline-flex
                 px-3 py-1.5
                 rounded-full
                 bg-gray-600
                 text-white
                 text-xs
                 font-bold
                 shadow-lg">

        {{ ucfirst($donation->status) }}

    </span>

@endif


                                    @elseif($donation->status === 'claimed')

                                        <span class="inline-flex
                                                     items-center gap-1.5
                                                     px-3 py-1.5
                                                     rounded-full
                                                     bg-blue-500
                                                     text-white
                                                     text-xs
                                                     font-bold
                                                     shadow-lg">

                                            Claimed

                                        </span>


                                    @elseif($donation->status === 'delivered')

                                        <span class="inline-flex
                                                     items-center gap-1.5
                                                     px-3 py-1.5
                                                     rounded-full
                                                     bg-purple-500
                                                     text-white
                                                     text-xs
                                                     font-bold
                                                     shadow-lg">

                                            Delivered

                                        </span>


                                    @else

                                        <span class="inline-flex
                                                     px-3 py-1.5
                                                     rounded-full
                                                     bg-gray-600
                                                     text-white
                                                     text-xs
                                                     font-bold
                                                     shadow-lg">

                                            {{ ucfirst($donation->status) }}

                                        </span>

                                    @endif

                                </div>

                            </div>



                            {{-- CARD CONTENT --}}

                            <div class="p-6">


                                {{-- TITLE --}}

                                <h3 class="text-xl
                                           font-bold
                                           text-gray-800
                                           mb-2">

                                    {{ $donation->title }}

                                </h3>


                                {{-- DESCRIPTION --}}

                                @if($donation->description)

                                    <p class="text-sm
                                              text-gray-500
                                              leading-relaxed
                                              mb-5">

                                        {{ Str::limit($donation->description, 100) }}

                                    </p>

                                @endif



                                {{-- FOOD ITEMS --}}

                                <div class="mb-5">


                                    <div class="flex items-center gap-2 mb-3">

                                        <div class="w-2 h-2
                                                    rounded-full
                                                    bg-emerald-500">
                                        </div>

                                        <h4 class="text-sm
                                                   font-bold
                                                   text-gray-700">

                                            Food Items

                                        </h4>

                                    </div>


                                    <div class="space-y-2">


                                        @foreach($donation->items as $item)

                                            <div class="flex items-center
                                                        justify-between
                                                        bg-gray-50
                                                        rounded-xl
                                                        px-4 py-3
                                                        border
                                                        border-gray-100">


                                                <div class="flex items-center
                                                            gap-3
                                                            min-w-0">

                                                    <div class="w-9 h-9
                                                                flex-shrink-0
                                                                flex items-center
                                                                justify-center
                                                                rounded-lg
                                                                bg-emerald-100
                                                                text-emerald-600">

                                                        🍽️

                                                    </div>


                                                    <div class="min-w-0">

                                                        <p class="text-sm
                                                                  font-semibold
                                                                  text-gray-800
                                                                  truncate">

                                                            {{ $item->item_name }}

                                                        </p>


                                                        @if($item->foodCategory)

                                                            <p class="text-xs
                                                                      text-gray-400
                                                                      mt-0.5">

                                                                {{ $item->foodCategory->name }}

                                                            </p>

                                                        @endif

                                                    </div>

                                                </div>


                                                <span class="flex-shrink-0
                                                             ml-3
                                                             text-sm
                                                             font-bold
                                                             text-emerald-600">

                                                    {{ $item->quantity }}
                                                    {{ $item->unit }}

                                                </span>

                                            </div>

                                        @endforeach


                                    </div>

                                </div>



                                {{-- DETAILS --}}

                                <div class="space-y-3
                                            border-t
                                            border-gray-100
                                            pt-5">


                                    {{-- EXPIRY --}}

                                    <div class="flex items-start gap-3">

                                        <div class="w-9 h-9
                                                    flex-shrink-0
                                                    flex items-center
                                                    justify-center
                                                    rounded-lg
                                                    bg-orange-100
                                                    text-orange-600">

                                            ⏰

                                        </div>


                                        <div>

                                            <p class="text-xs
                                                      text-gray-400
                                                      font-medium">

                                                Expiry

                                            </p>

                                            <p class="text-sm
                                                      font-semibold
                                                      text-gray-700">

                                                {{ $donation->expiry_time }}

                                            </p>

                                        </div>

                                    </div>



                                    {{-- PICKUP LOCATION --}}

                                    <div class="flex items-start gap-3">

                                        <div class="w-9 h-9
                                                    flex-shrink-0
                                                    flex items-center
                                                    justify-center
                                                    rounded-lg
                                                    bg-blue-100
                                                    text-blue-600">

                                            📍

                                        </div>


                                        <div class="min-w-0">

                                            <p class="text-xs
                                                      text-gray-400
                                                      font-medium">

                                                Pickup Location

                                            </p>

                                            <p class="text-sm
                                                      font-semibold
                                                      text-gray-700
                                                      break-words">

                                                {{ $donation->pickup_address }}

                                            </p>

                                        </div>

                                    </div>


                                </div>


                            </div>


                        </div>


                    @endforeach


                </div>


            @else


                {{-- =================================================
                     EMPTY STATE
                ================================================== --}}

                <div class="bg-white/95
                            backdrop-blur-sm
                            rounded-3xl
                            shadow-xl
                            border border-white
                            p-10
                            md:p-16
                            text-center">


                    <div class="w-24 h-24
                                mx-auto
                                flex items-center
                                justify-center
                                rounded-3xl
                                bg-emerald-100
                                text-emerald-600
                                text-5xl">

                        🍱

                    </div>


                    <h3 class="text-2xl
                               font-bold
                               text-gray-800
                               mt-6">

                        No Donations Yet

                    </h3>


                    <p class="text-gray-500
                              mt-2
                              max-w-md
                              mx-auto">

                        You haven't donated any food yet.
                        Start your first donation and help reduce
                        food waste in your community.

                    </p>


                    <a
                        href="{{ route('donations.create') }}"

                        class="inline-flex
                               items-center
                               gap-2
                               mt-6
                               px-6 py-3
                               rounded-xl
                               bg-gradient-to-r
                               from-emerald-600
                               to-teal-600
                               text-white
                               font-bold
                               shadow-lg
                               hover:from-emerald-700
                               hover:to-teal-700
                               hover:-translate-y-0.5
                               transition-all
                               duration-200">

                        <span class="text-lg">
                            +
                        </span>

                        Donate Food

                    </a>

                </div>


            @endif


            {{-- =================================================
                 FOOTER MESSAGE
            ================================================== --}}

            <div class="text-center mt-8">

                <p class="text-sm text-gray-500">

                    🌱 Every donation matters.
                    Together, we can reduce food waste.

                </p>

            </div>


        </div>

    </div>

</x-app-layout>