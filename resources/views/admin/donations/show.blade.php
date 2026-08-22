@php
    use Carbon\Carbon;
@endphp

<x-app-layout>

    <x-slot name="header">

        <div>

            <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                Donation Details
            </h2>

            <p class="mt-1 text-sm text-emerald-800">
                View complete information about this donation.
            </p>

        </div>

    </x-slot>


    {{-- ================================================= --}}
    {{-- MAIN PAGE --}}
    {{-- Darker emerald theme --}}
    {{-- ================================================= --}}

    <div class="min-h-screen bg-gradient-to-br from-emerald-100 via-white to-green-100">

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


            {{-- ================================================= --}}
            {{-- DETAILS CARD --}}
            {{-- ================================================= --}}

            <div
                class="bg-white
                       rounded-2xl
                       border border-emerald-200
                       shadow-sm
                       overflow-hidden"
            >


                {{-- ================================================= --}}
                {{-- CARD HEADER --}}
                {{-- ================================================= --}}

                <div
                    class="px-6 py-5
                           border-b border-emerald-200
                           bg-gradient-to-r
                           from-emerald-100
                           via-white
                           to-green-100"
                >

                    <div class="flex items-center gap-4">

                        <div
                            class="w-12 h-12 rounded-xl
                                   bg-emerald-200
                                   text-emerald-900
                                   border border-emerald-300
                                   flex items-center justify-center"
                        >

                            <svg
                                class="w-6 h-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                                />

                            </svg>

                        </div>


                        <div>

                            <h3 class="text-xl font-bold text-gray-900">
                                Donation Details
                            </h3>

                            <p class="text-sm text-gray-600">
                                Donation #{{ $donation->id }}
                            </p>

                        </div>

                    </div>

                </div>



                {{-- ================================================= --}}
                {{-- DONATION INFORMATION --}}
                {{-- ================================================= --}}

                <div class="p-6">

                    <div class="overflow-hidden rounded-xl border border-emerald-100">

                        <table class="min-w-full">

                            <tbody class="divide-y divide-emerald-100">


                                {{-- ================================================= --}}
                                {{-- TITLE --}}
                                {{-- ================================================= --}}

                                <tr>

                                    <td
                                        class="font-semibold
                                               text-emerald-900
                                               py-4 px-4
                                               w-48
                                               bg-emerald-50"
                                    >
                                        Title
                                    </td>

                                    <td class="py-4 px-4 text-gray-800">
                                        {{ $donation->title }}
                                    </td>

                                </tr>



                                {{-- ================================================= --}}
                                {{-- DONOR --}}
                                {{-- ================================================= --}}

                                <tr>

                                    <td
                                        class="font-semibold
                                               text-emerald-900
                                               py-4 px-4
                                               bg-emerald-50"
                                    >
                                        Donor
                                    </td>

                                    <td class="py-4 px-4">

                                        @if ($donation->donor)

                                            <div class="flex items-center gap-3">

                                                <div
                                                    class="w-9 h-9 rounded-lg
                                                           bg-emerald-100
                                                           text-emerald-800
                                                           border border-emerald-200
                                                           flex items-center justify-center
                                                           text-sm font-bold"
                                                >

                                                    {{ strtoupper(substr($donation->donor->name, 0, 1)) }}

                                                </div>

                                                <span class="text-gray-800">
                                                    {{ $donation->donor->name }}
                                                </span>

                                            </div>

                                        @else

                                            <span class="text-sm text-gray-400 italic">
                                                No donor assigned
                                            </span>

                                        @endif

                                    </td>

                                </tr>



                                {{-- ================================================= --}}
                                {{-- CATEGORY --}}
                                {{-- ================================================= --}}

                                <tr>

                                    <td
                                        class="font-semibold
                                               text-emerald-900
                                               py-4 px-4
                                               w-48
                                               bg-emerald-50"
                                    >
                                        Category
                                    </td>

                                    <td class="py-4 px-4">

                                        {{-- 
                                            A donation may not have a category.
                                            We check the relationship before accessing
                                            $donation->category->name to prevent:
                                            "Attempt to read property name on null"
                                        --}}

                                        @if ($donation->category)

                                            <span
                                                class="inline-flex items-center
                                                       px-2.5 py-1
                                                       rounded-lg
                                                       bg-purple-100
                                                       text-purple-800
                                                       border border-purple-200
                                                       text-xs font-semibold"
                                            >

                                                {{ $donation->category->name }}

                                            </span>

                                        @else

                                            <span class="text-sm text-gray-400 italic">
                                                No category assigned
                                            </span>

                                        @endif

                                    </td>

                                </tr>



                                {{-- ================================================= --}}
                                {{-- QUANTITY --}}
                                {{-- ================================================= --}}

                                <tr>

                                    <td
                                        class="font-semibold
                                               text-emerald-900
                                               py-4 px-4
                                               bg-emerald-50"
                                    >
                                        Quantity
                                    </td>

                                    <td class="py-4 px-4 text-gray-800">

                                        @if ($donation->quantity !== null)

                                            <span class="font-bold">
                                                {{ $donation->quantity }}
                                            </span>

                                            <span class="text-sm text-gray-400">
                                                units
                                            </span>

                                        @else

                                            <span class="text-sm text-gray-400 italic">
                                                Not specified
                                            </span>

                                        @endif

                                    </td>

                                </tr>



                                {{-- ================================================= --}}
                                {{-- STATUS --}}
                                {{-- ================================================= --}}

                                <tr>

                                    <td
                                        class="font-semibold
                                               text-emerald-900
                                               py-4 px-4
                                               bg-emerald-50"
                                    >
                                        Status
                                    </td>

                                    <td class="py-4 px-4">

                                        @if ($donation->status === 'available')

                                            <span
                                                class="inline-flex items-center gap-1.5
                                                       px-3 py-1
                                                       rounded-full
                                                       bg-emerald-100
                                                       text-emerald-800
                                                       border border-emerald-200
                                                       text-xs font-semibold"
                                            >

                                                <span
                                                    class="w-1.5 h-1.5
                                                           rounded-full
                                                           bg-emerald-600"
                                                ></span>

                                                Available

                                            </span>

                                        @elseif ($donation->status === 'claimed')

                                            <span
                                                class="inline-flex items-center gap-1.5
                                                       px-3 py-1
                                                       rounded-full
                                                       bg-amber-100
                                                       text-amber-800
                                                       border border-amber-200
                                                       text-xs font-semibold"
                                            >

                                                <span
                                                    class="w-1.5 h-1.5
                                                           rounded-full
                                                           bg-amber-600"
                                                ></span>

                                                Claimed

                                            </span>

                                        @elseif ($donation->status === 'completed')

                                            <span
                                                class="inline-flex items-center gap-1.5
                                                       px-3 py-1
                                                       rounded-full
                                                       bg-blue-100
                                                       text-blue-800
                                                       border border-blue-200
                                                       text-xs font-semibold"
                                            >

                                                <span
                                                    class="w-1.5 h-1.5
                                                           rounded-full
                                                           bg-blue-600"
                                                ></span>

                                                Completed

                                            </span>

                                        @elseif ($donation->status === 'expired')

                                            <span
                                                class="inline-flex items-center gap-1.5
                                                       px-3 py-1
                                                       rounded-full
                                                       bg-red-100
                                                       text-red-800
                                                       border border-red-200
                                                       text-xs font-semibold"
                                            >

                                                <span
                                                    class="w-1.5 h-1.5
                                                           rounded-full
                                                           bg-red-600"
                                                ></span>

                                                Expired

                                            </span>

                                        @else

                                            <span
                                                class="inline-flex items-center gap-1.5
                                                       px-3 py-1
                                                       rounded-full
                                                       bg-gray-100
                                                       text-gray-700
                                                       border border-gray-200
                                                       text-xs font-semibold"
                                            >

                                                <span
                                                    class="w-1.5 h-1.5
                                                           rounded-full
                                                           bg-gray-500"
                                                ></span>

                                                {{ ucfirst(str_replace('_', ' ', $donation->status)) }}

                                            </span>

                                        @endif

                                    </td>

                                </tr>



                                {{-- ================================================= --}}
                                {{-- PICKUP ADDRESS --}}
                                {{-- ================================================= --}}

                                <tr>

                                    <td
                                        class="font-semibold
                                               text-emerald-900
                                               py-4 px-4
                                               bg-emerald-50"
                                    >
                                        Pickup Address
                                    </td>

                                    <td class="py-4 px-4 text-gray-800">

                                        @if ($donation->pickup_address)

                                            {{ $donation->pickup_address }}

                                        @else

                                            <span class="text-sm text-gray-400 italic">
                                                Not specified
                                            </span>

                                        @endif

                                    </td>

                                </tr>



                                {{-- ================================================= --}}
                                {{-- PICKUP DATE --}}
                                {{-- ================================================= --}}

                                <tr>

                                    <td
                                        class="font-semibold
                                               text-emerald-900
                                               py-4 px-4
                                               bg-emerald-50"
                                    >
                                        Pickup Date
                                    </td>

                                    <td class="py-4 px-4 text-gray-800">

                                        {{
                                            $donation->pickup_date
                                                ? Carbon::parse($donation->pickup_date)->format('d M Y')
                                                : '-'
                                        }}

                                    </td>

                                </tr>



                                {{-- ================================================= --}}
                                {{-- PICKUP TIME --}}
                                {{-- ================================================= --}}

                                <tr>

                                    <td
                                        class="font-semibold
                                               text-emerald-900
                                               py-4 px-4
                                               bg-emerald-50"
                                    >
                                        Pickup Time
                                    </td>

                                    <td class="py-4 px-4 text-gray-800">

                                        {{
                                            $donation->pickup_time
                                                ? Carbon::parse($donation->pickup_time)->format('g:i A')
                                                : '-'
                                        }}

                                    </td>

                                </tr>



                                {{-- ================================================= --}}
                                {{-- EXPIRY TIME --}}
                                {{-- ================================================= --}}

                                <tr>

                                    <td
                                        class="font-semibold
                                               text-emerald-900
                                               py-4 px-4
                                               bg-emerald-50"
                                    >
                                        Expiry Time
                                    </td>

                                    <td class="py-4 px-4">

                                        @if ($donation->expiry_time)

                                            @php
                                                $expiry = Carbon::parse($donation->expiry_time);
                                            @endphp

                                            <span
                                                class="{{
                                                    $expiry->isPast()
                                                        ? 'text-red-700'
                                                        : 'text-gray-800'
                                                }} font-medium"
                                            >

                                                {{ $expiry->format('d M Y, g:i A') }}

                                            </span>


                                            @if ($expiry->isPast())

                                                <span
                                                    class="ml-2
                                                           inline-flex
                                                           px-2 py-0.5
                                                           rounded-full
                                                           bg-red-100
                                                           text-red-700
                                                           text-xs
                                                           font-semibold"
                                                >

                                                    Expired

                                                </span>

                                            @endif

                                        @else

                                            <span class="text-sm text-gray-400 italic">
                                                Not specified
                                            </span>

                                        @endif

                                    </td>

                                </tr>



                                {{-- ================================================= --}}
                                {{-- DESCRIPTION --}}
                                {{-- ================================================= --}}

                                <tr class="align-top">

                                    <td
                                        class="font-semibold
                                               text-emerald-900
                                               py-4 px-4
                                               bg-emerald-50"
                                    >
                                        Description
                                    </td>

                                    <td
                                        class="py-4 px-4
                                               text-gray-800
                                               whitespace-pre-line"
                                    >

                                        @if ($donation->description)

                                            {{ $donation->description }}

                                        @else

                                            <span class="text-sm text-gray-400 italic">
                                                No description provided
                                            </span>

                                        @endif

                                    </td>

                                </tr>


                            </tbody>

                        </table>

                    </div>



                    {{-- ================================================= --}}
                    {{-- ACTION BUTTONS --}}
                    {{-- ================================================= --}}

                    <div class="mt-8 flex flex-wrap items-center gap-3">


                        {{-- Back --}}

                        <a
                            href="{{ route('admin.donations') }}"
                            class="inline-flex items-center
                                   px-5 py-2.5
                                   rounded-xl
                                   bg-emerald-700
                                   text-white
                                   font-semibold
                                   hover:bg-emerald-800
                                   shadow-sm
                                   transition"
                        >

                            ← Back to Donations

                        </a>



                        {{-- Edit --}}

                        @if ($donation->status === 'available')

                            <a
                                href="{{ route('admin.donations.edit', $donation) }}"
                                class="inline-flex items-center
                                       px-5 py-2.5
                                       rounded-xl
                                       bg-emerald-100
                                       text-emerald-800
                                       border border-emerald-200
                                       font-semibold
                                       hover:bg-emerald-200
                                       transition"
                            >

                                Edit Donation

                            </a>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>