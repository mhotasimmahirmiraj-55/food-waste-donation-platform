<x-app-layout>

    {{-- =========================================================
         HEADER
    ========================================================== --}}

    <x-slot name="header">

        <div class="flex items-center gap-3">

            <div class="w-1.5 h-9 rounded-full bg-emerald-500"></div>

            <div>
                <h2 class="font-bold text-2xl text-gray-800">
                    Create Food Donation
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Share surplus food and help make a meaningful impact.
                </p>
            </div>

        </div>

    </x-slot>


    {{-- =========================================================
         PAGE BACKGROUND
    ========================================================== --}}

    <div class="min-h-screen
                bg-gradient-to-br
                from-emerald-100
                via-teal-50
                to-cyan-100
                py-10">


        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- =================================================
                 TOP INTRO CARD
            ================================================== --}}

            <div class="relative overflow-hidden
                        bg-gradient-to-r
                        from-emerald-600
                        via-teal-600
                        to-cyan-600
                        rounded-3xl
                        shadow-xl
                        mb-8">

                <div class="absolute -right-16 -top-16
                            w-48 h-48
                            bg-white/10
                            rounded-full">
                </div>

                <div class="absolute -right-8 -bottom-20
                            w-56 h-56
                            bg-white/10
                            rounded-full">
                </div>


                <div class="relative p-8 md:p-10">

                    <div class="max-w-2xl">

                        <div class="inline-flex items-center gap-2
                                    bg-white/15
                                    backdrop-blur-sm
                                    text-white
                                    px-4 py-2
                                    rounded-full
                                    text-sm
                                    font-semibold
                                    mb-4">

                            <span class="text-lg">🍱</span>

                            Food Donation

                        </div>


                        <h1 class="text-3xl md:text-4xl
                                   font-bold
                                   text-white">

                            Make a Difference Today

                        </h1>


                        <p class="mt-3
                                  text-emerald-50
                                  text-base
                                  md:text-lg
                                  leading-relaxed">

                            Have extra food?
                            Share it with someone who needs it
                            and help reduce food waste in your community.

                        </p>

                    </div>

                </div>

            </div>



            {{-- =================================================
                 SUCCESS MESSAGE
            ================================================== --}}

            @if(session('success'))

                <div class="mb-6
                            flex items-start gap-4
                            bg-emerald-50
                            border border-emerald-200
                            text-emerald-800
                            rounded-2xl
                            p-5
                            shadow-sm">

                    <div class="flex-shrink-0
                                w-10 h-10
                                flex items-center justify-center
                                rounded-full
                                bg-emerald-100
                                text-emerald-600">

                        ✓

                    </div>

                    <div>

                        <p class="font-bold">
                            Donation Successful
                        </p>

                        <p class="text-sm mt-1">
                            {{ session('success') }}
                        </p>

                    </div>

                </div>

            @endif



            {{-- =================================================
                 VALIDATION ERRORS
            ================================================== --}}

            @if($errors->any())

                <div class="mb-6
                            bg-red-50
                            border border-red-200
                            text-red-700
                            rounded-2xl
                            p-5
                            shadow-sm">

                    <div class="flex items-center gap-3 mb-3">

                        <div class="w-9 h-9
                                    flex items-center justify-center
                                    rounded-full
                                    bg-red-100">

                            !

                        </div>

                        <h3 class="font-bold">
                            Please fix the following errors
                        </h3>

                    </div>


                    <ul class="list-disc ml-12 space-y-1 text-sm">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif



            {{-- =================================================
                 MAIN FORM CARD
            ================================================== --}}

            <div class="bg-white/95
                        backdrop-blur-sm
                        rounded-3xl
                        shadow-xl
                        border border-white
                        overflow-hidden">


                {{-- Form Header --}}

                <div class="px-6 md:px-8
                            py-6
                            border-b
                            border-gray-100
                            bg-gray-50/70">

                    <div class="flex items-center gap-4">

                        <div class="w-12 h-12
                                    flex items-center justify-center
                                    rounded-2xl
                                    bg-emerald-100
                                    text-emerald-600">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-6 h-6"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M12 6v12m6-6H6"/>

                            </svg>

                        </div>


                        <div>

                            <h3 class="text-xl
                                       font-bold
                                       text-gray-800">

                                Donation Details

                            </h3>

                            <p class="text-sm
                                      text-gray-500
                                      mt-1">

                                Tell us about the food you would like to donate.

                            </p>

                        </div>

                    </div>

                </div>



                {{-- =================================================
                     FORM
                ================================================== --}}

                <form method="POST"
                      action="{{ route('donations.store') }}"
                      enctype="multipart/form-data"
                      class="p-6 md:p-8">

                    @csrf



               {{-- =============================================
     FOOD INFORMATION
============================================= --}}

