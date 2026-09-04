<x-app-layout>
    {{-- Header with Emerald Accent Bar (matching Donor Dashboard) --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <div class="w-1.5 h-8 rounded-full bg-emerald-500"></div>
                    <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                        Receiver Dashboard
                    </h2>
                </div>
                <p class="text-sm text-gray-500 mt-1 ml-4">
                    Welcome back, <span class="font-semibold text-emerald-700">{{ auth()->user()->name }}</span>! Take what you need, completely hassle free
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('receiver.milestones') }}"
                   class="inline-flex items-center px-4 py-2.5 bg-white border border-gray-200 hover:border-emerald-300 hover:bg-emerald-50/50 text-gray-700 text-sm font-semibold rounded-xl shadow-sm hover:shadow transition duration-200 group">
                    <svg class="w-5 h-5 mr-2 transition-transform group-hover:scale-110 group-hover:rotate-6 drop-shadow-xs" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="gamepadGrad" x1="2" y1="6" x2="22" y2="18" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#8b5cf6"/>
                                <stop offset="50%" stop-color="#6366f1"/>
                                <stop offset="100%" stop-color="#06b6d4"/>
                            </linearGradient>
                        </defs>
                        <!-- Gamepad Body -->
                        <path d="M7 6H17C19.7614 6 22 8.23858 22 11C22 13.7614 20.2 16.8 18 18C16.5 18.8 15 17 14 16H10C9 17 7.5 18.8 6 18C3.8 16.8 2 13.7614 2 11C2 8.23858 4.23858 6 7 6Z" fill="url(#gamepadGrad)"/>
                        <!-- D-Pad -->
                        <path d="M6 10H8V12H6V10Z" fill="#ffffff" fill-opacity="0.9"/>
                        <path d="M7 9V13" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M5 11H9" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"/>
                        <!-- Action Buttons -->
                        <circle cx="16" cy="10" r="1" fill="#fbcfe8"/>
                        <circle cx="18" cy="11" r="1" fill="#fde047"/>
                        <circle cx="14" cy="11" r="1" fill="#a7f3d0"/>
                        <circle cx="16" cy="12" r="1" fill="#bae6fd"/>
                        <!-- Gloss highlight -->
                        <path d="M6 8C9 7 15 7 18 8" stroke="#ffffff" stroke-width="1" stroke-linecap="round" stroke-opacity="0.6"/>
                    </svg>
                    Game & Milestone
                </a>
                <a href="{{ route('receiver.donations') }}"
                   class="inline-flex items-center px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl shadow-md hover:shadow-lg transition duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Browse Available Food
                </a>
            </div>
        </div>
    </x-slot>

    {{-- Main Background: emerald-100 via teal-50 to cyan-100 (matching Donor Dashboard) --}}
    <div class="min-h-screen bg-gradient-to-br from-emerald-100 via-teal-50 to-cyan-100 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            @if (session('success'))
                <div class="flex items-center gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-emerald-700 shadow-sm">
                    <div class="flex-shrink-0 w-9 h-9 rounded-full bg-emerald-100 flex items-center justify-center font-bold text-emerald-600">
                        ✓
                    </div>
                    <div>
                        <p class="font-semibold text-sm">{{ session('success') }}</p>
                        <p class="text-xs text-emerald-600 mt-0.5">Your action was completed successfully.</p>
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

            {{-- Welcome Hero (matching Donor Dashboard gradient from-emerald-800 via-emerald-600 to-teal-500) --}}
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-emerald-800 via-emerald-600 to-teal-500 shadow-xl text-white p-8 sm:p-10">
                {{-- Decorative background circles --}}
                <div class="absolute -right-16 -top-24 w-72 h-72 rounded-full bg-white/10 pointer-events-none"></div>
                <div class="absolute right-36 -bottom-28 w-56 h-56 rounded-full bg-white/10 pointer-events-none"></div>

                <div class="relative z-10 flex flex-col lg:flex-row lg:items-start lg:justify-between gap-8">
                    <div class="space-y-4 max-w-2xl flex-1">
                        <span class="inline-flex px-3 py-1 rounded-full bg-white/15 text-emerald-50 text-xs font-semibold tracking-wide">
                            RECEIVER ACCOUNT
                        </span>
                        <h1 class="text-3xl sm:text-4xl font-bold text-white tracking-tight">
                            Welcome back, {{ auth()->user()->name }}! 👋
                        </h1>
                        <p class="text-emerald-50 text-base leading-relaxed">
                            Discover freshly shared food donations nearby. Every meal claimed nourishes families, empowers volunteers, and cuts food waste.
                        </p>

                        {{-- Fresh Donations Widget inside Hero --}}
                        <div class="pt-4 border-t border-white/20">
                            <div class="flex items-center justify-between gap-2 mb-3">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-300 animate-pulse"></span>
                                        <h3 class="font-bold text-white text-base">Fresh Donations</h3>
                                    </div>
                                    <p class="text-xs text-emerald-100 font-medium mt-0.5">Available right now to claim</p>
                                </div>
                                <a href="{{ route('receiver.donations') }}"
                                   class="inline-flex items-center gap-1 text-xs font-bold text-white hover:text-emerald-100 bg-white/20 hover:bg-white/30 border border-white/30 px-3.5 py-1.5 rounded-xl transition backdrop-blur-sm shadow-sm">
                                    See All →
                                </a>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @forelse ($availableDonationsPreview->take(2) as $freshItem)
                                    <a href="{{ route('receiver.donations.show', $freshItem) }}"
                                       class="group flex items-center gap-3.5 bg-white/15 hover:bg-white/25 border border-white/25 hover:border-white/40 p-3 rounded-2xl backdrop-blur-md transition-all duration-200 text-white">
                                        @if ($freshItem->food_image)
                                            <img src="{{ $freshItem->image_url ?? asset('storage/' . $freshItem->food_image) }}"
                                                 alt="{{ $freshItem->title }}"
                                                 class="w-14 h-14 rounded-xl object-cover shrink-0 border border-white/30 shadow-sm">
                                        @else
                                            <div class="w-14 h-14 rounded-xl bg-white/20 flex items-center justify-center shrink-0 border border-white/25 text-white text-lg">
                                                🍲
                                            </div>
                                        @endif
                                        <div class="min-w-0 flex-1">
                                            <div class="flex items-center justify-between gap-1">
                                                <h4 class="font-bold text-sm text-white truncate group-hover:underline">
                                                    {{ $freshItem->title }}
                                                </h4>
                                                <span class="shrink-0 text-[11px] font-bold px-2 py-0.5 rounded-full bg-emerald-400/30 text-white border border-emerald-300/40">
                                                    {{ $freshItem->quantity }} portions
                                                </span>
                                            </div>
                                            <p class="text-xs text-emerald-100 mt-1 flex items-center gap-1 truncate">
                                                <span>📍</span> {{ $freshItem->pickup_address ?? 'Dhaka' }}
                                            </p>
                                        </div>
                                    </a>
                                @empty
                                    <div class="sm:col-span-2 bg-white/10 rounded-2xl p-4 text-center text-xs text-emerald-100">
                                        No fresh donations available right now. Check back soon!
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    {{-- Stat Cards in Hero --}}
                    <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-2 gap-3 sm:gap-4 shrink-0 lg:w-72">
                        <div class="bg-white/15 backdrop-blur-sm rounded-2xl p-4 border border-white/20 text-center shadow-sm">
                            <span class="text-xs text-emerald-100 font-semibold uppercase tracking-wider block">Meals Saved</span>
                            <span class="text-3xl font-bold text-white mt-1 block">{{ number_format($totalMealsReceived) }}</span>
                            <span class="text-[11px] text-emerald-100">portions</span>
                        </div>
                        <div class="bg-white/15 backdrop-blur-sm rounded-2xl p-4 border border-white/20 text-center shadow-sm">
                            <span class="text-xs text-emerald-100 font-semibold uppercase tracking-wider block">Deliveries</span>
                            <span class="text-3xl font-bold text-white mt-1 block">{{ $completedClaims }}</span>
                            <span class="text-[11px] text-emerald-100">completed</span>
                        </div>
                        <div class="bg-white/15 backdrop-blur-sm rounded-2xl p-4 border border-white/20 text-center shadow-sm">
                            <span class="text-xs text-emerald-100 font-semibold uppercase tracking-wider block">Donors</span>
                            <span class="text-3xl font-bold text-white mt-1 block">{{ $uniqueDonors }}</span>
                            <span class="text-[11px] text-emerald-100">partners</span>
                        </div>
                        <div class="bg-white/15 backdrop-blur-sm rounded-2xl p-4 border border-white/20 text-center shadow-sm">
                            <span class="text-xs text-emerald-100 font-semibold uppercase tracking-wider block">Saved</span>
                            <span class="text-3xl font-bold text-white mt-1 block">{{ $bookmarkCount }}</span>
                            <span class="text-[11px] text-emerald-100">bookmarked</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 4 Core Navigation Widgets (Exact Serial: [Browse Food] [My Claims] [Saved Food] [Help Center]) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                {{-- 1. [Browse Food] --}}
                <a href="{{ route('receiver.donations') }}"
                   class="group bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center mb-4 group-hover:bg-emerald-600 group-hover:text-white transition duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900 text-lg group-hover:text-emerald-600 transition">Browse Food</h3>
                        <p class="text-xs text-gray-500 mt-1.5 leading-relaxed">
                            Discover available food donations nearby with GPS distance & category filters.
                        </p>
                    </div>
                    <div class="mt-5 pt-3 border-t border-gray-100 flex items-center justify-between text-xs font-semibold text-emerald-700">
                        <span class="px-2.5 py-1 rounded-md bg-emerald-50 border border-emerald-200">{{ $availableDonations }} available</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </a>

                {{-- 2. [My Claims] --}}
                <a href="{{ route('receiver.claims') }}"
                   class="group bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-teal-100 text-teal-600 flex items-center justify-center mb-4 group-hover:bg-teal-600 group-hover:text-white transition duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900 text-lg group-hover:text-teal-600 transition">My Claims</h3>
                        <p class="text-xs text-gray-500 mt-1.5 leading-relaxed">
                            Track live delivery status, volunteer driver assignments, and pickups.
                        </p>
                    </div>
                    <div class="mt-5 pt-3 border-t border-gray-100 flex items-center justify-between text-xs font-semibold text-teal-700">
                        <span class="px-2.5 py-1 rounded-md bg-teal-50 border border-teal-200">{{ $activeClaimsCount }} active / {{ $myClaims }} total</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </a>

                {{-- 3. [Saved Food] --}}
                <a href="{{ route('receiver.bookmarks') }}"
                   class="group bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-cyan-100 text-cyan-600 flex items-center justify-center mb-4 group-hover:bg-cyan-600 group-hover:text-white transition duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900 text-lg group-hover:text-cyan-600 transition">Saved Food</h3>
                        <p class="text-xs text-gray-500 mt-1.5 leading-relaxed">
                            Access favorite donations you bookmarked for later community claiming.
                        </p>
                    </div>
                    <div class="mt-5 pt-3 border-t border-gray-100 flex items-center justify-between text-xs font-semibold text-cyan-700">
                        <span class="px-2.5 py-1 rounded-md bg-cyan-50 border border-cyan-200">{{ $bookmarkCount }} items saved</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </a>

                {{-- 4. [Help Center] --}}
                <a href="{{ route('receiver.help') }}"
                   class="group bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center mb-4 group-hover:bg-emerald-600 group-hover:text-white transition duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900 text-lg group-hover:text-emerald-600 transition">Help Center</h3>
                        <p class="text-xs text-gray-500 mt-1.5 leading-relaxed">
                            Support assistance, claim issue resolution, request status & bug reports.
                        </p>
                    </div>
                    <div class="mt-5 pt-3 border-t border-gray-100 flex items-center justify-between text-xs font-semibold text-emerald-700">
                        <span class="px-2.5 py-1 rounded-md bg-emerald-50 border border-emerald-200">Customer Support</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </a>
            </div>

            {{-- =========================================================
                 1. ACTIVE CLAIMS IN PROGRESS (Realistic Live Order Tracker)
            ========================================================== --}}
            @if ($activeClaims->count() > 0)
                <div class="bg-white rounded-3xl border border-emerald-100 shadow-sm p-6 sm:p-7 relative overflow-hidden">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                        <div class="flex items-center gap-3">
                            <span class="relative flex h-3.5 w-3.5">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3.5 w-3.5 bg-emerald-500"></span>
                            </span>
                            <div>
                                <h3 class="font-extrabold text-lg text-gray-900 leading-tight">Active Claims & Live Deliveries</h3>
                                <p class="text-xs text-gray-500 mt-0.5">Real-time status of your reserved food donations</p>
                            </div>
                        </div>
                        <a href="{{ route('receiver.claims') }}"
                           class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-emerald-50 border border-emerald-200 text-xs font-bold text-emerald-700 hover:bg-emerald-100 transition shadow-2xs">
                            View All Active ({{ $activeClaimsCount }})
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                        @foreach ($activeClaims as $claim)
                            @php
                                $hasVolunteer = $claim->delivery && $claim->delivery->volunteer;
                                $volunteerName = $hasVolunteer ? $claim->delivery->volunteer->name : null;
                                $qty = $claim->foodDonation->quantity ?? 1;
                            @endphp
                            <div class="rounded-2xl border border-gray-200/90 bg-gradient-to-br from-white via-emerald-50/20 to-teal-50/20 p-5 shadow-sm hover:shadow-md hover:border-emerald-300 transition duration-200 flex flex-col justify-between">
                                <div>
                                    {{-- Card Top Row: Image, Title, Status --}}
                                    <div class="flex items-start justify-between gap-3 mb-3.5">
                                        <div class="flex items-center gap-3 min-w-0">
                                            @if ($claim->foodDonation && $claim->foodDonation->image_url)
                                                <img src="{{ $claim->foodDonation->image_url }}" alt="{{ $claim->foodDonation->title }}" class="w-12 h-12 rounded-xl object-cover border border-emerald-100 shadow-2xs shrink-0">
                                            @else
                                                <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-xl shrink-0">
                                                    🍲
                                                </div>
                                            @endif
                                            <div class="min-w-0">
                                                <h4 class="font-bold text-gray-900 text-base leading-snug truncate">
                                                    {{ $claim->foodDonation->title ?? 'Food Donation' }}
                                                </h4>
                                                <div class="flex items-center gap-2 mt-0.5">
                                                    <span class="text-xs font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-100">
                                                        {{ $qty }} portions
                                                    </span>
                                                    @if ($claim->foodDonation && $claim->foodDonation->category)
                                                        <span class="text-xs text-gray-500 font-medium">
                                                            • {{ $claim->foodDonation->category->name }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Real-time Status Badge --}}
                                        <div class="shrink-0">
                                            @if ($hasVolunteer)
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-teal-50 text-teal-700 border border-teal-200 shadow-2xs">
                                                    <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                                                    Driver Assigned
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200 shadow-2xs">
                                                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                                    Looking for Driver
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Realistic Route & Driver Information Card --}}
                                    <div class="p-3.5 rounded-xl bg-white/90 border border-gray-100 space-y-2 mb-4 text-xs">
                                        <div class="flex items-start gap-2 text-gray-600">
                                            <span class="text-emerald-600 font-bold shrink-0">📍</span>
                                            <span class="truncate"><strong class="text-gray-800">Pickup:</strong> {{ $claim->foodDonation->pickup_address ?? 'Address provided upon claim' }}</span>
                                        </div>

                                        @if ($hasVolunteer)
                                            <div class="flex items-center justify-between pt-2 border-t border-gray-100/80">
                                                <div class="flex items-center gap-2">
                                                    <div class="w-6 h-6 rounded-full bg-teal-100 text-teal-700 font-bold flex items-center justify-center text-[10px]">
                                                        {{ strtoupper(substr($volunteerName, 0, 2)) }}
                                                    </div>
                                                    <span class="text-gray-700 font-semibold">Driver: <strong class="text-gray-900">{{ $volunteerName }}</strong></span>
                                                </div>
                                                <span class="text-[11px] text-teal-700 font-bold bg-teal-50 px-2 py-0.5 rounded-md border border-teal-100">
                                                    ✓ Verified Courier
                                                </span>
                                            </div>
                                        @else
                                            <div class="pt-2 border-t border-gray-100/80 text-[11px] text-amber-700 font-medium flex items-center gap-1.5">
                                                <span>⏳</span>
                                                <span>Notification broadcasted to nearby volunteer drivers...</span>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Realistic 3-Step Transit Progress Bar --}}
                                    <div class="px-1 mb-4">
                                        <div class="relative flex items-center justify-between">
                                            <div class="absolute left-3 right-3 top-1/2 -translate-y-1/2 h-0.5 bg-gray-200"></div>
                                            <div class="absolute left-3 {{ $hasVolunteer ? 'w-1/2' : 'w-0' }} top-1/2 -translate-y-1/2 h-0.5 bg-emerald-500 transition-all duration-500"></div>

                                            {{-- Step 1: Claimed --}}
                                            <div class="relative z-10 flex flex-col items-center">
                                                <div class="w-6 h-6 rounded-full bg-emerald-600 text-white font-bold text-[10px] flex items-center justify-center shadow-xs">
                                                    ✓
                                                </div>
                                                <span class="text-[10px] font-bold text-gray-700 mt-1">Claimed</span>
                                            </div>

                                            {{-- Step 2: Driver Assigned --}}
                                            <div class="relative z-10 flex flex-col items-center">
                                                <div class="w-6 h-6 rounded-full {{ $hasVolunteer ? 'bg-emerald-600 text-white' : 'bg-amber-100 text-amber-700 border-2 border-amber-400' }} font-bold text-[10px] flex items-center justify-center shadow-xs">
                                                    {{ $hasVolunteer ? '✓' : '•' }}
                                                </div>
                                                <span class="text-[10px] font-bold {{ $hasVolunteer ? 'text-gray-700' : 'text-amber-600' }} mt-1">
                                                    {{ $hasVolunteer ? 'Assigned' : 'Dispatching' }}
                                                </span>
                                            </div>

                                            {{-- Step 3: Delivered --}}
                                            <div class="relative z-10 flex flex-col items-center">
                                                <div class="w-6 h-6 rounded-full bg-gray-200 text-gray-500 font-bold text-[10px] flex items-center justify-center shadow-xs">
                                                    3
                                                </div>
                                                <span class="text-[10px] font-medium text-gray-400 mt-1">Delivered</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Card Bottom: Action Button --}}
                                <div class="pt-3 border-t border-gray-100 flex items-center justify-between">
                                    <span class="text-[11px] text-gray-500">
                                        Claimed {{ $claim->created_at->diffForHumans() }}
                                    </span>
                                    <a href="{{ route('receiver.claims.show', $claim) }}"
                                       class="inline-flex items-center gap-1.5 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl shadow-sm hover:shadow transition group">
                                        <span>Track Live Delivery</span>
                                        <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- =========================================================
                 2. RECENT DELIVERIES (Completed Rescues & Real Receipts)
            ========================================================== --}}
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 sm:p-8">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-700 flex items-center justify-center font-bold text-lg shadow-2xs">
                            📦
                        </div>
                        <div>
                            <h3 class="font-extrabold text-xl text-gray-900">Recent Deliveries</h3>
                            <p class="text-xs text-gray-500 mt-0.5">Completed meals & community receipt records</p>
                        </div>
                    </div>
                    <a href="{{ route('receiver.history') }}"
                       class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-700 hover:text-emerald-800 bg-emerald-50 border border-emerald-200 px-4 py-2 rounded-xl hover:bg-emerald-100 transition shadow-2xs">
                        View Full History
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

                <div class="space-y-3">
                    @forelse ($recentDeliveries as $claim)
                        @php
                            $rated = $claim->delivery && $claim->delivery->rating;
                            $ratingVal = $rated ? $claim->delivery->rating->rating : null;
                            $qty = $claim->foodDonation->quantity ?? 1;
                            $estWeight = round($qty * 0.45, 1);
                        @endphp
                        <div class="p-4 sm:p-5 rounded-2xl bg-white border border-gray-200/80 hover:border-emerald-300 hover:shadow-sm transition flex flex-col sm:flex-row sm:items-center justify-between gap-4 group">
                            <div class="flex items-center gap-4 min-w-0">
                                @if ($claim->foodDonation && $claim->foodDonation->image_url)
                                    <img src="{{ $claim->foodDonation->image_url }}" alt="{{ $claim->foodDonation->title }}" class="w-14 h-14 rounded-2xl object-cover border border-emerald-100 shadow-2xs shrink-0">
                                @else
                                    <div class="w-14 h-14 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-600 flex items-center justify-center text-2xl font-bold shrink-0">
                                        🍲
                                    </div>
                                @endif

                                <div class="space-y-1 min-w-0">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <h4 class="font-extrabold text-gray-900 text-base leading-tight">
                                            {{ $claim->foodDonation->title ?? 'Food Item' }}
                                        </h4>
                                        @if ($claim->foodDonation && $claim->foodDonation->category)
                                            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                                {{ $claim->foodDonation->category->name }}
                                            </span>
                                        @endif
                                        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-teal-700 bg-teal-50 px-2 py-0.5 rounded-md border border-teal-100">
                                            ✓ Delivered
                                        </span>
                                    </div>

                                    <div class="flex flex-wrap items-center gap-3 text-xs text-gray-600">
                                        <span class="flex items-center gap-1">
                                            <span class="text-gray-400">From:</span>
                                            <strong class="text-gray-800">{{ $claim->foodDonation->donor->name ?? 'Community Donor' }}</strong>
                                        </span>
                                        <span class="text-gray-300">•</span>
                                        <span class="font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded">
                                            {{ $qty }} portions (~{{ $estWeight }} kg)
                                        </span>
                                        <span class="text-gray-300">•</span>
                                        <span class="text-gray-500">
                                            {{ \Carbon\Carbon::parse($claim->delivery?->delivered_at ?? $claim->updated_at)->format('d M Y') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 shrink-0 self-end sm:self-center">
                                @if ($rated)
                                    <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 text-xs font-extrabold shadow-2xs">
                                        <span class="text-amber-500">★</span> {{ $ratingVal }}.0 Rated
                                    </div>
                                @else
                                    <a href="{{ route('receiver.claims.show', $claim) }}"
                                       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-white text-xs font-bold shadow-xs transition">
                                        <span>★</span> Rate Delivery
                                    </a>
                                @endif

                                <a href="{{ route('receiver.claims.show', $claim) }}"
                                   class="p-2.5 rounded-xl bg-gray-50 hover:bg-emerald-50 border border-gray-200/80 text-gray-600 hover:text-emerald-700 transition"
                                   title="View claim receipt">
                                    <svg class="w-4 h-4 group-hover:translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="py-12 text-center text-gray-400">
                            <div class="w-14 h-14 mx-auto rounded-2xl bg-gray-100 flex items-center justify-center text-2xl mb-3">
                                📦
                            </div>
                            <p class="text-base font-bold text-gray-700">No completed deliveries yet</p>
                            <p class="text-xs text-gray-400 mt-1 max-w-sm mx-auto">When you receive claimed food, your verified delivery records and ratings will appear here.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- =========================================================
                 3. COMMUNITY FEEDBACK (Heartwarming Testimonials & Ratings)
            ========================================================== --}}
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 sm:p-8">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-2xl bg-amber-50 border border-amber-200 text-amber-700 flex items-center justify-center font-bold text-lg shadow-2xs">
                            💬
                        </div>
                        <div>
                            <h3 class="font-extrabold text-xl text-gray-900">My Community Feedback</h3>
                            <p class="text-xs text-gray-500 mt-0.5">Ratings & appreciation you submitted to donors and volunteers</p>
                        </div>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-amber-50 text-amber-800 rounded-full border border-amber-200 text-xs font-bold shadow-2xs">
                        <span class="text-amber-500">★</span> Ratings Given
                    </span>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {{-- Column 1: Food Donors --}}
                    <div class="space-y-4">
                        <div class="flex items-center gap-2 pb-1 border-b border-gray-100">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                            <h4 class="font-bold text-sm text-gray-800">Food Donors You Supported</h4>
                        </div>

                        @forelse ($donorReviews as $rev)
                            <div class="p-5 rounded-2xl bg-gradient-to-br from-emerald-50/40 via-white to-gray-50/50 border border-gray-200/80 shadow-2xs hover:shadow-xs transition space-y-3">
                                <div class="flex items-center justify-between gap-2">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-600 text-white font-bold text-xs flex items-center justify-center shadow-xs">
                                            {{ strtoupper(substr($rev->receiver->name ?? 'D', 0, 2)) }}
                                        </div>
                                        <div>
                                            <h5 class="font-bold text-sm text-gray-900 leading-tight">
                                                {{ $rev->receiver->name ?? 'Donor' }}
                                            </h5>
                                            <span class="text-[11px] text-emerald-700 font-semibold">Verified Food Donor</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-1 bg-amber-50 border border-amber-200/70 px-2 py-0.5 rounded-lg">
                                        <span class="text-amber-500 text-xs">★</span>
                                        <span class="text-xs font-extrabold text-amber-800">{{ $rev->rating }}.0</span>
                                    </div>
                                </div>

                                @if ($rev->review)
                                    <div class="p-3 rounded-xl bg-white border border-emerald-100/70 shadow-2xs text-xs text-gray-700 leading-relaxed font-medium">
                                        <span class="text-emerald-500 font-serif text-base leading-none mr-1">“</span>{{ $rev->review }}<span class="text-emerald-500 font-serif text-base leading-none ml-1">”</span>
                                    </div>
                                @endif

                                <div class="flex items-center justify-between text-[11px] text-gray-400 pt-1">
                                    <span>
                                        @if ($rev->delivery && $rev->delivery->claim && $rev->delivery->claim->foodDonation)
                                            🍲 For <strong class="text-gray-700">{{ $rev->delivery->claim->foodDonation->title }}</strong>
                                        @endif
                                    </span>
                                    <span>{{ $rev->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="p-6 rounded-2xl bg-gray-50 border border-gray-100 text-center text-xs text-gray-400 italic">
                                No donor ratings submitted yet. Rate completed deliveries to express gratitude!
                            </div>
                        @endforelse
                    </div>

                    {{-- Column 2: Volunteer Couriers --}}
                    <div class="space-y-4">
                        <div class="flex items-center gap-2 pb-1 border-b border-gray-100">
                            <span class="w-2.5 h-2.5 rounded-full bg-teal-500"></span>
                            <h4 class="font-bold text-sm text-gray-800">Volunteer Couriers You Thanked</h4>
                        </div>

                        @forelse ($volunteerReviews as $vRev)
                            <div class="p-5 rounded-2xl bg-gradient-to-br from-teal-50/40 via-white to-gray-50/50 border border-gray-200/80 shadow-2xs hover:shadow-xs transition space-y-3">
                                <div class="flex items-center justify-between gap-2">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-teal-500 to-cyan-600 text-white font-bold text-xs flex items-center justify-center shadow-xs">
                                            {{ strtoupper(substr($vRev->volunteer->name ?? 'V', 0, 2)) }}
                                        </div>
                                        <div>
                                            <h5 class="font-bold text-sm text-gray-900 leading-tight">
                                                {{ $vRev->volunteer->name ?? 'Volunteer' }}
                                            </h5>
                                            <span class="text-[11px] text-teal-700 font-semibold">🚴 Delivery Courier</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-1 bg-amber-50 border border-amber-200/70 px-2 py-0.5 rounded-lg">
                                        <span class="text-amber-500 text-xs">★</span>
                                        <span class="text-xs font-extrabold text-amber-800">{{ $vRev->rating }}.0</span>
                                    </div>
                                </div>

                                @if ($vRev->review)
                                    <div class="p-3 rounded-xl bg-white border border-teal-100/70 shadow-2xs text-xs text-gray-700 leading-relaxed font-medium">
                                        <span class="text-teal-500 font-serif text-base leading-none mr-1">“</span>{{ $vRev->review }}<span class="text-teal-500 font-serif text-base leading-none ml-1">”</span>
                                    </div>
                                @endif

                                <div class="flex items-center justify-between text-[11px] text-gray-400 pt-1">
                                    <span>
                                        @if ($vRev->delivery && $vRev->delivery->claim && $vRev->delivery->claim->foodDonation)
                                            🍲 For <strong class="text-gray-700">{{ $vRev->delivery->claim->foodDonation->title }}</strong>
                                        @endif
                                    </span>
                                    <span>{{ $vRev->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="p-6 rounded-2xl bg-gray-50 border border-gray-100 text-center text-xs text-gray-400 italic">
                                No volunteer ratings submitted yet. Rate courier drivers to boost community spirit!
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
