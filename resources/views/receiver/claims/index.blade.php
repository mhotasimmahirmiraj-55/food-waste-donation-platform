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
                        {{-- Search and Filter --}}

                        <form
                            method="GET"
                            action="{{ route('receiver.claims') }}"
                            class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4"
                        >
                            {{-- Search --}}

                            <div>
                                <label
                                    for="search"
                                    class="block text-sm font-medium text-gray-700 mb-1"
                                >
                                    Search Donation
                                </label>

                                <input
                                    type="text"
                                    id="search"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Search by donation title..."
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                >
                            </div>

                            {{-- Status Filter --}}

                            <div>
                                <label
                                    for="status"
                                    class="block text-sm font-medium text-gray-700 mb-1"
                                >
                                    Status
                                </label>

                                <select
                                    id="status"
                                    name="status"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                >
                                    <option value="">All Statuses</option>

                                    <option
                                        value="pending"
                                        {{ request('status') === 'pending' ? 'selected' : '' }}
                                    >
                                        Pending
                                    </option>

                                    <option
                                        value="approved"
                                        {{ request('status') === 'approved' ? 'selected' : '' }}
                                    >
                                        Accepted
                                    </option>

                                    <option
                                        value="completed"
                                        {{ request('status') === 'completed' ? 'selected' : '' }}
                                    >
                                        Delivered
                                    </option>

                                    <option
                                        value="rejected"
                                        {{ request('status') === 'rejected' ? 'selected' : '' }}
                                    >
                                        Rejected
                                    </option>

                                    <option
                                        value="cancelled"
                                        {{ request('status') === 'cancelled' ? 'selected' : '' }}
                                    >
                                        Cancelled
                                    </option>
                                </select>
                            </div>

                            {{-- Buttons --}}

                            <div class="flex items-end gap-2">
                                <button
                                    type="submit"
                                    class="rounded-lg bg-gray-800 px-5 py-2.5 text-white hover:bg-gray-900"
                                >
                                    Search
                                </button>

                                <a
                                    href="{{ route('receiver.claims') }}"
                                    class="rounded-lg bg-gray-200 px-5 py-2.5 text-gray-800 hover:bg-gray-300"
                                >
                                    Clear
                                </a>
                            </div>
                        </form>
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
