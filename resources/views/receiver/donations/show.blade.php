<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <div class="w-1.5 h-8 rounded-full bg-emerald-500"></div>
                    <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                        Donation Details
                    </h2>
                </div>
                <p class="text-sm text-gray-500 mt-1 ml-4">
                    Review food information, pickup address, and reserve this donation.
                </p>
            </div>
            <a href="{{ route('receiver.donations') }}"
               class="inline-flex items-center px-4 py-2 bg-white border border-gray-200 hover:border-emerald-300 text-gray-700 text-sm font-semibold rounded-xl shadow-sm hover:shadow transition duration-200">
                <svg class="w-4 h-4 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Available Food
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-emerald-100 via-teal-50 to-cyan-100 py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="flex items-center gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-emerald-700 shadow-sm">
                    <div class="flex-shrink-0 w-9 h-9 rounded-full bg-emerald-100 flex items-center justify-center font-bold text-emerald-600">
                        ✓
                    </div>
                    <div>
                        <p class="font-semibold text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="flex items-center gap-3 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-rose-700 shadow-sm">
                    <div class="flex-shrink-0 w-9 h-9 rounded-full bg-rose-100 flex items-center justify-center font-bold text-rose-600">
                        ✕
                    </div>
                    <div>
                        <p class="font-semibold text-sm">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                @if (!empty($donation->image_urls))
                    <div class="relative bg-gray-900">
                        <img id="mainDonationImage"
                             src="{{ $donation->image_urls[0] }}"
                             alt="{{ $donation->title }}"
                             class="w-full max-h-96 object-cover transition-all duration-200">
                    </div>
                    @if (count($donation->image_urls) > 1)
                        <div class="p-3 bg-gray-50 border-b border-gray-100 flex items-center gap-2 overflow-x-auto">
                            @foreach ($donation->image_urls as $imgIndex => $url)
                                <button type="button"
                                        onclick="document.getElementById('mainDonationImage').src = '{{ $url }}'; document.querySelectorAll('.thumb-btn').forEach(b => b.classList.remove('ring-2', 'ring-emerald-500')); this.classList.add('ring-2', 'ring-emerald-500');"
                                        class="thumb-btn relative shrink-0 rounded-lg overflow-hidden border border-gray-200 focus:outline-none transition cursor-pointer {{ $imgIndex === 0 ? 'ring-2 ring-emerald-500' : '' }}">
                                    <img src="{{ $url }}" alt="Thumbnail {{ $imgIndex + 1 }}" class="w-14 h-14 object-cover">
                                </button>
                            @endforeach
                        </div>
                    @endif
                @elseif ($donation->food_image)
                    <img src="{{ $donation->image_url ?? asset('storage/' . $donation->food_image) }}"
                         alt="{{ $donation->title }}"
                         class="w-full max-h-96 object-cover">
                @else
                    <div class="w-full h-52 bg-gradient-to-tr from-emerald-100 to-teal-50 flex flex-col items-center justify-center text-emerald-500">
                        <svg class="w-14 h-14 stroke-current" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span class="text-xs font-semibold mt-2 text-gray-500">Community Food Donation</span>
                    </div>
                @endif

                <div class="p-8 space-y-7">
                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 pb-6 border-b border-gray-100">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 leading-tight">
                                {{ $donation->title }}
                            </h1>

                            @if ($donation->category)
                                <span class="inline-block mt-2 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200">
                                    {{ $donation->category->name }}
                                </span>
                            @endif
                        </div>

                        {{-- Donation Status --}}
                        @if ($myClaim)
                            <span class="inline-flex rounded-full bg-teal-100 border border-teal-200 px-3.5 py-1 text-xs font-semibold text-teal-800 shadow-sm w-fit">
                                ✓ Claimed by You
                            </span>
                        @elseif ($claimedBySomeoneElse)
                            <span class="inline-flex rounded-full bg-rose-100 border border-rose-200 px-3.5 py-1 text-xs font-semibold text-rose-800 shadow-sm w-fit">
                                ✕ Already Claimed
                            </span>
                        @else
                            <span class="inline-flex rounded-full bg-emerald-100 border border-emerald-200 px-3.5 py-1 text-xs font-semibold text-emerald-800 shadow-sm w-fit">
                                ● Available
                            </span>
                        @endif
                    </div>

                    {{-- Description --}}
                    <div>
                        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">About This Food</h4>
                        <p class="text-sm text-gray-700 leading-relaxed">
                            {{ $donation->description ?: 'Fresh surplus meals prepared and shared with care for community members.' }}
                        </p>
                    </div>

                    {{-- Info Grid --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5 p-6 rounded-xl bg-gray-50/70 border border-gray-100">
                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Quantity Available</p>
                            <p class="text-base font-semibold text-gray-900 mt-1">{{ $donation->quantity }} portions</p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Pickup Address</p>
                            <p class="text-base font-semibold text-gray-900 mt-1 truncate">{{ $donation->pickup_address }}</p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Donor</p>
                            <p class="text-base font-semibold text-emerald-700 mt-1">{{ $donation->donor?->name ?? 'Community Donor' }}</p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Pickup Date</p>
                            <p class="text-base font-semibold text-gray-900 mt-1">{{ $donation->pickup_date ?: 'Flexible / Contact' }}</p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Pickup Time</p>
                            <p class="text-base font-semibold text-gray-900 mt-1">{{ $donation->pickup_time ?: 'Flexible / Contact' }}</p>
                        </div>

                        <div>
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Expiry Time</p>
                            <p class="text-base font-semibold text-amber-800 mt-1">
                                {{ $donation->expiry_time ? \Carbon\Carbon::parse($donation->expiry_time)->format('M d, g:i A') : 'Same day' }}
                            </p>
                        </div>
                    </div>

                    {{-- Actions Bar --}}
                    <div class="pt-4 border-t border-gray-100 flex flex-wrap items-center gap-3">
                        <a href="{{ route('receiver.donations') }}"
                           class="rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-5 py-2.5 text-xs transition">
                            ← Back to Donations
                        </a>

                        {{-- Bookmark --}}
                        @php
                            $isBookmarked = \App\Models\Bookmark::where('user_id', auth()->id())
                                ->where('food_donation_id', $donation->id)
                                ->exists();
                        @endphp

                        @if ($isBookmarked)
                            <form method="POST" action="{{ route('receiver.bookmarks.destroy', $donation) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="rounded-xl bg-amber-50 text-amber-800 border border-amber-300 px-5 py-2.5 text-xs font-semibold shadow-sm hover:bg-amber-100 transition">
                                    🔖 Remove from Saved
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('receiver.bookmarks.store', $donation) }}">
                                @csrf
                                <button type="submit"
                                        class="rounded-xl bg-amber-50 text-amber-800 border border-amber-200 hover:bg-amber-100 px-5 py-2.5 text-xs font-semibold shadow-sm transition">
                                    🔖 Save Donation
                                </button>
                            </form>
                        @endif

                        {{-- Claim Actions --}}
                        @if ($myClaim)
                            <div class="w-full mt-4 rounded-xl bg-emerald-50 border border-emerald-200 p-5 space-y-2">
                                <p class="font-semibold text-emerald-800 text-base">
                                    ✓ You have already claimed this donation.
                                </p>
                                <p class="text-xs text-emerald-700">
                                    Track volunteer driver pickup and delivery status directly from your claims dashboard.
                                </p>
                                <div class="pt-2">
                                    <a href="{{ route('receiver.claims.show', $myClaim) }}"
                                       class="inline-block rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs px-5 py-2.5 shadow-sm transition">
                                        View Claim Tracking →
                                    </a>
                                </div>
                            </div>
                        @elseif ($claimedBySomeoneElse)
                            <div class="w-full mt-4 rounded-xl bg-rose-50 border border-rose-200 p-5">
                                <p class="font-semibold text-rose-800 text-base">
                                    This donation has already been claimed.
                                </p>
                                <p class="text-xs text-rose-700 mt-1">
                                    Another community receiver has reserved this meal. Explore other fresh donations nearby!
                                </p>
                            </div>
                        @else
                            <form method="POST" action="{{ route('receiver.claims.store', $donation) }}">
                                @csrf
                                <button type="submit"
                                        class="rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm px-8 py-3 shadow-md hover:shadow-lg transition duration-200">
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