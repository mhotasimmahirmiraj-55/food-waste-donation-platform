<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                    Delivery Details
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    View delivery information and track its progress.
                </p>

            </div>


            <a
                href="{{ route('admin.deliveries') }}"
                class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white border border-gray-200 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition shadow-sm"
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
                        d="M15 18l-6-6 6-6"
                    />

                </svg>

                Back to Deliveries

            </a>

        </div>

    </x-slot>


    <div class="min-h-screen bg-slate-50">

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


            {{-- ================================================= --}}
            {{-- TOP DELIVERY SUMMARY --}}
            {{-- ================================================= --}}

            <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-orange-900 rounded-2xl shadow-xl overflow-hidden mb-8">

                <div class="px-6 py-8 sm:px-8">

                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">


                        <div class="flex items-center gap-4">

                            <div class="w-14 h-14 rounded-2xl bg-white/10 border border-white/10 text-orange-300 flex items-center justify-center">

                                <svg
                                    class="w-7 h-7"
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

                                <p class="text-xs font-semibold uppercase tracking-wider text-orange-300">
                                    Delivery
                                </p>

                                <h1 class="mt-1 text-3xl font-bold text-white">
                                    #{{ $delivery->id }}
                                </h1>

                                <p class="mt-1 text-sm text-slate-300">
                                    Claim #{{ $delivery->claim_id }}
                                </p>

                            </div>

                        </div>


                        {{-- Status --}}
                        <div>

                            @if ($delivery->status === 'pending')

                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-500/20 border border-blue-400/20 text-blue-200 text-sm font-semibold">

                                    <span class="w-2 h-2 rounded-full bg-blue-400"></span>

                                    Pending

                                </span>

                            @elseif ($delivery->status === 'accepted')

                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-amber-500/20 border border-amber-400/20 text-amber-200 text-sm font-semibold">

                                    <span class="w-2 h-2 rounded-full bg-amber-400"></span>

                                    Accepted

                                </span>

                            @elseif ($delivery->status === 'picked_up')

                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-purple-500/20 border border-purple-400/20 text-purple-200 text-sm font-semibold">

                                    <span class="w-2 h-2 rounded-full bg-purple-400"></span>

                                    Picked Up

                                </span>

                            @elseif ($delivery->status === 'delivered')

                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-500/20 border border-emerald-400/20 text-emerald-200 text-sm font-semibold">

                                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>

                                    Delivered

                                </span>

                            @else

                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/10 text-white text-sm font-semibold">

                                    {{ ucfirst(str_replace('_', ' ', $delivery->status)) }}

                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- FLASH MESSAGES --}}
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
            {{-- INFORMATION GRID --}}
            {{-- ================================================= --}}

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">


                {{-- Donation Information --}}
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">

                    <div class="px-6 py-5 border-b border-gray-100">

                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-xl bg-green-50 text-green-600 flex items-center justify-center">

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
                                        d="M3 7h18M5 7l1 12h12l1-12M9 7V5a3 3 0 016 0v2"
                                    />

                                </svg>

                            </div>

                            <div>

                                <h3 class="font-bold text-gray-900">
                                    Donation
                                </h3>

                                <p class="text-xs text-gray-500">
                                    Food being delivered
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-6">

                        <p class="text-lg font-bold text-gray-900">
                            {{ $delivery->claim->foodDonation->title ?? 'N/A' }}
                        </p>

                        <p class="mt-2 text-sm text-gray-500">
                            Claim #{{ $delivery->claim_id }}
                        </p>

                    </div>

                </div>


                {{-- Receiver Information --}}
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">

                    <div class="px-6 py-5 border-b border-gray-100">

                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">

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
                                        d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 100-8 4 4 0 000 8z"
                                    />

                                </svg>

                            </div>

                            <div>

                                <h3 class="font-bold text-gray-900">
                                    Receiver
                                </h3>

                                <p class="text-xs text-gray-500">
                                    Donation recipient
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-6">

                        @if ($delivery->claim && $delivery->claim->receiver)

                            <div class="flex items-center gap-4">

                                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center font-bold">

                                    {{ strtoupper(substr($delivery->claim->receiver->name, 0, 1)) }}

                                </div>

                                <div>

                                    <p class="text-lg font-bold text-gray-900">
                                        {{ $delivery->claim->receiver->name }}
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        Receiver
                                    </p>

                                </div>

                            </div>

                        @else

                            <p class="text-sm text-gray-400 italic">
                                Receiver information unavailable.
                            </p>

                        @endif

                    </div>

                </div>


                {{-- Volunteer Information --}}
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">

                    <div class="px-6 py-5 border-b border-gray-100">

                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">

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
                                        d="M12 12a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 0114 0"
                                    />

                                </svg>

                            </div>

                            <div>

                                <h3 class="font-bold text-gray-900">
                                    Volunteer
                                </h3>

                                <p class="text-xs text-gray-500">
                                    Assigned delivery volunteer
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-6">

                        @if ($delivery->volunteer)

                            <div class="flex items-center gap-4">

                                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center font-bold">

                                    {{ strtoupper(substr($delivery->volunteer->name, 0, 1)) }}

                                </div>

                                <div>

                                    <p class="text-lg font-bold text-gray-900">
                                        {{ $delivery->volunteer->name }}
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        Assigned volunteer
                                    </p>

                                </div>

                            </div>

                        @else

                            <div class="flex items-center gap-3">

                                <span class="w-10 h-10 rounded-xl bg-gray-100 text-gray-400 flex items-center justify-center">

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
                                            d="M12 9v4m0 4h.01"
                                        />

                                    </svg>

                                </span>

                                <div>

                                    <p class="font-semibold text-gray-700">
                                        Not assigned
                                    </p>

                                    <p class="text-xs text-gray-400">
                                        Waiting for a volunteer
                                    </p>

                                </div>

                            </div>

                        @endif

                    </div>

                </div>


                {{-- Delivery Status --}}
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">

                    <div class="px-6 py-5 border-b border-gray-100">

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
                                        d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />

                                </svg>

                            </div>

                            <div>

                                <h3 class="font-bold text-gray-900">
                                    Current Status
                                </h3>

                                <p class="text-xs text-gray-500">
                                    Latest delivery state
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-6">

                        @if ($delivery->status === 'pending')

                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-50 text-blue-700 text-sm font-semibold">
                                <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                                Pending
                            </span>

                        @elseif ($delivery->status === 'accepted')

                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-amber-50 text-amber-700 text-sm font-semibold">
                                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                Accepted
                            </span>

                        @elseif ($delivery->status === 'picked_up')

                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-purple-50 text-purple-700 text-sm font-semibold">
                                <span class="w-2 h-2 rounded-full bg-purple-500"></span>
                                Picked Up
                            </span>

                        @elseif ($delivery->status === 'delivered')

                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-50 text-emerald-700 text-sm font-semibold">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                Delivered
                            </span>

                        @else

                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-gray-100 text-gray-700 text-sm font-semibold">
                                {{ ucfirst(str_replace('_', ' ', $delivery->status)) }}
                            </span>

                        @endif

                    </div>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- DELIVERY TIMELINE --}}
            {{-- ================================================= --}}

            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mb-6">

                <div class="px-6 py-5 border-b border-gray-100">

                    <h3 class="text-lg font-bold text-gray-900">
                        Delivery Timeline
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Track the progress of this delivery.
                    </p>

                </div>


                <div class="p-6">

                    <div class="space-y-6">


                        {{-- Created --}}
                        <div class="flex gap-4">

                            <div class="flex flex-col items-center">

                                <div class="w-10 h-10 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center">

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
                                            d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"
                                        />

                                    </svg>

                                </div>

                                <div class="w-px flex-1 bg-gray-200 mt-2"></div>

                            </div>


                            <div class="pb-2">

                                <p class="font-semibold text-gray-900">
                                    Delivery Created
                                </p>

                                <p class="text-sm text-gray-500 mt-1">
                                    {{ $delivery->created_at?->format('M d, Y · h:i A') ?? 'N/A' }}
                                </p>

                            </div>

                        </div>


                        {{-- Accepted --}}
                        <div class="flex gap-4">

                            <div class="flex flex-col items-center">

                                <div class="w-10 h-10 rounded-full
                                    {{ $delivery->accepted_at
                                        ? 'bg-amber-50 text-amber-600'
                                        : 'bg-gray-100 text-gray-400' }}
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
                                            d="M5 13l4 4L19 7"
                                        />

                                    </svg>

                                </div>

                                <div class="w-px flex-1 bg-gray-200 mt-2"></div>

                            </div>


                            <div class="pb-2">

                                <p class="font-semibold text-gray-900">
                                    Accepted
                                </p>

                                <p class="text-sm text-gray-500 mt-1">

                                    @if ($delivery->accepted_at)
                                        {{ \Carbon\Carbon::parse($delivery->accepted_at)->format('M d, Y · h:i A') }}
                                    @else
                                        Not yet accepted
                                    @endif

                                </p>

                            </div>

                        </div>


                        {{-- Picked Up --}}
                        <div class="flex gap-4">

                            <div class="flex flex-col items-center">

                                <div class="w-10 h-10 rounded-full
                                    {{ $delivery->picked_up_at
                                        ? 'bg-purple-50 text-purple-600'
                                        : 'bg-gray-100 text-gray-400' }}
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
                                            d="M3 7h11v10H3zM14 10h4l3 3v4h-7z"
                                        />

                                    </svg>

                                </div>

                                <div class="w-px flex-1 bg-gray-200 mt-2"></div>

                            </div>


                            <div class="pb-2">

                                <p class="font-semibold text-gray-900">
                                    Picked Up
                                </p>

                                <p class="text-sm text-gray-500 mt-1">

                                    @if ($delivery->picked_up_at)
                                        {{ \Carbon\Carbon::parse($delivery->picked_up_at)->format('M d, Y · h:i A') }}
                                    @else
                                        Not yet picked up
                                    @endif

                                </p>

                            </div>

                        </div>


                        {{-- Delivered --}}
                        <div class="flex gap-4">

                            <div class="flex flex-col items-center">

                                <div class="w-10 h-10 rounded-full
                                    {{ $delivery->delivered_at
                                        ? 'bg-emerald-50 text-emerald-600'
                                        : 'bg-gray-100 text-gray-400' }}
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
                                            d="M5 13l4 4L19 7"
                                        />

                                    </svg>

                                </div>

                            </div>


                            <div>

                                <p class="font-semibold text-gray-900">
                                    Delivered
                                </p>

                                <p class="text-sm text-gray-500 mt-1">

                                    @if ($delivery->delivered_at)
                                        {{ \Carbon\Carbon::parse($delivery->delivered_at)->format('M d, Y · h:i A') }}
                                    @else
                                        Not yet delivered
                                    @endif

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- ADMIN ACTIONS --}}
            {{-- ================================================= --}}

            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mb-6">

                <div class="px-6 py-5 border-b border-gray-100">

                    <h3 class="text-lg font-bold text-gray-900">
                        Administrative Actions
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Manage this delivery when intervention is required.
                    </p>

                </div>


                <div class="p-6">

                    @if (in_array($delivery->status, ['accepted', 'picked_up']))

                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                            <div>

                                <p class="font-semibold text-gray-900">
                                    Volunteer unable to complete delivery?
                                </p>

                                <p class="mt-1 text-sm text-gray-500">
                                    Release this delivery so another volunteer can take the job.
                                </p>

                            </div>


                            <form
                                action="{{ route('admin.deliveries.release', $delivery) }}"
                                method="POST"
                                onsubmit="return confirm('Release this delivery so another volunteer can take the job?');"
                            >

                                @csrf

                                @method('PUT')

                                <button
                                    type="submit"
                                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-orange-50 text-orange-700 hover:bg-orange-100 border border-orange-200 text-sm font-semibold transition"
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
                                            d="M4 12h16M13 5l7 7-7 7"
                                        />

                                    </svg>

                                    Release Delivery

                                </button>

                            </form>

                        </div>

                    @elseif ($delivery->status === 'pending')

                        <div class="flex items-center gap-3 rounded-xl bg-blue-50 border border-blue-100 p-4">

                            <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">

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
                                        d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />

                                </svg>

                            </div>

                            <div>

                                <p class="font-semibold text-blue-900">
                                    Waiting for a volunteer
                                </p>

                                <p class="text-sm text-blue-700 mt-1">
                                    This delivery is currently available for a volunteer to accept.
                                </p>

                            </div>

                        </div>

                    @elseif ($delivery->status === 'delivered')

                        <div class="flex items-center gap-3 rounded-xl bg-emerald-50 border border-emerald-100 p-4">

                            <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">

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
                                        d="M5 13l4 4L19 7"
                                    />

                                </svg>

                            </div>

                            <div>

                                <p class="font-semibold text-emerald-900">
                                    Delivery completed
                                </p>

                                <p class="text-sm text-emerald-700 mt-1">
                                    This delivery has been successfully completed.
                                </p>

                            </div>

                        </div>

                    @endif

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- MOBILE BACK BUTTON --}}
            {{-- ================================================= --}}

            <div class="sm:hidden">

                <a
                    href="{{ route('admin.deliveries') }}"
                    class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-slate-900 text-white text-sm font-semibold hover:bg-slate-800 transition"
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
                            d="M15 18l-6-6 6-6"
                        />

                    </svg>

                    Back to Deliveries

                </a>

            </div>

        </div>

    </div>

</x-app-layout>