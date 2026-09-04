<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <div class="w-1.5 h-8 rounded-full bg-emerald-500"></div>
                    <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                        Community Impact Record
                    </h2>
                </div>
                <p class="text-sm text-gray-500 mt-1 ml-4">
                    Track rescued food volume, diverted carbon emissions, donation inflow trends & community partnerships.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('receiver.history') }}"
                   class="inline-flex items-center px-4 py-2.5 bg-white border border-emerald-200 hover:border-emerald-400 text-emerald-700 text-sm font-semibold rounded-xl shadow-sm hover:shadow transition duration-200">
                    <svg class="w-4 h-4 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Donation History
                </a>
                <a href="{{ route('receiver.milestones') }}"
                   class="inline-flex items-center px-4 py-2.5 bg-white border border-emerald-200 hover:border-emerald-400 text-emerald-700 text-sm font-semibold rounded-xl shadow-sm hover:shadow transition duration-200">
                    <span class="mr-2">🎮</span>
                    Game & Milestone
                </a>
                <a href="{{ route('receiver.dashboard') }}"
                   class="inline-flex items-center px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl shadow-sm hover:shadow transition duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Dashboard
                </a>
            </div>
        </div>
    </x-slot>

    {{-- Main Background: Matching Donor Dashboard palette --}}
    <div class="min-h-screen bg-gradient-to-br from-emerald-100 via-teal-50 to-cyan-100 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- =========================================================
                 WELCOME / IMPACT HERO BANNER
            ========================================================== --}}
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-emerald-800 via-emerald-600 to-teal-500 shadow-xl p-8 sm:p-10 text-white">
                {{-- Decorative background glow --}}
                <div class="absolute -right-16 -top-24 w-96 h-96 rounded-full bg-white/10 blur-3xl pointer-events-none"></div>
                <div class="absolute right-32 -bottom-24 w-80 h-80 rounded-full bg-teal-400/20 blur-2xl pointer-events-none"></div>

                <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div class="max-w-2xl">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 backdrop-blur-md border border-white/20 text-emerald-100 text-xs font-semibold mb-3">
                            <span class="w-2 h-2 rounded-full bg-emerald-300 animate-pulse"></span>
                            Live Sustainability Telemetry
                        </div>
                        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-white leading-tight">
                            Food Rescue & Community Impact
                        </h1>
                        <p class="text-emerald-100 text-sm sm:text-base mt-2 leading-relaxed">
                            Every meal your organization claims intercepts surplus food before it reaches landfills, preserving critical agricultural resources and bringing dignified sustenance to families.
                        </p>
                        
                        <div class="mt-5 flex flex-wrap items-center gap-3 text-xs font-medium text-emerald-100">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-900/40 border border-emerald-400/30">
                                <svg class="w-4 h-4 text-emerald-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                Verified Claims: {{ $completedClaims->count() }}
                            </span>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-900/40 border border-emerald-400/30">
                                <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Localized Redistribution
                            </span>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-900/40 border border-emerald-400/30">
                                <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                </svg>
                                UN SDG 12.3 Aligned
                            </span>
                        </div>
                    </div>

                    {{-- Metric Quick Pill --}}
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20 text-center flex-shrink-0 min-w-[220px]">
                        <p class="text-xs uppercase tracking-wider font-semibold text-emerald-200">Total Food Diverted</p>
                        <p class="text-3xl sm:text-4xl font-black text-white mt-1">
                            {{ number_format($totalWeightKg, 1) }} <span class="text-lg font-bold text-emerald-200">kg</span>
                        </p>
                        <p class="text-xs text-emerald-100/80 mt-1 font-medium">
                            ({{ number_format($totalWeightLbs, 1) }} lbs rescued)
                        </p>
                        <div class="mt-4 pt-3 border-t border-white/10 flex items-center justify-center gap-1 text-xs text-emerald-200">
                            <span>🌱</span> {{ number_format($co2AvoidedKg, 1) }} kg CO₂e diverted
                        </div>
                    </div>
                </div>
            </div>

            {{-- =========================================================
                 KEY IMPACT METRICS GRID (Total Weight, Portions, GHG, Water)
            ========================================================== --}}
            <div>
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-4">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Direct Environmental & Meal Metrics</h3>
                        <p class="text-xs text-gray-500">Calculated from verified weights and standardized food recovery indices</p>
                    </div>

                    {{-- Weight Unit Toggle Component --}}
                    <div class="inline-flex items-center p-1 bg-white border border-gray-200 rounded-xl shadow-sm text-xs font-semibold">
                        <button type="button" id="toggleKgBtn" onclick="ImpactWeightToggle.setUnit('kg')" class="px-3 py-1.5 rounded-lg bg-emerald-600 text-white transition shadow-sm">
                            Kilograms (kg)
                        </button>
                        <button type="button" id="toggleLbsBtn" onclick="ImpactWeightToggle.setUnit('lbs')" class="px-3 py-1.5 rounded-lg text-gray-600 hover:text-gray-900 transition">
                            Pounds (lbs)
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                    {{-- 1. TOTAL WEIGHT DIVERTED (User Request: Display estimated total weight in kg or lbs) --}}
                    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-xl">
                                ⚖️
                            </div>
                            <span class="text-xs font-bold uppercase tracking-wider text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-100">
                                Substantial Impact
                            </span>
                        </div>
                        <p class="text-xs uppercase tracking-wider text-gray-400 font-bold">Total Weight Diverted</p>
                        
                        {{-- Interactive Weight Display --}}
                        <div class="mt-2 flex items-baseline gap-2">
                            <span id="displayWeightValue" class="text-3xl sm:text-4xl font-black text-gray-900">
                                {{ number_format($totalWeightKg, 1) }}
                            </span>
                            <span id="displayWeightUnit" class="text-base font-bold text-emerald-600">
                                kg
                            </span>
                        </div>

                        <p id="displayWeightAlt" class="text-xs text-gray-500 mt-1 font-medium">
                            Equal to {{ number_format($totalWeightLbs, 1) }} pounds of edible food
                        </p>

                        <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                            <span>Standard portions conversion</span>
                            <span class="text-emerald-600 font-semibold">100% Edible</span>
                        </div>
                    </div>

                    {{-- 2. RESCUED PORTIONS --}}
                    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-12 h-12 rounded-2xl bg-teal-100 text-teal-700 flex items-center justify-center font-bold text-xl">
                                🍲
                            </div>
                            <span class="text-xs font-bold uppercase tracking-wider text-teal-600 bg-teal-50 px-2.5 py-1 rounded-full border border-teal-100">
                                Nourishment
                            </span>
                        </div>
                        <p class="text-xs uppercase tracking-wider text-gray-400 font-bold">Portions Rescued</p>
                        <div class="mt-2 flex items-baseline gap-2">
                            <span class="text-3xl sm:text-4xl font-black text-gray-900">
                                {{ number_format($totalPortions) }}
                            </span>
                            <span class="text-base font-bold text-teal-600">meals</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-1 font-medium">
                            Across {{ $completedClaims->count() }} fulfilled donations
                        </p>
                        <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                            <span>Served to community</span>
                            <span class="text-teal-600 font-semibold">Zero Cost</span>
                        </div>
                    </div>

                    {{-- 3. CARBON EMISSIONS DIVERTED --}}
                    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-12 h-12 rounded-2xl bg-cyan-100 text-cyan-700 flex items-center justify-center font-bold text-xl">
                                🌍
                            </div>
                            <span class="text-xs font-bold uppercase tracking-wider text-cyan-700 bg-cyan-50 px-2.5 py-1 rounded-full border border-cyan-100">
                                Climate Relief
                            </span>
                        </div>
                        <p class="text-xs uppercase tracking-wider text-gray-400 font-bold">CO₂e Emissions Avoided</p>
                        <div class="mt-2 flex items-baseline gap-2">
                            <span class="text-3xl sm:text-4xl font-black text-gray-900">
                                {{ number_format($co2AvoidedKg, 1) }}
                            </span>
                            <span class="text-base font-bold text-cyan-700">kg CO₂e</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-1 font-medium">
                            Landfill methane emission prevention
                        </p>
                        <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                            <span>Index: 2.5 kg CO₂e / kg</span>
                            <span class="text-cyan-700 font-semibold">Net Green</span>
                        </div>
                    </div>

                    {{-- 4. WATER FOOTPRINT PRESERVED --}}
                    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-xl">
                                💧
                            </div>
                            <span class="text-xs font-bold uppercase tracking-wider text-blue-600 bg-blue-50 px-2.5 py-1 rounded-full border border-blue-100">
                                Resource Saver
                            </span>
                        </div>
                        <p class="text-xs uppercase tracking-wider text-gray-400 font-bold">Agricultural Water Saved</p>
                        <div class="mt-2 flex items-baseline gap-2">
                            <span class="text-3xl sm:text-4xl font-black text-gray-900">
                                {{ number_format($waterSavedLiters) }}
                            </span>
                            <span class="text-base font-bold text-blue-600">Liters</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-1 font-medium">
                            Embedded water in rescued produce & grains
                        </p>
                        <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
                            <span>Index: 800 L / kg</span>
                            <span class="text-blue-600 font-semibold">Conserved</span>
                        </div>
                    </div>

                </div>
            </div>

            {{-- =========================================================
                 DATA VISUALIZATION: 6-MONTH DONATION TRENDS CHART
                 (User Request: Line or bar chart showing donations received over last 6 months)
            ========================================================== --}}
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 sm:p-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                    <div>
                        <div class="flex items-center gap-2">
                            <div class="w-2.5 h-2.5 rounded-full bg-emerald-500"></div>
                            <h3 class="text-xl font-bold text-gray-800">
                                6-Month Food Inflow & Donation Trends
                            </h3>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">
                            Analyze monthly rescue volume (portions & weight) to forecast shelter food inflow, optimize pantry storage, and plan meal sourcing.
                        </p>
                    </div>

                    {{-- Chart Metric Selector Tabs --}}
                    <div class="flex items-center gap-2 bg-gray-100 p-1 rounded-xl text-xs font-semibold text-gray-600">
                        <button type="button" id="chartViewPortions" onclick="DonationTrendsChart.switchView('portions')"
                                class="px-3 py-1.5 rounded-lg bg-white text-emerald-700 shadow-sm transition">
                            Portions Rescued
                        </button>
                        <button type="button" id="chartViewWeight" onclick="DonationTrendsChart.switchView('weight')"
                                class="px-3 py-1.5 rounded-lg hover:text-gray-900 transition">
                            Weight Diverted (kg)
                        </button>
                        <button type="button" id="chartViewBoth" onclick="DonationTrendsChart.switchView('both')"
                                class="px-3 py-1.5 rounded-lg hover:text-gray-900 transition">
                            Dual Trend (Combined)
                        </button>
                    </div>
                </div>

                {{-- Chart Canvas Container --}}
                <div class="relative h-80 sm:h-96 w-full">
                    <canvas id="receiverTrendsChart"></canvas>
                </div>

                {{-- Practical Meal Planning Tips Bar (Simplified & Redesigned) --}}
                <div class="mt-8 pt-6 border-t border-gray-100 grid grid-cols-1 md:grid-cols-3 gap-5">
                    {{-- 1. Monthly Average --}}
                    <div class="p-5 rounded-2xl bg-gradient-to-br from-emerald-50/90 via-emerald-50/40 to-white border border-emerald-200/80 shadow-sm hover:shadow transition">
                        <div class="flex items-center justify-between gap-3 mb-2">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-base shadow-xs">
                                    📦
                                </div>
                                <h4 class="text-sm font-bold text-gray-900">Monthly Average</h4>
                            </div>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-bold bg-emerald-100/90 text-emerald-800">
                                ~{{ round($totalPortions / max(1, count(array_filter($trendPortions))), 1) }} meals
                            </span>
                        </div>
                        <p class="text-xs text-gray-600 leading-relaxed mt-2">
                            You receive around <strong class="text-gray-900">{{ round($totalPortions / max(1, count(array_filter($trendPortions))), 1) }} meals each active month</strong>. Use this number to plan how many people you can feed.
                        </p>
                    </div>

                    {{-- 2. Food Storage Tip --}}
                    <div class="p-5 rounded-2xl bg-gradient-to-br from-cyan-50/90 via-cyan-50/40 to-white border border-cyan-200/80 shadow-sm hover:shadow transition">
                        <div class="flex items-center justify-between gap-3 mb-2">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-xl bg-cyan-100 text-cyan-700 flex items-center justify-center text-base shadow-xs">
                                    ❄️
                                </div>
                                <h4 class="text-sm font-bold text-gray-900">Food Storage Tip</h4>
                            </div>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-bold bg-cyan-100/90 text-cyan-800">
                                Freshness
                            </span>
                        </div>
                        <p class="text-xs text-gray-600 leading-relaxed mt-2">
                            Make sure to clear <strong class="text-gray-900">fridge and shelf space</strong> before picking up bigger donations so cooked food and groceries stay fresh and safe.
                        </p>
                    </div>

                    {{-- 3. Connect With More Donors --}}
                    <div class="p-5 rounded-2xl bg-gradient-to-br from-teal-50/90 via-teal-50/40 to-white border border-teal-200/80 shadow-sm hover:shadow transition">
                        <div class="flex items-center justify-between gap-3 mb-2">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-xl bg-teal-100 text-teal-700 flex items-center justify-center text-base shadow-xs">
                                    🤝
                                </div>
                                <h4 class="text-sm font-bold text-gray-900">Different Donors</h4>
                            </div>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-bold bg-teal-100/90 text-teal-800">
                                Steady Supply
                            </span>
                        </div>
                        <p class="text-xs text-gray-600 leading-relaxed mt-2">
                            Claiming food from a <strong class="text-gray-900">variety of local shops and restaurants</strong> keeps your meal supplies steady even if one donor pauses.
                        </p>
                    </div>
                </div>
            </div>

            {{-- =========================================================
                 CATEGORY BREAKDOWN & RECENT RESCUE DELIVERIES
            ========================================================== --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                {{-- Category Distribution --}}
                <div class="lg:col-span-5 bg-white rounded-3xl border border-gray-100 shadow-sm p-6 sm:p-8">
                    <h4 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                        <span>🥗</span> Food Categories Rescued
                    </h4>
                    <p class="text-xs text-gray-500 mt-1">
                        Breakdown of meals received by food category
                    </p>

                    <div class="mt-6 space-y-4">
                        @forelse($categoryBreakdown as $categoryName => $catPortions)
                            @php
                                $percent = $totalPortions > 0 ? round(($catPortions / $totalPortions) * 100) : 0;
                            @endphp
                            <div>
                                <div class="flex items-center justify-between text-xs font-semibold mb-1.5">
                                    <span class="text-gray-700">{{ $categoryName }}</span>
                                    <span class="text-emerald-700 font-bold">{{ $catPortions }} portions ({{ $percent }}%)</span>
                                </div>
                                <div class="w-full bg-gray-100 rounded-full h-2.5 overflow-hidden">
                                    <div class="bg-gradient-to-r from-emerald-500 to-teal-500 h-2.5 rounded-full" style="width: {{ $percent }}%"></div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-400 text-xs">
                                No category distribution data available yet.
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-6 pt-4 border-t border-gray-100 text-xs text-gray-500 flex items-center justify-between">
                        <span>Diversified nutritional sourcing</span>
                        <a href="{{ route('receiver.donations') }}" class="font-semibold text-emerald-600 hover:text-emerald-700">
                            Find other categories →
                        </a>
                    </div>
                </div>

                {{-- Recent Verified Rescues Table --}}
                <div class="lg:col-span-7 bg-white rounded-3xl border border-gray-100 shadow-sm p-6 sm:p-8">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h4 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                                <span>📜</span> Recent Impact Deliveries
                            </h4>
                            <p class="text-xs text-gray-500 mt-1">
                                Latest completed claims credited to your impact record
                            </p>
                        </div>
                        <a href="{{ route('receiver.history') }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-700">
                            Full History →
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-gray-50 text-gray-500 uppercase tracking-wider font-semibold">
                                <tr>
                                    <th class="py-3 px-4 rounded-l-xl">Food Item</th>
                                    <th class="py-3 px-3">Donor</th>
                                    <th class="py-3 px-3 text-center">Portions</th>
                                    <th class="py-3 px-3 text-center">Est. Weight</th>
                                    <th class="py-3 px-4 rounded-r-xl text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($completedClaims->take(5) as $claim)
                                    @php
                                        $qty = $claim->foodDonation->quantity ?? 1;
                                        $claimKg = round($qty * 0.45, 1);
                                    @endphp
                                    <tr class="hover:bg-emerald-50/40 transition">
                                        <td class="py-3 px-4 font-semibold text-gray-800">
                                            {{ $claim->foodDonation->title ?? 'Donation Item' }}
                                        </td>
                                        <td class="py-3 px-3 text-gray-600">
                                            {{ $claim->foodDonation->donor->name ?? 'Community Donor' }}
                                        </td>
                                        <td class="py-3 px-3 text-center font-bold text-gray-800">
                                            {{ $qty }}
                                        </td>
                                        <td class="py-3 px-3 text-center font-bold text-emerald-700">
                                            {{ $claimKg }} kg
                                        </td>
                                        <td class="py-3 px-4 text-right">
                                            <a href="{{ route('receiver.claims.show', $claim->id) }}"
                                               class="inline-flex items-center px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 font-semibold transition">
                                                View Claim
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-8 text-center text-gray-400">
                                            No completed claims yet. Claim food from the dashboard to start logging impact!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>

    {{-- =========================================================
         MODULAR JAVASCRIPT: Chart.js & Impact Unit Toggle
         Clean, modular architecture with data handling logic
    ========================================================== --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        /**
         * Module 1: Weight Unit Toggle
         * Allows interactive switching between kilograms (kg) and pounds (lbs)
         */
        const ImpactWeightToggle = (function () {
            const totalKg = {{ (float) $totalWeightKg }};
            const totalLbs = {{ (float) $totalWeightLbs }};
            let currentUnit = 'kg';

            function updateUI() {
                const valEl = document.getElementById('displayWeightValue');
                const unitEl = document.getElementById('displayWeightUnit');
                const altEl = document.getElementById('displayWeightAlt');
                const btnKg = document.getElementById('toggleKgBtn');
                const btnLbs = document.getElementById('toggleLbsBtn');

                if (!valEl || !unitEl || !btnKg || !btnLbs) return;

                if (currentUnit === 'kg') {
                    valEl.innerText = totalKg.toLocaleString(undefined, { minimumFractionDigits: 1, maximumFractionDigits: 1 });
                    unitEl.innerText = 'kg';
                    if (altEl) altEl.innerText = `Equal to ${totalLbs.toLocaleString(undefined, { minimumFractionDigits: 1, maximumFractionDigits: 1 })} pounds of edible food`;

                    btnKg.className = 'px-3 py-1.5 rounded-lg bg-emerald-600 text-white transition shadow-sm';
                    btnLbs.className = 'px-3 py-1.5 rounded-lg text-gray-600 hover:text-gray-900 transition';
                } else {
                    valEl.innerText = totalLbs.toLocaleString(undefined, { minimumFractionDigits: 1, maximumFractionDigits: 1 });
                    unitEl.innerText = 'lbs';
                    if (altEl) altEl.innerText = `Equal to ${totalKg.toLocaleString(undefined, { minimumFractionDigits: 1, maximumFractionDigits: 1 })} kg of edible food`;

                    btnLbs.className = 'px-3 py-1.5 rounded-lg bg-emerald-600 text-white transition shadow-sm';
                    btnKg.className = 'px-3 py-1.5 rounded-lg text-gray-600 hover:text-gray-900 transition';
                }
            }

            return {
                setUnit: function (unit) {
                    currentUnit = unit;
                    updateUI();
                }
            };
        })();

        /**
         * Module 2: Donation Trends Chart
         * Interactive 6-month historical Chart.js line & bar chart
         */
        const DonationTrendsChart = (function () {
            let chartInstance = null;
            const months = @json($trendMonths);
            const portionsData = @json($trendPortions);
            const weightData = @json($trendWeightKg);
            let activeMode = 'portions';

            function getDatasets(mode) {
                if (mode === 'portions') {
                    return [{
                        type: 'line',
                        label: 'Portions Rescued (Meals)',
                        data: portionsData,
                        borderColor: '#059669', // Emerald-600
                        backgroundColor: 'rgba(5, 150, 105, 0.12)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.35,
                        pointRadius: 5,
                        pointHoverRadius: 8,
                        pointBackgroundColor: '#059669',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        yAxisID: 'y'
                    }];
                } else if (mode === 'weight') {
                    return [{
                        type: 'line',
                        label: 'Weight Diverted (kg)',
                        data: weightData,
                        borderColor: '#0d9488', // Teal-600
                        backgroundColor: 'rgba(13, 148, 136, 0.12)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.35,
                        pointRadius: 5,
                        pointHoverRadius: 8,
                        pointBackgroundColor: '#0d9488',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        yAxisID: 'y'
                    }];
                } else {
                    // Both
                    return [
                        {
                            type: 'bar',
                            label: 'Portions Rescued (Meals)',
                            data: portionsData,
                            backgroundColor: 'rgba(5, 150, 105, 0.75)',
                            borderColor: '#059669',
                            borderWidth: 1,
                            borderRadius: 6,
                            yAxisID: 'y'
                        },
                        {
                            type: 'line',
                            label: 'Weight Diverted (kg)',
                            data: weightData,
                            borderColor: '#0d9488',
                            backgroundColor: 'rgba(13, 148, 136, 0.15)',
                            borderWidth: 3,
                            fill: false,
                            tension: 0.35,
                            pointRadius: 5,
                            pointHoverRadius: 7,
                            pointBackgroundColor: '#0d9488',
                            yAxisID: 'y1'
                        }
                    ];
                }
            }

            function init() {
                const canvas = document.getElementById('receiverTrendsChart');
                if (!canvas) return;

                const ctx = canvas.getContext('2d');

                chartInstance = new Chart(ctx, {
                    data: {
                        labels: months,
                        datasets: getDatasets(activeMode)
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: {
                            intersect: false,
                            mode: 'index'
                        },
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                                labels: {
                                    boxWidth: 14,
                                    usePointStyle: true,
                                    font: {
                                        family: 'Inter, system-ui, sans-serif',
                                        weight: '600',
                                        size: 12
                                    }
                                }
                            },
                            tooltip: {
                                backgroundColor: '#111827',
                                titleFont: { size: 13, weight: 'bold' },
                                bodyFont: { size: 12 },
                                padding: 12,
                                cornerRadius: 10,
                                displayColors: true
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    font: {
                                        size: 11,
                                        weight: '600'
                                    },
                                    color: '#64748b'
                                }
                            },
                            y: {
                                type: 'linear',
                                display: true,
                                position: 'left',
                                beginAtZero: true,
                                ticks: {
                                    precision: 0,
                                    color: '#64748b'
                                },
                                grid: {
                                    color: 'rgba(226, 232, 240, 0.6)'
                                }
                            },
                            y1: {
                                type: 'linear',
                                display: activeMode === 'both',
                                position: 'right',
                                beginAtZero: true,
                                grid: {
                                    drawOnChartArea: false
                                },
                                ticks: {
                                    precision: 1,
                                    color: '#0d9488'
                                }
                            }
                        }
                    }
                });
            }

            return {
                init: init,
                switchView: function (mode) {
                    activeMode = mode;
                    if (!chartInstance) return;

                    // Update Tab Button Styles
                    const btnP = document.getElementById('chartViewPortions');
                    const btnW = document.getElementById('chartViewWeight');
                    const btnB = document.getElementById('chartViewBoth');

                    [btnP, btnW, btnB].forEach(b => {
                        if (b) b.className = 'px-3 py-1.5 rounded-lg hover:text-gray-900 transition';
                    });

                    if (mode === 'portions' && btnP) {
                        btnP.className = 'px-3 py-1.5 rounded-lg bg-white text-emerald-700 shadow-sm transition';
                    } else if (mode === 'weight' && btnW) {
                        btnW.className = 'px-3 py-1.5 rounded-lg bg-white text-emerald-700 shadow-sm transition';
                    } else if (mode === 'both' && btnB) {
                        btnB.className = 'px-3 py-1.5 rounded-lg bg-white text-emerald-700 shadow-sm transition';
                    }

                    // Update Datasets & Axis
                    chartInstance.data.datasets = getDatasets(mode);
                    chartInstance.options.scales.y1.display = (mode === 'both');
                    chartInstance.update();
                }
            };
        })();

        // Initialize when DOM is ready
        document.addEventListener('DOMContentLoaded', function () {
            DonationTrendsChart.init();
        });
    </script>
</x-app-layout>
