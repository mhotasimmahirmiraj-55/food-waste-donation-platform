<x-app-layout>

    <x-slot name="header">

        <div>

            <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                Edit Food Category
            </h2>

            <p class="mt-1 text-sm text-emerald-800">
                Update the selected food category.
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
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M16.5 3.5a2.12 2.12 0 013 3L10 16l-4 1 1-4 9.5-9.5z"
                                />

                            </svg>

                        </div>


                        <div>

                            <h3 class="text-xl font-bold text-gray-900">
                                Edit Food Category
                            </h3>

                            <p class="text-sm text-gray-600">
                                Category #{{ $category->id }}
                            </p>

                        </div>

                    </div>

                </div>



                {{-- Form --}}

                <form
                    action="{{ route('admin.categories.update', $category) }}"
                    method="POST"
                    class="p-6"
                >

                    @csrf
                    @method('PUT')


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
                            value="{{ old('name', $category->name) }}"
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

                            Update Category

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