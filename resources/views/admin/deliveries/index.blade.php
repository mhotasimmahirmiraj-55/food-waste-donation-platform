<x-app-layout>

    {{-- =========================================================
         HEADER
         =========================================================
         This is the page header displayed by the main app layout.
         The actual delivery data comes from:
         AdminDeliveryController@index
         ========================================================= --}}

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                    Delivery Management
                </h2>

                <p class="mt-1 text-sm text-emerald-800">
                    Monitor and manage food delivery operations.
                </p>

            </div>

            <div class="hidden sm:flex items-center gap-2 text-sm text-emerald-800">

                <span class="w-2 h-2 rounded-full bg-emerald-700"></span>

                Delivery Center

            </div>

        </div>

    </x-slot>


    {{-- =========================================================
         MAIN PAGE BACKGROUND
         ========================================================= --}}

    <div class="min-h-screen bg-gradient-to-br from-emerald-100 via-white to-green-100">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


            {{-- =================================================
                 PAGE TITLE
                 ================================================= --}}

            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6">

                <div>

                    <h1 class="text-2xl font-bold text-gray-900">
                        Deliveries
                    </h1>

                    <p class="mt-1 text-sm text-emerald-800">
                        Track delivery assignments and volunteer progress.
                    </p>

                </div>


                {{-- Total deliveries comes from Laravel paginator --}}

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
                                d="M3 7h11v10H3zM14 10h4l3 3v4h-7zM7 20a2 2 0 100-4 2 2 0 000 4zm10 0a2 2 0 100-4 2 2 0 000 4z"
                            />

                        </svg>

                    </div>

                    <div>

                        <p class="text-xs font-medium text-gray-500">
                            Total Deliveries
                        </p>

                        <p class="text-xl font-bold text-gray-900">
                            {{ $deliveries->total() }}
                        </p>

                    </div>

                </div>

            </div>



            {{-- =================================================
                 FLASH SUCCESS MESSAGE
                 ================================================= --}}

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



            {{-- =================================================
                 FLASH ERROR MESSAGE
                 ================================================= --}}

            @if (session('error'))

                <div
                    class="mb-6
                           flex items-start gap-3
                           rounded-xl
                           bg-red-100
                           border border-red-200
                           text-red-900
                           px-4 py-3
                           shadow-sm"
                >

                    <svg
                        class="w-5 h-5 mt-0.5 flex-shrink-0"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 9v4m0 4h.01M5.07 19h13.86a2 2 0 001.73-3L13.73 4a2 2 0 00-3.46 0L3.34 16a2 2 0 001.73 3z"
                        />

                    </svg>

                    <span class="text-sm font-medium">
                        {{ session('error') }}
                    </span>

                </div>

            @endif



            {{-- =================================================
                 MAIN DELIVERY CARD
                 ================================================= --}}

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

                    <h3 class="text-lg font-bold text-gray-900">
                        Delivery Records
                    </h3>

                    <p class="mt-1 text-sm text-gray-600">
                        Review delivery status, volunteers and associated claims.
                    </p>

                </div>



                {{-- =================================================
                     STATUS FILTERS
                     =================================================
                     These links send ?status=... to the controller.
                     AdminDeliveryController@index reads that value
                     and filters the database query.
                     ================================================= --}}

                <div
                    class="px-6 py-4
                           border-b border-emerald-200
                           bg-emerald-100/50"
                >

                    <div class="flex flex-wrap items-center gap-2">


                        {{-- All --}}

                        <a
                            href="{{ route('admin.deliveries') }}"
                            class="px-4 py-2 rounded-xl text-sm font-semibold transition
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
                            href="{{ route('admin.deliveries', ['status' => 'pending']) }}"
                            class="inline-flex items-center gap-2
                                   px-4 py-2 rounded-xl
                                   text-sm font-semibold transition
                                   {{
                                       request('status') === 'pending'
                                           ? 'bg-blue-700 text-white shadow-sm'
                                           : 'bg-white text-gray-600 border border-emerald-200 hover:bg-blue-50 hover:text-blue-700'
                                   }}"
                        >

                            <span
                                class="w-2 h-2 rounded-full
                                {{
                                    request('status') === 'pending'
                                        ? 'bg-white'
                                        : 'bg-blue-500'
                                }}"
                            ></span>

                            Pending

                        </a>


                        {{-- Accepted --}}

                        <a
                            href="{{ route('admin.deliveries', ['status' => 'accepted']) }}"
                            class="inline-flex items-center gap-2
                                   px-4 py-2 rounded-xl
                                   text-sm font-semibold transition
                                   {{
                                       request('status') === 'accepted'
                                           ? 'bg-amber-600 text-white shadow-sm'
                                           : 'bg-white text-gray-600 border border-emerald-200 hover:bg-amber-50 hover:text-amber-700'
                                   }}"
                        >

                            <span
                                class="w-2 h-2 rounded-full
                                {{
                                    request('status') === 'accepted'
                                        ? 'bg-white'
                                        : 'bg-amber-500'
                                }}"
                            ></span>

                            Accepted

                        </a>


                        {{-- Picked Up --}}

                        <a
                            href="{{ route('admin.deliveries', ['status' => 'picked_up']) }}"
                            class="inline-flex items-center gap-2
                                   px-4 py-2 rounded-xl
                                   text-sm font-semibold transition
                                   {{
                                       request('status') === 'picked_up'
                                           ? 'bg-purple-700 text-white shadow-sm'
                                           : 'bg-white text-gray-600 border border-emerald-200 hover:bg-purple-50 hover:text-purple-700'
                                   }}"
                        >

                            <span
                                class="w-2 h-2 rounded-full
                                {{
                                    request('status') === 'picked_up'
                                        ? 'bg-white'
                                        : 'bg-purple-500'
                                }}"
                            ></span>

                            Picked Up

                        </a>


                        {{-- Delivered --}}

                        <a
                            href="{{ route('admin.deliveries', ['status' => 'delivered']) }}"
                            class="inline-flex items-center gap-2
                                   px-4 py-2 rounded-xl
                                   text-sm font-semibold transition
                                   {{
                                       request('status') === 'delivered'
                                           ? 'bg-emerald-800 text-white shadow-sm'
                                           : 'bg-white text-gray-600 border border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700'
                                   }}"
                        >

                            <span
                                class="w-2 h-2 rounded-full
                                {{
                                    request('status') === 'delivered'
                                        ? 'bg-white'
                                        : 'bg-emerald-600'
                                }}"
                            ></span>

                            Delivered

                        </a>

                    </div>

                </div>



                {{-- =================================================
                     DELIVERY TABLE
                     ================================================= --}}

                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead class="bg-emerald-900">

                            <tr>

                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-emerald-100">
                                    Delivery
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-emerald-100">
                                    Donation
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-emerald-100">
                                    Receiver
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-emerald-100">
                                    Volunteer
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-emerald-100">
                                    Status
                                </th>

                                <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-emerald-100">
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-emerald-100">

                            @forelse ($deliveries as $delivery)

                                <tr class="hover:bg-emerald-50/70 transition">


                                    {{-- =================================================
                                         DELIVERY ID
                                         ================================================= --}}

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
                                                        d="M3 7h11v10H3zM14 10h4l3 3v4h-7zM7 20a2 2 0 100-4 2 2 0 000 4zm10 0a2 2 0 100-4 2 2 0 000 4z"
                                                    />

                                                </svg>

                                            </div>

                                            <div>

                                                <p class="text-sm font-bold text-gray-900">
                                                    #{{ $delivery->id }}
                                                </p>

                                                <p class="text-xs text-gray-400">
                                                    Claim #{{ $delivery->claim_id }}
                                                </p>

                                            </div>

                                        </div>

                                    </td>



                                    {{-- =================================================
                                         DONATION
                                         =================================================
                                         Null-safe operator prevents errors if a
                                         claim or donation no longer exists.
                                         ================================================= --}}

                                    <td class="px-6 py-4">

                                        <div class="max-w-[200px]">

                                            <p class="text-sm font-semibold text-gray-900 truncate">

                                                {{ $delivery->claim?->foodDonation?->title ?? 'N/A' }}

                                            </p>

                                            <p class="mt-1 text-xs text-emerald-700">

                                                Donation #{{ $delivery->claim?->foodDonation?->id ?? 'N/A' }}

                                            </p>

                                        </div>

                                    </td>



                                    {{-- =================================================
                                         RECEIVER
                                         ================================================= --}}

                                    <td class="px-6 py-4 whitespace-nowrap">

                                        @if ($delivery->claim?->receiver)

                                            <div class="flex items-center gap-2">

                                                <div
                                                    class="w-8 h-8 rounded-lg
                                                           bg-blue-100
                                                           text-blue-700
                                                           border border-blue-200
                                                           flex items-center justify-center
                                                           text-xs font-bold"
                                                >

                                                    {{ strtoupper(substr($delivery->claim->receiver->name, 0, 1)) }}

                                                </div>

                                                <span class="text-sm font-medium text-gray-800">

                                                    {{ $delivery->claim->receiver->name }}

                                                </span>

                                            </div>

                                        @else

                                            <span class="text-sm text-gray-400 italic">
                                                N/A
                                            </span>

                                        @endif

                                    </td>



                                    {{-- =================================================
                                         VOLUNTEER
                                         ================================================= --}}

                                    <td class="px-6 py-4 whitespace-nowrap">

                                        @if ($delivery->volunteer)

                                            <div class="flex items-center gap-2">

                                                <div
                                                    class="w-8 h-8 rounded-lg
                                                           bg-amber-100
                                                           text-amber-700
                                                           border border-amber-200
                                                           flex items-center justify-center
                                                           text-xs font-bold"
                                                >

                                                    {{ strtoupper(substr($delivery->volunteer->name, 0, 1)) }}

                                                </div>

                                                <span class="text-sm font-medium text-gray-800">

                                                    {{ $delivery->volunteer->name }}

                                                </span>

                                            </div>

                                        @else

                                            <span
                                                class="inline-flex items-center gap-2
                                                       px-2.5 py-1
                                                       rounded-full
                                                       bg-gray-100
                                                       text-gray-600
                                                       text-xs font-semibold"
                                            >

                                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>

                                                Unassigned

                                            </span>

                                        @endif

                                    </td>



                                    {{-- =================================================
                                         STATUS
                                         ================================================= --}}

                                    <td class="px-6 py-4 whitespace-nowrap">

                                        @if ($delivery->status === 'pending')

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

                                                Pending

                                            </span>

                                        @elseif ($delivery->status === 'accepted')

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

                                                Accepted

                                            </span>

                                        @elseif ($delivery->status === 'picked_up')

                                            <span
                                                class="inline-flex items-center gap-1.5
                                                       px-2.5 py-1
                                                       rounded-full
                                                       bg-purple-100
                                                       text-purple-800
                                                       border border-purple-200
                                                       text-xs font-semibold"
                                            >

                                                <span class="w-1.5 h-1.5 rounded-full bg-purple-600"></span>

                                                Picked Up

                                            </span>

                                        @elseif ($delivery->status === 'delivered')

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

                                                Delivered

                                            </span>

                                        @else

                                            <span
                                                class="inline-flex items-center
                                                       px-2.5 py-1
                                                       rounded-full
                                                       bg-gray-100
                                                       text-gray-700
                                                       text-xs font-semibold"
                                            >

                                                {{ ucfirst(str_replace('_', ' ', $delivery->status)) }}

                                            </span>

                                        @endif

                                    </td>



                                    {{-- =================================================
                                         ACTIONS
                                         ================================================= --}}

                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <div class="flex items-center justify-end gap-2">


                                            {{-- View delivery details --}}

                                            <a
                                                href="{{ route('admin.deliveries.show', $delivery) }}"
                                                class="inline-flex items-center
                                                       px-3 py-2
                                                       rounded-lg
                                                       bg-emerald-100
                                                       text-emerald-800
                                                       border border-emerald-200
                                                       hover:bg-emerald-200
                                                       text-xs font-semibold
                                                       transition"
                                            >
                                                View
                                            </a>


                                            {{-- Release is only available when delivery
                                                 has already been accepted or picked up. --}}

                                            @if (in_array($delivery->status, ['accepted', 'picked_up']))

                                                <form
                                                    action="{{ route('admin.deliveries.release', $delivery) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Release this delivery so another volunteer can take the job?');"
                                                >

                                                    @csrf

                                                    @method('PUT')

                                                    <button
                                                        type="submit"
                                                        class="inline-flex items-center
                                                               px-3 py-2
                                                               rounded-lg
                                                               bg-orange-100
                                                               text-orange-800
                                                               border border-orange-200
                                                               hover:bg-orange-200
                                                               text-xs font-semibold
                                                               transition"
                                                    >
                                                        Release
                                                    </button>

                                                </form>

                                            @endif

                                        </div>

                                    </td>

                                </tr>


                            @empty

                                {{-- =================================================
                                     EMPTY STATE
                                     ================================================= --}}

                                <tr>

                                    <td colspan="6" class="px-6 py-20">

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
                                                        d="M3 7h11v10H3zM14 10h4l3 3v4h-7z"
                                                    />

                                                </svg>

                                            </div>

                                            <h4 class="mt-5 text-lg font-bold text-gray-900">
                                                No deliveries found
                                            </h4>

                                            <p class="mt-1 max-w-md text-sm text-gray-500">
                                                Delivery records will appear here when deliveries are created.
                                            </p>

                                            @if (request('status'))

                                                <a
                                                    href="{{ route('admin.deliveries') }}"
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



                {{-- =================================================
                     PAGINATION
                     ================================================= --}}

                @if ($deliveries->hasPages())

                    <div
                        class="px-6 py-4
                               border-t border-emerald-200
                               bg-emerald-100/50"
                    >

                        {{ $deliveries->withQueryString()->links() }}

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>