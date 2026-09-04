<x-app-layout>

    <x-slot name="header">

        <div>

            <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                Claim Details
            </h2>

            <p class="mt-1 text-sm text-emerald-800">
                View complete information about this claim.
            </p>

        </div>

    </x-slot>


    {{-- ================================================= --}}
    {{-- MAIN PAGE --}}
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
                                    d="M9 12h6m-6 4h4M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"
                                />

                            </svg>

                        </div>


                        <div>

                            <h3 class="text-xl font-bold text-gray-900">
                                Claim Details
                            </h3>

                            <p class="text-sm text-gray-600">
                                Claim #{{ $claim->id }}
                            </p>

                        </div>

                    </div>

                </div>



                {{-- ================================================= --}}
                {{-- CLAIM INFORMATION --}}
                {{-- ================================================= --}}

                <div class="p-6">

                    <div class="overflow-hidden rounded-xl border border-emerald-100">

                        <table class="min-w-full">

                            <tbody class="divide-y divide-emerald-100">


                                {{-- Donation --}}

                                <tr>

                                    <td
                                        class="py-4 px-4
                                               w-48
                                               font-semibold
                                               text-emerald-900
                                               bg-emerald-50"
                                    >
                                        Donation
                                    </td>

                                    <td class="py-4 px-4 text-gray-800">

                                        @if ($claim->foodDonation)

                                            {{ $claim->foodDonation->title }}

                                        @else

                                            <span class="text-sm text-gray-400 italic">
                                                Donation not available
                                            </span>

                                        @endif

                                    </td>

                                </tr>



                                {{-- Receiver --}}

                                <tr>

                                    <td
                                        class="py-4 px-4
                                               font-semibold
                                               text-emerald-900
                                               bg-emerald-50"
                                    >
                                        Receiver
                                    </td>

                                    <td class="py-4 px-4">

                                        @if ($claim->receiver)

                                            <div class="flex items-center gap-3">

                                                <div
                                                    class="w-9 h-9 rounded-lg
                                                           bg-blue-100
                                                           text-blue-700
                                                           border border-blue-200
                                                           flex items-center justify-center
                                                           text-sm font-bold"
                                                >

                                                    {{ strtoupper(substr($claim->receiver->name, 0, 1)) }}

                                                </div>

                                                <span class="text-gray-800">
                                                    {{ $claim->receiver->name }}
                                                </span>

                                            </div>

                                        @else

                                            <span class="text-sm text-gray-400 italic">
                                                Receiver not available
                                            </span>

                                        @endif

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

                                        @if ($claim->status === 'pending')

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

                                        @elseif ($claim->status === 'approved')

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

                                                Approved

                                            </span>

                                        @elseif ($claim->status === 'rejected')

                                            <span
                                                class="inline-flex items-center gap-1.5
                                                       px-3 py-1
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
                                                       px-3 py-1
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
                                                       px-3 py-1
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
                                                class="inline-flex items-center
                                                       px-3 py-1
                                                       rounded-full
                                                       bg-gray-100
                                                       text-gray-700
                                                       text-xs font-semibold"
                                            >

                                                {{ ucfirst(str_replace('_', ' ', $claim->status)) }}

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

                                        {{ $claim->created_at
                                            ? $claim->created_at->format('d M Y, h:i A')
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

                                        {{ $claim->updated_at
                                            ? $claim->updated_at->format('d M Y, h:i A')
                                            : 'N/A'
                                        }}

                                    </td>

                                </tr>


                            </tbody>

                        </table>

                    </div>



                    {{-- ================================================= --}}
                    {{-- ACTION BUTTONS --}}
                    {{-- ================================================= --}}

                    <div class="mt-8 flex flex-wrap gap-3">

                        <a
                            href="{{ route('admin.claims') }}"
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

                            ← Back to Claims

                        </a>


                        <a
                            href="{{ route('admin.claims.edit', $claim) }}"
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