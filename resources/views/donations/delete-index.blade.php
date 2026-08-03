<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Delete Donations
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <h2 class="text-2xl font-bold mb-4">
                    Delete Your Donations
                </h2>

                @forelse($donations as $donation)

                    <div class="border rounded-lg p-4 mb-4">

                        <h3 class="text-xl font-semibold">
                            {{ $donation->title }}
                        </h3>

                        <p>Quantity: {{ $donation->quantity }}</p>

                        <p>Expiry: {{ $donation->expiry_time }}</p>

                        <p>Address: {{ $donation->pickup_address }}</p>
                        <p>Status: {{ $donation->status }}</p>
                       @if($donation->status == 'available')

    <form action="{{ route('donations.destroy', $donation->id) }}"
          method="POST"
          onsubmit="return confirm('Are you sure you want to delete this donation?');">

        @csrf
        @method('DELETE')

        <button
            type="submit"
            class="mt-4 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
            Delete
        </button>

    </form>

@else

    <button
        class="mt-4 bg-gray-400 text-white px-4 py-2 rounded cursor-not-allowed"
        disabled>
        Cannot Delete
    </button>

@endif
                    </div>

                @empty

                    <p>No donations found.</p>

                @endforelse

            </div>

        </div>

    </div>

</x-app-layout>