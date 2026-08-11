<x-app-layout>
    <x-slot name="header">
        <h2>Edit Donation</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">

                <h3 class="text-2xl font-bold mb-6">
                    Edit Donation
                </h3>

                <form action="{{ route('admin.donations.update', $donation) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-4">

                        <label class="block font-medium text-sm text-gray-700">
                            Title
                        </label>

                        <input
                            type="text"
                            name="title"
                            value="{{ $donation->title }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                        >

                    </div>

                    <div class="mb-4">

                        <label class="block font-medium text-sm text-gray-700">
                            Description
                        </label>

                        <textarea
                            name="description"
                            rows="4"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                        >{{ $donation->description }}</textarea>

                    </div>

                    <div class="mb-4">

                        <label class="block font-medium text-sm text-gray-700">
                            Category
                        </label>

                        <select
                            name="food_category_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                        >

                            @foreach ($categories as $category)

                                <option
                                    value="{{ $category->id }}"
                                    @selected($donation->food_category_id == $category->id)
                                >
                                    {{ $category->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="mb-4">

                        <label class="block font-medium text-sm text-gray-700">
                            Quantity
                        </label>

                        <input
                            type="number"
                            name="quantity"
                            value="{{ $donation->quantity }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                        >

                    </div>

                    <div class="mb-4">

                        <label class="block font-medium text-sm text-gray-700">
                            Expiry Time
                        </label>

                        <input
                            type="datetime-local"
                            name="expiry_time"
                            value="{{ \Carbon\Carbon::parse($donation->expiry_time)->format('Y-m-d\TH:i') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                        >

                    </div>

                    <div class="mb-4">

                        <label class="block font-medium text-sm text-gray-700">
                            Pickup Address
                        </label>

                        <input
                            type="text"
                            name="pickup_address"
                            value="{{ $donation->pickup_address }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                        >

                    </div>

                    <div class="mb-4">

                        <label class="block font-medium text-sm text-gray-700">
                            Pickup Date
                        </label>

                        <input
                            type="date"
                            name="pickup_date"
                            value="{{ $donation->pickup_date }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                        >

                    </div>

                    <div class="mb-4">

                        <label class="block font-medium text-sm text-gray-700">
                            Pickup Time
                        </label>

                        <input
                            type="time"
                            name="pickup_time"
                            value="{{ $donation->pickup_time }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                        >

                    </div>

                    <div class="mt-6">

                        <button
                            type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700"
                        >
                            Save Changes
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>