<x-app-layout>

    {{-- =========================================================
         HEADER
    ========================================================== --}}

    <x-slot name="header">

        <div class="flex items-center gap-3">

            <div class="w-1.5 h-10 rounded-full bg-emerald-500"></div>

            <div>
                <h2 class="font-bold text-2xl text-gray-800">
                    Edit Donations
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Manage and update your food donations.
                </p>
            </div>

        </div>

    </x-slot>


    {{-- =========================================================
         PAGE BACKGROUND
    ========================================================== --}}

    <div class="min-h-screen
                bg-gradient-to-br
                from-emerald-50
                via-teal-50
                to-cyan-50
                py-10">


        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- =================================================
                 HERO SECTION
            ================================================== --}}

            <div class="relative overflow-hidden
                        bg-gradient-to-r
                        from-emerald-600
                        via-teal-600
                        to-cyan-600
                        rounded-3xl
                        shadow-xl
                        mb-10">

                {{-- Decorative circles --}}

                <div class="absolute
                            -right-16
                            -top-16
                            w-52
                            h-52
                            bg-white/10
                            rounded-full">
                </div>

                <div class="absolute
                            -right-10
                            -bottom-24
                            w-64
                            h-64
                            bg-white/10
                            rounded-full">
                </div>


                <div class="relative p-8 md:p-10">

                    <div class="max-w-3xl">

                        <div class="inline-flex
                                    items-center
                                    gap-2
                                    bg-white/15
                                    backdrop-blur-sm
                                    text-white
                                    px-4
                                    py-2
                                    rounded-full
                                    text-sm
                                    font-semibold
                                    mb-4">

                            <span class="text-lg">
                                ✏️
                            </span>

                            Donation Management

                        </div>


                        <h1 class="text-3xl
                                   md:text-4xl
                                   font-bold
                                   text-white">

                            Edit Your Donations

                        </h1>


                        <p class="mt-3
                                  text-emerald-50
                                  text-base
                                  md:text-lg
                                  leading-relaxed">

                            Review your donations and update available
                            food information whenever necessary.

                        </p>

                    </div>

                </div>

            </div>



            {{-- =================================================
                 DONATIONS
            ================================================== --}}

            @if($donations->count() > 0)

                {{-- GRID --}}

                <div class="grid
                            grid-cols-1
                            md:grid-cols-2
                            xl:grid-cols-3
                            gap-6">


                    {{-- =================================================
                         LOOP DONATIONS
                    ================================================== --}}

                    @foreach($donations as $donation)


                        {{-- =================================================
                             DONATION CARD
                        ================================================== --}}

                        <div class="group
                                    bg-white
                                    rounded-3xl
                                    shadow-md
                                    border
                                    border-gray-100
                                    overflow-hidden
                                    hover:shadow-2xl
                                    hover:-translate-y-1
                                    transition-all
                                    duration-300">


                            {{-- =================================================
                                 IMAGE SECTION
                            ================================================== --}}

                            <div class="relative
                                        h-52
                                        bg-gray-100
                                        overflow-hidden">


                                @if($donation->food_image)

                                    <img
                                        src="{{ asset('storage/' . $donation->food_image) }}"
                                        alt="{{ $donation->title }}"
                                        class="w-full
                                               h-full
                                               object-cover
                                               group-hover:scale-105
                                               transition-transform
                                               duration-500">

                                @else

                                    <div class="w-full
                                                h-full
                                                flex
                                                flex-col
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



                                {{-- =================================================
                                     STATUS BADGE
                                ================================================== --}}

                                <div class="absolute
                                            top-4
                                            right-4">


                                    @if($donation->expiry_time < now())

                                        {{-- EXPIRED --}}

                                        <span class="inline-flex
                                                     items-center
                                                     gap-2
                                                     px-3
                                                     py-1.5
                                                     rounded-full
                                                     bg-red-500
                                                     text-white
                                                     text-xs
                                                     font-bold
                                                     shadow-lg">

                                            <span class="w-2
                                                         h-2
                                                         rounded-full
                                                         bg-white">
                                            </span>

                                            Expired

                                        </span>


                                    @elseif($donation->status === 'available')

                                        {{-- AVAILABLE --}}

                                        <span class="inline-flex
                                                     items-center
                                                     gap-2
                                                     px-3
                                                     py-1.5
                                                     rounded-full
                                                     bg-emerald-500
                                                     text-white
                                                     text-xs
                                                     font-bold
                                                     shadow-lg">

                                            <span class="w-2
                                                         h-2
                                                         rounded-full
                                                         bg-white">
                                            </span>

                                            Available

                                        </span>


                                    @elseif($donation->status === 'claimed')

                                        {{-- CLAIMED --}}

                                        <span class="inline-flex
                                                     items-center
                                                     gap-2
                                                     px-3
                                                     py-1.5
                                                     rounded-full
                                                     bg-blue-500
                                                     text-white
                                                     text-xs
                                                     font-bold
                                                     shadow-lg">

                                            <span class="w-2
                                                         h-2
                                                         rounded-full
                                                         bg-white">
                                            </span>

                                            Claimed

                                        </span>


                                    @elseif($donation->status === 'delivered')

                                        {{-- DELIVERED --}}

                                        <span class="inline-flex
                                                     items-center
                                                     gap-2
                                                     px-3
                                                     py-1.5
                                                     rounded-full
                                                     bg-purple-500
                                                     text-white
                                                     text-xs
                                                     font-bold
                                                     shadow-lg">

                                            <span class="w-2
                                                         h-2
                                                         rounded-full
                                                         bg-white">
                                            </span>

                                            Delivered

                                        </span>


                                    @else

                                        {{-- OTHER STATUS --}}

                                        <span class="inline-flex
                                                     items-center
                                                     gap-2
                                                     px-3
                                                     py-1.5
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



                            {{-- =================================================
                                 CARD CONTENT
                            ================================================== --}}

                            <div class="p-6">


                                {{-- =================================================
                                     TITLE
                                ================================================== --}}

                                <div class="mb-4">

                                    <h3 class="text-xl
                                               font-bold
                                               text-gray-800
                                               leading-tight">

                                        {{ $donation->title }}

                                    </h3>


                                    <div class="w-12
                                                h-1
                                                rounded-full
                                                bg-emerald-500
                                                mt-3">
                                    </div>

                                </div>



                                {{-- =================================================
                                     DESCRIPTION
                                ================================================== --}}

                                @if($donation->description)

                                    <p class="text-sm
                                              text-gray-500
                                              leading-relaxed
                                              mb-5">

                                        {{ Str::limit($donation->description, 100) }}

                                    </p>

                                @endif



                                {{-- =================================================
                                     FOOD ITEMS
                                ================================================== --}}

                                <div class="mb-5">


                                    {{-- Section heading --}}

                                    <div class="flex
                                                items-center
                                                gap-2
                                                mb-3">

                                        <div class="w-2
                                                    h-2
                                                    rounded-full
                                                    bg-emerald-500">
                                        </div>

                                        <h4 class="text-sm
                                                   font-bold
                                                   text-gray-700">

                                            Food Items

                                        </h4>

                                    </div>



                                    {{-- Items --}}

                                    <div class="space-y-2">


                                        @forelse($donation->items as $item)


                                            <div class="flex
                                                        items-center
                                                        justify-between
                                                        gap-3
                                                        bg-gray-50
                                                        rounded-xl
                                                        px-4
                                                        py-3
                                                        border
                                                        border-gray-100
                                                        hover:bg-emerald-50
                                                        transition">


                                                {{-- Item name --}}

                                                <div class="flex
                                                            items-center
                                                            gap-3
                                                            min-w-0">


                                                    <div class="w-9
                                                                h-9
                                                                flex-shrink-0
                                                                flex
                                                                items-center
                                                                justify-center
                                                                rounded-lg
                                                                bg-emerald-100
                                                                text-emerald-600">

                                                        🍽️

                                                    </div>


                                                    <p class="text-sm
                                                              font-semibold
                                                              text-gray-800
                                                              truncate">

                                                        {{ $item->item_name }}

                                                    </p>

                                                </div>



                                                {{-- Quantity --}}

                                                <span class="flex-shrink-0
                                                             text-sm
                                                             font-bold
                                                             text-emerald-600">

                                                    {{ $item->quantity }}
                                                    {{ $item->unit }}

                                                </span>


                                            </div>


                                        @empty


                                            <div class="text-sm
                                                        text-gray-400
                                                        bg-gray-50
                                                        rounded-xl
                                                        px-4
                                                        py-3">

                                                No food items available.

                                            </div>


                                        @endforelse


                                    </div>

                                </div>



                                {{-- =================================================
                                     DETAILS
                                ================================================== --}}

                                <div class="space-y-4
                                            border-t
                                            border-gray-100
                                            pt-5">


                                    {{-- =================================================
                                         EXPIRY
                                    ================================================== --}}

                                    <div class="flex
                                                items-start
                                                gap-3">


                                        <div class="w-10
                                                    h-10
                                                    flex-shrink-0
                                                    flex
                                                    items-center
                                                    justify-center
                                                    rounded-xl
                                                    bg-orange-100
                                                    text-orange-600">

                                            ⏰

                                        </div>


                                        <div class="min-w-0">

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



                                    {{-- =================================================
                                         PICKUP LOCATION
                                    ================================================== --}}

                                    <div class="flex
                                                items-start
                                                gap-3">


                                        <div class="w-10
                                                    h-10
                                                    flex-shrink-0
                                                    flex
                                                    items-center
                                                    justify-center
                                                    rounded-xl
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



                                {{-- =================================================
                                     EDIT BUTTON
                                ================================================== --}}

                                <div class="border-t
                                            border-gray-100
                                            mt-5
                                            pt-5">


                                    @if($donation->status === 'available')

                                        {{-- AVAILABLE → EDIT --}}

                                        <a
                                            href="{{ route('donations.edit', $donation->id) }}"
                                            class="w-full
                                                   inline-flex
                                                   items-center
                                                   justify-center
                                                   gap-2
                                                   px-5
                                                   py-3
                                                   rounded-xl
                                                   bg-gradient-to-r
                                                   from-emerald-500
                                                   to-teal-500
                                                   text-white
                                                   font-bold
                                                   shadow-md
                                                   hover:from-emerald-600
                                                   hover:to-teal-600
                                                   hover:shadow-lg
                                                   hover:-translate-y-0.5
                                                   transition-all
                                                   duration-200">

                                            <span class="text-lg">
                                                ✏️
                                            </span>

                                            Edit Donation

                                        </a>


                                    @else

                                        {{-- NOT AVAILABLE → CANNOT EDIT --}}

                                        <div
                                            class="w-full
                                                   inline-flex
                                                   items-center
                                                   justify-center
                                                   gap-2
                                                   px-5
                                                   py-3
                                                   rounded-xl
                                                   bg-gray-100
                                                   border
                                                   border-gray-200
                                                   text-gray-400
                                                   font-semibold
                                                   cursor-not-allowed">

                                            <span class="text-lg">
                                                🔒
                                            </span>

                                            Cannot Edit

                                        </div>

                                    @endif


                                </div>


                            </div>


                        </div>


                    @endforeach


                </div>


            @else


                {{-- =================================================
                     EMPTY STATE
                ================================================== --}}

                <div class="bg-white
                            rounded-3xl
                            shadow-xl
                            border
                            border-gray-100
                            p-10
                            md:p-16
                            text-center">


                    <div class="w-24
                                h-24
                                mx-auto
                                flex
                                items-center
                                justify-center
                                rounded-3xl
                                bg-emerald-100
                                text-emerald-600
                                text-5xl">

                        ✏️

                    </div>


                    <h3 class="text-2xl
                               font-bold
                               text-gray-800
                               mt-6">

                        No Donations to Edit

                    </h3>


                    <p class="text-gray-500
                              mt-2
                              max-w-md
                              mx-auto">

                        You haven't created any food donations yet.
                        Create a donation first to manage its details.

                    </p>


                    <a
                        href="{{ route('donations.create') }}"
                        class="inline-flex
                               items-center
                               gap-2
                               mt-6
                               px-6
                               py-3
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

                        Create Donation

                    </a>


                </div>


            @endif



            {{-- =================================================
                 FOOTER MESSAGE
            ================================================== --}}

            <div class="text-center mt-8">

                <p class="text-sm text-gray-500">

                    🌱 Keep your donation information up to date.

                </p>

            </div>


        </div>

    </div>

</x-app-layout>