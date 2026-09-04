<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <div class="w-1.5 h-8 rounded-full bg-emerald-500"></div>
                    <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                        My Claims
                    </h2>
                </div>
                <p class="text-sm text-gray-500 mt-1 ml-4">
                    Track live delivery status, volunteer driver assignments, and pickups.
                </p>
            </div>
            <a href="{{ route('receiver.donations') }}"
               class="inline-flex items-center px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl shadow-md hover:shadow-lg transition duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Browse Food
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-emerald-100 via-teal-50 to-cyan-100 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
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
                <div class="p-6 sm:p-8 border-b border-gray-100">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">Claim History</h3>
                            <p class="text-sm text-gray-500 mt-1">Track the status of every community food request.</p>
                        </div>
                        <span class="px-3.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 w-fit">
                            {{ $claims->total() }} Total Claims
                        </span>
                    </div>
                </div>

                <div class="divide-y divide-gray-100">
                    @forelse ($claims as $claim)
                        @php
                            $deliveryStatus = $claim->delivery?->status;
                            $isAssigned = $claim->delivery && $claim->delivery->volunteer_id;

                            if ($claim->status === 'completed') {
                                $badgeClass = 'bg-emerald-100 text-emerald-800 border border-emerald-200';
                                $badgeLabel = 'Delivered';
                            } elseif ($claim->status === 'cancelled') {
                                $badgeClass = 'bg-rose-100 text-rose-800 border border-rose-200';
                                $badgeLabel = 'Cancelled';
                            } elseif ($claim->status === 'rejected') {
                                $badgeClass = 'bg-rose-100 text-rose-800 border border-rose-200';
                                $badgeLabel = 'Rejected';
                            } elseif ($deliveryStatus === 'picked_up') {
                                $badgeClass = 'bg-teal-100 text-teal-800 border border-teal-200';
                                $badgeLabel = 'Out for Delivery';
                            } elseif ($isAssigned) {
                                $badgeClass = 'bg-cyan-100 text-cyan-800 border border-cyan-200';
                                $badgeLabel = 'Volunteer Assigned';
                            } else {
                                $badgeClass = 'bg-amber-100 text-amber-800 border border-amber-200';
                                $badgeLabel = 'Waiting for Volunteer';
                            }
                        @endphp

                        <div class="p-6 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 hover:bg-emerald-50/20 transition">
                            <div class="space-y-1 min-w-0">
                                <h4 class="text-lg font-bold text-gray-900">{{ $claim->foodDonation->title }}</h4>
                                <p class="text-xs text-gray-500 flex items-center gap-1">
                                    📍 {{ $claim->foodDonation->pickup_address }}
                                </p>
                                <p class="text-xs text-gray-400">
                                    Claimed {{ $claim->created_at->format('d M Y, h:i A') }}
                                    @if ($claim->delivery && $claim->delivery->volunteer)
                                        • <span class="text-emerald-700 font-medium">Driver: {{ $claim->delivery->volunteer->name }}</span>
                                    @endif
                                </p>
                            </div>

                            <div class="flex items-center gap-3 shrink-0">
                                <span class="rounded-full px-3.5 py-1 text-xs font-semibold {{ $badgeClass }}">
                                    {{ $badgeLabel }}
                                </span>
                                <a href="{{ route('receiver.claims.show', $claim) }}"
                                   class="rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2 text-xs font-semibold shadow-sm transition">
                                    Details
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="p-14 text-center text-gray-400">
                            You have not claimed any donations yet.
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="mt-6">{{ $claims->links() }}</div>
        </div>
    </div>
</x-app-layout>
