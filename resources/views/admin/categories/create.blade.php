<x-app-layout>

    <x-slot name="header">

        <div>

            <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                Add Food Category
            </h2>

            <p class="mt-1 text-sm text-emerald-800">
                Create a new category for organizing food donations.
            </p>

        </div>

    </x-slot>


    <div class="min-h-screen bg-gradient-to-br from-emerald-100 via-white to-green-100">

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


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

                    <div class="flex items-center gap-4">

                        <div
                            class="w-11 h-11 rounded-xl
                                   bg-emerald-200
                                   text-emerald-900
                                   border border-emerald-300
                                   flex items-center justify-center"
                        >

                            <svg
                                class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M12 4v16m8-8H4"
                                />

                            </svg>

                        </div>


                        <div>

                            <h3 class="text-xl font-bold text-gray-900">
                                Add Food Category
                            </h3>

                            <p class="text-sm text-gray-600">
                                Enter a name for the new category.
                            </p>

                        </div>

                    </div>

                </div>



                {{-- Form --}}

                <form
                    action="{{ route('admin.categories.store') }}"
                    method="POST"
                    class="p-6"
                >

                    @csrf


                    <div>

                        <label
                            for="name"
                            class="block text-sm font-semibold text-emerald-900"
                        >
                            Category Name
                        </label>


                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Enter category name"
                            class="mt-2 block w-full
                                   rounded-xl
                                   border-emerald-200
                                   focus:border-emerald-500
                                   focus:ring-emerald-500
                                   shadow-sm"
                        >


                        @error('name')

                            <p class="mt-2 text-sm text-red-600">
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

                            Save Category

                        </button>


                        <a
                            href="{{ route('admin.categories') }}"
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