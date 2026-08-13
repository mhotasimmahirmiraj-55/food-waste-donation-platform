<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Donation Details
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 rounded-lg bg-green-100 p-4 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 rounded-lg bg-red-100 p-4 text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-lg overflow-hidden">

                @if ($donation->food_image)
                    <img
                        src="{{ asset('storage/' . $donation->food_image) }}"
                        alt="{{ $donation->title }}"
                        class="w-full max-h-96 object-cover"
                    >
                @endif

                <div class="p-6">

                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">

                        <div>
                            <h1 class="text-3xl font-bold">
                                {{ $donation->title }}
                            </h1>

                            <p class="text-gray-500 mt-1">
                                {{ $donation->category?->name ?? 'Food donation' }}
                            </p>
                        </div>

                        {{-- Donation Status --}}
                        @if ($myClaim)
                            <span class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-sm font-semibold text-blue-800">
                                Claimed by You
                            </span>
                        @elseif ($claimedBySomeoneElse)
                            <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-sm font-semibold text-red-800">
                                Already Claimed
                            </span>
                        @else
                            <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-sm font-semibold text-green-800">
                                Available
                            </span>
                        @endif

                    </div>

                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>
                            <p class="text-sm text-gray-500">Description</p>
                            <p class="mt-1">
                                {{ $donation->description ?: 'No description provided.' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Quantity</p>
                            <p class="mt-1">{{ $donation->quantity }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Pickup Address</p>
                            <p class="mt-1">{{ $donation->pickup_address }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Donor</p>
                            <p class="mt-1">
                                {{ $donation->donor?->name ?? 'Donor' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Pickup Date</p>
                            <p class="mt-1">
                                {{ $donation->pickup_date ?: 'Not specified' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Pickup Time</p>
                            <p class="mt-1">
                                {{ $donation->pickup_time ?: 'Not specified' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Expiry</p>
                            <p class="mt-1">
                                {{ $donation->expiry_time ?: 'Not specified' }}
                            </p>
                        </div>

                    </div>

                    <div class="mt-8 flex flex-wrap gap-3">

                        {{-- Back --}}
                        <a
                            href="{{ route('receiver.donations') }}"
                            class="rounded-lg bg-gray-200 px-5 py-2.5 text-gray-800 hover:bg-gray-300"
                        >
                            Back to Donations
                        </a>

                        {{-- Bookmark --}}
                        @php
                            $isBookmarked = \App\Models\Bookmark::where('user_id', auth()->id())
                                ->where('food_donation_id', $donation->id)
                                ->exists();
                        @endphp

                        @if ($isBookmarked)

                            <form
                                method="POST"
                                action="{{ route('receiver.bookmarks.destroy', $donation) }}"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="rounded-lg bg-yellow-500 px-5 py-2.5 text-white hover:bg-yellow-600"
                                >
                                    🔖 Remove Saved
                                </button>
                            </form>

                        @else

                            <form
                                method="POST"
                                action="{{ route('receiver.bookmarks.store', $donation) }}"
                            >
                                @csrf

                                <button
                                    type="submit"
                                    class="rounded-lg bg-yellow-500 px-5 py-2.5 text-white hover:bg-yellow-600"
                                >
                                    🔖 Save Donation
                                </button>
                            </form>

                        @endif

                        {{-- Claim Status --}}

                        @if ($myClaim)

                            {{-- Claimed by current receiver --}}
                            <div class="w-full rounded-lg bg-blue-50 border border-blue-200 p-4">
                                <p class="font-semibold text-blue-800">
                                    ✓ You have already claimed this donation.
                                </p>

                                <p class="text-sm text-blue-700 mt-1">
                                    You can track your claim status from My Claims.
                                </p>

                                <a
                                    href="{{ route('receiver.claims.show', $myClaim) }}"
                                    class="inline-block mt-3 rounded-lg bg-blue-600 px-5 py-2.5 text-white hover:bg-blue-700"
                                >
                                    View My Claim
                                </a>
                            </div>

                        @elseif ($claimedBySomeoneElse)

                            {{-- Claimed by another receiver --}}
                            <div class="w-full rounded-lg bg-red-50 border border-red-200 p-4">
                                <p class="font-semibold text-red-800">
                                    This donation has already been claimed.
                                </p>

                                <p class="text-sm text-red-700 mt-1">
                                    Unfortunately, this donation is no longer available to claim.
                                </p>
                            </div>

                        @else

                            {{-- Available to claim --}}
                            <form
                                method="POST"
                                action="{{ route('receiver.claims.store', $donation) }}"
                            >
                                @csrf

                                <button
                                    type="submit"
                                    class="rounded-lg bg-blue-600 px-5 py-2.5 text-white hover:bg-blue-700"
                                >
                                    Claim Food
                                </button>
                            </form>

                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>