<div class="mb-8">

    <div class="flex items-center gap-2 mb-5">

        <div class="w-2 h-2
                    rounded-full
                    bg-emerald-500">
        </div>

        <h4 class="text-lg
                   font-bold
                   text-gray-800">

            Food Information

        </h4>

    </div>


    {{-- Donation Title --}}

    <div class="mb-6">

        <label for="title"
               class="block text-sm
                      font-semibold
                      text-gray-700
                      mb-2">

            Donation Title

            <span class="text-red-500">*</span>

        </label>

        <input
            id="title"
            type="text"
            name="title"
            value="{{ old('title') }}"
            placeholder="e.g. Surplus Food Donation"

            class="w-full
                   px-4 py-3
                   rounded-xl
                   border border-gray-200
                   bg-gray-50
                   text-gray-800
                   placeholder-gray-400
                   focus:outline-none
                   focus:ring-2
                   focus:ring-emerald-500
                   focus:border-transparent
                   focus:bg-white
                   transition">

    </div>


    {{-- Multiple Food Items --}}

    <div>

        <div class="flex items-center
                    justify-between
                    mb-4">

            <div>

                <h5 class="font-bold text-gray-800">
                    Food Items
                </h5>

                <p class="text-sm text-gray-500 mt-1">
                    Add all the food items included in this donation.
                </p>

            </div>

        </div>


        <div id="food-items-container">

            {{-- First Food Item --}}

            <div class="food-item
                        bg-gray-50
                        border border-gray-200
                        rounded-2xl
                        p-5
                        mb-4">

                <div class="grid grid-cols-1
                            md:grid-cols-4
                            gap-4">

                    {{-- Category --}}

                    <div>

                        <label class="block text-sm
                                      font-semibold
                                      text-gray-700
                                      mb-2">

                            Category

                            <span class="text-red-500">*</span>

                        </label>

                        <select
                            name="items[0][food_category_id]"
                            required

                            class="w-full
                                   px-4 py-3
                                   rounded-xl
                                   border border-gray-200
                                   bg-white
                                   text-gray-800
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-emerald-500
                                   focus:border-transparent">

                            <option value="">
                                Select Category
                            </option>

                            @foreach($categories as $category)

                                <option
                                    value="{{ $category->id }}">

                                    {{ $category->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Item Name --}}

                    <div>

                        <label class="block text-sm
                                      font-semibold
                                      text-gray-700
                                      mb-2">

                            Food Name

                            <span class="text-red-500">*</span>

                        </label>

                        <input
                            type="text"
                            name="items[0][item_name]"
                            required
                            placeholder="e.g. Rice"

                            class="w-full
                                   px-4 py-3
                                   rounded-xl
                                   border border-gray-200
                                   bg-white
                                   text-gray-800
                                   placeholder-gray-400
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-emerald-500
                                   focus:border-transparent">

                    </div>


                    {{-- Quantity --}}

                    <div>

                        <label class="block text-sm
                                      font-semibold
                                      text-gray-700
                                      mb-2">

                            Quantity

                            <span class="text-red-500">*</span>

                        </label>

                        <input
                            type="number"
                            name="items[0][quantity]"
                            required
                            min="0.1"
                            step="0.1"
                            placeholder="e.g. 10"

                            class="w-full
                                   px-4 py-3
                                   rounded-xl
                                   border border-gray-200
                                   bg-white
                                   text-gray-800
                                   placeholder-gray-400
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-emerald-500
                                   focus:border-transparent">

                    </div>


                    {{-- Unit --}}

                    <div>

                        <label class="block text-sm
                                      font-semibold
                                      text-gray-700
                                      mb-2">

                            Unit

                            <span class="text-red-500">*</span>

                        </label>

                        <select
                            name="items[0][unit]"
                            required

                            class="w-full
                                   px-4 py-3
                                   rounded-xl
                                   border border-gray-200
                                   bg-white
                                   text-gray-800
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-emerald-500
                                   focus:border-transparent">

                            <option value="">
                                Select Unit
                            </option>

                            <option value="kg">
                                Kilogram (kg)
                            </option>

                            <option value="g">
                                Gram (g)
                            </option>

                            <option value="liter">
                                Liter
                            </option>

                            <option value="ml">
                                Milliliter (ml)
                            </option>

                            <option value="piece">
                                Piece
                            </option>

                            <option value="pack">
                                Pack
                            </option>

                        </select>

                    </div>

                </div>

            </div>

        </div>


        {{-- Add Another Food Button --}}

        <button
            type="button"
            id="add-food-item"

            class="inline-flex
                   items-center
                   gap-2
                   px-5 py-3
                   rounded-xl
                   bg-emerald-50
                   text-emerald-700
                   border border-emerald-200
                   font-semibold
                   hover:bg-emerald-100
                   transition">

            <span class="text-xl">
                +
            </span>

            Add Another Food

        </button>

    </div>


    {{-- Expiry Date --}}

    <div class="mt-6">

        <label for="expiry_time"
               class="block text-sm
                      font-semibold
                      text-gray-700
                      mb-2">

            Expiry Date & Time

            <span class="text-red-500">*</span>

        </label>

        <input
            id="expiry_time"
            type="datetime-local"
            name="expiry_time"
            value="{{ old('expiry_time') }}"
            required

            class="w-full
                   px-4 py-3
                   rounded-xl
                   border border-gray-200
                   bg-gray-50
                   text-gray-800
                   focus:outline-none
                   focus:ring-2
                   focus:ring-emerald-500
                   focus:border-transparent
                   focus:bg-white
                   transition">

    </div>


    {{-- Description --}}

    <div class="mt-6">

        <label for="description"
               class="block text-sm
                      font-semibold
                      text-gray-700
                      mb-2">

            Description

            <span class="text-gray-400 font-normal">
                (Optional)
            </span>

        </label>

        <textarea
            id="description"
            name="description"
            rows="5"
            placeholder="Describe the food, ingredients, serving size, condition, or any important information..."

            class="w-full
                   px-4 py-3
                   rounded-xl
                   border border-gray-200
                   bg-gray-50
                   text-gray-800
                   placeholder-gray-400
                   resize-none
                   focus:outline-none
                   focus:ring-2
                   focus:ring-emerald-500
                   focus:border-transparent
                   focus:bg-white
                   transition">{{ old('description') }}</textarea>

    </div>

