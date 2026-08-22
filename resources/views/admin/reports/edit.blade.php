<x-app-layout>

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <x-slot name="header">

        <div>

            <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                Edit Report Status
            </h2>

            <p class="mt-1 text-sm text-emerald-800">
                Update the moderation status of this report.
            </p>

        </div>

    </x-slot>



    {{-- ========================================================= --}}
    {{-- MAIN PAGE --}}
    {{-- ========================================================= --}}

    <div class="min-h-screen bg-gradient-to-br from-emerald-100 via-white to-green-100">

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


            {{-- ========================================================= --}}
            {{-- EDIT CARD --}}
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
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M16.5 3.5a2.12 2.12 0 013 3L10 16l-4 1 1-4 9.5-9.5z"
                                />

                            </svg>

                        </div>


                        <div>

                            <h3 class="text-xl font-bold text-gray-900">
                                Edit Report Status
                            </h3>

                            <p class="text-sm text-gray-600">
                                Report #{{ $report->id }}
                            </p>

                        </div>

                    </div>

                </div>



                {{-- ========================================================= --}}
                {{-- FORM --}}
                {{-- ========================================================= --}}

                <form
                    action="{{ route('admin.reports.update', $report) }}"
                    method="POST"
                    class="p-6"
                >

                    @csrf

                    {{-- PUT tells Laravel this form updates an existing report --}}
                    @method('PUT')



                    {{-- ========================================================= --}}
                    {{-- REPORTER --}}
                    {{-- ========================================================= --}}

                    <div class="mb-6">

                        <label class="block text-sm font-semibold text-emerald-900">
                            Reporter
                        </label>

                        <input
                            type="text"
                            value="{{ $report->reporter->name ?? 'Reporter not available' }}"
                            class="mt-2 block w-full
                                   rounded-xl
                                   border-emerald-200
                                   bg-emerald-50
                                   text-gray-700
                                   shadow-sm"
                            readonly
                        >

                    </div>



                    {{-- ========================================================= --}}
                    {{-- REPORTED USER --}}
                    {{-- ========================================================= --}}

                    <div class="mb-6">

                        <label class="block text-sm font-semibold text-emerald-900">
                            Reported User
                        </label>

                        <input
                            type="text"
                            value="{{ $report->reportedUser->name ?? 'Reported user not available' }}"
                            class="mt-2 block w-full
                                   rounded-xl
                                   border-emerald-200
                                   bg-emerald-50
                                   text-gray-700
                                   shadow-sm"
                            readonly
                        >

                    </div>



                    {{-- ========================================================= --}}
                    {{-- DONATION --}}
                    {{-- ========================================================= --}}

                    <div class="mb-6">

                        <label class="block text-sm font-semibold text-emerald-900">
                            Donation
                        </label>

                        <input
                            type="text"
                            value="{{ $report->foodDonation->title ?? 'Donation not available' }}"
                            class="mt-2 block w-full
                                   rounded-xl
                                   border-emerald-200
                                   bg-emerald-50
                                   text-gray-700
                                   shadow-sm"
                            readonly
                        >

                        @if ($report->foodDonation)

                            <p class="mt-1 text-xs text-emerald-700">
                                Donation #{{ $report->foodDonation->id }}
                            </p>

                        @endif

                    </div>



                    {{-- ========================================================= --}}
                    {{-- REASON --}}
                    {{-- ========================================================= --}}

                    <div class="mb-6">

                        <label class="block text-sm font-semibold text-emerald-900">
                            Reason
                        </label>

                        <textarea
                            rows="5"
                            class="mt-2 block w-full
                                   rounded-xl
                                   border-emerald-200
                                   bg-emerald-50
                                   text-gray-700
                                   shadow-sm"
                            readonly
                        >{{ $report->reason }}</textarea>

                    </div>



                    {{-- ========================================================= --}}
                    {{-- STATUS --}}
                    {{-- ========================================================= --}}

                    <div class="mb-6">

                        <label
                            for="status"
                            class="block text-sm font-semibold text-emerald-900"
                        >
                            Report Status
                        </label>

                        <p class="mt-1 text-xs text-gray-500">
                            Select the current moderation status.
                        </p>


                        <select
                            id="status"
                            name="status"
                            class="mt-2 block w-full
                                   rounded-xl
                                   border-emerald-200
                                   focus:border-emerald-500
                                   focus:ring-emerald-500
                                   shadow-sm"
                        >

                            <option
                                value="pending"
                                @selected($report->status === 'pending')
                            >
                                Pending
                            </option>


                            <option
                                value="reviewed"
                                @selected($report->status === 'reviewed')
                            >
                                Reviewed
                            </option>


                            <option
                                value="resolved"
                                @selected($report->status === 'resolved')
                            >
                                Resolved
                            </option>

                        </select>


                        @error('status')

                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>



                    {{-- ========================================================= --}}
                    {{-- ACTION BUTTONS --}}
                    {{-- ========================================================= --}}

                    <div class="mt-8 flex flex-wrap items-center gap-3">

                        <button
                            type="submit"
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

                            Update Status

                        </button>


                        <a
                            href="{{ route('admin.reports') }}"
                            class="inline-flex items-center
                                   px-5 py-2.5
                                   rounded-xl
                                   bg-gray-100
                                   text-gray-700
                                   font-semibold
                                   hover:bg-gray-200
                                   transition"
                        >

                            Cancel

                        </a>

                    </div>

                </form>

            </div>



            {{-- ========================================================= --}}
            {{-- ADMIN INFORMATION --}}
            {{-- ========================================================= --}}

            <div
                class="mt-6
                       rounded-2xl
                       border border-emerald-200
                       bg-emerald-100/70
                       px-5 py-4"
            >

                <div class="flex items-start gap-3">

                    <div
                        class="w-9 h-9 rounded-lg
                               bg-emerald-200
                               text-emerald-800
                               flex items-center justify-center
                               flex-shrink-0"
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
                                d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z"
                            />

                        </svg>

                    </div>


                    <div>

                        <p class="text-sm font-semibold text-emerald-900">
                            Moderation status
                        </p>

                        <p class="mt-1 text-sm text-emerald-800">
                            Use Pending when the report has not been reviewed,
                            Reviewed when the admin has inspected it, and
                            Resolved when the issue has been handled.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>