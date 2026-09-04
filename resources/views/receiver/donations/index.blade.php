<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <div class="w-1.5 h-8 rounded-full bg-emerald-500"></div>
                    <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                        Available Food Donations
                    </h2>
                </div>
                <p class="text-sm text-gray-500 mt-1 ml-4">
                    Explore surplus meals and pantry items shared by donors in your community.
                </p>
            </div>
            <a href="{{ route('receiver.bookmarks') }}"
               class="inline-flex items-center px-4 py-2.5 bg-white border border-gray-200 hover:border-rose-300 text-gray-700 text-sm font-semibold rounded-xl shadow-sm hover:shadow transition">
                <svg class="w-4 h-4 mr-2 text-rose-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                </svg>
                Saved Donations
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-emerald-100 via-teal-50 to-cyan-100 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

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

            {{-- Search & Filter Card --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <form id="filterForm" method="GET" action="{{ route('receiver.donations') }}" class="space-y-4">
                    {{-- Hidden coordinates --}}
                    <input type="hidden" id="userLat" name="lat" value="{{ request('lat', $userLat) }}">
                    <input type="hidden" id="userLng" name="lng" value="{{ request('lng', $userLng) }}">

                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                        {{-- Search Input --}}
                        <div class="md:col-span-5">
                            <label for="search" class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">
                                Search Keywords
                            </label>
                            <div class="relative">
                                <input type="text"
                                       id="search"
                                       name="search"
                                       value="{{ request('search') }}"
                                       placeholder="e.g. Rice, Bread, Dhanmondi, Gulshan..."
                                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-200 text-sm text-gray-800 focus:border-emerald-500 focus:ring-emerald-500 shadow-sm" />
                                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                        </div>

                        {{-- Category Dropdown --}}
                        <div class="md:col-span-3">
                            <label for="category" class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">
                                Food Category
                            </label>
                            <select id="category"
                                    name="category"
                                    class="w-full py-2.5 rounded-xl border border-gray-200 text-sm font-medium text-gray-800 focus:border-emerald-500 focus:ring-emerald-500 shadow-sm">
                                <option value="">All Categories</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Distance / Radius Filter --}}
                        <div class="md:col-span-2">
                            <label for="radius" class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">
                                Distance Radius
                            </label>
                            <select id="radius"
                                    name="radius"
                                    class="w-full py-2.5 rounded-xl border border-gray-200 text-sm font-medium text-gray-800 focus:border-emerald-500 focus:ring-emerald-500 shadow-sm">
                                <option value="">Any distance</option>
                                <option value="2" {{ request('radius') == '2' ? 'selected' : '' }}>Within 2 km</option>
                                <option value="5" {{ request('radius') == '5' ? 'selected' : '' }}>Within 5 km</option>
                                <option value="10" {{ request('radius') == '10' ? 'selected' : '' }}>Within 10 km</option>
                                <option value="20" {{ request('radius') == '20' ? 'selected' : '' }}>Within 20 km</option>
                                <option value="50" {{ request('radius') == '50' ? 'selected' : '' }}>Within 50 km</option>
                            </select>
                        </div>

                        {{-- Submit Buttons --}}
                        <div class="md:col-span-2 flex items-end gap-2">
                            <button type="submit"
                                    class="w-full py-2.5 px-4 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm rounded-xl shadow-sm transition">
                                Filter
                            </button>
                        </div>
                    </div>

                    {{-- Geolocation helper bar --}}
                    <div class="flex flex-wrap items-center justify-between gap-3 pt-3 text-xs text-gray-500 border-t border-gray-100">
                        <div class="flex items-center gap-2">
                            <button type="button"
                                    id="detectLocationBtn"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-700 font-semibold hover:bg-emerald-100 border border-emerald-200 transition">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span>📍 Detect My Location</span>
                            </button>
                            <span id="locationStatus" class="text-xs text-gray-500">
                                @if (request('lat') && request('lng'))
                                    <span class="text-emerald-700 font-semibold">✓ Location active (sorted by nearest)</span>
                                @else
                                    Click to calculate exact distances from your current location
                                @endif
                            </span>
                        </div>

                        @if (request('search') || request('category') || request('radius') || request('lat'))
                            <a href="{{ route('receiver.donations') }}"
                               class="text-rose-600 font-semibold hover:underline flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Reset All Filters
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Donations Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($donations as $donation)
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        {{-- Image / Header badge --}}
                        <div class="relative h-48 bg-gradient-to-tr from-emerald-100 to-teal-50 overflow-hidden">
                            @if ($donation->food_image)
                                <img src="{{ $donation->image_url ?? asset('storage/' . $donation->food_image) }}"
                                     alt="{{ $donation->title }}"
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-emerald-500">
                                    <svg class="w-12 h-12 stroke-current" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    <span class="text-xs font-semibold mt-1 text-gray-500">Community Donation</span>
                                </div>
                            @endif

                            {{-- Distance Badge --}}
                            @if (isset($donation->distance) && $donation->distance !== null)
                                <div class="absolute top-3 left-3 bg-white/95 backdrop-blur-sm px-3 py-1 rounded-full shadow text-xs font-semibold text-emerald-700 border border-gray-100 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 text-rose-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $donation->distance }} km away
                                </div>
                            @endif

                            {{-- Category Badge --}}
                            @if ($donation->category)
                                <div class="absolute top-3 right-3 bg-emerald-800/80 backdrop-blur-sm text-white px-3 py-1 rounded-full text-xs font-semibold shadow">
                                    {{ $donation->category->name }}
                                </div>
                            @endif
                        </div>

                        {{-- Body Content --}}
                        <div class="p-6 flex flex-col flex-1">
                            <div class="flex items-start justify-between gap-2">
                                <h3 class="font-bold text-gray-900 text-lg leading-snug">
                                    {{ $donation->title }}
                                </h3>
                                <span class="shrink-0 px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-800 font-semibold text-xs border border-emerald-200">
                                    {{ $donation->quantity }} {{ Str::plural('portion', $donation->quantity) }}
                                </span>
                            </div>

                            <p class="text-sm text-gray-600 mt-2 line-clamp-2 leading-relaxed flex-1">
                                {{ $donation->description ?: 'Freshly prepared food available for community claim and pickup.' }}
                            </p>

                            {{-- Location & Details --}}
                            <div class="mt-4 pt-4 border-t border-gray-100 space-y-2 text-xs text-gray-500">
                                <div class="flex items-start gap-2">
                                    <svg class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span class="truncate font-medium text-gray-700">{{ $donation->pickup_address }}</span>
                                </div>

                                <div class="flex items-center justify-between text-xs text-gray-500">
                                    <span class="flex items-center gap-1.5 font-medium">
                                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        {{ $donation->donor->name ?? 'Community Donor' }}
                                    </span>

                                    @if ($donation->expiry_time)
                                        <span class="text-amber-700 font-medium bg-amber-50 px-2 py-0.5 rounded border border-amber-200">
                                            Exp: {{ \Carbon\Carbon::parse($donation->expiry_time)->format('M d, g:i A') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- Card CTA --}}
                            <div class="mt-5 pt-3 border-t border-gray-100 flex items-center gap-3">
                                <a href="{{ route('receiver.donations.show', $donation) }}"
                                   class="flex-1 text-center py-2.5 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm shadow-sm transition">
                                    View & Claim
                                </a>

                                {{-- Bookmark button --}}
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
                                                class="p-2.5 rounded-xl border border-rose-200 bg-rose-50 text-rose-600 hover:bg-rose-100 transition"
                                                title="Remove from saved">
                                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('receiver.bookmarks.store', $donation) }}">
                                        @csrf
                                        <button type="submit"
                                                class="p-2.5 rounded-xl border border-gray-200 bg-white text-gray-400 hover:text-rose-500 hover:border-rose-200 hover:bg-rose-50 transition"
                                                title="Save donation">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center">
                        <div class="w-16 h-16 mx-auto bg-gray-100 rounded-2xl flex items-center justify-center text-gray-400 mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-800 text-lg">No matching food donations</h4>
                        <p class="text-sm text-gray-500 mt-1 max-w-sm mx-auto">
                            We couldn't find any available donations matching your search or radius criteria. Try broadening your distance or clearing filters.
                        </p>
                        <div class="mt-6">
                            <a href="{{ route('receiver.donations') }}"
                               class="inline-flex items-center px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm rounded-xl shadow-sm transition">
                                View All Available Food
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if ($donations->hasPages())
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
                    {{ $donations->links() }}
                </div>
            @endif

        </div>
    </div>

    {{-- Geolocation JS Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const detectBtn = document.getElementById('detectLocationBtn');
            const latInput = document.getElementById('userLat');
            const lngInput = document.getElementById('userLng');
            const statusSpan = document.getElementById('locationStatus');
            const form = document.getElementById('filterForm');

            if (detectBtn) {
                detectBtn.addEventListener('click', function() {
                    if (!navigator.geolocation) {
                        statusSpan.textContent = 'Geolocation is not supported by your browser.';
                        return;
                    }

                    statusSpan.textContent = 'Detecting coordinates...';

                    navigator.geolocation.getCurrentPosition(
                        function(position) {
                            latInput.value = position.coords.latitude;
                            lngInput.value = position.coords.longitude;
                            statusSpan.textContent = 'Location detected! Updating search...';

                            // Automatically submit form with new coords
                            form.submit();
                        },
                        function(error) {
                            statusSpan.textContent = 'Unable to retrieve location: ' + error.message;
                        },
                        {
                            enableHighAccuracy: true,
                            timeout: 8000,
                            maximumAge: 60000
                        }
                    );
                });
            }
        });
    </script>
</x-app-layout>
