<x-app-layout>

    {{-- =========================================================
         HEADER
    ========================================================== --}}

    <x-slot name="header">

        <div class="flex items-center gap-3">

            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-600 text-white shadow-lg shadow-emerald-900/40">
                ✏️
            </div>

            <div>
                <h2 class="text-xl font-bold tracking-tight text-gray-900">
                    Edit Donation
                </h2>

                <p class="text-sm text-gray-500">
                    Manage your donation details
                </p>
            </div>

        </div>

    </x-slot>


    {{-- =========================================================
         DARK PAGE BACKGROUND
    ========================================================== --}}

    <div class="relative min-h-screen overflow-hidden bg-gradient-to-br from-slate-500 via-emerald-600 to-slate-500 py-10">


        {{-- Decorative Background Glow --}}

        <div class="pointer-events-none absolute -left-32 -top-32 h-96 w-96 rounded-full bg-emerald-600/10 blur-3xl"></div>

        <div class="pointer-events-none absolute -right-32 top-1/4 h-96 w-96 rounded-full bg-green-500/10 blur-3xl"></div>

        <div class="pointer-events-none absolute bottom-0 left-1/3 h-80 w-80 rounded-full bg-teal-500/10 blur-3xl"></div>


        <div class="relative mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">


            {{-- =================================================
                 BACK LINK
            ================================================== --}}

            <div class="mb-6">

                <a
                    href="{{ route('donations.edit.list') }}"
                    class="group inline-flex items-center gap-2 text-sm font-semibold text-slate-300 transition hover:text-emerald-400"
                >

                    <span class="transition-transform duration-200 group-hover:-translate-x-1">
                        ←
                    </span>

                    Back to Edit Donations

                </a>

            </div>


            {{-- =================================================
                 HERO
            ================================================== --}}

            <div class="mb-7 overflow-hidden rounded-3xl border border-emerald-500/20 bg-gradient-to-r from-emerald-900 via-emerald-800 to-green-900 p-7 text-white shadow-2xl shadow-black/30 sm:p-9">

                <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-5">

                        <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-emerald-400/10 text-3xl shadow-inner ring-1 ring-emerald-300/20 backdrop-blur">
                            🍱
                        </div>

                        <div>

                            <div class="mb-1 inline-flex items-center rounded-full bg-emerald-400/10 px-3 py-1 text-xs font-semibold text-emerald-200 ring-1 ring-emerald-300/20">
                                DONATION MANAGEMENT
                            </div>

                            <h1 class="text-2xl font-extrabold tracking-tight sm:text-3xl">
                                Edit Food Donation
                            </h1>

                            <p class="mt-1 text-sm text-emerald-100 sm:text-base">
                                Update your donation information and food items.
                            </p>

                        </div>

                    </div>


                    {{-- STATUS --}}

                    <div class="w-fit rounded-2xl border border-emerald-400/20 bg-emerald-950/40 px-5 py-3 backdrop-blur">

                        <p class="text-xs font-medium uppercase tracking-wider text-emerald-300">
                            Status
                        </p>

                        <div class="mt-1 flex items-center gap-2">

                            <span class="h-2.5 w-2.5 rounded-full bg-green-400 shadow-lg shadow-green-400/50"></span>

                            <span class="text-sm font-bold text-white">
                                Available
                            </span>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 FORM
            ================================================== --}}

            <form
                method="POST"
                action="{{ route('donations.update', $donation->id) }}"
                id="editDonationForm"
                enctype="multipart/form-data"
            >

                @csrf
                @method('PUT')


                {{-- =================================================
                     VALIDATION ERRORS
                ================================================== --}}

                @if ($errors->any())

                    <div class="mb-7 rounded-2xl border border-red-500/30 bg-red-950/50 p-5 shadow-xl shadow-black/20">

                        <div class="flex gap-3">

                            <div class="text-xl">
                                ⚠️
                            </div>

                            <div>

                                <h3 class="font-bold text-red-300">
                                    Please fix the following errors
                                </h3>

                                <ul class="mt-2 list-inside list-disc space-y-1 text-sm text-red-200">

                                    @foreach ($errors->all() as $error)

                                        <li>
                                            {{ $error }}
                                        </li>

                                    @endforeach

                                </ul>

                            </div>

                        </div>

                    </div>

                @endif


                <div class="space-y-7">


                    {{-- =================================================
                         DONATION INFORMATION CARD
                    ================================================== --}}

                    <section class="overflow-hidden rounded-3xl border border-slate-700/80 bg-slate-800/95 shadow-2xl shadow-black/30 backdrop-blur">


                        {{-- SECTION HEADER --}}

                        <div class="border-b border-slate-700 bg-gradient-to-r from-slate-800 to-emerald-950/50 px-6 py-5 sm:px-7">

                            <div class="flex items-center gap-4">

                                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-900/60 text-xl ring-1 ring-emerald-500/20">
                                    📋
                                </div>

                                <div>

                                    <h3 class="font-bold text-white">
                                        Donation Details
                                    </h3>

                                    <p class="text-sm text-slate-400">
                                        Basic information about your donation
                                    </p>

                                </div>

                            </div>

                        </div>


                        <div class="p-6 sm:p-7">


                            <div class="grid gap-6 md:grid-cols-2">


                                {{-- TITLE --}}

                                <div class="md:col-span-2">

                                    <label
                                        for="title"
                                        class="mb-2 block text-sm font-bold text-slate-200"
                                    >
                                        Donation Title
                                        <span class="text-red-400">*</span>
                                    </label>

                                    <input
                                        id="title"
                                        type="text"
                                        name="title"
                                        value="{{ old('title', $donation->title) }}"
                                        placeholder="e.g. Fresh cooked rice and vegetables"
                                        class="w-full rounded-2xl border border-slate-600 bg-slate-700/80 px-4 py-3.5 text-sm text-white outline-none transition duration-200 placeholder:text-slate-500 hover:border-slate-500 focus:border-emerald-500 focus:bg-slate-700 focus:ring-4 focus:ring-emerald-500/10"
                                    >

                                </div>


                                {{-- DESCRIPTION --}}

                                <div class="md:col-span-2">

                                    <label
                                        for="description"
                                        class="mb-2 block text-sm font-bold text-slate-200"
                                    >
                                        Description
                                    </label>

                                    <textarea
                                        id="description"
                                        name="description"
                                        rows="4"
                                        placeholder="Tell receivers a little more about this donation..."
                                        class="w-full resize-none rounded-2xl border border-slate-600 bg-slate-700/80 px-4 py-3.5 text-sm text-white outline-none transition duration-200 placeholder:text-slate-500 hover:border-slate-500 focus:border-emerald-500 focus:bg-slate-700 focus:ring-4 focus:ring-emerald-500/10"
                                    >{{ old('description', $donation->description) }}</textarea>

                                </div>


                                {{-- PICKUP ADDRESS --}}

                                <div>

                                    <label
                                        for="pickup_address"
                                        class="mb-2 block text-sm font-bold text-slate-200"
                                    >
                                        Pickup Location
                                        <span class="text-red-400">*</span>
                                    </label>

                                    <div class="relative">

                                        <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-lg">
                                            📍
                                        </span>

                                        <input
                                            id="pickup_address"
                                            type="text"
                                            name="pickup_address"
                                            value="{{ old('pickup_address', $donation->pickup_address) }}"
                                            placeholder="Enter pickup address"
                                            class="w-full rounded-2xl border border-slate-600 bg-slate-700/80 py-3.5 pl-11 pr-4 text-sm text-white outline-none transition duration-200 placeholder:text-slate-500 hover:border-slate-500 focus:border-emerald-500 focus:bg-slate-700 focus:ring-4 focus:ring-emerald-500/10"
                                        >

                                    </div>

                                </div>


                                {{-- EXPIRY --}}

                                <div>

                                    <label
                                        for="expiry_time"
                                        class="mb-2 block text-sm font-bold text-slate-200"
                                    >
                                        Expiry Date & Time
                                        <span class="text-red-400">*</span>
                                    </label>

                                    <input
                                        id="expiry_time"
                                        type="datetime-local"
                                        name="expiry_time"
                                        value="{{ old('expiry_time', \Carbon\Carbon::parse($donation->expiry_time)->format('Y-m-d\TH:i')) }}"
                                        class="w-full rounded-2xl border border-slate-600 bg-slate-700/80 px-4 py-3.5 text-sm text-white outline-none transition duration-200 hover:border-slate-500 focus:border-emerald-500 focus:bg-slate-700 focus:ring-4 focus:ring-emerald-500/10"
                                    >

                                </div>

                            </div>

                        </div>

                    </section>


                    {{-- =================================================
                         FOOD ITEMS CARD
                    ================================================== --}}

                    <section class="overflow-hidden rounded-3xl border border-slate-700/80 bg-slate-800/95 shadow-2xl shadow-black/30 backdrop-blur">


                        {{-- SECTION HEADER --}}

                        <div class="border-b border-slate-700 bg-gradient-to-r from-slate-800 to-orange-950/30 px-6 py-5 sm:px-7">

                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                                <div class="flex items-center gap-4">

                                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-orange-900/40 text-xl ring-1 ring-orange-500/20">
                                        🍽️
                                    </div>

                                    <div>

                                        <h3 class="font-bold text-white">
                                            Food Items
                                        </h3>

                                        <p class="text-sm text-slate-400">
                                            Manage the food included in this donation
                                        </p>

                                    </div>

                                </div>


                                <div
                                    id="itemCount"
                                    class="w-fit rounded-full bg-emerald-900/60 px-4 py-1.5 text-xs font-bold text-emerald-300 ring-1 ring-emerald-500/20"
                                >
                                    {{ $donation->items->count() }}
                                    {{ Str::plural('Item', $donation->items->count()) }}
                                </div>

                            </div>

                        </div>


                        <div class="p-6 sm:p-7">


                            {{-- ITEMS --}}

                            <div
                                id="itemsContainer"
                                class="space-y-4"
                            >

                                @foreach($donation->items as $index => $item)

                                    <div class="item-row group rounded-2xl border border-slate-600 bg-gradient-to-r from-slate-700/90 to-slate-800/90 p-5 transition duration-200 hover:border-emerald-500/60 hover:shadow-lg hover:shadow-emerald-950/40">


                                        {{-- EXISTING ITEM ID --}}

                                        <input
                                            type="hidden"
                                            name="items[{{ $index }}][id]"
                                            value="{{ $item->id }}"
                                        >


                                        {{-- ITEM TOP --}}

                                        <div class="mb-5 flex items-center justify-between">

                                            <div class="flex items-center gap-3">

                                                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-900/70 text-sm font-bold text-emerald-300 ring-1 ring-emerald-500/20">
                                                    {{ $index + 1 }}
                                                </div>

                                                <div>

                                                    <p class="text-sm font-bold text-white">
                                                        Food Item
                                                    </p>

                                                    <p class="text-xs text-slate-400">
                                                        Update item information
                                                    </p>

                                                </div>

                                            </div>


                                            <button
                                                type="button"
                                                class="remove-item inline-flex items-center gap-1.5 rounded-xl px-3 py-2 text-xs font-bold text-red-400 transition hover:bg-red-950/60 hover:text-red-300"
                                            >

                                                🗑️
                                                Remove

                                            </button>

                                        </div>


                                        {{-- ITEM FIELDS --}}

                                        <div class="grid gap-4 md:grid-cols-12">


                                            {{-- CATEGORY --}}

                                            <div class="md:col-span-4">

                                                <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-400">
                                                    Category
                                                </label>

                                                <select
                                                    name="items[{{ $index }}][food_category_id]"
                                                    required
                                                    class="w-full rounded-xl border border-slate-600 bg-slate-700 px-3.5 py-3 text-sm font-medium text-white outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10"
                                                >

                                                    <option value="" class="bg-slate-800">
                                                        Select category
                                                    </option>

                                                    @foreach($categories as $category)

                                                        <option
                                                            value="{{ $category->id }}"
                                                            @selected($item->food_category_id == $category->id)
                                                            class="bg-slate-800"
                                                        >
                                                            {{ $category->name }}
                                                        </option>

                                                    @endforeach

                                                </select>

                                            </div>


                                            {{-- ITEM NAME --}}

                                            <div class="md:col-span-4">

                                                <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-400">
                                                    Item Name
                                                </label>

                                                <input
                                                    type="text"
                                                    name="items[{{ $index }}][item_name]"
                                                    value="{{ old("items.$index.item_name", $item->item_name) }}"
                                                    required
                                                    placeholder="e.g. Rice"
                                                    class="w-full rounded-xl border border-slate-600 bg-slate-700 px-3.5 py-3 text-sm font-medium text-white outline-none transition placeholder:text-slate-500 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10"
                                                >

                                            </div>


                                            {{-- QUANTITY --}}

                                            <div class="md:col-span-2">

                                                <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-400">
                                                    Quantity
                                                </label>

                                                <input
                                                    type="number"
                                                    name="items[{{ $index }}][quantity]"
                                                    value="{{ old("items.$index.quantity", $item->quantity) }}"
                                                    min="0.1"
                                                    step="0.1"
                                                    required
                                                    class="w-full rounded-xl border border-slate-600 bg-slate-700 px-3.5 py-3 text-sm font-medium text-white outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10"
                                                >

                                            </div>


                                            {{-- UNIT --}}

                                            <div class="md:col-span-2">

                                                <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-400">
                                                    Unit
                                                </label>

                                                <input
                                                    type="text"
                                                    name="items[{{ $index }}][unit]"
                                                    value="{{ old("items.$index.unit", $item->unit) }}"
                                                    required
                                                    placeholder="kg"
                                                    class="w-full rounded-xl border border-slate-600 bg-slate-700 px-3.5 py-3 text-sm font-medium text-white outline-none transition placeholder:text-slate-500 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10"
                                                >

                                            </div>

                                        </div>

                                    </div>

                                @endforeach

                            </div>


                            {{-- =================================================
                                 ADD ITEM BUTTON
                            ================================================== --}}

                            <button
                                type="button"
                                id="addItemBtn"
                                class="mt-5 flex w-full items-center justify-center gap-3 rounded-2xl border-2 border-dashed border-emerald-500/40 bg-emerald-950/30 px-5 py-4 text-sm font-bold text-emerald-300 transition duration-200 hover:border-emerald-400 hover:bg-emerald-900/40 hover:text-emerald-200 hover:shadow-lg hover:shadow-emerald-950/30"
                            >

                                <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-emerald-600 text-lg text-white shadow-sm">
                                    +
                                </span>

                                Add Another Food Item

                            </button>

                        </div>

                    </section>


                    {{-- =================================================
                         FOOD PICTURES CARD
                    ================================================== --}}

                    <section class="overflow-hidden rounded-3xl border border-slate-700/80 bg-slate-800/95 shadow-2xl shadow-black/30 backdrop-blur">

                        {{-- SECTION HEADER --}}
                        <div class="border-b border-slate-700 bg-gradient-to-r from-slate-800 to-purple-950/30 px-6 py-5 sm:px-7">
                            <div class="flex items-center gap-4">
                                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-purple-900/40 text-xl ring-1 ring-purple-500/20">
                                    📸
                                </div>
                                <div>
                                    <h3 class="font-bold text-white">
                                        Food Pictures
                                    </h3>
                                    <p class="text-sm text-slate-400">
                                        Manage existing photos and upload additional photos for this donation
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 sm:p-7 space-y-6">

                            {{-- Existing Pictures (Keep or Delete) --}}
                            @if (!empty($donation->images))
                                <div class="p-4 sm:p-5 rounded-2xl bg-slate-700/50 border border-slate-600/80 space-y-3">
                                    <div class="flex items-center justify-between">
                                        <h4 class="text-xs font-bold text-slate-300 uppercase tracking-wider">
                                            Existing Photos ({{ count($donation->images) }})
                                        </h4>
                                        <span class="text-[11px] text-slate-400">Select Keep or Delete</span>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                                        @foreach ($donation->images as $idx => $img)
                                            @php
                                                $imgUrl = str_starts_with($img, 'http') ? $img : (str_starts_with($img, 'storage/') ? asset($img) : asset('storage/' . $img));
                                            @endphp
                                            <div class="p-2.5 rounded-xl bg-slate-800/90 border border-slate-600 flex items-center gap-3">
                                                <img src="{{ $imgUrl }}"
                                                     alt="Donation Photo #{{ $idx + 1 }}"
                                                     class="w-16 h-16 rounded-lg object-cover border border-slate-500 shrink-0">
                                                <div class="flex-1 min-w-0">
                                                    <span class="text-xs font-semibold text-slate-300 block truncate">Photo #{{ $idx + 1 }}</span>
                                                    <div class="mt-2 flex items-center gap-3 text-xs font-semibold">
                                                        <label class="inline-flex items-center gap-1.5 cursor-pointer text-emerald-400 hover:text-emerald-300">
                                                            <input type="radio"
                                                                   name="image_actions[{{ $idx }}]"
                                                                   value="keep"
                                                                   checked
                                                                   class="text-emerald-500 bg-slate-900 border-slate-600 focus:ring-0">
                                                            Keep
                                                        </label>
                                                        <label class="inline-flex items-center gap-1.5 cursor-pointer text-rose-400 hover:text-rose-300">
                                                            <input type="radio"
                                                                   name="image_actions[{{ $idx }}]"
                                                                   value="delete"
                                                                   class="text-rose-500 bg-slate-900 border-slate-600 focus:ring-0">
                                                            Delete
                                                        </label>
                                                    </div>
                                                    <input type="hidden" name="existing_images[{{ $idx }}]" value="{{ $img }}">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            {{-- Upload More / Add Photos Area --}}
                            <div id="imageDropzone"
                                 class="border-2 border-dashed border-slate-600 hover:border-emerald-500 rounded-2xl p-6 text-center bg-slate-700/40 hover:bg-slate-700/60 transition-all duration-200">

                                <div class="w-12 h-12 mx-auto flex items-center justify-center rounded-2xl bg-emerald-500/10 text-emerald-400 ring-1 ring-emerald-500/20 mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>

                                <h5 class="text-sm font-bold text-slate-200">
                                    {{ !empty($donation->images) ? 'Add More Photos' : 'Upload Food Photos' }}
                                </h5>

                                <p class="text-xs text-slate-400 mt-0.5 mb-4">
                                    You can select 1 or more photos (JPG, PNG • Max 2MB each)
                                </p>

                                <button
                                    type="button"
                                    onclick="document.getElementById('food_images').click()"
                                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-semibold shadow-md hover:shadow-lg transition-all duration-200 cursor-pointer"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Choose Photos
                                </button>

                                <input
                                    type="file"
                                    id="food_images"
                                    name="food_images[]"
                                    accept="image/*"
                                    multiple
                                    class="hidden"
                                >

                                {{-- Compact Live Previews for newly selected photos --}}
                                <div id="imagePreviewContainer" class="hidden mt-5 pt-4 border-t border-slate-700/60 text-left">
                                    <div class="flex items-center justify-between mb-3">
                                        <span id="selectedImageInfo" class="text-xs font-semibold text-emerald-400"></span>
                                        <button type="button" id="clearNewImagesBtn" class="text-xs text-rose-400 hover:text-rose-300 font-medium cursor-pointer">
                                            Clear new photos
                                        </button>
                                    </div>
                                    <div id="newImagesPreviewGrid" class="flex flex-wrap gap-3 justify-center sm:justify-start"></div>
                                </div>

                            </div>

                        </div>

                    </section>


                    {{-- =================================================
                         ACTION BAR
                    ================================================== --}}

                    <div class="sticky bottom-4 z-10 rounded-2xl border border-slate-700/80 bg-slate-900/95 p-4 shadow-2xl shadow-black/50 backdrop-blur-md">

                        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-between">


                            {{-- CANCEL --}}

                            <a
                                href="{{ route('donations.edit.list') }}"
                                class="inline-flex items-center justify-center rounded-xl border border-slate-600 bg-slate-800 px-6 py-3 text-sm font-bold text-slate-300 transition hover:border-slate-500 hover:bg-slate-700 hover:text-white"
                            >
                                Cancel
                            </a>


                            {{-- UPDATE --}}

                            <button
                                type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-emerald-600 to-green-600 px-8 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-950/50 transition duration-200 hover:-translate-y-0.5 hover:from-emerald-500 hover:to-green-500 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-emerald-500/20"
                            >

                                <span class="text-base">
                                    ✓
                                </span>

                                Update Donation

                            </button>

                        </div>

                    </div>

                </div>

            </form>


            {{-- =================================================
                 FOOTER
            ================================================== --}}

            <div class="mt-6 text-center">

                <p class="text-xs font-medium text-slate-500">
                    🔒 Only available donations can be edited.
                </p>

            </div>

        </div>

    </div>


    {{-- =========================================================
         JAVASCRIPT
    ========================================================== --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const container = document.getElementById('itemsContainer');
            const addButton = document.getElementById('addItemBtn');
            const itemCount = document.getElementById('itemCount');
            const form = document.getElementById('editDonationForm');

            let itemIndex = {{ $donation->items->count() }};


            // =====================================================
            // CATEGORY OPTIONS
            // =====================================================

            const categoryOptions = `
                <option value="" class="bg-slate-800">
                    Select category
                </option>

                @foreach($categories as $category)

                    <option
                        value="{{ $category->id }}"
                        class="bg-slate-800"
                    >
                        {{ $category->name }}
                    </option>

                @endforeach
            `;


            // =====================================================
            // UPDATE ITEM COUNT
            // =====================================================

            function updateItemCount() {

                const count =
                    container.querySelectorAll('.item-row').length;

                itemCount.textContent =
                    count + (count === 1 ? ' Item' : ' Items');
            }


            // =====================================================
            // ADD NEW ITEM
            // =====================================================

            addButton.addEventListener('click', function () {

                const row =
                    document.createElement('div');

                row.className =
                    'item-row group rounded-2xl border border-emerald-500/30 bg-gradient-to-r from-emerald-950/40 to-slate-800/90 p-5 transition duration-200 hover:border-emerald-500/60 hover:shadow-lg hover:shadow-emerald-950/40';


                row.innerHTML = `

                    <div class="mb-5 flex items-center justify-between">

                        <div class="flex items-center gap-3">

                            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-900/70 text-sm font-bold text-emerald-300 ring-1 ring-emerald-500/20">
                                ${itemIndex + 1}
                            </div>

                            <div>

                                <p class="text-sm font-bold text-white">
                                    New Food Item
                                </p>

                                <p class="text-xs text-slate-400">
                                    Add a food item to this donation
                                </p>

                            </div>

                        </div>


                        <button
                            type="button"
                            class="remove-item inline-flex items-center gap-1.5 rounded-xl px-3 py-2 text-xs font-bold text-red-400 transition hover:bg-red-950/60 hover:text-red-300"
                        >

                            🗑️
                            Remove

                        </button>

                    </div>


                    <div class="grid gap-4 md:grid-cols-12">


                        {{-- CATEGORY --}}

                        <div class="md:col-span-4">

                            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-400">
                                Category
                            </label>

                            <select
                                name="items[${itemIndex}][food_category_id]"
                                required
                                class="w-full rounded-xl border border-slate-600 bg-slate-700 px-3.5 py-3 text-sm font-medium text-white outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10"
                            >

                                ${categoryOptions}

                            </select>

                        </div>


                        {{-- ITEM NAME --}}

                        <div class="md:col-span-4">

                            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-400">
                                Item Name
                            </label>

                            <input
                                type="text"
                                name="items[${itemIndex}][item_name]"
                                required
                                placeholder="e.g. Rice"
                                class="w-full rounded-xl border border-slate-600 bg-slate-700 px-3.5 py-3 text-sm font-medium text-white outline-none transition placeholder:text-slate-500 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10"
                            >

                        </div>


                        {{-- QUANTITY --}}

                        <div class="md:col-span-2">

                            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-400">
                                Quantity
                            </label>

                            <input
                                type="number"
                                name="items[${itemIndex}][quantity]"
                                min="0.1"
                                step="0.1"
                                required
                                placeholder="10"
                                class="w-full rounded-xl border border-slate-600 bg-slate-700 px-3.5 py-3 text-sm font-medium text-white outline-none transition placeholder:text-slate-500 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10"
                            >

                        </div>


                        {{-- UNIT --}}

                        <div class="md:col-span-2">

                            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-400">
                                Unit
                            </label>

                            <input
                                type="text"
                                name="items[${itemIndex}][unit]"
                                required
                                placeholder="kg"
                                class="w-full rounded-xl border border-slate-600 bg-slate-700 px-3.5 py-3 text-sm font-medium text-white outline-none transition placeholder:text-slate-500 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10"
                            >

                        </div>

                    </div>
                `;


                container.appendChild(row);

                itemIndex++;

                updateItemCount();

            });


            // =====================================================
            // REMOVE ITEM
            // =====================================================

            container.addEventListener('click', function (event) {

                const removeButton =
                    event.target.closest('.remove-item');


                if (!removeButton) {
                    return;
                }


                const rows =
                    container.querySelectorAll('.item-row');


                if (rows.length <= 1) {

                    alert('At least one food item is required.');

                    return;
                }


                const row =
                    removeButton.closest('.item-row');


                row.remove();

                updateItemCount();

            });


            // =====================================================
            // SUBMIT VALIDATION
            // =====================================================

            form.addEventListener('submit', function (event) {

                const rows =
                    container.querySelectorAll('.item-row');


                if (rows.length === 0) {

                    event.preventDefault();

                    alert('Please add at least one food item.');

                }

            });


            // =====================================================
            // MULTI-IMAGE PREVIEW HANDLER
            // =====================================================

            const fileInput = document.getElementById('food_images');
            const previewContainer = document.getElementById('imagePreviewContainer');
            const previewGrid = document.getElementById('newImagesPreviewGrid');
            const infoText = document.getElementById('selectedImageInfo');
            const clearBtn = document.getElementById('clearNewImagesBtn');

            let dt = new DataTransfer();

            if (fileInput) {
                fileInput.addEventListener('change', function () {
                    for (let i = 0; i < this.files.length; i++) {
                        const file = this.files[i];
                        if (file.size > 2 * 1024 * 1024) {
                            alert(`File "${file.name}" exceeds 2MB limit and was skipped.`);
                            continue;
                        }
                        dt.items.add(file);
                    }
                    fileInput.files = dt.files;
                    renderNewPreviews();
                });
            }

            if (clearBtn) {
                clearBtn.addEventListener('click', function () {
                    dt = new DataTransfer();
                    if (fileInput) fileInput.files = dt.files;
                    renderNewPreviews();
                });
            }

            function renderNewPreviews() {
                if (!previewGrid || !previewContainer) return;
                previewGrid.innerHTML = '';

                if (dt.files.length === 0) {
                    previewContainer.classList.add('hidden');
                    return;
                }

                previewContainer.classList.remove('hidden');
                if (infoText) {
                    infoText.textContent = `${dt.files.length} new photo${dt.files.length > 1 ? 's' : ''} selected (unsaved)`;
                }

                Array.from(dt.files).forEach((file, index) => {
                    const card = document.createElement('div');
                    card.className = 'relative group w-16 h-16 rounded-xl overflow-hidden shadow-xs border border-emerald-400 bg-slate-900 shrink-0';

                    const img = document.createElement('img');
                    img.className = 'w-full h-full object-cover';
                    img.src = URL.createObjectURL(file);

                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.className = 'absolute top-1 right-1 w-4 h-4 bg-black/70 hover:bg-rose-600 text-white rounded-full flex items-center justify-center text-[9px] font-bold transition cursor-pointer';
                    removeBtn.innerHTML = '✕';
                    removeBtn.title = 'Remove';
                    removeBtn.onclick = function (e) {
                        e.stopPropagation();
                        removeNewFile(index);
                    };

                    card.appendChild(img);
                    card.appendChild(removeBtn);
                    previewGrid.appendChild(card);
                });
            }

            function removeNewFile(index) {
                const newDt = new DataTransfer();
                for (let i = 0; i < dt.files.length; i++) {
                    if (i !== index) {
                        newDt.items.add(dt.files[i]);
                    }
                }
                dt = newDt;
                if (fileInput) fileInput.files = dt.files;
                renderNewPreviews();
            }

        });

    </script>

</x-app-layout>