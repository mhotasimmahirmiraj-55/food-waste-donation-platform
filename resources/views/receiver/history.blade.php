<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <div class="w-1.5 h-8 rounded-full bg-emerald-500"></div>
                    <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                        Donation History
                    </h2>
                </div>
                <p class="text-sm text-gray-500 mt-1 ml-4">
                    Your complete record of received food donations and completed deliveries.
                </p>
            </div>
            <a href="{{ route('receiver.donations') }}"
               class="inline-flex items-center px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl shadow-md hover:shadow-lg transition duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Browse More Food
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-emerald-100 via-teal-50 to-cyan-100 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Impact Overview Stats --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                {{-- Total Deliveries --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-center justify-between hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Deliveries Received</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">{{ number_format($totalDeliveries) }}</p>
                        <p class="text-xs text-emerald-600 font-medium mt-1">100% completed</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </div>

                {{-- Meals / Portions Diverted --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-center justify-between hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Food Portions Saved</p>
                        <p class="text-3xl font-bold text-teal-700 mt-1">{{ number_format($totalMeals) }}</p>
                        <p class="text-xs text-teal-600 font-medium mt-1">Diverted from waste</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-teal-100 text-teal-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                </div>

                {{-- Unique Donors --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-center justify-between hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Donors Supported</p>
                        <p class="text-3xl font-bold text-cyan-700 mt-1">{{ number_format($uniqueDonors) }}</p>
                        <p class="text-xs text-cyan-600 font-medium mt-1">Local food heroes</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-cyan-100 text-cyan-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                </div>

                {{-- Volunteers --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex items-center justify-between hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Volunteers Assisted</p>
                        <p class="text-3xl font-bold text-purple-700 mt-1">{{ number_format($uniqueVolunteers) }}</p>
                        <p class="text-xs text-purple-600 font-medium mt-1">Delivery champions</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- History Section --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                {{-- Header & Search bar --}}
                <div class="p-6 border-b border-gray-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h3 class="font-bold text-xl text-gray-900">Completed Donation Records</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Every successfully delivered food donation you received</p>
                    </div>

                    <form method="GET" action="{{ route('receiver.history') }}" class="flex items-center gap-2">
                        <div class="relative">
                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   placeholder="Search by food or address..."
                                   class="pl-9 pr-4 py-2 border border-gray-200 rounded-xl text-sm text-gray-800 focus:ring-emerald-500 focus:border-emerald-500 w-64 shadow-sm" />
                            <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <button type="submit"
                                class="px-5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold rounded-xl shadow-sm transition">
                            Filter
                        </button>
                        @if (request('search'))
                            <a href="{{ route('receiver.history') }}" class="text-xs text-emerald-600 font-medium hover:underline">Clear</a>
                        @endif
                    </form>
                </div>

                {{-- List / Table --}}
                @if ($claims->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-gray-600">
                            <thead class="bg-gray-50/80 text-xs uppercase font-semibold text-gray-500 tracking-wider">
                                <tr>
                                    <th class="px-6 py-4">Food Item</th>
                                    <th class="px-6 py-4">Donor</th>
                                    <th class="px-6 py-4">Portions</th>
                                    <th class="px-6 py-4">Delivered On</th>
                                    <th class="px-6 py-4">Volunteer</th>
                                    <th class="px-6 py-4">Feedback</th>
                                    <th class="px-6 py-4 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($claims as $claim)
                                    <tr class="hover:bg-emerald-50/20 transition">
                                        <td class="px-6 py-4">
                                            <div class="font-bold text-gray-900">{{ $claim->foodDonation->title ?? 'Food Item' }}</div>
                                            @if ($claim->foodDonation && $claim->foodDonation->category)
                                                <span class="inline-block mt-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200">
                                                    {{ $claim->foodDonation->category->name }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <p class="font-semibold text-gray-900">{{ $claim->foodDonation->donor->name ?? 'Donor' }}</p>
                                            <p class="text-xs text-gray-400 mt-0.5 truncate max-w-xs">{{ $claim->foodDonation->pickup_address ?? 'Address' }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="font-semibold text-gray-900">{{ $claim->foodDonation->quantity ?? 1 }}</span>
                                            <span class="text-xs text-gray-500">portions</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($claim->delivery && $claim->delivery->delivered_at)
                                                <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($claim->delivery->delivered_at)->format('d M Y') }}</p>
                                                <p class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($claim->delivery->delivered_at)->format('h:i A') }}</p>
                                            @elseif ($claim->updated_at)
                                                <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($claim->updated_at)->format('d M Y') }}</p>
                                                <p class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($claim->updated_at)->format('h:i A') }}</p>
                                            @else
                                                <p class="text-xs text-gray-400">Delivered</p>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($claim->delivery && $claim->delivery->volunteer)
                                                <div class="flex items-center gap-2">
                                                    <div class="w-7 h-7 rounded-full bg-teal-100 text-teal-800 font-bold text-xs flex items-center justify-center">
                                                        {{ strtoupper(substr($claim->delivery->volunteer->name, 0, 1)) }}
                                                    </div>
                                                    <span class="text-gray-900 font-medium text-xs">{{ $claim->delivery->volunteer->name }}</span>
                                                </div>
                                            @else
                                                <span class="text-gray-400 italic text-xs">Direct pickup</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            @php
                                                $donorRated = $claim->delivery && $claim->delivery->rating;
                                                $volRated = $claim->delivery && $claim->delivery->volunteerRating;
                                            @endphp
                                            <div class="space-y-1">
                                                <div class="flex items-center gap-1 text-xs">
                                                    <span class="text-gray-500">Donor:</span>
                                                    @if ($donorRated)
                                                        <span class="text-amber-500 font-bold">★ {{ $claim->delivery->rating->rating }}/5</span>
                                                    @else
                                                        <a href="{{ route('receiver.claims.show', $claim) }}" class="text-emerald-600 font-medium hover:underline">Rate</a>
                                                    @endif
                                                </div>
                                                @if ($claim->delivery && $claim->delivery->volunteer)
                                                    <div class="flex items-center gap-1 text-xs">
                                                        <span class="text-gray-500">Volunteer:</span>
                                                        @if ($volRated)
                                                            <span class="text-amber-500 font-bold">★ {{ $claim->delivery->volunteerRating->rating }}/5</span>
                                                        @else
                                                            <a href="{{ route('receiver.claims.show', $claim) }}" class="text-emerald-600 font-medium hover:underline">Rate</a>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('receiver.claims.show', $claim) }}"
                                               class="inline-flex items-center px-3.5 py-1.5 rounded-xl text-xs font-semibold text-emerald-700 bg-emerald-50 hover:bg-emerald-600 hover:text-white transition">
                                                View Claim
                                                <svg class="w-3.5 h-3.5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if ($claims->hasPages())
                        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                            {{ $claims->links() }}
                        </div>
                    @endif
                @else
                    <div class="text-center py-16 px-4">
                        <div class="w-16 h-16 mx-auto bg-gray-100 rounded-2xl flex items-center justify-center text-gray-400 mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-800 text-lg">No completed donations yet</h4>
                        <p class="text-sm text-gray-500 mt-1 max-w-sm mx-auto">
                            When your claimed donations are marked as delivered by volunteers, their impact record and rating opportunities will appear here.
                        </p>
                        <div class="mt-6">
                            <a href="{{ route('receiver.donations') }}"
                               class="inline-flex items-center px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold rounded-xl shadow-sm transition">
                                Browse Available Food
                            </a>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