</div>

                    {{-- =============================================
                         PICKUP INFORMATION
                    ============================================== --}}

                    <div class="border-t
                                border-gray-100
                                pt-8
                                mb-8">

                        <div class="flex items-center gap-2 mb-5">

                            <div class="w-2 h-2
                                        rounded-full
                                        bg-blue-500">
                            </div>

                            <h4 class="text-lg
                                       font-bold
                                       text-gray-800">

                                Pickup Information

                            </h4>

                        </div>


                        <label for="pickup_address"
                               class="block text-sm
                                      font-semibold
                                      text-gray-700
                                      mb-2">

                            Pickup Location

                            <span class="text-red-500">*</span>

                        </label>


                        <div class="relative">

                            <input
                                id="pickup_address"
                                type="text"
                                name="pickup_address"
                                value="{{ old('pickup_address') }}"
                                placeholder="Enter the location where the food can be collected"

                                class="w-full
                                       px-4 py-3
                                       rounded-xl
                                       border border-gray-200
                                       bg-gray-50
                                       text-gray-800
                                       placeholder-gray-400
                                       focus:outline-none
                                       focus:ring-2
                                       focus:ring-blue-500
                                       focus:border-transparent
                                       focus:bg-white
                                       transition">

                        </div>


                        <p class="text-xs
                                  text-gray-400
                                  mt-2">

                            Please provide an accurate pickup location for the receiver.

                        </p>

                    </div>



                    {{-- =============================================
                         FOOD IMAGE
                    ============================================== --}}

                    <div class="border-t
                                border-gray-100
                                pt-8
                                mb-8">

                        <div class="flex items-center gap-2 mb-5">

                            <div class="w-2 h-2
                                        rounded-full
                                        bg-purple-500">
                            </div>

                            <h4 class="text-lg
                                       font-bold
                                       text-gray-800">

                                Food Picture

                            </h4>

                        </div>


                        <div class="border-2
                                    border-dashed
                                    border-gray-200
                                    hover:border-emerald-400
                                    rounded-2xl
                                    p-8
                                    text-center
                                    bg-gray-50
                                    hover:bg-emerald-50/40
                                    transition-all
                                    duration-200">


                            <div class="w-14 h-14
                                        mx-auto
                                        flex items-center justify-center
                                        rounded-2xl
                                        bg-emerald-100
                                        text-emerald-600
                                        mb-4">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-7 h-7"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>

                                </svg>

                            </div>


                            <h5 class="font-bold
                                       text-gray-800">

                                Add a Food Picture

                            </h5>


                            <p class="text-sm
                                      text-gray-500
                                      mt-1
                                      mb-5">

                                A clear picture helps receivers understand the donation.

                            </p>


                            <button
                                type="button"
                                id="openModal"

                                class="inline-flex
                                       items-center
                                       justify-center
                                       gap-2
                                       px-5 py-3
                                       rounded-xl
                                       bg-emerald-600
                                       text-white
                                       font-semibold
                                       shadow-sm
                                       hover:bg-emerald-700
                                       hover:shadow-lg
                                       transition-all
                                       duration-200">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M12 4v16m8-8H4"/>

                                </svg>

                                Upload Picture

                            </button>


                            <p id="selectedImageName"
                               class="mt-4
                                      text-sm
                                      text-emerald-600
                                      font-semibold">
                            </p>


                            <p class="text-xs
                                      text-gray-400
                                      mt-3">

                                JPG, JPEG or PNG • Maximum 2MB

                            </p>


                            <input
                                type="file"
                                id="food_image"
                                name="food_image"
                                accept="image/*"
                                class="hidden">

                        </div>

                    </div>



                    {{-- =============================================
                         ACTION BUTTONS
                    ============================================== --}}

                    <div class="border-t
                                border-gray-100
                                pt-6
                                flex flex-col
                                sm:flex-row
                                sm:items-center
                                sm:justify-between
                                gap-4">


                        <div>

                            <p class="text-sm
                                      text-gray-500">

                                Ready to share your food?

                            </p>

                            <p class="text-xs
                                      text-gray-400
                                      mt-1">

                                Your donation will be listed as available.

                            </p>

                        </div>


                        <button
                            type="submit"

                            class="inline-flex
                                   items-center
                                   justify-center
                                   gap-2
                                   px-7 py-3.5
                                   rounded-xl
                                   bg-gradient-to-r
                                   from-emerald-600
                                   to-teal-600
                                   text-white
                                   font-bold
                                   shadow-lg
                                   hover:from-emerald-700
                                   hover:to-teal-700
                                   hover:-translate-y-0.5
                                   hover:shadow-xl
                                   transition-all
                                   duration-200">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-5 h-5"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M12 19V5m0 0l-6 6m6-6l6 6"/>

                            </svg>

                            Donate Food

                        </button>

                    </div>


                </form>

            </div>


            {{-- =================================================
                 FOOTER MESSAGE
            ================================================== --}}

            <div class="text-center mt-6">

                <p class="text-sm text-gray-500">

                    🌱 Every donation matters.
                    Together, we can reduce food waste.

                </p>

            </div>


        </div>

    </div>



    {{-- =========================================================
         IMAGE UPLOAD SCRIPT
    ========================================================== --}}

    <script>

        const openModal = document.getElementById('openModal');

        const foodImage = document.getElementById('food_image');

        const selectedImageName =
            document.getElementById('selectedImageName');
        // ==========================================
