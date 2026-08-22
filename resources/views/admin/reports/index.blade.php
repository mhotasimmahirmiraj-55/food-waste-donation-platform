<x-app-layout>

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                    Report Management
                </h2>

                <p class="mt-1 text-sm text-emerald-800">
                    Review and manage user reports and moderation issues.
                </p>

            </div>

            <div class="hidden sm:flex items-center gap-2 text-sm text-emerald-800">

                <span class="w-2 h-2 rounded-full bg-emerald-600"></span>

                Moderation Center

            </div>

        </div>

    </x-slot>


    {{-- ========================================================= --}}
    {{-- MAIN PAGE --}}
    {{-- Dark emerald theme matching the Donor module --}}
    {{-- ========================================================= --}}

    <div class="min-h-screen bg-gradient-to-br from-emerald-100 via-white to-green-100">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


            {{-- ========================================================= --}}
            {{-- PAGE HEADER --}}
            {{-- ========================================================= --}}

            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6">

                <div>

                    <h1 class="text-2xl font-bold text-gray-900">
                        Moderation Center
                    </h1>

                    <p class="mt-1 text-sm text-emerald-800">
                        Monitor reported users and resolve reported issues.
                    </p>

                </div>


                {{-- Total Reports --}}
                {{-- $reports comes from AdminReportController@index --}}

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



            {{-- ========================================================= --}}
            {{-- FLASH MESSAGES --}}
            {{-- ========================================================= --}}

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



            {{-- ========================================================= --}}
            {{-- REPORT CARD --}}
            {{-- ========================================================= --}}

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
                        Report Records
                    </h3>

                    <p class="mt-1 text-sm text-gray-600">
                        Review reports submitted by users.
                    </p>

                </div>



                {{-- ========================================================= --}}
                {{-- STATUS FILTERS --}}
                {{-- ========================================================= --}}

                <div
                    class="px-6 py-4
                           border-b border-emerald-200
                           bg-emerald-100/50"
                >

                    <div class="flex flex-wrap items-center gap-2">


                        {{-- All Reports --}}

                        <a
                            href="{{ route('admin.reports') }}"
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
                            href="{{ route('admin.reports', ['status' => 'pending']) }}"
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


                        {{-- Reviewed --}}

                        <a
                            href="{{ route('admin.reports', ['status' => 'reviewed']) }}"
                            class="inline-flex items-center gap-2
                                   px-4 py-2
                                   rounded-xl
                                   text-sm font-semibold
                                   transition
                                   {{
                                       request('status') === 'reviewed'
                                           ? 'bg-blue-700 text-white shadow-sm'
                                           : 'bg-white text-gray-600 border border-emerald-200 hover:bg-blue-50 hover:text-blue-700'
                                   }}"
                        >

                            <span
                                class="w-2 h-2 rounded-full
                                    {{
                                        request('status') === 'reviewed'
                                            ? 'bg-white'
                                            : 'bg-blue-500'
                                    }}"
                            ></span>

                            Reviewed

                        </a>


                        {{-- Resolved --}}

                        <a
                            href="{{ route('admin.reports', ['status' => 'resolved']) }}"
                            class="inline-flex items-center gap-2
                                   px-4 py-2
                                   rounded-xl
                                   text-sm font-semibold
                                   transition
                                   {{
                                       request('status') === 'resolved'
                                           ? 'bg-emerald-800 text-white shadow-sm'
                                           : 'bg-white text-gray-600 border border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700'
                                   }}"
                        >

                            <span
                                class="w-2 h-2 rounded-full
                                    {{
                                        request('status') === 'resolved'
                                            ? 'bg-white'
                                            : 'bg-emerald-600'
                                    }}"
                            ></span>

                            Resolved

                        </a>

                    </div>

                </div>



                {{-- ========================================================= --}}
                {{-- REPORT TABLE --}}
                {{-- ========================================================= --}}

                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead class="bg-emerald-900">

                            <tr>

                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-emerald-100">
                                    Report
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-emerald-100">
                                    Reporter
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-emerald-100">
                                    Reported User
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-emerald-100">
                                    Donation
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-emerald-100">
                                    Reason
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

                            @forelse ($reports as $report)

                                <tr class="hover:bg-emerald-50/70 transition">


                                    {{-- Report ID --}}

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

                                                <div
                                                    class="w-8 h-8 rounded-lg
                                                           bg-blue-100
                                                           text-blue-700
                                                           border border-blue-200
                                                           flex items-center justify-center
                                                           text-xs font-bold"
                                                >
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

                                                <div
                                                    class="w-8 h-8 rounded-lg
                                                           bg-red-100
                                                           text-red-700
                                                           border border-red-200
                                                           flex items-center justify-center
                                                           text-xs font-bold"
                                                >
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



                                    {{-- Donation --}}
                                    {{-- New donor report feature stores food_donation_id --}}

                                    <td class="px-6 py-4">

                                        @if ($report->foodDonation)

                                            <div class="max-w-[200px]">

                                                <p class="text-sm font-semibold text-gray-900 truncate">
                                                    {{ $report->foodDonation->title }}
                                                </p>

                                                <p class="text-xs text-emerald-700 mt-1">
                                                    Donation #{{ $report->foodDonation->id }}
                                                </p>

                                            </div>

                                        @else

                                            <span class="text-sm text-gray-400 italic">
                                                N/A
                                            </span>

                                        @endif

                                    </td>



                                    {{-- Reason --}}

                                    <td class="px-6 py-4">

                                        <div class="max-w-[240px]">

                                            <p
                                                class="text-sm text-gray-700 truncate"
                                                title="{{ $report->reason }}"
                                            >
                                                {{ $report->reason }}
                                            </p>

                                        </div>

                                    </td>



                                    {{-- Status --}}

                                    <td class="px-6 py-4 whitespace-nowrap">

                                        @if ($report->status === 'pending')

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

                                        @elseif ($report->status === 'reviewed')

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

                                                Reviewed

                                            </span>

                                        @elseif ($report->status === 'resolved')

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

                                                Resolved

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
                                                {{ ucfirst(str_replace('_', ' ', $report->status)) }}
                                            </span>

                                        @endif

                                    </td>



                                    {{-- Actions --}}

                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <div class="flex items-center justify-end gap-2">


                                            {{-- View button --}}
                                            {{-- Route sends the selected report to AdminReportController@show --}}

                                            <a
                                                href="{{ route('admin.reports.show', $report) }}"
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

                                                View

                                            </a>


                                            {{-- Edit button --}}
                                            {{-- Route opens AdminReportController@edit --}}

                                            <a
                                                href="{{ route('admin.reports.edit', $report) }}"
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

                                                Edit

                                            </a>

                                        </div>

                                    </td>

                                </tr>


                            @empty

                                {{-- Empty state when no report matches the filter --}}

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
                                                        d="M12 9v4m0 4h.01M5.07 19h13.86a2 2 0 001.73-3L13.73 4a2 2 0 00-3.46 0L3.34 16a2 2 0 001.73 3z"
                                                    />

                                                </svg>

                                            </div>


                                            <h4 class="mt-5 text-lg font-bold text-gray-900">
                                                No reports found
                                            </h4>


                                            <p class="mt-1 max-w-md text-sm text-gray-500">
                                                Reports will appear here when users submit an issue.
                                            </p>


                                            @if (request('status'))

                                                <a
                                                    href="{{ route('admin.reports') }}"
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



                {{-- ========================================================= --}}
                {{-- PAGINATION --}}
                {{-- ========================================================= --}}

                @if ($reports->hasPages())

                    <div
                        class="px-6 py-4
                               border-t border-emerald-200
                               bg-emerald-100/50"
                    >

                        {{-- Pagination is generated by Laravel --}}
                        {{ $reports->withQueryString()->links() }}

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>