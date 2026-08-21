<x-app-layout>

    {{-- =========================================================
         HEADER
    ========================================================== --}}

    <x-slot name="header">

        <div class="flex items-center gap-3">

            <div class="w-1.5 h-10 rounded-full bg-red-500"></div>

            <div>

                <h2 class="font-bold text-2xl text-gray-800">
                    Delete Donations
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Manage and remove your food donations.
                </p>

            </div>

        </div>

    </x-slot>


    {{-- =========================================================
         PAGE BACKGROUND
    ========================================================== --}}

    <div class="min-h-screen
                bg-gradient-to-br
                from-red-50
                via-orange-50
                to-rose-50
                py-10">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- =================================================
                 HERO SECTION
            ================================================== --}}

            <div class="relative overflow-hidden
                        bg-gradient-to-r
                        from-red-600
                        via-rose-600
                        to-orange-500
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

                        {{-- Badge --}}

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
                                🗑️
                            </span>

                            Donation Management

                        </div>


                        {{-- Heading --}}

                        <h1 class="text-3xl
                                   md:text-4xl
                                   font-bold
                                   text-white">

                            Delete Your Donations

                        </h1>


                        {{-- Description --}}

                        <p class="mt-3
                                  text-red-50
                                  text-base
                                  md:text-lg
                                  leading-relaxed">

                            Review your donations and remove available
                            food donations that are no longer needed.

                        </p>

                    </div>

                </div>

            </div>



            {{-- =================================================
                 WARNING MESSAGE
            ================================================== --}}

            <div class="mb-8
                        flex
                        items-start
                        gap-4
                        bg-white
                        border
                        border-red-100
                        rounded-2xl
                        p-5
                        shadow-sm">

                <div class="w-11
                            h-11
                            flex-shrink-0
                            flex
                            items-center
                            justify-center
                            rounded-xl
                            bg-red-100
                            text-red-600
                            text-xl">

                    ⚠️

                </div>


                <div>

                    <h3 class="font-bold text-gray-800">
                        Important
                    </h3>

                    <p class="text-sm
                              text-gray-500
                              mt-1
                              leading-relaxed">

                        Only available donations can be deleted.
                        Donations that are expired, claimed, or delivered
                        cannot be removed.

                    </p>

                </div>

            </div>



            {{-- =================================================
                 DONATIONS
            ================================================== --}}

            @if($donations->count() > 0)


                {{-- =================================================
                     DONATION GRID
                ================================================== --}}

                <div class="grid
                            grid-cols-1
                            md:grid-cols-2
                            xl:grid-cols-3
                            gap-6">


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
                                 IMAGE
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
                                                from-red-50
                                                to-orange-100">

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

                                <div class="absolute
                                            top-4
                                            right-4">

                                    @if($donation->status === 'available')

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

                                    @elseif($donation->status === 'expired')

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

                                    @elseif($donation->status === 'claimed')

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


                                {{-- TITLE --}}

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
                                                bg-red-500
                                                mt-3">
                                    </div>

                                </div>



                                {{-- DESCRIPTION --}}

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

                                    <div class="flex
                                                items-center
                                                gap-2
                                                mb-3">

                                        <div class="w-2
                                                    h-2
                                                    rounded-full
                                                    bg-red-500">
                                        </div>

                                        <h4 class="text-sm
                                                   font-bold
                                                   text-gray-700">

                                            Food Items

                                        </h4>

                                    </div>


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
                                                        border-gray-100">

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
                                                                bg-red-100
                                                                text-red-600">

                                                        🍽️

                                                    </div>

                                                    <p class="text-sm
                                                              font-semibold
                                                              text-gray-800
                                                              truncate">

                                                        {{ $item->item_name }}

                                                    </p>

                                                </div>


                                                <span class="flex-shrink-0
                                                             text-sm
                                                             font-bold
                                                             text-red-600">

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


                                    {{-- EXPIRY --}}

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



                                    {{-- PICKUP LOCATION --}}

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
                                     DELETE BUTTON
                                ================================================== --}}

                                <div class="border-t
                                            border-gray-100
                                            mt-5
                                            pt-5">

                                    @if($donation->status === 'available')

                                        <form
                                            action="{{ route('donations.destroy', $donation->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to permanently delete this donation?');">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="w-full
                                                       inline-flex
                                                       items-center
                                                       justify-center
                                                       gap-2
                                                       px-5
                                                       py-3
                                                       rounded-xl
                                                       bg-gradient-to-r
                                                       from-red-500
                                                       to-rose-500
                                                       text-white
                                                       font-bold
                                                       shadow-md
                                                       hover:from-red-600
                                                       hover:to-rose-600
                                                       hover:shadow-lg
                                                       hover:-translate-y-0.5
                                                       transition-all
                                                       duration-200">

                                                <span class="text-lg">
                                                    🗑️
                                                </span>

                                                Delete Donation

                                            </button>

                                        </form>

                                    @else

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

                                            Cannot Delete

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
                                bg-red-100
                                text-red-600
                                text-5xl">

                        🗑️

                    </div>


                    <h3 class="text-2xl
                               font-bold
                               text-gray-800
                               mt-6">

                        No Donations Found

                    </h3>


                    <p class="text-gray-500
                              mt-2
                              max-w-md
                              mx-auto">

                        You haven't created any food donations yet.
                        Create a donation first to manage your donations.

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
                               from-red-600
                               to-rose-600
                               text-white
                               font-bold
                               shadow-lg
                               hover:from-red-700
                               hover:to-rose-700
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

                    🌱 Manage your donations responsibly.

                </p>

            </div>


        </div>

    </div>

</x-app-layout>