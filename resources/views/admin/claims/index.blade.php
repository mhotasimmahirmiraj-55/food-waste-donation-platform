<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                    Claim Management
                </h2>

                <p class="mt-1 text-sm text-emerald-800">
                    Review and manage donation claims.
                </p>

            </div>

            <div class="hidden sm:flex items-center gap-2 text-sm text-emerald-800">

                <span class="w-2 h-2 rounded-full bg-emerald-600"></span>

                Claim Operations

            </div>

        </div>

    </x-slot>


    {{-- ================================================= --}}
    {{-- MAIN PAGE --}}
    {{-- Darker emerald Admin theme --}}
    {{-- ================================================= --}}

    <div class="min-h-screen bg-gradient-to-br from-emerald-100 via-white to-green-100">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


            {{-- ================================================= --}}
            {{-- PAGE HEADER --}}
            {{-- ================================================= --}}

            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6">

                <div>

                    <h1 class="text-2xl font-bold text-gray-900">
                        Claim Operations
                    </h1>

                    <p class="mt-1 text-sm text-emerald-800">
                        Monitor donation requests and their approval status.
                    </p>

                </div>


                {{-- Total Claims --}}

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
                                d="M9 12h6m-6 4h4M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"
                            />

                        </svg>

                    </div>


                    <div>

                        <p class="text-xs font-medium text-gray-500">
                            Total Claims
                        </p>

                        <p class="text-xl font-bold text-gray-900">
                            {{ $claims->total() }}
                        </p>

                    </div>

                </div>

            </div>



            {{-- ================================================= --}}
            {{-- SUCCESS MESSAGE --}}
            {{-- ================================================= --}}

            @if (session('success'))

                <div
                    class="mb-6
                           flex items-start gap-3
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
            {{-- CLAIM CARD --}}
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
                            Claim Records
                        </h3>

                        <p class="mt-1 text-sm text-gray-600">
                            Review claims submitted by receivers.
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
                            href="{{ route('admin.claims') }}"
                            class="inline-flex items-center gap-2
                                   px-4 py-2
                                   rounded-xl
                                   text-sm font-semibold
                                   transition
                                   {{
                                       !request('status')
                                           ? 'bg-emerald-800 text-white shadow-sm'
                                           : 'bg-white text-gray-600 border border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700'
                                   }}"
                        >
                            All
                        </a>



                        {{-- Pending --}}

                        <a
                            href="{{ route('admin.claims', ['status' => 'pending']) }}"
                            class="inline-flex items-center gap-2
                                   px-4 py-2
                                   rounded-xl
                                   text-sm font-semibold
                                   transition
                                   {{
                                       request('status') === 'pending'
                                           ? 'bg-amber-600 text-white shadow-sm'
                                           : 'bg-white text-gray-600 border border-emerald-200 hover:bg-amber-50 hover:text-amber-700'
                                   }}"
                        >

                            <span
                                class="w-2 h-2 rounded-full
                                    {{
                                        request('status') === 'pending'
                                            ? 'bg-white'
                                            : 'bg-amber-500'
                                    }}"
                            ></span>

                            Pending

                        </a>



                        {{-- Approved --}}

                        <a
                            href="{{ route('admin.claims', ['status' => 'approved']) }}"
                            class="inline-flex items-center gap-2
                                   px-4 py-2
                                   rounded-xl
                                   text-sm font-semibold
                                   transition
                                   {{
                                       request('status') === 'approved'
                                           ? 'bg-blue-700 text-white shadow-sm'
                                           : 'bg-white text-gray-600 border border-emerald-200 hover:bg-blue-50 hover:text-blue-700'
                                   }}"
                        >

                            <span
                                class="w-2 h-2 rounded-full
                                    {{
                                        request('status') === 'approved'
                                            ? 'bg-white'
                                            : 'bg-blue-500'
                                    }}"
                            ></span>

                            Approved

                        </a>



                        {{-- Rejected --}}

                        <a
                            href="{{ route('admin.claims', ['status' => 'rejected']) }}"
                            class="inline-flex items-center gap-2
                                   px-4 py-2
                                   rounded-xl
                                   text-sm font-semibold
                                   transition
                                   {{
                                       request('status') === 'rejected'
                                           ? 'bg-red-700 text-white shadow-sm'
                                           : 'bg-white text-gray-600 border border-emerald-200 hover:bg-red-50 hover:text-red-700'
                                   }}"
                        >

                            <span
                                class="w-2 h-2 rounded-full
                                    {{
                                        request('status') === 'rejected'
                                            ? 'bg-white'
                                            : 'bg-red-500'
                                    }}"
                            ></span>

                            Rejected

                        </a>



                        {{-- Completed --}}

                        <a
                            href="{{ route('admin.claims', ['status' => 'completed']) }}"
                            class="inline-flex items-center gap-2
                                   px-4 py-2
                                   rounded-xl
                                   text-sm font-semibold
                                   transition
                                   {{
                                       request('status') === 'completed'
                                           ? 'bg-emerald-800 text-white shadow-sm'
                                           : 'bg-white text-gray-600 border border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700'
                                   }}"
                        >

                            <span
                                class="w-2 h-2 rounded-full
                                    {{
                                        request('status') === 'completed'
                                            ? 'bg-white'
                                            : 'bg-emerald-600'
                                    }}"
                            ></span>

                            Completed

                        </a>



                        {{-- Cancelled --}}

                        <a
                            href="{{ route('admin.claims', ['status' => 'cancelled']) }}"
                            class="inline-flex items-center gap-2
                                   px-4 py-2
                                   rounded-xl
                                   text-sm font-semibold
                                   transition
                                   {{
                                       request('status') === 'cancelled'
                                           ? 'bg-gray-700 text-white shadow-sm'
                                           : 'bg-white text-gray-600 border border-emerald-200 hover:bg-gray-100'
                                   }}"
                        >

                            <span
                                class="w-2 h-2 rounded-full
                                    {{
                                        request('status') === 'cancelled'
                                            ? 'bg-white'
                                            : 'bg-gray-500'
                                    }}"
                            ></span>

                            Cancelled

                        </a>

                    </div>

                </div>



                {{-- ================================================= --}}
                {{-- TABLE --}}
                {{-- ================================================= --}}

                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead
                            class="bg-emerald-900
                                   border-b border-emerald-800"
                        >

                            <tr>

                                <th
                                    class="px-6 py-4
                                           text-left
                                           text-xs
                                           font-semibold
                                           uppercase
                                           tracking-wider
                                           text-emerald-100"
                                >
                                    Claim
                                </th>

                                <th
                                    class="px-6 py-4
                                           text-left
                                           text-xs
                                           font-semibold
                                           uppercase
                                           tracking-wider
                                           text-emerald-100"
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
                                           text-emerald-100"
                                >
                                    Receiver
                                </th>

                                <th
                                    class="px-6 py-4
                                           text-left
                                           text-xs
                                           font-semibold
                                           uppercase
                                           tracking-wider
                                           text-emerald-100"
                                >
                                    Status
                                </th>

                                <th
                                    class="px-6 py-4
                                           text-right
                                           text-xs
                                           font-semibold
                                           uppercase
                                           tracking-wider
                                           text-emerald-100"
                                >
                                    Actions
                                </th>

                            </tr>

                        </thead>



                        <tbody class="divide-y divide-emerald-100">

                            @forelse ($claims as $claim)

                                <tr class="hover:bg-emerald-50/70 transition">


                                    {{-- Claim ID --}}

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
                                                        d="M9 12h6m-6 4h4M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"
                                                    />

                                                </svg>

                                            </div>


                                            <div>

                                                <p class="text-sm font-bold text-gray-900">
                                                    #{{ $claim->id }}
                                                </p>

                                                <p class="text-xs text-gray-400">
                                                    Claim
                                                </p>

                                            </div>

                                        </div>

                                    </td>



                                    {{-- Donation --}}

                                    <td class="px-6 py-4">

                                        <div class="max-w-[260px]">

                                            <p class="text-sm font-semibold text-gray-900 truncate">

                                                {{ $claim->foodDonation->title ?? 'N/A' }}

                                            </p>

                                            <p class="text-xs text-gray-400 mt-1">
                                                Food Donation
                                            </p>

                                        </div>

                                    </td>



                                    {{-- Receiver --}}

                                    <td class="px-6 py-4 whitespace-nowrap">

                                        @if ($claim->receiver)

                                            <div class="flex items-center gap-2">

                                                <div
                                                    class="w-8 h-8 rounded-lg
                                                           bg-blue-100
                                                           text-blue-700
                                                           border border-blue-200
                                                           flex items-center justify-center
                                                           text-xs font-bold"
                                                >

                                                    {{ strtoupper(substr($claim->receiver->name, 0, 1)) }}

                                                </div>

                                                <span class="text-sm font-medium text-gray-800">

                                                    {{ $claim->receiver->name }}

                                                </span>

                                            </div>

                                        @else

                                            <span class="text-sm text-gray-400 italic">
                                                N/A
                                            </span>

                                        @endif

                                    </td>



                                    {{-- Status --}}

                                    <td class="px-6 py-4 whitespace-nowrap">

                                        @if ($claim->status === 'pending')

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

                                                Pending

                                            </span>

                                        @elseif ($claim->status === 'approved')

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

                                                Approved

                                            </span>

                                        @elseif ($claim->status === 'rejected')

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

                                                Rejected

                                            </span>

                                        @elseif ($claim->status === 'completed')

                                            <span
                                                class="inline-flex items-center gap-1.5
                                                       px-2.5 py-1
                                                       rounded-full
                                                       bg-emerald-100
                                                       text-emerald-800
                                                       border border-emerald-200
                                                       text-xs font-semibold"
                                            >

                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-700"></span>

                                                Completed

                                            </span>

                                        @elseif ($claim->status === 'cancelled')

                                            <span
                                                class="inline-flex items-center gap-1.5
                                                       px-2.5 py-1
                                                       rounded-full
                                                       bg-gray-100
                                                       text-gray-700
                                                       border border-gray-200
                                                       text-xs font-semibold"
                                            >

                                                <span class="w-1.5 h-1.5 rounded-full bg-gray-600"></span>

                                                Cancelled

                                            </span>

                                        @else

                                            <span
                                                class="inline-flex items-center gap-1.5
                                                       px-2.5 py-1
                                                       rounded-full
                                                       bg-gray-100
                                                       text-gray-700
                                                       border border-gray-200
                                                       text-xs font-semibold"
                                            >

                                                {{ ucfirst(str_replace('_', ' ', $claim->status)) }}

                                            </span>

                                        @endif

                                    </td>



                                    {{-- Actions --}}

                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <div class="flex items-center justify-end gap-2">


                                            {{-- View --}}

                                            <a
                                                href="{{ route('admin.claims.show', $claim) }}"
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

                                            <a
                                                href="{{ route('admin.claims.edit', $claim) }}"
                                                class="inline-flex items-center gap-1.5
                                                       px-3 py-2
                                                       rounded-lg
                                                       bg-green-100
                                                       text-green-800
                                                       border border-green-200
                                                       hover:bg-green-200
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

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                {{-- ================================================= --}}
                                {{-- EMPTY STATE --}}
                                {{-- ================================================= --}}

                                <tr>

                                    <td colspan="5" class="px-6 py-20">

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
                                                        d="M9 12h6m-6 4h4M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"
                                                    />

                                                </svg>

                                            </div>


                                            <h4 class="mt-5 text-lg font-bold text-gray-900">
                                                No claims found
                                            </h4>


                                            <p class="mt-1 max-w-md text-sm text-gray-500">
                                                Claims will appear here when receivers request donated food.
                                            </p>


                                            @if (request('status'))

                                                <a
                                                    href="{{ route('admin.claims') }}"
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

                @if ($claims->hasPages())

                    <div
                        class="px-6 py-4
                               border-t border-emerald-200
                               bg-emerald-100/50"
                    >

                        {{ $claims->withQueryString()->links() }}

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>