<x-app-layout>

    {{-- =========================================================
         HEADER
    ========================================================== --}}

    <x-slot name="header">

        <div class="flex items-center gap-3">

            <div class="w-1.5 h-8 rounded-full bg-red-500"></div>

            <div>
                <h2 class="font-bold text-2xl text-gray-800">
                    Report Donation
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Help us keep the donation platform safe and reliable.
                </p>
            </div>

        </div>

    </x-slot>


    {{-- =========================================================
         MAIN BACKGROUND
    ========================================================== --}}

    <div class="min-h-screen
                bg-gradient-to-br
                from-rose-50
                via-red-50
                to-orange-50
                py-10">

        <div class="max-w-6xl mx-auto px-6">


            {{-- =================================================
                 PREMIUM REPORT HEADER
            ================================================== --}}

            <div class="relative overflow-hidden
                        rounded-3xl
                        mb-8
                        bg-gradient-to-r
                        from-red-500
                        via-rose-500
                        to-orange-400
                        shadow-xl
                        shadow-red-200/60">

                {{-- Decorative Circle --}}

                <div class="absolute
                            -right-20
                            -top-24
                            w-80 h-80
                            rounded-full
                            bg-white/10">
                </div>

                <div class="absolute
                            -left-16
                            -bottom-28
                            w-64 h-64
                            rounded-full
                            bg-white/10">
                </div>


                <div class="relative
                            px-8
                            py-9">

                    <div class="flex items-center gap-5">


                        {{-- ICON --}}

                        <div class="flex-shrink-0
                                    w-16 h-16
                                    rounded-2xl
                                    bg-white/15
                                    border border-white/25
                                    backdrop-blur-sm
                                    flex items-center
                                    justify-center
                                    shadow-lg">

                            <svg class="w-8 h-8 text-white"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M12 9v2m0 4h.01
                                         M10.29 3.86l-8.18 14
                                         a2 2 0 001.71 3h16.36
                                         a2 2 0 001.71-3l-8.18-14
                                         a2 2 0 00-3.42 0z"/>

                            </svg>

                        </div>


                        {{-- TEXT --}}

                        <div>

                            {{-- BADGE --}}

                            <span class="inline-flex
                                         items-center
                                         px-3 py-1
                                         rounded-full
                                         bg-white/15
                                         border border-white/20
                                         text-white
                                         text-[11px]
                                         font-bold
                                         uppercase
                                         tracking-[0.18em]">

                                DONATION REPORT

                            </span>


                            {{-- TITLE --}}

                            <h1 class="text-3xl
                                       font-extrabold
                                       text-white
                                       tracking-tight
                                       mt-2">

                                Report Donation

                            </h1>


                            {{-- DESCRIPTION --}}

                            <p class="text-white/85
                                      text-sm
                                      mt-1">

                                Report an issue with one of your expired donations.

                            </p>

                        </div>

                    </div>

                </div>

            </div>



            {{-- =================================================
                 INFO MESSAGE
            ================================================== --}}

            <div class="mb-6
                        rounded-2xl
                        border border-red-100
                        bg-white
                        shadow-sm
                        px-6
                        py-5">

                <div class="flex items-start gap-4">

                    <div class="w-10 h-10
                                flex-shrink-0
                                rounded-xl
                                bg-red-50
                                text-red-500
                                flex items-center
                                justify-center">

                        <svg class="w-5 h-5"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M13 16h-1v-4h-1m1-8h.01
                                     M12 18a6 6 0 100-12
                                     6 6 0 000 12z"/>

                        </svg>

                    </div>


                    <div>

                        <h3 class="font-semibold text-gray-800">
                            Why report a donation?
                        </h3>

                        <p class="text-sm
                                  text-gray-500
                                  mt-1
                                  leading-relaxed">

                            If you notice an issue with an expired donation,
                            please let us know. Your report helps administrators
                            review and maintain the quality of the platform.

                        </p>

                    </div>

                </div>

            </div>



            {{-- =================================================
                 DONATIONS
            ================================================== --}}

            @forelse($donations as $donation)


                {{-- =================================================
                     DONATION CARD
                ================================================== --}}

                <div class="bg-white
                            rounded-2xl
                            border border-gray-100
                            shadow-sm
                            hover:shadow-lg
                            transition
                            duration-300
                            mb-5
                            overflow-hidden">


                    <div class="p-6">


                        {{-- TOP SECTION --}}

                        <div class="flex items-start
                                    justify-between
                                    gap-5">


                            <div class="flex items-start gap-4">


                                {{-- FOOD ICON --}}

                                <div class="w-14 h-14
                                            flex-shrink-0
                                            rounded-2xl
                                            bg-red-50
                                            text-red-500
                                            flex items-center
                                            justify-center">

                                    <svg class="w-7 h-7"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M12 6.253v13m0-13
                                                 C10.832 5.477 9.246 5 7.5 5
                                                 S4.168 5.477 3 6.253v13
                                                 C4.168 18.477 5.754 18
                                                 7.5 18s3.332.477 4.5 1.253
                                                 M12 6.253
                                                 C13.168 5.477 14.754 5
                                                 16.5 5S19.832 5.477 21 6.253v13
                                                 C19.832 18.477 18.246 18
                                                 16.5 18s-3.332.477-4.5 1.253"/>

                                    </svg>

                                </div>


                                {{-- DONATION INFO --}}

                                <div>

                                    <h3 class="text-xl
                                               font-bold
                                               text-gray-800">

                                        {{ $donation->title }}

                                    </h3>


                                    <div class="flex flex-wrap
                                                items-center
                                                gap-3
                                                mt-2">

                                        <span class="text-sm
                                                     text-gray-500">

                                            Quantity:
                                            <span class="font-semibold text-gray-700">
                                                {{ $donation->quantity }}
                                            </span>

                                        </span>


                                        <span class="text-gray-300">
                                            •
                                        </span>


                                        <span class="text-sm
                                                     text-gray-500">

                                            Expired:
                                            <span class="font-semibold text-red-500">

                                                {{ $donation->expiry_time
                                                    ? \Carbon\Carbon::parse($donation->expiry_time)->format('d M Y, h:i A')
                                                    : 'N/A'
                                                }}

                                            </span>

                                        </span>

                                    </div>

                                </div>

                            </div>


                            {{-- STATUS --}}

                            <span class="inline-flex
                                         items-center
                                         px-3 py-1.5
                                         rounded-full
                                         bg-red-50
                                         text-red-600
                                         border border-red-100
                                         text-xs
                                         font-bold
                                         uppercase">

                                Expired

                            </span>

                        </div>



                        {{-- DIVIDER --}}

                        <div class="border-t
                                    border-gray-100
                                    my-6">
                        </div>



                        {{-- REPORT ACTION --}}

                        <div class="flex items-center
                                    justify-between
                                    gap-5">


                            <div>

                                <p class="font-semibold
                                          text-gray-800">

                                    Found an issue?

                                </p>

                                <p class="text-sm
                                          text-gray-500
                                          mt-1">

                                    Tell us what went wrong with this donation.

                                </p>

                            </div>


                            {{-- REPORT FORM --}}

                            <form action="{{ route('donations.report', $donation->id) }}"
                                  method="POST">

                                @csrf


                                <div class="flex items-center gap-3">


                                    {{-- DESCRIPTION --}}

                                    <textarea
                                        name="reason"
                                        required
                                        maxlength="1000"
                                        rows="2"
                                        placeholder="Describe the issue..."
                                        class="hidden
                                               report-description
                                               w-72
                                               rounded-xl
                                               border-gray-200
                                               focus:border-red-400
                                               focus:ring-red-400
                                               text-sm
                                               resize-none"></textarea>


                                    {{-- REPORT BUTTON --}}

                                    <button type="button"
                                            onclick="showReportBox(this)"
                                            class="report-button
                                                   inline-flex
                                                   items-center
                                                   gap-2
                                                   px-5 py-3
                                                   rounded-xl
                                                   bg-gradient-to-r
                                                   from-red-500
                                                   to-rose-500
                                                   text-white
                                                   text-sm
                                                   font-semibold
                                                   shadow-md
                                                   shadow-red-200
                                                   hover:from-red-600
                                                   hover:to-rose-600
                                                   hover:-translate-y-0.5
                                                   transition">

                                        <svg class="w-4 h-4"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M12 9v2m0 4h.01
                                                     M10.29 3.86l-8.18 14
                                                     a2 2 0 001.71 3h16.36
                                                     a2 2 0 001.71-3l-8.18-14
                                                     a2 2 0 00-3.42 0z"/>

                                        </svg>

                                        Report This Donation

                                    </button>


                                    {{-- SUBMIT BUTTON --}}

                                    <button type="submit"
                                            class="submit-report hidden
                                                   inline-flex
                                                   items-center
                                                   gap-2
                                                   px-5 py-3
                                                   rounded-xl
                                                   bg-red-500
                                                   text-white
                                                   text-sm
                                                   font-semibold
                                                   shadow-md
                                                   hover:bg-red-600
                                                   transition">

                                        Submit Report

                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>


            @empty


                {{-- =================================================
                     NO DONATIONS
                ================================================== --}}

                <div class="bg-white
                            rounded-3xl
                            border border-gray-100
                            shadow-sm
                            p-12
                            text-center">


                    <div class="w-20 h-20
                                mx-auto
                                rounded-3xl
                                bg-emerald-50
                                flex items-center
                                justify-center
                                text-4xl">

                        ✓

                    </div>


                    <h3 class="text-xl
                               font-bold
                               text-gray-800
                               mt-5">

                        No Donations to Report

                    </h3>


                    <p class="text-sm
                              text-gray-500
                              mt-2
                              max-w-md
                              mx-auto">

                        You have no unreported expired donations at the moment.

                    </p>


                    <a href="{{ route('donor.dashboard') }}"
                       class="inline-flex
                              items-center
                              gap-2
                              mt-6
                              px-5 py-3
                              rounded-xl
                              bg-emerald-600
                              text-white
                              text-sm
                              font-semibold
                              hover:bg-emerald-700
                              transition">

                        ← Back to Dashboard

                    </a>

                </div>


            @endforelse


        </div>

    </div>



    {{-- =========================================================
         REPORT BOX SCRIPT
    ========================================================== --}}

    <script>

        function showReportBox(button) {

            const form = button.closest('form');

            const textarea =
                form.querySelector('.report-description');

            const submitButton =
                form.querySelector('.submit-report');


            textarea.classList.remove('hidden');

            submitButton.classList.remove('hidden');

            button.classList.add('hidden');

            textarea.focus();

        }

    </script>


</x-app-layout>