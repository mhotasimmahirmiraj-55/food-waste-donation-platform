<x-app-layout>

    <div class="min-h-screen bg-slate-50">

        <!-- Page Header -->
        <div class="border-b border-slate-200 bg-white">
            <div class="mx-auto max-w-7xl px-6 py-6">

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <p class="text-sm font-medium text-emerald-600">
                            Volunteer Portal
                        </p>

                        <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
                            Deliveries
                        </h1>

                        <p class="mt-2 text-sm text-slate-500">
                            Find available deliveries and manage your assigned deliveries.
                        </p>
                    </div>

                    <a href="{{ route('volunteer.dashboard') }}"
                       class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                        ← Dashboard
                    </a>

                </div>

            </div>
        </div>


        <main class="mx-auto max-w-7xl px-6 py-8">


            <!-- Available Deliveries -->
            <section>

                <div class="mb-5 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">

                    <div>
                        <h2 class="text-xl font-bold text-slate-900">
                            Available Deliveries
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Choose a delivery assignment that you can complete.
                        </p>
                    </div>

                    <span class="inline-flex w-fit rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700">
                        {{ $availableDeliveries->total() }} available
                    </span>

                </div>


                @forelse($availableDeliveries as $delivery)

                    <div class="mb-4 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">

                        <div class="p-6">

                            <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

                                <div class="min-w-0 flex-1">

                                    <div class="flex flex-wrap items-center gap-2">

                                        <h3 class="text-lg font-bold text-slate-900">
                                            {{ $delivery->claim?->foodDonation?->title ?? 'Food Donation' }}
                                        </h3>

                                        <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                                            Available
                                        </span>

                                    </div>


                                    <div class="mt-4 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">

                                        <div class="rounded-xl bg-slate-50 p-3">
                                            <p class="text-xs font-medium text-slate-400">
                                                Delivery ID
                                            </p>

                                            <p class="mt-1 text-sm font-semibold text-slate-800">
                                                #{{ $delivery->id }}
                                            </p>
                                        </div>


                                        <div class="rounded-xl bg-slate-50 p-3">
                                            <p class="text-xs font-medium text-slate-400">
                                                Receiver
                                            </p>

                                            <p class="mt-1 text-sm font-semibold text-slate-800">
                                                {{ $delivery->claim?->receiver?->name ?? 'N/A' }}
                                            </p>
                                        </div>


                                        <div class="rounded-xl bg-slate-50 p-3">
                                            <p class="text-xs font-medium text-slate-400">
                                                Created
                                            </p>

                                            <p class="mt-1 text-sm font-semibold text-slate-800">
                                                {{ $delivery->created_at?->format('d M Y') }}
                                            </p>
                                        </div>

                                    </div>

                                </div>


                                <div class="flex shrink-0 items-center gap-3">

                                    <a href="{{ route('volunteer.deliveries.show', $delivery) }}"
                                       class="rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                                        View Details
                                    </a>

                                    <form method="POST"
                                          action="{{ route('volunteer.deliveries.accept', $delivery) }}">

                                        @csrf

                                        <button type="submit"
                                                class="rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                                            Accept
                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-14 text-center">

                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-emerald-50 text-emerald-600">

                            <svg class="h-7 w-7"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M20 13V7a2 2 0 00-2-2h-3l-1-2H10L9 5H6a2 2 0 00-2 2v6m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4"/>

                            </svg>

                        </div>

                        <h3 class="mt-4 text-sm font-semibold text-slate-900">
                            No deliveries available
                        </h3>

                        <p class="mx-auto mt-1 max-w-md text-sm text-slate-500">
                            There are currently no unassigned deliveries.
                            Check back later for new opportunities.
                        </p>

                    </div>

                @endforelse


                @if($availableDeliveries->hasPages())

                    <div class="mt-5">
                        {{ $availableDeliveries->links() }}
                    </div>

                @endif

            </section>


            <!-- My Deliveries -->
            <section class="mt-12">

                <div class="mb-5 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">

                    <div>
                        <h2 class="text-xl font-bold text-slate-900">
                            My Deliveries
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Track the deliveries you have accepted.
                        </p>
                    </div>

                    <span class="inline-flex w-fit rounded-full bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700">
                        {{ $myDeliveries->total() }} assigned
                    </span>

                </div>


                @forelse($myDeliveries as $delivery)

                    <div class="mb-4 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                        <div class="p-6">

                            <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

                                <div class="min-w-0">

                                    <div class="flex flex-wrap items-center gap-2">

                                        <h3 class="text-lg font-bold text-slate-900">
                                            {{ $delivery->claim?->foodDonation?->title ?? 'Food Donation' }}
                                        </h3>

                                        @php
                                            $statusClasses = match ($delivery->status) {
                                                'accepted' => 'bg-blue-50 text-blue-700',
                                                'picked_up' => 'bg-amber-50 text-amber-700',
                                                'delivered' => 'bg-green-50 text-green-700',
                                                default => 'bg-slate-100 text-slate-600',
                                            };

                                            $statusLabel = match ($delivery->status) {
                                                'picked_up' => 'Picked Up',
                                                'delivered' => 'Delivered',
                                                default => ucfirst($delivery->status),
                                            };
                                        @endphp

                                        <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $statusClasses }}">
                                            {{ $statusLabel }}
                                        </span>

                                    </div>


                                    <div class="mt-4 grid gap-3 sm:grid-cols-3">

                                        <div class="rounded-xl bg-slate-50 p-3">

                                            <p class="text-xs font-medium text-slate-400">
                                                Delivery ID
                                            </p>

                                            <p class="mt-1 text-sm font-semibold text-slate-800">
                                                #{{ $delivery->id }}
                                            </p>

                                        </div>


                                        <div class="rounded-xl bg-slate-50 p-3">

                                            <p class="text-xs font-medium text-slate-400">
                                                Receiver
                                            </p>

                                            <p class="mt-1 text-sm font-semibold text-slate-800">
                                                {{ $delivery->claim?->receiver?->name ?? 'N/A' }}
                                            </p>

                                        </div>


                                        <div class="rounded-xl bg-slate-50 p-3">

                                            <p class="text-xs font-medium text-slate-400">
                                                Accepted
                                            </p>

                                            <p class="mt-1 text-sm font-semibold text-slate-800">
                                                {{ $delivery->accepted_at?->format('d M Y') ?? '—' }}
                                            </p>

                                        </div>

                                    </div>

                                </div>


                                <a href="{{ route('volunteer.deliveries.show', $delivery) }}"
                                   class="inline-flex shrink-0 items-center justify-center rounded-xl bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800">
                                    Manage Delivery →
                                </a>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-12 text-center">

                        <h3 class="text-sm font-semibold text-slate-900">
                            No assigned deliveries yet
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            Accept an available delivery to see it here.
                        </p>

                    </div>

                @endforelse


                @if($myDeliveries->hasPages())

                    <div class="mt-5">
                        {{ $myDeliveries->links() }}
                    </div>

                @endif

            </section>


            <!-- Helpful Note -->
            <div class="mt-10 rounded-2xl bg-gradient-to-r from-emerald-600 to-teal-500 p-6 text-white shadow-sm">

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center">

                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-white/15 text-2xl">
                        🚚
                    </div>

                    <div>
                        <h3 class="font-bold">
                            Make every delivery count
                        </h3>

                        <p class="mt-1 text-sm leading-6 text-emerald-50">
                            Accept an assignment, pick up the food, deliver it safely,
                            and upload proof when the delivery is complete.
                        </p>
                    </div>

                </div>

            </div>

        </main>

    </div>

</x-app-layout>