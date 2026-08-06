<x-app-layout>
    <x-slot name="header">
        <h2>Add Food Category</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">

                <h3 class="text-2xl font-bold mb-6">
                    Add Food Category
                </h3>

                <form action="{{ route('admin.categories.store') }}" method="POST">

                    @csrf

                    <div class="mb-4">

                        <label class="block font-medium text-sm text-gray-700">
                            Category Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            placeholder="Enter category name"
                        >

                    </div>

                    <div class="mt-6">

                        <button
                            type="submit"
                            class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700"
                        >
                            Save Category
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>