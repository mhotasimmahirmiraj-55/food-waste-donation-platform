<x-app-layout>

    <div class="min-h-screen bg-slate-50">

        <!-- Header -->
        <div class="border-b border-slate-200 bg-white">
            <div class="mx-auto max-w-7xl px-6 py-6">

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <p class="text-sm font-medium text-emerald-600">
                            Volunteer Dashboard
                        </p>

                        <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
                            Welcome back, {{ auth()->user()->name }}! 👋
                        </h1>

                        <p class="mt-2 text-sm text-slate-500">
                            Help move surplus food to people who need it.
                        </p>
                    </div>

                    <a href="{{ route('volunteer.deliveries.index') }}"
                       class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
                        View Deliveries →
                    </a>

                </div>

            </div>
        </div>


        <!-- Main Content -->
        <main class="mx-auto max-w-7xl px-6 py-8">


            <!-- Statistics -->
            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">

                <!-- Available -->
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                Available
                            </p>

                            <p class="mt-2 text-3xl font-bold text-slate-900">
                                {{ $availableDeliveries }}
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
                                Waiting for volunteers
                            </p>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M20 7l-8-4-8 4m16 0v10l-8 4-8-4V7m16 0l-8 4m0 0L4 7m8 4v10"/>
                            </svg>
                        </div>

                    </div>
                </div>


                <!-- My Deliveries -->
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                My Deliveries
                            </p>

                            <p class="mt-2 text-3xl font-bold text-slate-900">
                                {{ $myDeliveries }}
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
                                Total assignments
                            </p>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>

                    </div>
                </div>


                <!-- Active -->
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                Active
                            </p>

                            <p class="mt-2 text-3xl font-bold text-slate-900">
                                {{ $activeDeliveries }}
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
                                Currently in progress
                            </p>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>

                    </div>
                </div>


                <!-- Completed -->
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                Completed
                            </p>

                            <p class="mt-2 text-3xl font-bold text-slate-900">
                                {{ $completedDeliveries }}
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
                                Successfully delivered
                            </p>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-50 text-green-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>

                    </div>
                </div>

            </div>


            <!-- Available Assignments -->
            <div class="mt-8 rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="flex flex-col gap-3 border-b border-slate-100 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <h2 class="text-lg font-bold text-slate-900">
                            Available Deliveries
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Deliveries waiting for a volunteer.
                        </p>
                    </div>

                    <a href="{{ route('volunteer.deliveries.index') }}">
                       class="text-sm font-semibold text-emerald-600 hover:text-emerald-700">
                        View all →
                    </a>

                </div>


                @forelse($availableAssignments as $delivery)

                    <div class="border-b border-slate-100 px-6 py-5 last:border-b-0">

                        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                            <div class="min-w-0">

                                <div class="flex flex-wrap items-center gap-2">

                                    <h3 class="font-semibold text-slate-900">
                                        {{ $delivery->claim?->foodDonation?->title ?? 'Food Donation' }}
                                    </h3>

                                    <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                                        Available
                                    </span>

                                </div>

                                <div class="mt-2 flex flex-wrap gap-x-5 gap-y-1 text-sm text-slate-500">

                                    <span>
                                        Receiver:
                                        {{ $delivery->claim?->receiver?->name ?? 'N/A' }}
                                    </span>

                                    <span>
                                        Delivery #{{ $delivery->id }}
                                    </span>

                                </div>

                            </div>


                            <div class="flex items-center gap-3">

                                <a href="{{ route('volunteer.deliveries.show', $delivery) }}"
                                   class="rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                                    Details
                                </a>

                                <form method="POST"
                                      action="{{ route('volunteer.deliveries.accept', $delivery) }}">
                                    @csrf

                                    <button type="submit"
                                            class="rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-700">
                                        Accept
                                    </button>
                                </form>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="px-6 py-12 text-center">

                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M20 13V7a2 2 0 00-2-2h-3l-1-2H10L9 5H6a2 2 0 00-2 2v6m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4"/>
                            </svg>
                        </div>

                        <h3 class="mt-4 text-sm font-semibold text-slate-900">
                            No deliveries available
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            New delivery assignments will appear here.
                        </p>

                    </div>

                @endforelse

            </div>


            <!-- Recent Deliveries -->
            <div class="mt-8 rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">

                    <div>
                        <h2 class="text-lg font-bold text-slate-900">
                            Recent Deliveries
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Your latest delivery activity.
                        </p>
                    </div>

                    <a href="{{ route('volunteer.deliveries.index') }}">
                       class="text-sm font-semibold text-emerald-600 hover:text-emerald-700">
                        View all →
                    </a>

                </div>


                @forelse($recentDeliveries as $delivery)

                    <div class="flex flex-col gap-3 border-b border-slate-100 px-6 py-5 last:border-b-0 sm:flex-row sm:items-center sm:justify-between">

                        <div>

                            <h3 class="font-semibold text-slate-900">
                                {{ $delivery->claim?->foodDonation?->title ?? 'Food Donation' }}
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Receiver:
                                {{ $delivery->claim?->receiver?->name ?? 'N/A' }}
                            </p>

                        </div>


                        <div class="flex items-center gap-4">

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

                            <span class="rounded-full px-3 py-1.5 text-xs font-semibold {{ $statusClasses }}">
                                {{ $statusLabel }}
                            </span>

                            <a href="{{ route('volunteer.deliveries.show', $delivery) }}"
                               class="text-sm font-semibold text-slate-600 hover:text-emerald-600">
                                Open →
                            </a>

                        </div>

                    </div>

                @empty

                    <div class="px-6 py-10 text-center text-sm text-slate-500">
                        You haven't accepted any deliveries yet.
                    </div>

                @endforelse

            </div>


            <!-- Impact Section -->
            <div class="mt-8 overflow-hidden rounded-2xl bg-gradient-to-r from-emerald-600 to-teal-500 p-8 text-white shadow-sm">

                <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">

                    <div>

                        <p class="text-sm font-semibold text-emerald-100">
                            YOUR IMPACT
                        </p>

                        <h2 class="mt-2 text-2xl font-bold">
                            Every delivery makes a difference 🌱
                        </h2>

                        <p class="mt-2 max-w-2xl text-sm leading-6 text-emerald-50">
                            Thank you for helping move surplus food from donors
                            to people and communities who need it.
                        </p>

                    </div>

                    <div class="rounded-2xl bg-white/10 px-6 py-5 text-center backdrop-blur-sm">

                        <p class="text-3xl font-bold">
                            {{ $completedDeliveries }}
                        </p>

                        <p class="mt-1 text-xs font-medium text-emerald-50">
                            Completed Deliveries
                        </p>

                    </div>

                </div>

            </div>

        </main>

    </div>

</x-app-layout>