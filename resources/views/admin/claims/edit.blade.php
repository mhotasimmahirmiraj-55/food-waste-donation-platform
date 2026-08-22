<x-app-layout>

    <x-slot name="header">

        <div>

            <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                Edit Claim Status
            </h2>

            <p class="mt-1 text-sm text-emerald-800">
                Update the current status of this donation claim.
            </p>

        </div>

    </x-slot>


    {{-- ================================================= --}}
    {{-- MAIN PAGE --}}
    {{-- ================================================= --}}

    <div class="min-h-screen bg-gradient-to-br from-emerald-100 via-white to-green-100">

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


            {{-- ================================================= --}}
            {{-- EDIT CARD --}}
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
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M16.5 3.5a2.12 2.12 0 013 3L10 16l-4 1 1-4 9.5-9.5z"
                                />

                            </svg>

                        </div>


                        <div>

                            <h3 class="text-xl font-bold text-gray-900">
                                Edit Claim Status
                            </h3>

                            <p class="text-sm text-gray-600">
                                Claim #{{ $claim->id }}
                            </p>

                        </div>

                    </div>

                </div>



                {{-- ================================================= --}}
                {{-- FORM --}}
                {{-- ================================================= --}}

                <form
                    action="{{ route('admin.claims.update', $claim) }}"
                    method="POST"
                    class="p-6"
                >

                    @csrf
                    @method('PUT')



                    {{-- ================================================= --}}
                    {{-- DONATION --}}
                    {{-- ================================================= --}}

                    <div class="mb-6">

                        <label
                            class="block text-sm font-semibold text-emerald-900"
                        >
                            Donation
                        </label>


                        <input
                            type="text"
                            value="{{ $claim->foodDonation->title ?? 'Donation not available' }}"
                            class="mt-2 block w-full
                                   rounded-xl
                                   border-emerald-200
                                   bg-emerald-50
                                   text-gray-700
                                   shadow-sm"
                            readonly
                        >

                    </div>



                    {{-- ================================================= --}}
                    {{-- RECEIVER --}}
                    {{-- ================================================= --}}

                    <div class="mb-6">

                        <label
                            class="block text-sm font-semibold text-emerald-900"
                        >
                            Receiver
                        </label>


                        <input
                            type="text"
                            value="{{ $claim->receiver->name ?? 'Receiver not available' }}"
                            class="mt-2 block w-full
                                   rounded-xl
                                   border-emerald-200
                                   bg-emerald-50
                                   text-gray-700
                                   shadow-sm"
                            readonly
                        >

                    </div>



                    {{-- ================================================= --}}
                    {{-- STATUS --}}
                    {{-- ================================================= --}}

                    <div class="mb-6">

                        <label
                            for="status"
                            class="block text-sm font-semibold text-emerald-900"
                        >
                            Claim Status
                        </label>


                        <p class="mt-1 text-xs text-gray-500">
                            Select the new status for this claim.
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
                                @selected($claim->status === 'pending')
                            >
                                Pending
                            </option>


                            <option
                                value="approved"
                                @selected($claim->status === 'approved')
                            >
                                Approved
                            </option>


                            <option
                                value="rejected"
                                @selected($claim->status === 'rejected')
                            >
                                Rejected
                            </option>


                            <option
                                value="completed"
                                @selected($claim->status === 'completed')
                            >
                                Completed
                            </option>


                            <option
                                value="cancelled"
                                @selected($claim->status === 'cancelled')
                            >
                                Cancelled
                            </option>

                        </select>


                        @error('status')

                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>



                    {{-- ================================================= --}}
                    {{-- ACTIONS --}}
                    {{-- ================================================= --}}

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
                            href="{{ route('admin.claims') }}"
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



            {{-- ================================================= --}}
            {{-- INFORMATION --}}
            {{-- ================================================= --}}

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
                            Claim status
                        </p>

                        <p class="mt-1 text-sm text-emerald-800">
                            Changing the claim status updates the claim record
                            used by the platform.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>