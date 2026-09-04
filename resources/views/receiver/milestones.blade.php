<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2.5">
                    <span class="text-xl">🎮</span>
                    <h2 class="font-bold text-xl text-gray-900 leading-tight">
                        Game & Milestone
                    </h2>
                </div>
                <p class="text-xs text-gray-500 mt-1">
                    Your rescue streaks, level progression, and community achievements.
                </p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('receiver.dashboard') }}"
                   class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold rounded-xl shadow-2xs transition">
                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Dashboard
                </a>
            </div>
        </div>
    </x-slot>

    {{-- Clean, serene background --}}
    <div class="min-h-screen bg-gray-50/80 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- =========================================================
                 MINIMAL LEVEL & XP HEADER CARD
            ========================================================== --}}
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs p-6 sm:p-7">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
                    
                    {{-- Level Details & Progress --}}
                    <div class="lg:col-span-7 space-y-3">
                        <div class="flex items-center gap-2.5">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/60 tracking-wide uppercase">
                                Level {{ $level }}
                            </span>
                            <span class="text-sm font-semibold text-gray-700">
                                @if($level >= 5)
                                    Community Champion
                                @elseif($level >= 3)
                                    Zero-Waste Advocate
                                @elseif($level >= 2)
                                    Active Rescuer
                                @else
                                    Grassroots Seedling
                                @endif
                            </span>
                        </div>

                        <div class="space-y-1.5">
                            <div class="flex justify-between text-xs text-gray-500 font-medium">
                                <span>Progress to Level {{ $level + 1 }}</span>
                                <span class="text-gray-700 font-semibold">{{ $xpInCurrentLevel }} / 200 XP ({{ $levelProgressPercent }}%)</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2 overflow-hidden">
                                <div class="bg-emerald-500 h-2 rounded-full transition-all duration-500"
                                     style="width: {{ $levelProgressPercent }}%"></div>
                            </div>
                        </div>

                        <p class="text-xs text-gray-400">
                            Earn 10 XP per portion claimed, 50 XP per completed delivery, and 100 XP per streak week.
                        </p>
                    </div>

                    {{-- Quick Minimal Metrics --}}
                    <div class="lg:col-span-5 grid grid-cols-3 gap-3 border-t lg:border-t-0 lg:border-l border-gray-100 pt-4 lg:pt-0 lg:pl-6 text-center">
                        <div class="p-2">
                            <div class="text-xl sm:text-2xl font-bold text-gray-900 tracking-tight">
                                {{ number_format($totalXP) }}
                            </div>
                            <div class="text-[11px] text-gray-500 font-medium mt-0.5">Total XP</div>
                        </div>
                        <div class="p-2">
                            <div class="text-xl sm:text-2xl font-bold text-gray-900 tracking-tight flex items-center justify-center gap-1">
                                {{ $streakWeeks }} <span class="text-xs font-normal text-amber-500">🔥</span>
                            </div>
                            <div class="text-[11px] text-gray-500 font-medium mt-0.5">Streak Wks</div>
                        </div>
                        <div class="p-2">
                            <div class="text-xl sm:text-2xl font-bold text-emerald-600 tracking-tight">
                                {{ count(array_filter($badges, fn($b) => $b['unlocked'])) }}/{{ count($badges) }}
                            </div>
                            <div class="text-[11px] text-gray-500 font-medium mt-0.5">Badges</div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- =========================================================
                 2-COLUMN: TOP SUPPORTER & RESCUE STREAKS
            ========================================================== --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- 1. TOP COMMUNITY SUPPORTER --}}
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs p-6 flex flex-col justify-between space-y-5">
                    <div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider">
                                    Top Supporter
                                </h3>
                            </div>
                            <span class="text-xs text-gray-400 font-medium">Donor Recognition</span>
                        </div>

                        @if ($topDonor)
                            <div class="mt-4 p-4 rounded-xl bg-gray-50 border border-gray-100 flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-emerald-600 text-white flex items-center justify-center font-bold text-lg shrink-0">
                                    {{ strtoupper(substr($topDonor->name, 0, 1)) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-base font-bold text-gray-900 truncate">
                                        {{ $topDonor->name }}
                                    </h4>
                                    <p class="text-xs text-gray-500 truncate">
                                        {{ $topDonor->organization_name ?? 'Community Food Donor' }}
                                    </p>
                                    <div class="flex items-center gap-3 mt-2 text-xs text-gray-600">
                                        <span><strong class="text-gray-900">{{ number_format($topDonorMeals) }}</strong> portions</span>
                                        <span class="text-gray-300">•</span>
                                        <span><strong class="text-gray-900">{{ number_format($topDonorDonations) }}</strong> pickups</span>
                                    </div>
                                </div>
                            </div>

                            <p class="mt-3 text-xs text-gray-600 italic bg-emerald-50/50 p-2.5 rounded-lg border border-emerald-100 text-center">
                                "Your biggest supporter is <strong class="text-emerald-900 not-italic">{{ $topDonor->name }}</strong>! Thank you for reducing food waste together."
                            </p>
                        @else
                            <div class="mt-4 text-center py-6 px-4 bg-gray-50 rounded-xl border border-dashed border-gray-200">
                                <p class="text-xs text-gray-500">
                                    No completed donations yet. Your top donor partner will appear here once you receive your first delivery.
                                </p>
                            </div>
                        @endif
                    </div>

                    <div class="pt-3 border-t border-gray-100 flex items-center justify-between text-xs">
                        <span class="text-gray-400">Based on total meals rescued</span>
                        <a href="{{ route('receiver.donations') }}" class="font-semibold text-emerald-600 hover:text-emerald-700">
                            Find Donations →
                        </a>
                    </div>
                </div>

                {{-- 2. ACTIVE RESCUE STREAK --}}
                <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs p-6 flex flex-col justify-between space-y-5">
                    <div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider">
                                    Active Rescue Streak
                                </h3>
                            </div>
                            <span class="text-xs font-semibold text-amber-700 bg-amber-50 px-2.5 py-0.5 rounded-full border border-amber-200/60">
                                {{ $streakBadge }}
                            </span>
                        </div>

                        <div class="mt-4 p-4 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-between">
                            <div>
                                <div class="text-2xl sm:text-3xl font-bold text-gray-900 tracking-tight">
                                    {{ $streakWeeks }} <span class="text-sm font-medium text-gray-500">consecutive {{ Str::plural('week', $streakWeeks) }}</span>
                                </div>
                                <p class="text-xs text-gray-500 mt-0.5">
                                    Keep claiming at least 1 donation per week to hold your streak.
                                </p>
                            </div>
                            <span class="text-3xl">🔥</span>
                        </div>

                        {{-- Next Tier Progress --}}
                        <div class="mt-4 space-y-1.5">
                            <div class="flex justify-between text-xs text-gray-500">
                                <span>Next: <strong class="text-gray-700 font-semibold">{{ $nextTierName }}</strong></span>
                                <span>{{ $streakWeeks }} / {{ $nextTierTarget }} weeks</span>
                            </div>
                            @php
                                $streakPercent = min(100, round(($streakWeeks / max(1, $nextTierTarget)) * 100));
                            @endphp
                            <div class="w-full bg-gray-100 rounded-full h-2 overflow-hidden">
                                <div class="bg-amber-500 h-2 rounded-full transition-all duration-500"
                                     style="width: {{ $streakPercent }}%"></div>
                            </div>
                        </div>

                        {{-- Tier Roadmap Pills --}}
                        <div class="mt-3 grid grid-cols-3 gap-2 text-center text-[11px]">
                            <div class="p-1.5 rounded-lg border {{ $streakWeeks >= 1 ? 'bg-emerald-50 border-emerald-200 text-emerald-800 font-bold' : 'bg-gray-50 border-gray-100 text-gray-400' }}">
                                1+ Wk Partner
                            </div>
                            <div class="p-1.5 rounded-lg border {{ $streakWeeks >= 4 ? 'bg-emerald-50 border-emerald-200 text-emerald-800 font-bold' : 'bg-gray-50 border-gray-100 text-gray-400' }}">
                                4+ Wks Sustainer
                            </div>
                            <div class="p-1.5 rounded-lg border {{ $streakWeeks >= 12 ? 'bg-emerald-50 border-emerald-200 text-emerald-800 font-bold' : 'bg-gray-50 border-gray-100 text-gray-400' }}">
                                12+ Wks Champion
                            </div>
                        </div>
                    </div>

                    <div class="pt-3 border-t border-gray-100 flex items-center justify-between text-xs">
                        <span class="text-gray-400">Weekly consistency tracker</span>
                        <span class="font-semibold text-emerald-600">Active Rescue Streaks</span>
                    </div>
                </div>

            </div>

            {{-- =========================================================
                 MINIMALIST ACHIEVEMENT BADGES CABINET
            ========================================================== --}}
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs p-6 space-y-5">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-bold text-gray-900">
                            Achievements
                        </h3>
                        <p class="text-xs text-gray-500 mt-0.5">
                            Milestones unlocked through food rescue consistency and community participation.
                        </p>
                    </div>
                    <span class="text-xs font-semibold px-2.5 py-1 bg-gray-100 text-gray-700 rounded-md">
                        {{ count(array_filter($badges, fn($b) => $b['unlocked'])) }} of {{ count($badges) }} Unlocked
                    </span>
                </div>

                {{-- Badges Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($badges as $badge)
                        <div class="p-4 rounded-xl border transition-colors flex flex-col justify-between
                            {{ $badge['unlocked']
                                ? 'bg-white border-emerald-200/80'
                                : 'bg-gray-50/50 border-gray-200/60 opacity-75' }}">
                            
                            <div>
                                <div class="flex items-start justify-between gap-2">
                                    <span class="text-2xl">{{ $badge['icon'] }}</span>
                                    @if ($badge['unlocked'])
                                        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200/60">
                                            ✓ Unlocked
                                        </span>
                                    @else
                                        <span class="inline-flex items-center text-[11px] font-medium text-gray-400 bg-gray-100 px-2 py-0.5 rounded">
                                            Locked
                                        </span>
                                    @endif
                                </div>

                                <div class="mt-3">
                                    <div class="text-[10px] font-bold uppercase tracking-wider text-gray-400">
                                        {{ $badge['category'] }}
                                    </div>
                                    <h4 class="text-sm font-bold text-gray-900 mt-0.5">
                                        {{ $badge['title'] }}
                                    </h4>
                                    <p class="text-xs text-gray-500 mt-1 leading-relaxed">
                                        {{ $badge['description'] }}
                                    </p>
                                </div>
                            </div>

                            {{-- Minimal Progress Bar --}}
                            <div class="mt-4 pt-3 border-t border-gray-100 space-y-1">
                                <div class="flex justify-between text-[11px] font-medium {{ $badge['unlocked'] ? 'text-emerald-700' : 'text-gray-500' }}">
                                    <span>{{ $badge['progress_text'] }}</span>
                                    <span>{{ round($badge['progress']) }}%</span>
                                </div>
                                <div class="w-full bg-gray-100 rounded-full h-1.5 overflow-hidden">
                                    <div class="h-1.5 rounded-full transition-all duration-500 {{ $badge['unlocked'] ? 'bg-emerald-500' : 'bg-gray-300' }}"
                                         style="width: {{ $badge['progress'] }}%"></div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
