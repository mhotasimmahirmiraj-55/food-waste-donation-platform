<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Saved Donations
            </h2>

            <a href="{{ route('receiver.dashboard') }}"
               class="text-sm text-indigo-600 hover:text-indigo-800">
                Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 rounded-lg bg-green-100 px-4 py-3 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 rounded-lg bg-red-100 px-4 py-3 text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            @if($bookmarks->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    @foreach($bookmarks as $bookmark)

                        @php
                            $donation = $bookmark->foodDonation;
                        @endphp

                        @if($donation)
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

                                @if($donation->food_image)
                                    <img
                                        src="{{ asset('storage/' . $donation->food_image) }}"
                                        alt="{{ $donation->title }}"
                                        class="w-full h-48 object-cover"
                                    >
                                @else
                                    <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400">
                                        No image available
                                    </div>
                                @endif

                                <div class="p-5">

                                    <div class="flex items-start justify-between gap-3">
                                        <h3 class="text-lg font-semibold text-gray-900">
                                            {{ $donation->title }}
                                        </h3>

                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                            {{ ucfirst($donation->status) }}
                                        </span>
                                    </div>

                                    <p class="mt-2 text-sm text-gray-600">
                                        {{ Str::limit($donation->description, 100) }}
                                    </p>

                                    <div class="mt-4 space-y-2 text-sm text-gray-600">
                                        <p>
                                            <strong>Quantity:</strong>
                                            {{ $donation->quantity }}
                                        </p>

                                        @if($donation->category)
                                            <p>
                                                <strong>Category:</strong>
                                                {{ $donation->category->name }}
                                            </p>
                                        @endif

                                        <p>
                                            <strong>Pickup:</strong>
                                            {{ $donation->pickup_address }}
                                        </p>
                                    </div>

                                    <div class="mt-5 flex items-center justify-between">

                                        <a href="{{ url('/receiver/donations/' . $donation->id) }}"
                                           class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                                            View Details
                                        </a>

                                        <form method="POST"
                                              action="{{ route('receiver.bookmarks.destroy', $donation) }}">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="text-sm font-medium text-red-600 hover:text-red-800">
                                                Remove
                                            </button>
                                        </form>

                                    </div>

                                </div>
                            </div>
                        @endif

                    @endforeach

                </div>

                <div class="mt-6">
                    {{ $bookmarks->links() }}
                </div>

            @else
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-10 text-center">

                    <div class="text-5xl mb-4">
                        🔖
                    </div>

                    <h3 class="text-lg font-semibold text-gray-900">
                        No Saved Donations
                    </h3>

                    <p class="mt-2 text-sm text-gray-500">
                        Donations you bookmark will appear here.
                    </p>

                    <a href="{{ route('receiver.dashboard') }}"
                       class="inline-block mt-5 px-5 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                        Browse Donations
                    </a>

                </div>
            @endif

        </div>
    </div>
</x-app-layout>