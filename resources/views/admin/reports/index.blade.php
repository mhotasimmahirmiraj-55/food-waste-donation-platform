<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                    Report Management
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Review and manage user reports and moderation issues.
                </p>

            </div>

            <div class="hidden sm:flex items-center gap-2 text-sm text-gray-500">

                <span class="w-2 h-2 rounded-full bg-red-500"></span>

                Moderation Center

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
                        Moderation Center
                    </h1>

                    <p class="mt-1 text-sm text-gray-500">
                        Monitor reported users and resolve reported issues.
                    </p>

                </div>


                {{-- Total Reports --}}
                <div class="inline-flex items-center gap-3 bg-white border border-gray-200 rounded-2xl px-5 py-3 shadow-sm">

                    <div class="w-10 h-10 rounded-xl bg-red-50 text-red-600 flex items-center justify-center">

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
                                d="M12 9v4m0 4h.01M5.07 19h13.86a2 2 0 001.73-3L13.73 4a2 2 0 00-3.46 0L3.34 16a2 2 0 001.73 3z"
                            />

                        </svg>

                    </div>

                    <div>

                        <p class="text-xs font-medium text-gray-500">
                            Total Reports
                        </p>

                        <p class="text-xl font-bold text-gray-900">
                            {{ $reports->total() }}
                        </p>

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
            {{-- REPORT CARD --}}
            {{-- ================================================= --}}

            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">


                {{-- Card Header --}}
                <div class="px-6 py-5 border-b border-gray-100">

                    <div>

                        <h3 class="text-lg font-bold text-gray-900">
                            Report Records
                        </h3>

                        <p class="mt-1 text-sm text-gray-500">
                            Review reports submitted by users.
                        </p>

                    </div>

                </div>


                {{-- ================================================= --}}
                {{-- STATUS FILTERS --}}
                {{-- ================================================= --}}

                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/60">

                    <div class="flex flex-wrap items-center gap-2">


                        {{-- All --}}
                        <a
                            href="{{ route('admin.reports') }}"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold transition
                                {{ !request('status')
                                    ? 'bg-slate-900 text-white shadow-sm'
                                    : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-100' }}"
                        >
                            All
                        </a>


                        {{-- Pending --}}
                        <a
                            href="{{ route('admin.reports', ['status' => 'pending']) }}"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold transition
                                {{ request('status') === 'pending'
                                    ? 'bg-amber-500 text-white shadow-sm'
                                    : 'bg-white text-gray-600 border border-gray-200 hover:bg-amber-50 hover:text-amber-700' }}"
                        >

                            <span
                                class="w-2 h-2 rounded-full
                                    {{ request('status') === 'pending'
                                        ? 'bg-white'
                                        : 'bg-amber-500' }}"
                            ></span>

                            Pending

                        </a>


                        {{-- Reviewed --}}
                        <a
                            href="{{ route('admin.reports', ['status' => 'reviewed']) }}"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold transition
                                {{ request('status') === 'reviewed'
                                    ? 'bg-blue-600 text-white shadow-sm'
                                    : 'bg-white text-gray-600 border border-gray-200 hover:bg-blue-50 hover:text-blue-700' }}"
                        >

                            <span
                                class="w-2 h-2 rounded-full
                                    {{ request('status') === 'reviewed'
                                        ? 'bg-white'
                                        : 'bg-blue-500' }}"
                            ></span>

                            Reviewed

                        </a>


                        {{-- Resolved --}}
                        <a
                            href="{{ route('admin.reports', ['status' => 'resolved']) }}"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold transition
                                {{ request('status') === 'resolved'
                                    ? 'bg-emerald-600 text-white shadow-sm'
                                    : 'bg-white text-gray-600 border border-gray-200 hover:bg-emerald-50 hover:text-emerald-700' }}"
                        >

                            <span
                                class="w-2 h-2 rounded-full
                                    {{ request('status') === 'resolved'
                                        ? 'bg-white'
                                        : 'bg-emerald-500' }}"
                            ></span>

                            Resolved

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
                                    Report
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Reporter
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Reported User
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Reason
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

                            @forelse ($reports as $report)

                                <tr class="hover:bg-slate-50/70 transition">


                                    {{-- Report ID --}}
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <div class="flex items-center gap-3">

                                            <div class="w-10 h-10 rounded-xl bg-red-50 text-red-600 flex items-center justify-center">

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
                                                        d="M12 9v4m0 4h.01M5.07 19h13.86a2 2 0 001.73-3L13.73 4a2 2 0 00-3.46 0L3.34 16a2 2 0 001.73 3z"
                                                    />

                                                </svg>

                                            </div>


                                            <div>

                                                <p class="text-sm font-bold text-gray-900">
                                                    #{{ $report->id }}
                                                </p>

                                                <p class="text-xs text-gray-400">
                                                    Report
                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- Reporter --}}
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        @if ($report->reporter)

                                            <div class="flex items-center gap-2">

                                                <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-xs font-bold">

                                                    {{ strtoupper(substr($report->reporter->name, 0, 1)) }}

                                                </div>

                                                <span class="text-sm font-medium text-gray-800">
                                                    {{ $report->reporter->name }}
                                                </span>

                                            </div>

                                        @else

                                            <span class="text-sm text-gray-400 italic">
                                                N/A
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Reported User --}}
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        @if ($report->reportedUser)

                                            <div class="flex items-center gap-2">

                                                <div class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center text-xs font-bold">

                                                    {{ strtoupper(substr($report->reportedUser->name, 0, 1)) }}

                                                </div>

                                                <span class="text-sm font-medium text-gray-800">
                                                    {{ $report->reportedUser->name }}
                                                </span>

                                            </div>

                                        @else

                                            <span class="text-sm text-gray-400 italic">
                                                N/A
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Reason --}}
                                    <td class="px-6 py-4">

                                        <div class="max-w-[280px]">

                                            <p class="text-sm text-gray-700 truncate">
                                                {{ $report->reason }}
                                            </p>

                                        </div>

                                    </td>


                                    {{-- Status --}}
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        @if ($report->status === 'pending')

                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-amber-50 text-amber-700 text-xs font-semibold">

                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>

                                                Pending

                                            </span>

                                        @elseif ($report->status === 'reviewed')

                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-semibold">

                                                <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>

                                                Reviewed

                                            </span>

                                        @elseif ($report->status === 'resolved')

                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold">

                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                                                Resolved

                                            </span>

                                        @else

                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-semibold">

                                                {{ ucfirst(str_replace('_', ' ', $report->status)) }}

                                            </span>

                                        @endif

                                    </td>


                                    {{-- Actions --}}
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <div class="flex items-center justify-end gap-2">

                                            {{-- View --}}
                                            <a
                                                href="{{ route('admin.reports.show', $report) }}"
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

                                                View

                                            </a>


                                            {{-- Edit --}}
                                            <a
                                                href="{{ route('admin.reports.edit', $report) }}"
                                                class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg bg-red-50 text-red-700 hover:bg-red-100 text-xs font-semibold transition"
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

                                {{-- Empty State --}}
                                <tr>

                                    <td colspan="6" class="px-6 py-20">

                                        <div class="flex flex-col items-center text-center">

                                            <div class="w-16 h-16 rounded-2xl bg-red-50 text-red-500 flex items-center justify-center">

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
                                                        d="M12 9v4m0 4h.01M5.07 19h13.86a2 2 0 001.73-3L13.73 4a2 2 0 00-3.46 0L3.34 16a2 2 0 001.73 3z"
                                                    />

                                                </svg>

                                            </div>


                                            <h4 class="mt-5 text-lg font-bold text-gray-900">
                                                No reports found
                                            </h4>


                                            <p class="mt-1 max-w-md text-sm text-gray-500">
                                                User reports will appear here when an issue is reported.
                                            </p>


                                            @if (request('status'))

                                                <a
                                                    href="{{ route('admin.reports') }}"
                                                    class="mt-4 text-sm font-semibold text-red-600 hover:text-red-700"
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

                @if ($reports->hasPages())

                    <div class="px-6 py-4 border-t border-gray-100">

                        {{ $reports->withQueryString()->links() }}

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>