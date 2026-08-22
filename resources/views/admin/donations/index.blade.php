@php
    use Carbon\Carbon;
@endphp

<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                    Donation Management
                </h2>

                <p class="mt-1 text-sm text-emerald-800">
                    Monitor and manage food donations across the platform.
                </p>

            </div>


            <div class="hidden sm:flex items-center gap-2 text-sm text-emerald-800">

                <span class="w-2 h-2 rounded-full bg-emerald-600"></span>

                Donation Operations

            </div>

        </div>

    </x-slot>


    {{-- ================================================= --}}
    {{-- MAIN PAGE --}}
    {{-- Darker emerald theme --}}
    {{-- ================================================= --}}

    <div class="min-h-screen bg-gradient-to-br from-emerald-100 via-white to-green-100">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


            {{-- ================================================= --}}
            {{-- PAGE HEADER --}}
            {{-- ================================================= --}}

            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6">

                <div>

                    <h1 class="text-2xl font-bold text-gray-900">
                        Donation Operations
                    </h1>

                    <p class="mt-1 text-sm text-emerald-800">
                        Review donated food, donors, quantities and availability.
                    </p>

                </div>


                {{-- Total Donations --}}

                <div
                    class="inline-flex items-center gap-3
                           bg-white
                           border border-emerald-200
                           rounded-2xl
                           px-5 py-3
                           shadow-sm"
                >

                    <div
                        class="w-10 h-10 rounded-xl
                               bg-emerald-100
                               text-emerald-800
                               border border-emerald-200
                               flex items-center justify-center"
                    >

                        <svg
                            class="w-5 h-5"
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

                        <p class="text-xs font-medium text-gray-500">
                            Total Donations
                        </p>

                        <p class="text-xl font-bold text-gray-900">
                            {{ $donations->total() }}
                        </p>

                    </div>

                </div>

            </div>



            {{-- ================================================= --}}
            {{-- FLASH MESSAGE --}}
            {{-- ================================================= --}}

            @if (session('success'))

                <div
                    class="mb-6 flex items-start gap-3
                           rounded-xl
                           bg-emerald-100
                           border border-emerald-200
                           text-emerald-900
                           px-4 py-3
                           shadow-sm"
                >

                    <svg
                        class="w-5 h-5 mt-0.5 flex-shrink-0 text-emerald-700"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M5 13l4 4L19 7"
                        />

                    </svg>

                    <span class="text-sm font-medium">
                        {{ session('success') }}
                    </span>

                </div>

            @endif



            {{-- ================================================= --}}
            {{-- DONATION CARD --}}
            {{-- ================================================= --}}

            <div
                class="bg-white
                       rounded-2xl
                       border border-emerald-200
                       shadow-sm
                       overflow-hidden"
            >


                {{-- Card Header --}}

                <div
                    class="px-6 py-5
                           border-b border-emerald-200
                           bg-gradient-to-r
                           from-emerald-100
                           via-white
                           to-green-100"
                >

                    <div>

                        <h3 class="text-lg font-bold text-gray-900">
                            Donation Records
                        </h3>

                        <p class="mt-1 text-sm text-gray-600">
                            Manage active, claimed and completed donations.
                        </p>

                    </div>

                </div>



                {{-- ================================================= --}}
                {{-- STATUS FILTERS --}}
                {{-- ================================================= --}}

                <div
                    class="px-6 py-4
                           border-b border-emerald-200
                           bg-emerald-100/50"
                >

                    <div class="flex flex-wrap items-center gap-2">


                        {{-- All --}}

                        <a
                            href="{{ route('admin.donations') }}"
                            class="inline-flex items-center gap-2
                                   px-4 py-2
                                   rounded-xl
                                   text-sm font-semibold
                                   transition
                                   {{
                                       !request('status')
                                           ? 'bg-emerald-800 text-white shadow-sm'
                                           : 'bg-white text-gray-600 border border-emerald-200 hover:bg-emerald-100 hover:text-emerald-800'
                                   }}"
                        >

                            All

                        </a>



                        {{-- Available --}}

                        <a
                            href="{{ route('admin.donations', ['status' => 'available']) }}"
                            class="inline-flex items-center gap-2
                                   px-4 py-2
                                   rounded-xl
                                   text-sm font-semibold
                                   transition
                                   {{
                                       request('status') === 'available'
                                           ? 'bg-emerald-700 text-white shadow-sm'
                                           : 'bg-white text-gray-600 border border-emerald-200 hover:bg-emerald-100 hover:text-emerald-800'
                                   }}"
                        >

                            <span
                                class="w-2 h-2 rounded-full
                                    {{
                                        request('status') === 'available'
                                            ? 'bg-white'
                                            : 'bg-emerald-600'
                                    }}"
                            ></span>

                            Available

                        </a>



                        {{-- Claimed --}}

                        <a
                            href="{{ route('admin.donations', ['status' => 'claimed']) }}"
                            class="inline-flex items-center gap-2
                                   px-4 py-2
                                   rounded-xl
                                   text-sm font-semibold
                                   transition
                                   {{
                                       request('status') === 'claimed'
                                           ? 'bg-amber-600 text-white shadow-sm'
                                           : 'bg-white text-gray-600 border border-gray-200 hover:bg-amber-50 hover:text-amber-700'
                                   }}"
                        >

                            <span
                                class="w-2 h-2 rounded-full
                                    {{
                                        request('status') === 'claimed'
                                            ? 'bg-white'
                                            : 'bg-amber-500'
                                    }}"
                            ></span>

                            Claimed

                        </a>



                        {{-- Completed --}}

                        <a
                            href="{{ route('admin.donations', ['status' => 'completed']) }}"
                            class="inline-flex items-center gap-2
                                   px-4 py-2
                                   rounded-xl
                                   text-sm font-semibold
                                   transition
                                   {{
                                       request('status') === 'completed'
                                           ? 'bg-blue-700 text-white shadow-sm'
                                           : 'bg-white text-gray-600 border border-gray-200 hover:bg-blue-50 hover:text-blue-700'
                                   }}"
                        >

                            <span
                                class="w-2 h-2 rounded-full
                                    {{
                                        request('status') === 'completed'
                                            ? 'bg-white'
                                            : 'bg-blue-500'
                                    }}"
                            ></span>

                            Completed

                        </a>

                    </div>

                </div>



                {{-- ================================================= --}}
                {{-- TABLE --}}
                {{-- ================================================= --}}

                <div class="overflow-x-auto">

                    <table class="min-w-full">


                        {{-- Table Header --}}

                        <thead class="bg-emerald-100 border-b border-emerald-200">

                            <tr>

                                <th
                                    class="px-6 py-4
                                           text-left
                                           text-xs
                                           font-semibold
                                           uppercase
                                           tracking-wider
                                           text-emerald-900"
                                >
                                    Donation
                                </th>

                                <th
                                    class="px-6 py-4
                                           text-left
                                           text-xs
                                           font-semibold
                                           uppercase
                                           tracking-wider
                                           text-emerald-900"
                                >
                                    Donor
                                </th>

                                <th
                                    class="px-6 py-4
                                           text-left
                                           text-xs
                                           font-semibold
                                           uppercase
                                           tracking-wider
                                           text-emerald-900"
                                >
                                    Category
                                </th>

                                <th
                                    class="px-6 py-4
                                           text-center
                                           text-xs
                                           font-semibold
                                           uppercase
                                           tracking-wider
                                           text-emerald-900"
                                >
                                    Quantity
                                </th>

                                <th
                                    class="px-6 py-4
                                           text-left
                                           text-xs
                                           font-semibold
                                           uppercase
                                           tracking-wider
                                           text-emerald-900"
                                >
                                    Status
                                </th>

                                <th
                                    class="px-6 py-4
                                           text-left
                                           text-xs
                                           font-semibold
                                           uppercase
                                           tracking-wider
                                           text-emerald-900"
                                >
                                    Expiry
                                </th>

                                <th
                                    class="px-6 py-4
                                           text-right
                                           text-xs
                                           font-semibold
                                           uppercase
                                           tracking-wider
                                           text-emerald-900"
                                >
                                    Actions
                                </th>

                            </tr>

                        </thead>



                        {{-- Table Body --}}

                        <tbody class="divide-y divide-emerald-100">

                            @forelse ($donations as $donation)

                                <tr class="hover:bg-emerald-100/70 transition">


                                    {{-- Donation --}}

                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <div class="flex items-center gap-3">

                                            <div
                                                class="w-10 h-10 rounded-xl
                                                       bg-emerald-100
                                                       text-emerald-800
                                                       border border-emerald-200
                                                       flex items-center justify-center"
                                            >

                                                <svg
                                                    class="w-5 h-5"
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


                                            <div class="max-w-[220px]">

                                                <p class="text-sm font-bold text-gray-900 truncate">
                                                    {{ $donation->title }}
                                                </p>

                                                <p class="text-xs text-gray-400 mt-1">
                                                    Donation #{{ $donation->id }}
                                                </p>

                                            </div>

                                        </div>

                                    </td>



                                    {{-- Donor --}}

                                    <td class="px-6 py-4 whitespace-nowrap">

                                        @if ($donation->donor)

                                            <div class="flex items-center gap-2">

                                                <div
                                                    class="w-8 h-8 rounded-lg
                                                           bg-emerald-100
                                                           text-emerald-800
                                                           border border-emerald-200
                                                           flex items-center justify-center
                                                           text-xs font-bold"
                                                >

                                                    {{ strtoupper(substr($donation->donor->name, 0, 1)) }}

                                                </div>

                                                <span class="text-sm font-medium text-gray-800">
                                                    {{ $donation->donor->name }}
                                                </span>

                                            </div>

                                        @else

                                            <span class="text-sm text-gray-400 italic">
                                                N/A
                                            </span>

                                        @endif

                                    </td>



                                    {{-- Category --}}

                                    <td class="px-6 py-4 whitespace-nowrap">

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
                                                N/A
                                            </span>

                                        @endif

                                    </td>



                                    {{-- Quantity --}}

                                    <td class="px-6 py-4 text-center whitespace-nowrap">

                                        <span class="text-sm font-bold text-gray-900">
                                            {{ $donation->quantity }}
                                        </span>

                                        <span class="block text-xs text-gray-400">
                                            units
                                        </span>

                                    </td>



                                    {{-- Status --}}

                                    <td class="px-6 py-4 whitespace-nowrap">

                                        @if ($donation->status === 'available')

                                            <span
                                                class="inline-flex items-center gap-1.5
                                                       px-2.5 py-1
                                                       rounded-full
                                                       bg-emerald-100
                                                       text-emerald-800
                                                       border border-emerald-200
                                                       text-xs font-semibold"
                                            >

                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>

                                                Available

                                            </span>

                                        @elseif ($donation->status === 'claimed')

                                            <span
                                                class="inline-flex items-center gap-1.5
                                                       px-2.5 py-1
                                                       rounded-full
                                                       bg-amber-100
                                                       text-amber-800
                                                       border border-amber-200
                                                       text-xs font-semibold"
                                            >

                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span>

                                                Claimed

                                            </span>

                                        @elseif ($donation->status === 'completed')

                                            <span
                                                class="inline-flex items-center gap-1.5
                                                       px-2.5 py-1
                                                       rounded-full
                                                       bg-blue-100
                                                       text-blue-800
                                                       border border-blue-200
                                                       text-xs font-semibold"
                                            >

                                                <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>

                                                Completed

                                            </span>

                                        @else

                                            <span
                                                class="inline-flex items-center gap-1.5
                                                       px-2.5 py-1
                                                       rounded-full
                                                       bg-red-100
                                                       text-red-800
                                                       border border-red-200
                                                       text-xs font-semibold"
                                            >

                                                <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span>

                                                {{ ucfirst(str_replace('_', ' ', $donation->status)) }}

                                            </span>

                                        @endif

                                    </td>



                                    {{-- Expiry --}}

                                    <td class="px-6 py-4 whitespace-nowrap">

                                        @php
                                            $expiry = Carbon::parse($donation->expiry_time);
                                            $isExpired = $expiry->isPast();
                                        @endphp

                                        <div>

                                            <p
                                                class="text-sm font-medium
                                                    {{ $isExpired
                                                        ? 'text-red-700'
                                                        : 'text-gray-800' }}"
                                            >

                                                {{ $expiry->format('d M Y') }}

                                            </p>


                                            <p
                                                class="text-xs
                                                    {{ $isExpired
                                                        ? 'text-red-500'
                                                        : 'text-gray-400' }}"
                                            >

                                                {{ $expiry->format('g:i A') }}

                                                @if ($isExpired)
                                                    · Expired
                                                @endif

                                            </p>

                                        </div>

                                    </td>



                                    {{-- Actions --}}

                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <div class="flex items-center justify-end gap-2">


                                            {{-- View --}}

                                            <a
                                                href="{{ route('admin.donations.show', $donation) }}"
                                                class="inline-flex items-center gap-1.5
                                                       px-3 py-2
                                                       rounded-lg
                                                       bg-emerald-100
                                                       text-emerald-800
                                                       border border-emerald-200
                                                       hover:bg-emerald-200
                                                       text-xs font-semibold
                                                       transition"
                                            >

                                                <svg
                                                    class="w-4 h-4"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="1.8"
                                                        d="M2.5 12S6 5.5 12 5.5 21.5 12 21.5 12 18 18.5 12 18.5 2.5 12 2.5 12z"
                                                    />

                                                    <circle
                                                        cx="12"
                                                        cy="12"
                                                        r="2.5"
                                                        stroke-width="1.8"
                                                    />

                                                </svg>

                                                View

                                            </a>



                                            {{-- Edit --}}

                                            @if ($donation->status === 'available')

                                                <a
                                                    href="{{ route('admin.donations.edit', $donation) }}"
                                                    class="inline-flex items-center gap-1.5
                                                           px-3 py-2
                                                           rounded-lg
                                                           bg-emerald-100
                                                           text-emerald-800
                                                           border border-emerald-200
                                                           hover:bg-emerald-200
                                                           text-xs font-semibold
                                                           transition"
                                                >

                                                    <svg
                                                        class="w-4 h-4"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        viewBox="0 0 24 24"
                                                    >

                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="1.8"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M16.5 3.5a2.12 2.12 0 013 3L10 16l-4 1 1-4 9.5-9.5z"
                                                        />

                                                    </svg>

                                                    Edit

                                                </a>

                                            @endif



                                            {{-- Delete --}}

                                            @if ($donation->status === 'available')

                                                <form
                                                    action="{{ route('admin.donations.destroy', $donation) }}"
                                                    method="POST"
                                                    class="inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this donation?');"
                                                >

                                                    @csrf

                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="inline-flex items-center gap-1.5
                                                               px-3 py-2
                                                               rounded-lg
                                                               bg-red-50
                                                               text-red-700
                                                               border border-red-100
                                                               hover:bg-red-100
                                                               text-xs font-semibold
                                                               transition"
                                                    >

                                                        <svg
                                                            class="w-4 h-4"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            viewBox="0 0 24 24"
                                                        >

                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                stroke-width="1.8"
                                                                d="M3 6h18M8 6V4h8v2m-9 0l1 14h8l1-14M10 11v6M14 11v6"
                                                            />

                                                        </svg>

                                                        Delete

                                                    </button>

                                                </form>

                                            @endif

                                        </div>

                                    </td>

                                </tr>


                            @empty

                                {{-- Empty State --}}

                                <tr>

                                    <td colspan="7" class="px-6 py-20">

                                        <div class="flex flex-col items-center text-center">

                                            <div
                                                class="w-16 h-16 rounded-2xl
                                                       bg-emerald-100
                                                       text-emerald-700
                                                       border border-emerald-200
                                                       flex items-center justify-center"
                                            >

                                                <svg
                                                    class="w-8 h-8"
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


                                            <h4 class="mt-5 text-lg font-bold text-gray-900">
                                                No donations found
                                            </h4>


                                            <p class="mt-1 max-w-md text-sm text-gray-500">
                                                Donations will appear here when users contribute food to the platform.
                                            </p>


                                            @if (request('status'))

                                                <a
                                                    href="{{ route('admin.donations') }}"
                                                    class="mt-4 text-sm font-semibold text-emerald-700 hover:text-emerald-900"
                                                >
                                                    Clear filter
                                                </a>

                                            @endif

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>



                {{-- ================================================= --}}
                {{-- PAGINATION --}}
                {{-- ================================================= --}}

                @if ($donations->hasPages())

                    <div
                        class="px-6 py-4
                               border-t border-emerald-200
                               bg-emerald-100/50"
                    >

                        {{ $donations->withQueryString()->links() }}

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>