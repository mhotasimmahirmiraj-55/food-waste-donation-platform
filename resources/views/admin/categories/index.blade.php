<x-app-layout>
    <x-slot name="header">
        <h2>Food Categories</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">

                <div class="flex justify-between items-center mb-6">

                    <h3 class="text-2xl font-bold">
                        Food Categories
                    </h3>

                    <a href="{{ route('admin.categories.create') }}"
                        class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                        + Add Category
                    </a>

                </div>          

                @if (session('success'))

                    <div class="mb-4 rounded-lg bg-green-100 border border-green-400 text-green-700 px-4 py-3">
                        {{ session('success') }}
                    </div>

                @endif

                @if (session('error'))

                    <div class="mb-4 rounded-lg bg-red-100 border border-red-400 text-red-700 px-4 py-3">
                        {{ session('error') }}
                    </div>

                @endif

                <table class="min-w-full border border-gray-300">

                    <thead class="bg-gray-200">

                        <tr>

                            <th class="border px-4 py-2 text-center">
                                ID
                            </th>

                            <th class="border px-4 py-2">
                                Category Name
                            </th>

                            <th class="border px-4 py-2 text-center">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($categories as $category)

                            <tr class="hover:bg-gray-50">

                                <td class="border px-4 py-2 text-center">
                                    {{ $category->id }}
                                </td>

                                <td class="border px-4 py-2">
                                    {{ $category->name }}
                                </td>

                                <td class="border px-4 py-2 text-center">

                                    <a href="{{ route('admin.categories.edit', $category) }}"
                                        class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.categories.destroy', $category) }}"
                                        method="POST"
                                        class="inline">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            onclick="return confirm('Are you sure you want to delete this category?')"
                                            class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 ml-2">
                                            Delete
                                        </button>

                                    </form>

                                </td>
                            </tr>

                        @endforeach

                    </tbody>

                </table>

                <div class="mt-6">
                    {{ $categories->links() }}
                </div>

            </div>

        </div>
    </div>
</x-app-layout>