<x-app-layout>

    {{-- =========================================================
         HEADER
    ========================================================== --}}

    <x-slot name="header">

        <div class="flex items-center gap-3">

            <div class="w-1.5 h-10 rounded-full bg-emerald-600"></div>

            <div>

                <h2 class="font-bold text-2xl text-gray-800 tracking-tight">
                    {{ __('Profile') }}
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Manage your account information and security settings.
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
                via-white
                to-teal-50
                py-10">


        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- =================================================
                 PREMIUM PROFILE HERO
            ================================================== --}}

            <div class="relative
                        overflow-hidden
                        rounded-[2rem]
                        bg-gradient-to-r
                        from-emerald-800
                        via-teal-700
                        to-cyan-700
                        shadow-2xl
                        mb-8">


                {{-- Decorative circles --}}

                <div class="absolute
                            -right-20
                            -top-24
                            w-72
                            h-72
                            rounded-full
                            bg-white/10
                            blur-2xl">
                </div>

                <div class="absolute
                            right-20
                            -bottom-32
                            w-80
                            h-80
                            rounded-full
                            bg-emerald-300/10
                            blur-3xl">
                </div>

                <div class="absolute
                            left-1/2
                            -top-20
                            w-52
                            h-52
                            rounded-full
                            bg-cyan-300/10
                            blur-3xl">
                </div>


                {{-- Hero Content --}}

                <div class="relative
                            px-8
                            py-9
                            md:px-10
                            md:py-11">

                    <div class="flex
                                flex-col
                                md:flex-row
                                md:items-center
                                md:justify-between
                                gap-6">


                        {{-- Profile Identity --}}

                        <div class="flex
                                    items-center
                                    gap-5">


                            {{-- Avatar --}}

                            <div class="w-20
                                        h-20
                                        flex-shrink-0
                                        rounded-2xl
                                        bg-white/15
                                        border
                                        border-white/20
                                        backdrop-blur-md
                                        flex
                                        items-center
                                        justify-center
                                        shadow-xl">

                                <span class="text-4xl">
                                    👤
                                </span>

                            </div>


                            {{-- Text --}}

                            <div>

                                <div class="inline-flex
                                            items-center
                                            gap-2
                                            px-3
                                            py-1
                                            rounded-full
                                            bg-white/10
                                            border
                                            border-white/20
                                            text-emerald-50
                                            text-xs
                                            font-semibold
                                            mb-2">

                                    <span class="w-1.5
                                                 h-1.5
                                                 rounded-full
                                                 bg-emerald-300">
                                    </span>

                                    Account Settings

                                </div>


                                <h1 class="text-3xl
                                           md:text-4xl
                                           font-extrabold
                                           text-white
                                           tracking-tight">

                                    Your Profile

                                </h1>


                                <p class="text-emerald-100
                                          mt-2
                                          text-sm
                                          md:text-base">

                                    Keep your account information secure and up to date.

                                </p>

                            </div>

                        </div>


                        {{-- Security Badge --}}

                        <div class="hidden
                                    md:flex
                                    items-center
                                    gap-3
                                    px-5
                                    py-3
                                    rounded-2xl
                                    bg-white/10
                                    border
                                    border-white/20
                                    backdrop-blur-md">

                            <span class="text-xl">
                                🛡️
                            </span>

                            <div>

                                <p class="text-xs
                                          text-emerald-100">

                                    Account

                                </p>

                                <p class="text-sm
                                          font-bold
                                          text-white">

                                    Secure Settings

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            {{-- =================================================
                 PROFILE SECTIONS
            ================================================== --}}

            <div class="space-y-7">


                {{-- =================================================
                     UPDATE PROFILE INFORMATION
                ================================================== --}}

                <section class="bg-white
                                rounded-[1.75rem]
                                border
                                border-gray-100
                                shadow-md
                                hover:shadow-xl
                                transition-shadow
                                duration-300
                                overflow-hidden">


                    {{-- Section Header --}}

                    <div class="px-6
                                md:px-8
                                py-5
                                border-b
                                border-gray-100
                                bg-gradient-to-r
                                from-white
                                to-emerald-50/50">

                        <div class="flex
                                    items-center
                                    gap-4">

                            <div class="w-12
                                        h-12
                                        flex-shrink-0
                                        rounded-xl
                                        bg-emerald-50
                                        border
                                        border-emerald-100
                                        flex
                                        items-center
                                        justify-center
                                        text-emerald-700
                                        text-xl">

                                👤

                            </div>

                            <div>

                                <h3 class="font-bold
                                           text-lg
                                           text-gray-800">

                                    Profile Information

                                </h3>

                                <p class="text-sm
                                          text-gray-500
                                          mt-0.5">

                                    Update your name and email address.

                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Existing Breeze Form --}}

                    <div class="p-6 md:p-8">

                        <div class="max-w-2xl">

                            @include('profile.partials.update-profile-information-form')

                        </div>

                    </div>

                </section>



                {{-- =================================================
                     UPDATE PASSWORD
                ================================================== --}}

                <section class="bg-white
                                rounded-[1.75rem]
                                border
                                border-gray-100
                                shadow-md
                                hover:shadow-xl
                                transition-shadow
                                duration-300
                                overflow-hidden">


                    {{-- Section Header --}}

                    <div class="px-6
                                md:px-8
                                py-5
                                border-b
                                border-gray-100
                                bg-gradient-to-r
                                from-white
                                to-blue-50/50">

                        <div class="flex
                                    items-center
                                    gap-4">

                            <div class="w-12
                                        h-12
                                        flex-shrink-0
                                        rounded-xl
                                        bg-blue-50
                                        border
                                        border-blue-100
                                        flex
                                        items-center
                                        justify-center
                                        text-blue-700
                                        text-xl">

                                🔐

                            </div>

                            <div>

                                <h3 class="font-bold
                                           text-lg
                                           text-gray-800">

                                    Update Password

                                </h3>

                                <p class="text-sm
                                          text-gray-500
                                          mt-0.5">

                                    Use a strong password to keep your account protected.

                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Existing Breeze Form --}}

                    <div class="p-6 md:p-8">

                        <div class="max-w-2xl">

                            @include('profile.partials.update-password-form')

                        </div>

                    </div>

                </section>



                {{-- =================================================
                     DELETE ACCOUNT
                ================================================== --}}

                <section class="bg-white
                                rounded-[1.75rem]
                                border
                                border-red-100
                                shadow-md
                                hover:shadow-xl
                                transition-shadow
                                duration-300
                                overflow-hidden">


                    {{-- Section Header --}}

                    <div class="px-6
                                md:px-8
                                py-5
                                border-b
                                border-red-100
                                bg-gradient-to-r
                                from-white
                                to-red-50/60">

                        <div class="flex
                                    items-center
                                    gap-4">

                            <div class="w-12
                                        h-12
                                        flex-shrink-0
                                        rounded-xl
                                        bg-red-50
                                        border
                                        border-red-100
                                        flex
                                        items-center
                                        justify-center
                                        text-red-700
                                        text-xl">

                                ⚠️

                            </div>

                            <div>

                                <h3 class="font-bold
                                           text-lg
                                           text-gray-800">

                                    Delete Account

                                </h3>

                                <p class="text-sm
                                          text-gray-500
                                          mt-0.5">

                                    Permanently remove your account and associated data.

                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Existing Breeze Form --}}

                    <div class="p-6 md:p-8">

                        <div class="max-w-2xl">

                            @include('profile.partials.delete-user-form')

                        </div>

                    </div>

                </section>


            </div>



            {{-- =================================================
                 FOOTER
            ================================================== --}}

            <div class="text-center mt-8">

                <p class="text-sm text-gray-400">

                    🔒 Your account information is protected.

                </p>

            </div>


        </div>

    </div>

</x-app-layout>