// MULTIPLE FOOD ITEMS
// ==========================================

const addFoodItemButton =
    document.getElementById('add-food-item');

const foodItemsContainer =
    document.getElementById('food-items-container');

let foodItemIndex = 1;


addFoodItemButton.addEventListener('click', function () {

    const item = document.createElement('div');

    item.className =
        'food-item bg-gray-50 border border-gray-200 rounded-2xl p-5 mb-4';


    item.innerHTML = `

        <div class="flex justify-between items-center mb-4">

            <h6 class="font-bold text-gray-700">
                Food Item ${foodItemIndex + 1}
            </h6>

            <button
                type="button"
                class="remove-food-item text-red-500 hover:text-red-700 font-semibold">

                Remove

            </button>

        </div>


        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Category
                </label>

                <select
                    name="items[${foodItemIndex}][food_category_id]"
                    required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white">

                    <option value="">
                        Select Category
                    </option>

                    @foreach($categories as $category)

                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>

                    @endforeach

                </select>

            </div>


            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Food Name
                </label>

                <input
                    type="text"
                    name="items[${foodItemIndex}][item_name]"
                    required
                    placeholder="e.g. Rice"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white">

            </div>


            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Quantity
                </label>

                <input
                    type="number"
                    name="items[${foodItemIndex}][quantity]"
                    required
                    min="0.1"
                    step="0.1"
                    placeholder="e.g. 10"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white">

            </div>


            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Unit
                </label>

                <select
                    name="items[${foodItemIndex}][unit]"
                    required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white">

                    <option value="">
                        Select Unit
                    </option>

                    <option value="kg">
                        Kilogram (kg)
                    </option>

                    <option value="g">
                        Gram (g)
                    </option>

                    <option value="liter">
                        Liter
                    </option>

                    <option value="ml">
                        Milliliter (ml)
                    </option>

                    <option value="piece">
                        Piece
                    </option>

                    <option value="pack">
                        Pack
                    </option>

                </select>

            </div>

        </div>
    `;


    foodItemsContainer.appendChild(item);


    item.querySelector('.remove-food-item')
        .addEventListener('click', function () {

            item.remove();

        });


    foodItemIndex++;

});


        openModal.addEventListener('click', function () {

            foodImage.click();

        });


        foodImage.addEventListener('change', function () {

            if (foodImage.files.length > 0) {

                selectedImageName.innerHTML =
                    "✓ Selected: " + foodImage.files[0].name;

            }

        });

    </script>


</x-app-layout>