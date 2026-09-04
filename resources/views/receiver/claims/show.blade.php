<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <div class="w-1.5 h-8 rounded-full bg-emerald-500"></div>
                    <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                        Claim Details
                    </h2>
                </div>
                <p class="text-sm text-gray-500 mt-1 ml-4">
                    Manage your food reservation, check volunteer delivery tracking & leave feedback.
                </p>
            </div>
            <a href="{{ route('receiver.claims') }}"
               class="inline-flex items-center px-4 py-2 bg-white border border-gray-200 hover:border-emerald-300 text-gray-700 text-sm font-semibold rounded-xl shadow-sm hover:shadow transition duration-200">
                <svg class="w-4 h-4 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Claims
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

            @php
                $statusLabels = [
                    'approved'  => 'Waiting for Volunteer',
                    'completed' => 'Delivered',
                    'rejected'  => 'Rejected',
                    'cancelled' => 'Cancelled',
                ];

                $deliveryStatus = $claim->delivery?->status;
                $isAssigned = $claim->delivery && $claim->delivery->volunteer_id;

                if ($claim->status === 'completed') {
                    $headerBadgeClass = 'bg-emerald-100 text-emerald-800 border border-emerald-200';
                    $headerBadgeLabel = 'Delivered';
                } elseif ($claim->status === 'cancelled') {
                    $headerBadgeClass = 'bg-rose-100 text-rose-800 border border-rose-200';
                    $headerBadgeLabel = 'Cancelled';
                } elseif ($claim->status === 'rejected') {
                    $headerBadgeClass = 'bg-rose-100 text-rose-800 border border-rose-200';
                    $headerBadgeLabel = 'Rejected';
                } elseif ($deliveryStatus === 'picked_up') {
                    $headerBadgeClass = 'bg-teal-100 text-teal-800 border border-teal-200';
                    $headerBadgeLabel = 'Out for Delivery';
                } elseif ($isAssigned) {
                    $headerBadgeClass = 'bg-cyan-100 text-cyan-800 border border-cyan-200';
                    $headerBadgeLabel = 'Volunteer Assigned';
                } else {
                    $headerBadgeClass = 'bg-amber-100 text-amber-800 border border-amber-200';
                    $headerBadgeLabel = 'Waiting for Volunteer';
                }
            @endphp

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 space-y-8">
                {{-- Header section --}}
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b border-gray-100">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 leading-tight">
                            {{ $claim->foodDonation->title }}
                        </h1>
                        <p class="text-gray-400 text-xs mt-1">Claim #{{ $claim->id }}</p>
                    </div>
                    <span class="rounded-full px-4 py-1.5 text-xs font-semibold {{ $headerBadgeClass }} shadow-sm w-fit">
                        {{ $headerBadgeLabel }}
                    </span>
                </div>

                @if ($claim->status === 'cancelled')
                    <div class="rounded-xl bg-rose-50 border border-rose-200 p-5 text-rose-900">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-rose-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <div>
                                <h4 class="font-bold text-base text-rose-900">This claim was cancelled</h4>
                                @if ($claim->cancellation_reason)
                                    <p class="mt-1 text-sm text-rose-800">
                                        <span class="font-semibold">Reason provided:</span> {{ $claim->cancellation_reason }}
                                    </p>
                                @endif
                                <p class="mt-1 text-xs text-rose-500">
                                    Cancelled on {{ $claim->updated_at->format('d M Y, h:i A') }} • The food has been returned to the available community pool.
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Key Details Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5 p-6 rounded-xl bg-gray-50/70 border border-gray-100">
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Quantity</p>
                        <p class="text-base font-semibold text-gray-900 mt-1">{{ $claim->foodDonation->quantity }} portions</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Pickup Address</p>
                        <p class="text-base font-semibold text-gray-900 mt-1 truncate">{{ $claim->foodDonation->pickup_address }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Pickup Date</p>
                        <p class="text-base font-semibold text-gray-900 mt-1">{{ $claim->foodDonation->pickup_date ?: 'Not specified' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Pickup Time</p>
                        <p class="text-base font-semibold text-gray-900 mt-1">{{ $claim->foodDonation->pickup_time ?: 'Not specified' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Donor</p>
                        <p class="text-base font-semibold text-emerald-700 mt-1">{{ $claim->foodDonation->donor?->name ?? 'Community Partner' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Claimed At</p>
                        <p class="text-base font-semibold text-gray-900 mt-1">{{ $claim->created_at->format('d M Y, h:i A') }}</p>
                    </div>
                </div>

                {{-- Progress Tracker Steps --}}
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Claim & Delivery Progress</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="rounded-xl border p-4 {{ $claim->status === 'approved' && $claim->delivery && is_null($claim->delivery->volunteer_id) ? 'border-amber-300 bg-amber-50/80 shadow-sm' : 'border-gray-100 bg-gray-50/50' }}">
                            <p class="font-semibold text-sm {{ $claim->status === 'approved' && $claim->delivery && is_null($claim->delivery->volunteer_id) ? 'text-amber-900' : 'text-gray-700' }}">1. Waiting for Volunteer</p>
                            <p class="text-xs text-gray-500 mt-1">Claim approved, queued for volunteer drivers.</p>
                        </div>
                        <div class="rounded-xl border p-4 {{ $claim->delivery && in_array($claim->delivery->status, ['accepted','picked_up']) ? 'border-teal-400 bg-teal-50/80 shadow-sm' : 'border-gray-100 bg-gray-50/50' }}">
                            <p class="font-semibold text-sm {{ $claim->delivery && in_array($claim->delivery->status, ['accepted','picked_up']) ? 'text-teal-900' : 'text-gray-700' }}">2. Volunteer Assigned</p>
                            <p class="text-xs text-gray-500 mt-1">
                                @if ($claim->delivery && $claim->delivery->volunteer)
                                    Assigned to <strong>{{ $claim->delivery->volunteer->name }}</strong>
                                @else
                                    A volunteer driver will accept soon.
                                @endif
                            </p>
                        </div>
                        <div class="rounded-xl border p-4 {{ $claim->status === 'completed' ? 'border-emerald-400 bg-emerald-50/80 shadow-sm' : 'border-gray-100 bg-gray-50/50' }}">
                            <p class="font-semibold text-sm {{ $claim->status === 'completed' ? 'text-emerald-900' : 'text-gray-700' }}">3. Delivered</p>
                            <p class="text-xs text-gray-500 mt-1">Food received and marked complete.</p>
                        </div>
                    </div>
                </div>

                {{-- Volunteer Details Section --}}
                @if ($claim->delivery && $claim->delivery->volunteer)
                    <div class="rounded-xl bg-emerald-50/60 border border-emerald-200 p-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="space-y-1">
                            <span class="text-xs font-semibold text-emerald-800 uppercase tracking-wider">Assigned Driver</span>
                            <h4 class="font-bold text-lg text-gray-900">🚴 {{ $claim->delivery->volunteer->name }}</h4>
                            <p class="text-xs text-gray-600">Status: <strong class="text-emerald-800">{{ ucfirst(str_replace('_', ' ', $claim->delivery->status)) }}</strong></p>
                        </div>
                        @if ($claim->delivery->volunteer->phone)
                            <a href="tel:{{ $claim->delivery->volunteer->phone }}"
                               class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-semibold shadow-sm transition">
                                📞 Call Driver
                            </a>
                        @endif
                    </div>
                @endif

                {{-- Rating Section: Donor --}}
                @if ($claim->status === 'completed' && $claim->delivery)
                    @php
                        $hasRated = $claim->delivery->rating !== null
                            && $claim->delivery->rating->giver_id === auth()->id();
                    @endphp

                    <div class="rounded-2xl bg-amber-50/60 border border-amber-200 p-6 shadow-sm">
                        <h3 class="text-xl font-bold text-amber-900">
                            ★ Rate the Food Donor
                        </h3>

                        @if ($hasRated)
                            <div class="mt-2 text-sm text-amber-800 flex items-center gap-2">
                                <span class="text-amber-600 font-bold text-lg">✓</span>
                                You submitted a {{ $claim->delivery->rating->rating }}-star rating for this donation. Thank you for your feedback!
                            </div>
                        @else
                            <p class="mt-1 text-xs text-amber-700">
                                How was the quality, packaging, and freshness of this food donation?
                            </p>

                            <form method="POST" action="{{ route('receiver.claims.rate', $claim) }}" class="mt-4 space-y-4">
                                @csrf

                                <div>
                                    <label for="rating" class="block text-xs font-semibold text-amber-900 uppercase tracking-wider mb-1">
                                        Rating Score <span class="text-rose-600">*</span>
                                    </label>
                                    <select id="rating"
                                            name="rating"
                                            required
                                            class="w-full sm:w-64 rounded-xl border border-amber-300 text-sm text-gray-800 focus:border-amber-500 focus:ring-amber-500 shadow-sm py-2 px-3">
                                        <option value="">Select rating</option>
                                        <option value="5">★★★★★ — 5 Stars (Excellent)</option>
                                        <option value="4">★★★★☆ — 4 Stars (Good)</option>
                                        <option value="3">★★★☆☆ — 3 Stars (Average)</option>
                                        <option value="2">★★☆☆☆ — 2 Stars (Poor)</option>
                                        <option value="1">★☆☆☆☆ — 1 Star (Very Poor)</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="review" class="block text-xs font-semibold text-amber-900 uppercase tracking-wider mb-1">
                                        Review Message <span class="text-amber-600">(Optional)</span>
                                    </label>
                                    <textarea id="review"
                                              name="review"
                                              rows="3"
                                              maxlength="1000"
                                              class="w-full rounded-xl border border-amber-300 text-sm text-gray-800 focus:border-amber-500 focus:ring-amber-500 shadow-sm py-2 px-4"
                                              placeholder="Share appreciation or notes for the donor..."></textarea>
                                </div>

                                <button type="submit"
                                        style="background-color: #f59e0b; color: #ffffff;"
                                        class="py-2.5 px-6 rounded-xl bg-amber-500 hover:bg-amber-600 text-white font-semibold text-xs shadow-sm transition cursor-pointer">
                                    Submit Donor Rating
                                </button>
                            </form>
                        @endif
                    </div>
                @endif

                {{-- Rating Section: Volunteer Driver --}}
                @if ($claim->status === 'completed' && $claim->delivery)
                    @php
                        $hasVolunteerRated = $claim->delivery->volunteerRating !== null
                            && $claim->delivery->volunteerRating->giver_id === auth()->id();
                    @endphp

                    <div class="rounded-2xl bg-teal-50/60 border border-teal-200 p-6 shadow-sm">
                        <h3 class="text-xl font-bold text-teal-900">
                            ★ Rate the Volunteer Driver
                        </h3>

                        @if (!$claim->delivery->volunteer)
                            <p class="mt-2 text-xs text-teal-700">
                                No volunteer was assigned to this delivery.
                            </p>
                        @elseif ($hasVolunteerRated)
                            <div class="mt-2 text-sm text-teal-800 flex items-center gap-2">
                                <span class="text-teal-600 font-bold text-lg">✓</span>
                                You submitted a {{ $claim->delivery->volunteerRating->rating }}-star rating for driver {{ $claim->delivery->volunteer->name }}. Thank you!
                            </div>
                        @else
                            <p class="mt-1 text-xs text-teal-700">
                                How was your delivery experience with <strong>{{ $claim->delivery->volunteer->name }}</strong>?
                            </p>

                            <form method="POST" action="{{ route('receiver.claims.rate-volunteer', $claim) }}" class="mt-4 space-y-4">
                                @csrf

                                <div>
                                    <label for="volunteer_rating" class="block text-xs font-semibold text-teal-900 uppercase tracking-wider mb-1">
                                        Driver Rating <span class="text-rose-600">*</span>
                                    </label>
                                    <select id="volunteer_rating"
                                            name="rating"
                                            required
                                            class="w-full sm:w-64 rounded-xl border border-teal-300 text-sm text-gray-800 focus:border-teal-500 focus:ring-teal-500 shadow-sm py-2 px-3">
                                        <option value="">Select rating</option>
                                        <option value="5">★★★★★ — 5 Stars (Prompt & Courteous)</option>
                                        <option value="4">★★★★☆ — 4 Stars (Good)</option>
                                        <option value="3">★★★☆☆ — 3 Stars (Satisfactory)</option>
                                        <option value="2">★★☆☆☆ — 2 Stars (Late / Issues)</option>
                                        <option value="1">★☆☆☆☆ — 1 Star (Unsatisfactory)</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="volunteer_review" class="block text-xs font-semibold text-teal-900 uppercase tracking-wider mb-1">
                                        Feedback for Driver <span class="text-teal-600">(Optional)</span>
                                    </label>
                                    <textarea id="volunteer_review"
                                              name="review"
                                              rows="3"
                                              maxlength="1000"
                                              class="w-full rounded-xl border border-teal-300 text-sm text-gray-800 focus:border-teal-500 focus:ring-teal-500 shadow-sm py-2 px-4"
                                              placeholder="Share your experience with the driver's service..."></textarea>
                                </div>

                                <button type="submit"
                                        style="background-color: #0d9488; color: #ffffff;"
                                        class="py-2.5 px-6 rounded-xl bg-teal-600 hover:bg-teal-700 text-white font-semibold text-xs shadow-sm transition cursor-pointer">
                                    Submit Driver Rating
                                </button>
                            </form>
                        @endif
                    </div>
                @endif

                {{-- Report an Issue Section --}}
                <div class="rounded-2xl bg-rose-50/60 border border-rose-200 p-6">
                    <h3 class="text-xl font-bold text-rose-900">
                        ⚠️ Report an Issue
                    </h3>
                    <p class="text-xs text-rose-700 mt-1">
                        If there is a problem with this food donation, delivery, or volunteer pickup, let us know immediately.
                    </p>

                    <form method="POST" action="{{ route('receiver.claims.report', $claim) }}" class="mt-4 space-y-4">
                        @csrf

                        <div>
                            <label for="reason" class="block text-xs font-semibold text-rose-900 uppercase tracking-wider mb-1">
                                Describe the Issue <span class="text-rose-600">*</span>
                            </label>
                            <textarea id="reason"
                                      name="reason"
                                      rows="3"
                                      required
                                      minlength="10"
                                      maxlength="1000"
                                      class="w-full rounded-xl border border-rose-200 text-sm text-gray-800 focus:border-rose-500 focus:ring-rose-500 shadow-sm py-2 px-4"
                                      placeholder="Describe the issue with the food quality, quantity, or delivery..."></textarea>
                            @error('reason')
                                <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                                style="background-color: #dc2626; color: #ffffff;"
                                class="inline-flex items-center gap-2 py-2.5 px-6 rounded-xl bg-red-600 hover:bg-red-700 text-white font-semibold text-xs shadow-md shadow-red-600/20 hover:shadow-lg transition duration-200 cursor-pointer">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            Submit Issue Report
                        </button>
                    </form>
                </div>

                {{-- Bottom Actions & Cancel Claim Modal Trigger --}}
                <div x-data="{ showCancelModal: false }" class="pt-4 border-t border-gray-100">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <a href="{{ route('receiver.claims') }}"
                           class="rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-5 py-2.5 text-xs transition">
                            ← Back to My Claims
                        </a>

                        @if ($claim->status === 'approved' && $claim->delivery && is_null($claim->delivery->volunteer_id))
                            <button @click="showCancelModal = true"
                                    type="button"
                                    class="rounded-xl bg-rose-50 border border-rose-200 px-5 py-2.5 text-rose-700 font-semibold text-xs hover:bg-rose-100 transition flex items-center gap-2">
                                <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Cancel Claim
                            </button>
                        @endif
                    </div>

                    {{-- Cancellation Reason Modal --}}
                    @if ($claim->status === 'approved' && $claim->delivery && is_null($claim->delivery->volunteer_id))
                        <div x-show="showCancelModal"
                             x-cloak
                             class="fixed inset-0 z-50 overflow-y-auto bg-black/60 backdrop-blur-sm flex items-center justify-center p-4">
                            <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-xl border border-gray-100"
                                 @click.away="showCancelModal = false">
                                <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center font-bold">
                                            ✕
                                        </div>
                                        <h3 class="text-lg font-bold text-gray-900">Cancel Food Claim</h3>
                                    </div>
                                    <button @click="showCancelModal = false" class="text-gray-400 hover:text-gray-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>

                                <p class="mt-3 text-xs text-gray-600 leading-relaxed">
                                    Cancelling this claim will release <strong>{{ $claim->foodDonation->title }}</strong> back into the public donations list so other families in need can claim it.
                                </p>

                                <form method="POST" action="{{ route('receiver.claims.cancel', $claim) }}" class="mt-4 space-y-4">
                                    @csrf
                                    @method('PATCH')

                                    <div>
                                        <label for="cancellation_reason" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">
                                            Cancellation Reason <span class="text-rose-500">*</span>
                                        </label>
                                        <textarea id="cancellation_reason"
                                                  name="cancellation_reason"
                                                  rows="3"
                                                  required
                                                  minlength="5"
                                                  maxlength="1000"
                                                  placeholder="Please explain why you need to cancel (e.g., schedule conflict, surplus already acquired)..."
                                                  class="w-full rounded-xl border border-gray-200 text-sm text-gray-800 focus:border-rose-500 focus:ring-rose-500 shadow-sm py-2 px-3"></textarea>
                                    </div>

                                    <div class="flex justify-end gap-3 pt-2">
                                        <button type="button"
                                                @click="showCancelModal = false"
                                                class="px-4 py-2 text-xs font-semibold text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition">
                                            Keep Claim
                                        </button>
                                        <button type="submit"
                                                style="background-color: #dc2626; color: #ffffff;"
                                                class="px-5 py-2 text-xs font-semibold text-white bg-red-600 hover:bg-red-700 rounded-xl shadow-sm transition cursor-pointer">
                                            Confirm Cancellation
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
