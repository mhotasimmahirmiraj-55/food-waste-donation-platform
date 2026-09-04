<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <div class="w-1.5 h-8 rounded-full bg-emerald-500"></div>
                    <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                        Help Center & Support
                    </h2>
                </div>
                <p class="text-sm text-gray-500 mt-1 ml-4">
                    We're here to assist you with claims, pickups, technical questions, and community support.
                </p>
            </div>
            <a href="{{ route('receiver.dashboard') }}"
               class="inline-flex items-center px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl shadow-md hover:shadow-lg transition duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-emerald-100 via-teal-50 to-cyan-100 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

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

            {{-- Hero Search Banner (matching Donor Dashboard emerald gradient) --}}
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-emerald-800 via-emerald-600 to-teal-500 shadow-xl text-white p-8 sm:p-12 text-center">
                <div class="absolute -right-16 -top-24 w-72 h-72 rounded-full bg-white/10 pointer-events-none"></div>
                <div class="absolute right-36 -bottom-28 w-56 h-56 rounded-full bg-white/10 pointer-events-none"></div>

                <div class="relative z-10 max-w-2xl mx-auto space-y-4">
                    <span class="inline-flex px-3 py-1 rounded-full bg-white/15 text-emerald-50 text-xs font-semibold tracking-wide">
                        HELP & SUPPORT
                    </span>
                    <h1 class="text-3xl sm:text-4xl font-bold text-white tracking-tight">
                        How can we help?
                    </h1>
                    <p class="text-emerald-50 text-base leading-relaxed">
                        Find answers to common questions, report an issue with a claim, or get in touch with our team.
                    </p>

                    {{-- Search bar: "Search for help....(press enter)" --}}
                    <form method="GET" action="{{ route('receiver.help') }}" class="mt-6">
                        <div class="relative max-w-xl mx-auto">
                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   placeholder="Search for help....(press enter)"
                                   class="w-full pl-12 pr-4 py-4 rounded-2xl bg-white text-gray-800 placeholder-gray-400 text-sm sm:text-base shadow-lg border border-gray-100 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/20 transition outline-none" />
                            <svg class="w-5 h-5 text-emerald-600 absolute left-4 top-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </form>
                </div>
            </div>

            {{-- 4 Core Support Channels --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                {{-- 1. Contact Customer Support --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900 text-lg">Contact Customer Support</h3>
                        <p class="text-xs text-gray-500 mt-1.5 leading-relaxed">
                            Need personalized assistance? Reach our dedicated receiver support team anytime.
                        </p>
                        <div class="mt-4 pt-3 border-t border-gray-100 text-xs text-gray-600 space-y-1">
                            <p>📞 <strong>Helpline:</strong> +880 1700-000000</p>
                            <p>✉️ <strong>Email:</strong> support@fooddonation.org</p>
                            <p>⏰ <strong>Hours:</strong> 8:00 AM - 10:00 PM</p>
                        </div>
                    </div>
                    <div class="mt-5">
                        <a href="mailto:support@fooddonation.org"
                           class="w-full inline-block text-center py-2.5 px-4 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs rounded-xl shadow-sm transition">
                            Email Support
                        </a>
                    </div>
                </div>

                {{-- 2. Issue With My Claim --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900 text-lg">Issue with My Claim</h3>
                        <p class="text-xs text-gray-500 mt-1.5 leading-relaxed">
                            Food not received, incorrect quantity, or pickup location problem? File an immediate issue report.
                        </p>
                        <div class="mt-4 pt-3 border-t border-gray-100 text-xs text-gray-600">
                            @if ($activeClaims->count() > 0)
                                <p class="text-xs font-semibold text-gray-800 mb-2">Select an active claim:</p>
                                <div class="space-y-1.5 max-h-24 overflow-y-auto">
                                    @foreach ($activeClaims as $ac)
                                        <a href="{{ route('receiver.claims.show', $ac) }}"
                                           class="block text-xs text-emerald-700 font-medium hover:underline truncate">
                                            • {{ $ac->foodDonation->title ?? 'Claim #'.$ac->id }}
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-xs text-gray-400 italic">No active claims right now.</p>
                            @endif
                        </div>
                    </div>
                    <div class="mt-5">
                        <a href="{{ route('receiver.claims') }}"
                           class="w-full inline-block text-center py-2.5 px-4 bg-gray-800 hover:bg-gray-900 text-white font-semibold text-xs rounded-xl shadow-sm transition">
                            Go to Claims
                        </a>
                    </div>
                </div>

                {{-- 3. My Requests --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-teal-100 text-teal-600 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900 text-lg">My Requests</h3>
                        <p class="text-xs text-gray-500 mt-1.5 leading-relaxed">
                            Check the live status of all issues, claims, or inquiries you submitted to the platform.
                        </p>
                        <div class="mt-4 pt-3 border-t border-gray-100 text-xs text-gray-600">
                            <p><strong>Reports Submitted:</strong> {{ $myReports->count() }}</p>
                            <p class="mt-1">
                                <strong>Pending Review:</strong>
                                <span class="font-bold text-amber-600">{{ $myReports->where('status', 'pending')->count() }}</span>
                            </p>
                        </div>
                    </div>
                    <div class="mt-5">
                        <a href="#my-requests-section"
                           class="w-full inline-block text-center py-2.5 px-4 bg-teal-600 hover:bg-teal-700 text-white font-semibold text-xs rounded-xl shadow-sm transition">
                            View My Requests
                        </a>
                    </div>
                </div>

                {{-- 4. Report Technical Problems --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900 text-lg">Report Technical Problems</h3>
                        <p class="text-xs text-gray-500 mt-1.5 leading-relaxed">
                            Found a bug, glitch, or broken button? Let our development team know so we can fix it.
                        </p>
                    </div>
                    <div class="mt-5">
                        <a href="#technical-report-section"
                           class="w-full inline-block text-center py-2.5 px-4 bg-rose-600 hover:bg-rose-700 text-white font-semibold text-xs rounded-xl shadow-sm transition">
                            Report a Bug
                        </a>
                    </div>
                </div>
            </div>

            {{-- Frequently Asked Questions (searchable) --}}
            @php
                $faqs = [
                    [
                        'q' => 'How does claiming a food donation work?',
                        'a' => 'Browse available food on the Browse Food page, click on any donation, and press "Claim Food". Your claim is instantly queued for local volunteer drivers who will accept and deliver it to your address.'
                    ],
                    [
                        'q' => 'Can I cancel a claim if my plans change?',
                        'a' => 'Yes! As long as a volunteer has not yet accepted your delivery, you can open your Claim Details page and click "Cancel Claim". You will be asked to provide a brief cancellation reason so the food can be safely returned to the community pool.'
                    ],
                    [
                        'q' => 'How can I filter donations near me?',
                        'a' => 'On the Browse Food page, click "📍 Detect My Location" to automatically detect your coordinates, or choose a distance radius (e.g. within 2 km, 5 km, 10 km) from the dropdown filter.'
                    ],
                    [
                        'q' => 'How do I rate the donor and delivery volunteer?',
                        'a' => 'Once your claim is marked as delivered, open the Claim Details page. You will see dedicated rating sections to submit a 1 to 5 star review for both the food donor and the delivery driver.'
                    ],
                    [
                        'q' => 'Where can I see all my completed deliveries?',
                        'a' => 'Click on "View Full History" in your dashboard Recent Deliveries widget or visit the "Impact & History" page from the navigation bar.'
                    ],
                ];

                if (!empty($search)) {
                    $faqs = array_filter($faqs, function($faq) use ($search) {
                        return stripos($faq['q'], $search) !== false || stripos($faq['a'], $search) !== false;
                    });
                }
            @endphp

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="font-bold text-xl text-gray-900">Frequently Asked Questions</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Quick answers to common questions about claiming, delivery, and tracking</p>
                    </div>
                    @if (!empty($search))
                        <a href="{{ route('receiver.help') }}" class="text-xs text-emerald-600 font-semibold hover:underline">
                            Clear Search
                        </a>
                    @endif
                </div>

                <div class="space-y-4">
                    @forelse ($faqs as $faq)
                        <div x-data="{ open: false }" class="border border-gray-100 rounded-xl overflow-hidden bg-emerald-50/20 hover:border-emerald-200 transition">
                            <button @click="open = !open"
                                    type="button"
                                    class="w-full text-left px-5 py-4 flex items-center justify-between font-semibold text-gray-800 hover:text-emerald-700 transition">
                                <span>{{ $faq['q'] }}</span>
                                <svg class="w-4 h-4 transform transition duration-200" :class="{ 'rotate-180 text-emerald-600': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="open" x-cloak class="px-5 pb-4 text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-3">
                                {{ $faq['a'] }}
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-400 text-sm">
                            No articles found matching "{{ $search }}". Try another keyword or submit a support inquiry below.
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- "My Requests" Section --}}
            <div id="my-requests-section" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="font-bold text-xl text-gray-900">My Requests & Support Tickets</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Track reports and issues you have raised with the platform</p>
                    </div>
                    <span class="text-xs font-semibold px-3 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-full">
                        {{ $myReports->count() }} Total
                    </span>
                </div>

                @if ($myReports->count() > 0)
                    <div class="divide-y divide-gray-100">
                        @foreach ($myReports as $report)
                            <div class="py-4 first:pt-0 last:pb-0 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                <div class="space-y-1">
                                    <div class="flex items-center gap-2">
                                        <span class="font-semibold text-sm text-gray-900">
                                            Ticket #{{ $report->id }}
                                        </span>
                                        <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $report->status === 'resolved' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                            {{ ucfirst($report->status) }}
                                        </span>
                                    </div>
                                    <p class="text-xs text-gray-600 leading-relaxed">
                                        {{ $report->reason }}
                                    </p>
                                    @if ($report->foodDonation)
                                        <p class="text-[11px] text-emerald-700 font-medium">
                                            Related food: {{ $report->foodDonation->title }}
                                        </p>
                                    @endif
                                </div>
                                <div class="text-xs text-gray-400 shrink-0 sm:text-right">
                                    {{ $report->created_at->format('d M Y, h:i A') }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="py-8 text-center text-gray-400 text-sm">
                        You have not submitted any support tickets or reports yet.
                    </div>
                @endif
            </div>

            {{-- "Report Technical Problems" Form --}}
            <div id="technical-report-section" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
                <div class="mb-6">
                    <h3 class="font-bold text-xl text-gray-900">Report Technical Problems</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Submit details about any system bugs, page errors, or technical difficulty</p>
                </div>

                <form method="POST" action="{{ route('receiver.help.technical-report') }}" class="space-y-4 max-w-2xl">
                    @csrf

                    <div>
                        <label for="subject" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">
                            Issue Subject / Title <span class="text-rose-500">*</span>
                        </label>
                        <input type="text"
                               id="subject"
                               name="subject"
                               required
                               placeholder="e.g. Unable to filter distance, button not responding..."
                               class="w-full rounded-xl border border-gray-200 text-sm text-gray-800 focus:border-emerald-500 focus:ring-emerald-500 shadow-sm py-2.5 px-4" />
                    </div>

                    <div>
                        <label for="description" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">
                            Detailed Description <span class="text-rose-500">*</span>
                        </label>
                        <textarea id="description"
                                  name="description"
                                  rows="4"
                                  required
                                  minlength="10"
                                  placeholder="Please describe what happened, what page you were on, and any error message you noticed..."
                                  class="w-full rounded-xl border border-gray-200 text-sm text-gray-800 focus:border-emerald-500 focus:ring-emerald-500 shadow-sm py-2.5 px-4"></textarea>
                    </div>

                    <button type="submit"
                            class="py-3 px-8 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm rounded-xl shadow-md hover:shadow-lg transition duration-200">
                        Submit Technical Report
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
