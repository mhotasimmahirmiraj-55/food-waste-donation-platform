<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Food Donation
        </h2>
    </x-slot>


    <div class="py-8">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">


                <h3 class="text-2xl font-bold mb-6">
                    Donate Food
                </h3>
                @if(session('success'))
                 <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                   {{ session('success') }}
                  </div>
                @endif
                


                {{-- Success Message --}}
                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif


                {{-- Validation Error --}}
                @if($errors->any())
                    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">

                        <ul>
                            @foreach($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>

                    </div>
                @endif



                <form method="POST"
                   action="{{ route('donations.store') }}"
                   enctype="multipart/form-data">

                    @csrf



                    <!-- Food Name -->
                    <div class="mb-4">

                        <label class="block font-medium text-gray-700">
                            Food Name
                        </label>

                        <input 
                            type="text"
                            name="title"
                            value="{{ old('title') }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="Example: Rice, Vegetable Curry">

                    </div>



                    <!-- Quantity -->
                    <div class="mb-4">

                        <label class="block font-medium text-gray-700">
                            Quantity
                        </label>

                        <input 
                            type="number"
                            name="quantity"
                            value="{{ old('quantity') }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="Enter quantity">

                    </div>



                    <!-- Expiry Time -->
                    <div class="mb-4">

                        <label class="block font-medium text-gray-700">
                            Expiry Date & Time
                        </label>

                        <input 
                            type="datetime-local"
                            name="expiry_time"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">

                    </div>



                    <!-- Description -->
                    <div class="mb-4">

                        <label class="block font-medium text-gray-700">
                            Description
                        </label>

                        <textarea
                            name="description"
                            rows="4"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="Describe the food">{{ old('description') }}</textarea>

                    </div>



                    <!-- Pickup Address -->
                    <div class="mb-4">

                        <label class="block font-medium text-gray-700">
                            Pickup Location
                        </label>

                        <input 
                            type="text"
                            name="pickup_address"
                            value="{{ old('pickup_address') }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="Enter pickup location">

                    </div>
                    <!-- Upload Picture -->
<!-- Food Picture -->
<div class="mb-4">

    <label class="block font-medium text-gray-700">
        Food Picture (Optional)
    </label>

    <button
        type="button"
        id="openModal"
        style="background:#2563eb;color:white;padding:10px 20px;border-radius:5px;margin-top:8px;">

        Upload Picture

    </button>

    <p id="selectedImageName"
       style="margin-top:10px;color:green;font-weight:bold;">
    </p>

    <!-- Hidden File Input -->
    <input
        type="file"
        id="food_image"
        name="food_image"
        accept="image/*"
        style="display:none;">

</div>




                    <!-- Submit Button -->
                    <button 
                        type="submit"
                        style="background:green;color:white;padding:10px 20px;border-radius:5px;">


                        Donate Food

                    </button>



                </form>


            </div>

        </div>

    </div>
<script>

    const openModal = document.getElementById('openModal');
    const foodImage = document.getElementById('food_image');
    const selectedImageName = document.getElementById('selectedImageName');

    openModal.addEventListener('click', function () {

        foodImage.click();

    });

    foodImage.addEventListener('change', function () {

        if (foodImage.files.length > 0) {

            selectedImageName.innerHTML =
                "✔ Selected: " + foodImage.files[0].name;

        }

    });

</script>

</x-app-layout>