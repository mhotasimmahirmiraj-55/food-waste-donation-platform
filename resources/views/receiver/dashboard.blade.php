<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Receiver Dashboard</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 rounded-lg bg-green-100 p-4 text-green-800">{{ session('success') }}</div>
            @endif

            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <h3 class="text-3xl font-bold">Welcome, {{ auth()->user()->name }}!</h3>
                <p class="text-gray-600 mt-2">Find available food donations and manage your claims.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white shadow rounded-lg p-6">
                    <p class="text-gray-500">Available Donations</p>
                    <p class="text-3xl font-bold mt-2">{{ $availableDonations }}</p>
                </div>
                <div class="bg-white shadow rounded-lg p-6">
                    <p class="text-gray-500">My Claims</p>
                    <p class="text-3xl font-bold mt-2">{{ $myClaims }}</p>
                </div>
                <div class="bg-white shadow rounded-lg p-6">
                    <p class="text-gray-500">Pending Claims</p>
                    <p class="text-3xl font-bold mt-2">{{ $pendingClaims }}</p>
                </div>
                <div class="bg-white shadow rounded-lg p-6">
                    <p class="text-gray-500">Delivered</p>
                    <p class="text-3xl font-bold mt-2">{{ $completedClaims }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <a href="{{ route('receiver.donations') }}"
                   class="bg-white shadow rounded-lg p-6 hover:shadow-md">
                    <h3 class="text-xl font-bold mb-2">Browse Food</h3>
                    <p class="text-gray-600">Browse available food donations and search by location.</p>
                </a>

                <a href="{{ route('receiver.claims') }}"
                   class="bg-white shadow rounded-lg p-6 hover:shadow-md">
                    <h3 class="text-xl font-bold mb-2">My Claims</h3>
                    <p class="text-gray-600">Track your pending, accepted, cancelled and delivered claims.</p>
                </a>
            </div>

            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold">Recent Claims</h3>
                    <a href="{{ route('receiver.claims') }}" class="text-blue-600 hover:underline">View all</a>
                </div>

                @forelse ($recentClaims as $claim)
                    <div class="border-b last:border-b-0 py-4 flex items-center justify-between">
                        <div>
                            <p class="font-semibold">{{ $claim->foodDonation->title }}</p>
                            <p class="text-sm text-gray-500">{{ $claim->created_at->format('d M Y, h:i A') }}</p>
                        </div>
                        <a href="{{ route('receiver.claims.show', $claim) }}"
                           class="text-blue-600 hover:underline">Details</a>
                    </div>
                @empty
                    <p class="text-gray-500">You have not made any claims yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
