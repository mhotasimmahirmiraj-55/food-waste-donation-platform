<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Available Food Donations</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('error'))
                <div class="mb-6 rounded-lg bg-red-100 p-4 text-red-800">{{ session('error') }}</div>
            @endif

            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <form method="GET" action="{{ route('receiver.donations') }}"
                      class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="md:col-span-3">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                            Search by food or location
                        </label>
                        <input id="search" name="search" value="{{ request('search') }}"
                               placeholder="e.g. Badda, rice, Gulshan..."
                               class="w-full rounded-lg border-gray-300">
                    </div>
                    <div class="flex items-end">
                        <button type="submit"
                                class="w-full rounded-lg bg-blue-600 px-5 py-2.5 text-white hover:bg-blue-700">
                            Search
                        </button>
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($donations as $donation)
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                        @if ($donation->food_image)
                            <img src="{{ asset('storage/' . $donation->food_image) }}"
                                 alt="{{ $donation->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-500">
                                No image
                            </div>
                        @endif

                        <div class="p-5">
                            <h3 class="text-xl font-bold">{{ $donation->title }}</h3>
                            <p class="text-sm text-gray-500 mt-1">{{ $donation->category?->name ?? 'Food' }}</p>
                            <p class="text-gray-600 mt-3 line-clamp-2">{{ $donation->description }}</p>

                            <div class="mt-4 space-y-1 text-sm">
                                <p><strong>Quantity:</strong> {{ $donation->quantity }}</p>
                                <p><strong>Pickup:</strong> {{ $donation->pickup_address }}</p>
                                @if ($donation->expiry_time)
                                    <p><strong>Expiry:</strong> {{ $donation->expiry_time }}</p>
                                @endif
                            </div>

                            <a href="{{ route('receiver.donations.show', $donation) }}"
                               class="block text-center mt-5 rounded-lg bg-blue-600 px-4 py-2.5 text-white hover:bg-blue-700">
                                View Details
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white shadow rounded-lg p-8 text-center text-gray-500">
                        No available donations matched your search.
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $donations->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
