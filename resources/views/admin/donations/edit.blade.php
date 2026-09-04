<x-app-layout>

    <x-slot name="header">

        <div>

            <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                Edit Donation
            </h2>

            <p class="mt-1 text-sm text-emerald-800">
                Update the donation information.
            </p>

        </div>

    </x-slot>


    {{-- ================================================= --}}
    {{-- MAIN PAGE --}}
    {{-- ================================================= --}}

    <div class="min-h-screen bg-gradient-to-br from-emerald-100 via-white to-green-100">

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


            {{-- ================================================= --}}
            {{-- FORM CARD --}}
            {{-- ================================================= --}}

            <div
                class="bg-white
                       rounded-2xl
                       border border-emerald-200
                       shadow-sm
                       overflow-hidden"
            >


                {{-- Card Header --}}

                <div
                    class="px-6 py-5
                           border-b border-emerald-200
                           bg-gradient-to-r
                           from-emerald-100
                           via-white
                           to-green-100"
                >

                    <h3 class="text-xl font-bold text-gray-900">
                        Edit Donation
                    </h3>

                    <p class="mt-1 text-sm text-gray-600">
                        Modify the donation details below.
                    </p>

                </div>



                {{-- ================================================= --}}
                {{-- FORM --}}
                {{-- ================================================= --}}

                <form
                    action="{{ route('admin.donations.update', $donation) }}"
                    method="POST"
                    class="p-6"
                >

                    @csrf
                    @method('PUT')


                    {{-- Title --}}

                    <div class="mb-5">

                        <label
                            class="block text-sm font-semibold text-emerald-900"
                        >
                            Title
                        </label>

                        <input
                            type="text"
                            name="title"
                            value="{{ old('title', $donation->title) }}"
                            class="mt-2 block w-full
                                   rounded-xl
                                   border-emerald-200
                                   focus:border-emerald-500
                                   focus:ring-emerald-500
                                   shadow-sm"
                        >

                        @error('title')

                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>



                    {{-- Description --}}

                    <div class="mb-5">

                        <label
                            class="block text-sm font-semibold text-emerald-900"
                        >
                            Description
                        </label>

                        <textarea
                            name="description"
                            rows="4"
                            class="mt-2 block w-full
                                   rounded-xl
                                   border-emerald-200
                                   focus:border-emerald-500
                                   focus:ring-emerald-500
                                   shadow-sm"
                        >{{ old('description', $donation->description) }}</textarea>

                        @error('description')

                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>



                    {{-- Category --}}

                    <div class="mb-5">

                        <label
                            class="block text-sm font-semibold text-emerald-900"
                        >
                            Category
                        </label>

                        <select
                            name="food_category_id"
                            class="mt-2 block w-full
                                   rounded-xl
                                   border-emerald-200
                                   focus:border-emerald-500
                                   focus:ring-emerald-500
                                   shadow-sm"
                        >

                            @foreach ($categories as $category)

                                <option
                                    value="{{ $category->id }}"
                                    @selected(
                                        old(
                                            'food_category_id',
                                            $donation->food_category_id
                                        ) == $category->id
                                    )
                                >
                                    {{ $category->name }}
                                </option>

                            @endforeach

                        </select>

                        @error('food_category_id')

                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>



                    {{-- Quantity --}}

                    <div class="mb-5">

                        <label
                            class="block text-sm font-semibold text-emerald-900"
                        >
                            Quantity
                        </label>

                        <input
                            type="number"
                            name="quantity"
                            value="{{ old('quantity', $donation->quantity) }}"
                            min="1"
                            class="mt-2 block w-full
                                   rounded-xl
                                   border-emerald-200
                                   focus:border-emerald-500
                                   focus:ring-emerald-500
                                   shadow-sm"
                        >

                        @error('quantity')

                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>



                    {{-- Expiry Time --}}

                    <div class="mb-5">

                        <label
                            class="block text-sm font-semibold text-emerald-900"
                        >
                            Expiry Time
                        </label>

                        <input
                            type="datetime-local"
                            name="expiry_time"
                            value="{{ old('expiry_time', \Carbon\Carbon::parse($donation->expiry_time)->format('Y-m-d\TH:i')) }}"
                            class="mt-2 block w-full
                                   rounded-xl
                                   border-emerald-200
                                   focus:border-emerald-500
                                   focus:ring-emerald-500
                                   shadow-sm"
                        >

                        @error('expiry_time')

                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>



                    {{-- Pickup Address --}}

                    <div class="mb-5">

                        <label
                            class="block text-sm font-semibold text-emerald-900"
                        >
                            Pickup Address
                        </label>

                        <input
                            type="text"
                            name="pickup_address"
                            value="{{ old('pickup_address', $donation->pickup_address) }}"
                            class="mt-2 block w-full
                                   rounded-xl
                                   border-emerald-200
                                   focus:border-emerald-500
                                   focus:ring-emerald-500
                                   shadow-sm"
                        >

                        @error('pickup_address')

                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>



                    {{-- Pickup Date --}}

                    <div class="mb-5">

                        <label
                            class="block text-sm font-semibold text-emerald-900"
                        >
                            Pickup Date
                        </label>

                        <input
                            type="date"
                            name="pickup_date"
                            value="{{ old('pickup_date', $donation->pickup_date) }}"
                            class="mt-2 block w-full
                                   rounded-xl
                                   border-emerald-200
                                   focus:border-emerald-500
                                   focus:ring-emerald-500
                                   shadow-sm"
                        >

                        @error('pickup_date')

                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>



                    {{-- Pickup Time --}}

                    <div class="mb-5">

                        <label
                            class="block text-sm font-semibold text-emerald-900"
                        >
                            Pickup Time
                        </label>

                        <input
                            type="time"
                            name="pickup_time"
                            value="{{ old('pickup_time', $donation->pickup_time) }}"
                            class="mt-2 block w-full
                                   rounded-xl
                                   border-emerald-200
                                   focus:border-emerald-500
                                   focus:ring-emerald-500
                                   shadow-sm"
                        >

                        @error('pickup_time')

                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>



                    {{-- Buttons --}}

                    <div class="mt-8 flex items-center gap-3">

                        <button
                            type="submit"
                            class="inline-flex items-center
                                   px-5 py-2.5
                                   rounded-xl
                                   bg-emerald-700
                                   text-white
                                   font-semibold
                                   hover:bg-emerald-800
                                   shadow-sm
                                   transition"
                        >
                            Save Changes
                        </button>


                        <a
                            href="{{ route('admin.donations.show', $donation) }}"
                            class="inline-flex items-center
                                   px-5 py-2.5
                                   rounded-xl
                                   bg-gray-100
                                   text-gray-700
                                   font-semibold
                                   hover:bg-gray-200
                                   transition"
                        >
                            Cancel
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>