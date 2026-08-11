<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                    Delivery Management
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Monitor and manage food delivery operations.
                </p>
            </div>

            <div class="hidden sm:flex items-center gap-2 text-sm text-gray-500">
                <span class="w-2 h-2 rounded-full bg-orange-500"></span>
                Delivery Operations
            </div>

        </div>

    </x-slot>


    <div class="min-h-screen bg-slate-50">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


            {{-- ================================================= --}}
            {{-- PAGE HEADER --}}
            {{-- ================================================= --}}

            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6">

                <div>

                    <h1 class="text-2xl font-bold text-gray-900">
                        Delivery Operations
                    </h1>

                    <p class="mt-1 text-sm text-gray-500">
                        Track delivery assignments, volunteers and completion status.
                    </p>

                </div>


                {{-- Total Deliveries --}}
                <div class="inline-flex items-center gap-3 bg-white border border-gray-200 rounded-2xl px-5 py-3 shadow-sm">

                    <div class="w-10 h-10 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center">

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


            {{-- ================================================= --}}
            {{-- FLASH MESSAGE --}}
            {{-- ================================================= --}}

            @if (session('success'))

                <div class="mb-6 flex items-start gap-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3">

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
                            d="M5 13l4 4L19 7"
                        />

                    </svg>

                    <span class="text-sm font-medium">
                        {{ session('success') }}
                    </span>

                </div>

            @endif


            @if (session('error'))

                <div class="mb-6 flex items-start gap-3 rounded-xl bg-red-50 border border-red-200 text-red-800 px-4 py-3">

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


            {{-- ================================================= --}}
            {{-- DELIVERY CARD --}}
            {{-- ================================================= --}}

            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">


                {{-- Card Header --}}
                <div class="px-6 py-5 border-b border-gray-100">

                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

                        <div>

                            <h3 class="text-lg font-bold text-gray-900">
                                Delivery Records
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                Manage active and completed food deliveries.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- STATUS FILTERS --}}
                {{-- ================================================= --}}

                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/60">

                    <div class="flex flex-wrap items-center gap-2">

                        {{-- All --}}
                        <a
                            href="{{ route('admin.deliveries') }}"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold transition
                                {{ !request('status')
                                    ? 'bg-slate-900 text-white shadow-sm'
                                    : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-100' }}"
                        >
                            All
                        </a>


                        {{-- Pending --}}
                        <a
                            href="{{ route('admin.deliveries', ['status' => 'pending']) }}"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold transition
                                {{ request('status') === 'pending'
                                    ? 'bg-blue-600 text-white shadow-sm'
                                    : 'bg-white text-gray-600 border border-gray-200 hover:bg-blue-50 hover:text-blue-700' }}"
                        >

                            <span
                                class="w-2 h-2 rounded-full
                                    {{ request('status') === 'pending'
                                        ? 'bg-white'
                                        : 'bg-blue-500' }}"
                            ></span>

                            Pending

                        </a>


                        {{-- Accepted --}}
                        <a
                            href="{{ route('admin.deliveries', ['status' => 'accepted']) }}"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold transition
                                {{ request('status') === 'accepted'
                                    ? 'bg-amber-500 text-white shadow-sm'
                                    : 'bg-white text-gray-600 border border-gray-200 hover:bg-amber-50 hover:text-amber-700' }}"
                        >

                            <span
                                class="w-2 h-2 rounded-full
                                    {{ request('status') === 'accepted'
                                        ? 'bg-white'
                                        : 'bg-amber-500' }}"
                            ></span>

                            Accepted

                        </a>


                        {{-- Picked Up --}}
                        <a
                            href="{{ route('admin.deliveries', ['status' => 'picked_up']) }}"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold transition
                                {{ request('status') === 'picked_up'
                                    ? 'bg-purple-600 text-white shadow-sm'
                                    : 'bg-white text-gray-600 border border-gray-200 hover:bg-purple-50 hover:text-purple-700' }}"
                        >

                            <span
                                class="w-2 h-2 rounded-full
                                    {{ request('status') === 'picked_up'
                                        ? 'bg-white'
                                        : 'bg-purple-500' }}"
                            ></span>

                            Picked Up

                        </a>


                        {{-- Delivered --}}
                        <a
                            href="{{ route('admin.deliveries', ['status' => 'delivered']) }}"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold transition
                                {{ request('status') === 'delivered'
                                    ? 'bg-emerald-600 text-white shadow-sm'
                                    : 'bg-white text-gray-600 border border-gray-200 hover:bg-emerald-50 hover:text-emerald-700' }}"
                        >

                            <span
                                class="w-2 h-2 rounded-full
                                    {{ request('status') === 'delivered'
                                        ? 'bg-white'
                                        : 'bg-emerald-500' }}"
                            ></span>

                            Delivered

                        </a>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- TABLE --}}
                {{-- ================================================= --}}

                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead class="bg-slate-50 border-b border-gray-200">

                            <tr>

                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Delivery
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Donation
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Receiver
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Volunteer
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Status
                                </th>

                                <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-100">

                            @forelse ($deliveries as $delivery)

                                <tr class="hover:bg-slate-50/70 transition">


                                    {{-- Delivery ID --}}
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <div class="flex items-center gap-3">

                                            <div class="w-10 h-10 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center">

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
                                                        d="M3 7h11v10H3zM14 10h4l3 3v4h-7z"
                                                    />

                                                </svg>

                                            </div>

                                            <div>

                                                <p class="text-sm font-bold text-gray-900">
                                                    #{{ $delivery->id }}
                                                </p>

                                                <p class="text-xs text-gray-400">
                                                    Delivery
                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- Donation --}}
                                    <td class="px-6 py-4">

                                        <div class="max-w-[220px]">

                                            <p class="text-sm font-semibold text-gray-900 truncate">
                                                {{ $delivery->claim->foodDonation->title ?? 'N/A' }}
                                            </p>

                                            <p class="text-xs text-gray-400 mt-1">
                                                Claim #{{ $delivery->claim_id }}
                                            </p>

                                        </div>

                                    </td>


                                    {{-- Receiver --}}
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        @if ($delivery->claim && $delivery->claim->receiver)

                                            <div class="flex items-center gap-2">

                                                <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-xs font-bold">

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


                                    {{-- Volunteer --}}
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        @if ($delivery->volunteer)

                                            <div class="flex items-center gap-2">

                                                <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center text-xs font-bold">

                                                    {{ strtoupper(substr($delivery->volunteer->name, 0, 1)) }}

                                                </div>

                                                <span class="text-sm font-medium text-gray-800">
                                                    {{ $delivery->volunteer->name }}
                                                </span>

                                            </div>

                                        @else

                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-gray-100 text-gray-500 text-xs font-medium">

                                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>

                                                Not assigned

                                            </span>

                                        @endif

                                    </td>


                                    {{-- Status --}}
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        @if ($delivery->status === 'pending')

                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-semibold">

                                                <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>

                                                Pending

                                            </span>

                                        @elseif ($delivery->status === 'accepted')

                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-amber-50 text-amber-700 text-xs font-semibold">

                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>

                                                Accepted

                                            </span>

                                        @elseif ($delivery->status === 'picked_up')

                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-purple-50 text-purple-700 text-xs font-semibold">

                                                <span class="w-1.5 h-1.5 rounded-full bg-purple-500"></span>

                                                Picked Up

                                            </span>

                                        @elseif ($delivery->status === 'delivered')

                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold">

                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                                                Delivered

                                            </span>

                                        @else

                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-semibold">

                                                {{ ucfirst(str_replace('_', ' ', $delivery->status)) }}

                                            </span>

                                        @endif

                                    </td>


                                    {{-- Actions --}}
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <div class="flex items-center justify-end gap-2">

                                            {{-- View Details --}}
                                            <a
                                                href="{{ route('admin.deliveries.show', $delivery) }}"
                                                class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg bg-slate-100 text-slate-700 hover:bg-slate-200 text-xs font-semibold transition"
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

                                                Details

                                            </a>


                                            {{-- Release --}}
                                            @if (in_array($delivery->status, ['accepted', 'picked_up']))

                                                <form
                                                    action="{{ route('admin.deliveries.release', $delivery) }}"
                                                    method="POST"
                                                    class="inline"
                                                    onsubmit="return confirm('Release this delivery so another volunteer can take the job?');"
                                                >

                                                    @csrf

                                                    @method('PUT')

                                                    <button
                                                        type="submit"
                                                        class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg bg-orange-50 text-orange-700 hover:bg-orange-100 text-xs font-semibold transition"
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
                                                                d="M4 12h16M13 5l7 7-7 7"
                                                            />

                                                        </svg>

                                                        Release

                                                    </button>

                                                </form>

                                            @endif

                                        </div>

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td colspan="6" class="px-6 py-20">

                                        <div class="flex flex-col items-center text-center">

                                            <div class="w-16 h-16 rounded-2xl bg-orange-50 text-orange-500 flex items-center justify-center">

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
                                                        d="M3 7h11v10H3zM14 10h4l3 3v4h-7zM7 20a2 2 0 100-4 2 2 0 000 4zm10 0a2 2 0 100-4 2 2 0 000 4z"
                                                    />

                                                </svg>

                                            </div>


                                            <h4 class="mt-5 text-lg font-bold text-gray-900">
                                                No deliveries found
                                            </h4>


                                            <p class="mt-1 max-w-md text-sm text-gray-500">
                                                Delivery records will appear here when a delivery
                                                is created for a claimed donation.
                                            </p>


                                            @if (request('status'))

                                                <a
                                                    href="{{ route('admin.deliveries') }}"
                                                    class="mt-4 text-sm font-semibold text-orange-600 hover:text-orange-700"
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

                @if ($deliveries->hasPages())

                    <div class="px-6 py-4 border-t border-gray-100">

                        {{ $deliveries->withQueryString()->links() }}

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>