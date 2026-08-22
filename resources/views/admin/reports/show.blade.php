<x-app-layout>

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <x-slot name="header">

        <div>

            <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                Report Details
            </h2>

            <p class="mt-1 text-sm text-emerald-800">
                Review the complete report and associated donation.
            </p>

        </div>

    </x-slot>



    {{-- ========================================================= --}}
    {{-- MAIN PAGE --}}
    {{-- ========================================================= --}}

    <div class="min-h-screen bg-gradient-to-br from-emerald-100 via-white to-green-100">

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


            {{-- ========================================================= --}}
            {{-- DETAILS CARD --}}
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
                                    d="M12 9v4m0 4h.01M5.07 19h13.86a2 2 0 001.73-3L13.73 4a2 2 0 00-3.46 0L3.34 16a2 2 0 001.73 3z"
                                />

                            </svg>

                        </div>


                        <div>

                            <h3 class="text-xl font-bold text-gray-900">
                                Report #{{ $report->id }}
                            </h3>

                            <p class="text-sm text-gray-600">
                                Report investigation details
                            </p>

                        </div>

                    </div>

                </div>



                {{-- ========================================================= --}}
                {{-- REPORT INFORMATION --}}
                {{-- ========================================================= --}}

                <div class="p-6">

                    <div class="overflow-hidden rounded-xl border border-emerald-100">

                        <table class="min-w-full">

                            <tbody class="divide-y divide-emerald-100">


                                {{-- Reporter --}}

                                <tr>

                                    <td
                                        class="py-4 px-4
                                               w-48
                                               font-semibold
                                               text-emerald-900
                                               bg-emerald-50"
                                    >
                                        Reporter
                                    </td>

                                    <td class="py-4 px-4">

                                        @if ($report->reporter)

                                            <div class="flex items-center gap-3">

                                                <div
                                                    class="w-9 h-9 rounded-lg
                                                           bg-blue-100
                                                           text-blue-700
                                                           border border-blue-200
                                                           flex items-center justify-center
                                                           text-sm font-bold"
                                                >

                                                    {{ strtoupper(substr($report->reporter->name, 0, 1)) }}

                                                </div>

                                                <span class="text-gray-800">
                                                    {{ $report->reporter->name }}
                                                </span>

                                            </div>

                                        @else

                                            <span class="text-gray-400 italic">
                                                Reporter not available
                                            </span>

                                        @endif

                                    </td>

                                </tr>



                                {{-- Reported User --}}

                                <tr>

                                    <td
                                        class="py-4 px-4
                                               font-semibold
                                               text-emerald-900
                                               bg-emerald-50"
                                    >
                                        Reported User
                                    </td>

                                    <td class="py-4 px-4">

                                        @if ($report->reportedUser)

                                            <div class="flex items-center gap-3">

                                                <div
                                                    class="w-9 h-9 rounded-lg
                                                           bg-red-100
                                                           text-red-700
                                                           border border-red-200
                                                           flex items-center justify-center
                                                           text-sm font-bold"
                                                >

                                                    {{ strtoupper(substr($report->reportedUser->name, 0, 1)) }}

                                                </div>

                                                <span class="text-gray-800">
                                                    {{ $report->reportedUser->name }}
                                                </span>

                                            </div>

                                        @else

                                            <span class="text-gray-400 italic">
                                                Reported user not available
                                            </span>

                                        @endif

                                    </td>

                                </tr>



                                {{-- Donation --}}

                                <tr>

                                    <td
                                        class="py-4 px-4
                                               font-semibold
                                               text-emerald-900
                                               bg-emerald-50"
                                    >
                                        Donation
                                    </td>

                                    <td class="py-4 px-4">

                                        @if ($report->foodDonation)

                                            <div>

                                                <p class="font-semibold text-gray-900">
                                                    {{ $report->foodDonation->title }}
                                                </p>

                                                <p class="mt-1 text-xs text-emerald-700">
                                                    Donation #{{ $report->foodDonation->id }}
                                                </p>

                                                @if ($report->foodDonation->status)

                                                    <span
                                                        class="inline-flex mt-2
                                                               px-2.5 py-1
                                                               rounded-full
                                                               bg-red-100
                                                               text-red-800
                                                               border border-red-200
                                                               text-xs font-semibold"
                                                    >

                                                        {{ ucfirst($report->foodDonation->status) }}

                                                    </span>

                                                @endif

                                            </div>

                                        @else

                                            <span class="text-gray-400 italic">
                                                Donation not available
                                            </span>

                                        @endif

                                    </td>

                                </tr>



                                {{-- Reason --}}

                                <tr class="align-top">

                                    <td
                                        class="py-4 px-4
                                               font-semibold
                                               text-emerald-900
                                               bg-emerald-50"
                                    >
                                        Reason
                                    </td>

                                    <td class="py-4 px-4 text-gray-800">

                                        <div
                                            class="rounded-xl
                                                   bg-gray-50
                                                   border border-gray-200
                                                   px-4 py-3
                                                   leading-relaxed"
                                        >

                                            {{ $report->reason ?: 'No reason provided.' }}

                                        </div>

                                    </td>

                                </tr>



                                {{-- Status --}}

                                <tr>

                                    <td
                                        class="py-4 px-4
                                               font-semibold
                                               text-emerald-900
                                               bg-emerald-50"
                                    >
                                        Status
                                    </td>

                                    <td class="py-4 px-4">

                                        @if ($report->status === 'pending')

                                            <span
                                                class="inline-flex items-center gap-1.5
                                                       px-3 py-1
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
                                                       px-3 py-1
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
                                                       px-3 py-1
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
                                                class="inline-flex px-3 py-1
                                                       rounded-full
                                                       bg-gray-100
                                                       text-gray-700
                                                       text-xs font-semibold"
                                            >

                                                {{ ucfirst($report->status) }}

                                            </span>

                                        @endif

                                    </td>

                                </tr>



                                {{-- Created At --}}

                                <tr>

                                    <td
                                        class="py-4 px-4
                                               font-semibold
                                               text-emerald-900
                                               bg-emerald-50"
                                    >
                                        Created At
                                    </td>

                                    <td class="py-4 px-4 text-gray-800">

                                        {{ $report->created_at
                                            ? $report->created_at->format('d M Y, h:i A')
                                            : 'N/A'
                                        }}

                                    </td>

                                </tr>



                                {{-- Updated At --}}

                                <tr>

                                    <td
                                        class="py-4 px-4
                                               font-semibold
                                               text-emerald-900
                                               bg-emerald-50"
                                    >
                                        Last Updated
                                    </td>

                                    <td class="py-4 px-4 text-gray-800">

                                        {{ $report->updated_at
                                            ? $report->updated_at->format('d M Y, h:i A')
                                            : 'N/A'
                                        }}

                                    </td>

                                </tr>


                            </tbody>

                        </table>

                    </div>



                    {{-- ========================================================= --}}
                    {{-- ACTIONS --}}
                    {{-- ========================================================= --}}

                    <div class="mt-8 flex flex-wrap gap-3">

                        <a
                            href="{{ route('admin.reports') }}"
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

                            ← Back to Reports

                        </a>


                        <a
                            href="{{ route('admin.reports.edit', $report) }}"
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

                            Edit Status

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>