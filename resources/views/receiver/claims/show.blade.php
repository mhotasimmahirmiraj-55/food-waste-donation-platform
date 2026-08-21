<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Claim Details</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 rounded-lg bg-green-100 p-4 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 rounded-lg bg-red-100 p-4 text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            @php
                $statusLabels = [
                    'pending' => 'Pending',
                    'approved' => 'Accepted',
                    'completed' => 'Delivered',
                    'rejected' => 'Rejected',
                    'cancelled' => 'Cancelled',
                ];
            @endphp

            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h1 class="text-3xl font-bold">{{ $claim->foodDonation->title }}</h1>
                        <p class="text-gray-500 mt-1">Claim #{{ $claim->id }}</p>
                    </div>
                    <span class="rounded-full bg-gray-100 px-3 py-1 text-sm font-semibold">
                        {{ $statusLabels[$claim->status] ?? ucfirst($claim->status) }}
                    </span>
                </div>

                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <p class="text-sm text-gray-500">Quantity</p>
                        <p class="mt-1">{{ $claim->foodDonation->quantity }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Pickup Address</p>
                        <p class="mt-1">{{ $claim->foodDonation->pickup_address }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Pickup Date</p>
                        <p class="mt-1">{{ $claim->foodDonation->pickup_date ?: 'Not specified' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Pickup Time</p>
                        <p class="mt-1">{{ $claim->foodDonation->pickup_time ?: 'Not specified' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Donor</p>
                        <p class="mt-1">{{ $claim->foodDonation->donor?->name ?? 'Donor' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Claimed At</p>
                        <p class="mt-1">{{ $claim->created_at->format('d M Y, h:i A') }}</p>
                    </div>
                </div>

                <div class="mt-8">
                    <h3 class="text-xl font-bold mb-4">Claim Status</h3>
                    <div class="flex flex-col md:flex-row gap-3">
                        <div class="flex-1 rounded-lg border p-4 {{ $claim->status === 'pending' ? 'border-yellow-400 bg-yellow-50' : 'bg-gray-50' }}">
                            <p class="font-semibold">1. Pending</p>
                            <p class="text-sm text-gray-500">Waiting for processing.</p>
                        </div>
                        <div class="flex-1 rounded-lg border p-4 {{ $claim->status === 'approved' ? 'border-blue-400 bg-blue-50' : 'bg-gray-50' }}">
                            <p class="font-semibold">2. Accepted</p>
                            <p class="text-sm text-gray-500">The claim has been accepted.</p>
                        </div>
                        <div class="flex-1 rounded-lg border p-4 {{ $claim->status === 'completed' ? 'border-green-400 bg-green-50' : 'bg-gray-50' }}">
                            <p class="font-semibold">3. Delivered</p>
                            <p class="text-sm text-gray-500">The food has been delivered.</p>
                        </div>
                    </div>
                </div>

                @if ($claim->delivery)
                    <div class="mt-8 rounded-lg bg-gray-50 p-5">
                        <h3 class="text-lg font-bold">Delivery Information</h3>
                        <p class="mt-2"><strong>Status:</strong> {{ ucfirst(str_replace('_', ' ', $claim->delivery->status)) }}</p>
                    </div>
                @endif

                <div class="mt-8 bg-red-50 border border-red-200 rounded-lg p-6">
                    <h3 class="text-lg font-bold text-red-800">
                        Report an Issue
                    </h3>

                    <p class="text-sm text-red-700 mt-1">
                        If there is a problem with this donation or pickup, Please let us know!!
                    </p>

                    <form
                        method="POST"
                        action="{{ route('receiver.claims.report', $claim) }}"
                        class="mt-4"
                    >
                        @csrf

                        <label
                            for="reason"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Describe the issue
                        </label>

                        <textarea
                            id="reason"
                            name="reason"
                            rows="4"
                            required
                            minlength="10"
                            maxlength="1000"
                            class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500"
                            placeholder="Describe the problem with the donation or pickup..."
                        ></textarea>

                        @error('reason')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                        <button
                            type="submit"
                            class="mt-4 rounded-lg bg-red-600 px-5 py-2.5 text-white hover:bg-red-700"
                        >
                            Report Issue
                        </button>
                    </form>
                </div>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('receiver.claims') }}"
                       class="rounded-lg bg-gray-200 px-5 py-2.5 text-gray-800 hover:bg-gray-300">
                        Back to My Claims
                    </a>

                    @if ($claim->status === 'pending')
                        <form method="POST" action="{{ route('receiver.claims.cancel', $claim) }}"
                              onsubmit="return confirm('Are you sure you want to cancel this claim?');">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                    class="rounded-lg bg-red-600 px-5 py-2.5 text-white hover:bg-red-700">
                                Cancel Claim
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
