<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <div class="w-1.5 h-8 rounded-full bg-emerald-500"></div>
                    <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                        Saved Donations
                    </h2>
                </div>
                <p class="text-sm text-gray-500 mt-1 ml-4">
                    Keep track of items you bookmarked for later pickup and claiming.
                </p>
            </div>
            <a href="{{ route('receiver.donations') }}"
               class="inline-flex items-center px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl shadow-md hover:shadow-lg transition duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Browse Available Food
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-emerald-100 via-teal-50 to-cyan-100 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="flex items-center gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-emerald-700 shadow-sm">
                    <div class="flex-shrink-0 w-9 h-9 rounded-full bg-emerald-100 flex items-center justify-center font-bold text-emerald-600">
                        ✓
                    </div>
                    <div>
                        <p class="font-semibold text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="flex items-center gap-3 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-rose-700 shadow-sm">
                    <div class="flex-shrink-0 w-9 h-9 rounded-full bg-rose-100 flex items-center justify-center font-bold text-rose-600">
                        ✕
                    </div>
                    <div>
                        <p class="font-semibold text-sm">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            @if($bookmarks->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    @foreach($bookmarks as $bookmark)
                        @php
                            $donation = $bookmark->foodDonation;
                        @endphp

                        @if($donation)
                            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col hover:shadow-xl hover:-translate-y-1 transition-all duration-300">

                                <div class="relative h-48 bg-gradient-to-tr from-emerald-100 to-teal-50 overflow-hidden">
                                    @if($donation->food_image)
                                        <img src="{{ $donation->image_url ?? asset('storage/' . $donation->food_image) }}"
                                             alt="{{ $donation->title }}"
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex flex-col items-center justify-center text-emerald-500">
                                            <svg class="w-12 h-12 stroke-current" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            </svg>
                                            <span class="text-xs font-semibold mt-1 text-gray-500">Saved Food</span>
                                        </div>
                                    @endif

                                    <div class="absolute top-3 right-3 bg-emerald-100 text-emerald-800 font-semibold px-3 py-1 rounded-full text-xs shadow-sm border border-emerald-200">
                                        {{ ucfirst($donation->status) }}
                                    </div>
                                </div>

                                <div class="p-6 flex flex-col flex-1 justify-between">
                                    <div>
                                        <div class="flex items-start justify-between gap-3">
                                            <h3 class="font-bold text-gray-900 text-lg leading-snug">
                                                {{ $donation->title }}
                                            </h3>
                                            <span class="shrink-0 px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-800 font-semibold text-xs border border-emerald-200">
                                                {{ $donation->quantity }} portions
                                            </span>
                                        </div>

                                        <p class="mt-2 text-sm text-gray-600 line-clamp-2 leading-relaxed">
                                            {{ Str::limit($donation->description ?: 'Community food available for claim.', 100) }}
                                        </p>

                                        <div class="mt-4 pt-3 border-t border-gray-100 space-y-1.5 text-xs text-gray-500">
                                            @if($donation->category)
                                                <p><strong>Category:</strong> {{ $donation->category->name }}</p>
                                            @endif
                                            <p class="truncate">📍 <strong>Pickup:</strong> {{ $donation->pickup_address }}</p>
                                        </div>
                                    </div>

                                    <div class="mt-6 pt-4 border-t border-gray-100 flex items-center justify-between gap-3">
                                        <a href="{{ route('receiver.donations.show', $donation) }}"
                                           class="flex-1 text-center py-2 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs shadow-sm transition">
                                            View & Claim
                                        </a>

                                        <form method="POST" action="{{ route('receiver.bookmarks.destroy', $donation) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="py-2 px-3.5 rounded-xl border border-rose-200 bg-rose-50 text-rose-700 hover:bg-rose-100 text-xs font-semibold transition"
                                                    title="Remove from bookmarks">
                                                Remove
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        @endif

                    @endforeach

                </div>

                <div class="mt-6">
                    {{ $bookmarks->links() }}
                </div>

            @else
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-14 text-center">
                    <div class="text-5xl mb-4">
                        🔖
                    </div>

                    <h3 class="text-xl font-bold text-gray-900">
                        No Saved Donations
                    </h3>

                    <p class="mt-2 text-sm text-gray-500 max-w-sm mx-auto">
                        Donations you bookmark while browsing will appear here so you can claim them later.
                    </p>

                    <a href="{{ route('receiver.donations') }}"
                       class="inline-block mt-6 px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm rounded-xl shadow-md transition">
                        Browse Available Food
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>