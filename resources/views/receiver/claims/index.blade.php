<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Claims</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 rounded-lg bg-green-100 p-4 text-green-800">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mb-6 rounded-lg bg-red-100 p-4 text-red-800">{{ session('error') }}</div>
            @endif

            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="p-6 border-b">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                        <div>
                            <h3 class="text-2xl font-bold">Claim History</h3>
                            <p class="text-gray-500 mt-1">Track the status of every food request.</p>
                        </div>
                        <a href="{{ route('receiver.donations') }}"
                           class="rounded-lg bg-blue-600 px-4 py-2.5 text-white hover:bg-blue-700">
                            Browse Food
                        </a>
                    </div>
                </div>

                <div class="divide-y">
                    @forelse ($claims as $claim)
                        @php
                            $statusClasses = [
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'approved' => 'bg-blue-100 text-blue-800',
                                'completed' => 'bg-green-100 text-green-800',
                                'rejected' => 'bg-red-100 text-red-800',
                                'cancelled' => 'bg-gray-100 text-gray-800',
                            ];
                            $statusLabels = [
                                'pending' => 'Pending',
                                'approved' => 'Accepted',
                                'completed' => 'Delivered',
                                'rejected' => 'Rejected',
                                'cancelled' => 'Cancelled',
                            ];
                        @endphp

                        <div class="p-6 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                            <div>
                                <h4 class="text-lg font-bold">{{ $claim->foodDonation->title }}</h4>
                                <p class="text-sm text-gray-500 mt-1">
                                    {{ $claim->foodDonation->pickup_address }}
                                </p>
                                <p class="text-sm text-gray-500 mt-1">
                                    Claimed {{ $claim->created_at->format('d M Y, h:i A') }}
                                </p>
                            </div>

                            <div class="flex items-center gap-3">
                                <span class="rounded-full px-3 py-1 text-sm font-semibold {{ $statusClasses[$claim->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $statusLabels[$claim->status] ?? ucfirst($claim->status) }}
                                </span>
                                <a href="{{ route('receiver.claims.show', $claim) }}"
                                   class="rounded-lg bg-gray-800 px-4 py-2 text-white hover:bg-gray-900">
                                    Details
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="p-10 text-center text-gray-500">
                            You have not claimed any donations yet.
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="mt-6">{{ $claims->links() }}</div>
        </div>
    </div>
</x-app-layout>
