<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                    Food Categories
                </h2>

                <p class="mt-1 text-sm text-emerald-800">
                    Organize the types of food available on the platform.
                </p>

            </div>

            <div class="hidden sm:flex items-center gap-2 text-sm text-emerald-800">

                <span class="w-2 h-2 rounded-full bg-emerald-600"></span>

                Category Management

            </div>

        </div>

    </x-slot>


    {{-- ================================================= --}}
    {{-- MAIN PAGE --}}
    {{-- Darker emerald theme --}}
    {{-- ================================================= --}}

    <div class="min-h-screen bg-gradient-to-br from-emerald-100 via-white to-green-100">

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


            {{-- ================================================= --}}
            {{-- PAGE HEADER --}}
            {{-- ================================================= --}}

            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6">

                <div>

                    <h1 class="text-2xl font-bold text-gray-900">
                        Food Categories
                    </h1>

                    <p class="mt-1 text-sm text-emerald-800">
                        Create and maintain food donation categories.
                    </p>

                </div>


                {{-- Total Categories --}}

                <div
                    class="inline-flex items-center gap-3
                           bg-white
                           border border-emerald-200
                           rounded-2xl
                           px-5 py-3
                           shadow-sm"
                >

                    <div
                        class="w-10 h-10 rounded-xl
                               bg-emerald-100
                               text-emerald-800
                               border border-emerald-200
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
                                d="M4 6h16M4 12h16M4 18h16"
                            />

                        </svg>

                    </div>


                    <div>

                        <p class="text-xs font-medium text-gray-500">
                            Total Categories
                        </p>

                        <p class="text-xl font-bold text-gray-900">
                            {{ $categories->total() }}
                        </p>

                    </div>

                </div>

            </div>



            {{-- ================================================= --}}
            {{-- SUCCESS MESSAGE --}}
            {{-- ================================================= --}}

            @if (session('success'))

                <div
                    class="mb-6 flex items-start gap-3
                           rounded-xl
                           bg-emerald-100
                           border border-emerald-200
                           text-emerald-900
                           px-4 py-3
                           shadow-sm"
                >

                    <svg
                        class="w-5 h-5 mt-0.5 flex-shrink-0 text-emerald-700"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M5 13l4 4L19 7"
                        />

                    </svg>

                    <span class="text-sm font-medium">
                        {{ session('success') }}
                    </span>

                </div>

            @endif



            {{-- ================================================= --}}
            {{-- ERROR MESSAGE --}}
            {{-- ================================================= --}}

            @if (session('error'))

                <div
                    class="mb-6 flex items-start gap-3
                           rounded-xl
                           bg-red-50
                           border border-red-200
                           text-red-800
                           px-4 py-3
                           shadow-sm"
                >

                    <svg
                        class="w-5 h-5 mt-0.5 flex-shrink-0 text-red-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 9v4m0 4h.01M5.07 19h13.86a2 2 0 001.73-3L13.73 4a2 2 0 00-3.46 0L3.34 16a2 2 0 001.73 3z"
                        />

                    </svg>

                    <span class="text-sm font-medium">
                        {{ session('error') }}
                    </span>

                </div>

            @endif



            {{-- ================================================= --}}
            {{-- CATEGORY CARD --}}
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

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                        <div>

                            <h3 class="text-lg font-bold text-gray-900">
                                Category List
                            </h3>

                            <p class="mt-1 text-sm text-gray-600">
                                Manage the categories used when creating food donations.
                            </p>

                        </div>


                        {{-- Add Category --}}

                        <a
                            href="{{ route('admin.categories.create') }}"
                            class="inline-flex items-center justify-center gap-2
                                   px-4 py-2.5
                                   rounded-xl
                                   bg-emerald-700
                                   text-white
                                   text-sm
                                   font-semibold
                                   hover:bg-emerald-800
                                   transition
                                   shadow-sm"
                        >

                            <svg
                                class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 4v16m8-8H4"
                                />

                            </svg>

                            Add Category

                        </a>

                    </div>

                </div>



                {{-- ================================================= --}}
                {{-- CATEGORY LIST --}}
                {{-- ================================================= --}}

                <div class="divide-y divide-emerald-100">

                    @forelse ($categories as $category)

                        <div class="px-6 py-4 hover:bg-emerald-100/70 transition">

                            <div class="flex items-center justify-between gap-4">


                                {{-- Category Information --}}

                                <div class="flex items-center gap-4 min-w-0">

                                    <div
                                        class="w-11 h-11 rounded-xl
                                               bg-emerald-100
                                               text-emerald-800
                                               border border-emerald-200
                                               flex items-center justify-center
                                               flex-shrink-0"
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
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0l-4 5H8l-4-5m16 0H4"
                                            />

                                        </svg>

                                    </div>


                                    <div class="min-w-0">

                                        <p class="text-sm font-bold text-gray-900 truncate">
                                            {{ $category->name }}
                                        </p>

                                        <p class="text-xs text-gray-400 mt-1">
                                            Category #{{ $category->id }}
                                        </p>

                                    </div>

                                </div>



                                {{-- Actions --}}

                                <div class="flex items-center gap-2 flex-shrink-0">


                                    {{-- Edit --}}

                                    <a
                                        href="{{ route('admin.categories.edit', $category) }}"
                                        class="inline-flex items-center gap-1.5
                                               px-3 py-2
                                               rounded-lg
                                               bg-emerald-100
                                               text-emerald-800
                                               border border-emerald-200
                                               hover:bg-emerald-200
                                               text-xs
                                               font-semibold
                                               transition"
                                    >

                                        <svg
                                            class="w-4 h-4"
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

                                        Edit

                                    </a>



                                    {{-- Delete --}}

                                    <form
                                        action="{{ route('admin.categories.destroy', $category) }}"
                                        method="POST"
                                        class="inline"
                                        onsubmit="return confirm('Are you sure you want to delete this category?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="inline-flex items-center gap-1.5
                                                   px-3 py-2
                                                   rounded-lg
                                                   bg-red-50
                                                   text-red-700
                                                   border border-red-100
                                                   hover:bg-red-100
                                                   text-xs
                                                   font-semibold
                                                   transition"
                                        >

                                            <svg
                                                class="w-4 h-4"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.8"
                                                    d="M3 6h18M8 6V4h8v2m-9 0l1 14h8l1-14M10 11v6M14 11v6"
                                                />

                                            </svg>

                                            Delete

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    @empty

                        {{-- ================================================= --}}
                        {{-- EMPTY STATE --}}
                        {{-- ================================================= --}}

                        <div class="px-6 py-20">

                            <div class="flex flex-col items-center text-center">

                                <div
                                    class="w-16 h-16 rounded-2xl
                                           bg-emerald-100
                                           text-emerald-700
                                           border border-emerald-200
                                           flex items-center justify-center"
                                >

                                    <svg
                                        class="w-8 h-8"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0l-4 5H8l-4-5m16 0H4"
                                        />

                                    </svg>

                                </div>


                                <h4 class="mt-5 text-lg font-bold text-gray-900">
                                    No categories yet
                                </h4>


                                <p class="mt-1 max-w-md text-sm text-gray-500">
                                    Create your first food category to organize donations.
                                </p>


                                <a
                                    href="{{ route('admin.categories.create') }}"
                                    class="mt-5 inline-flex items-center gap-2
                                           px-4 py-2.5
                                           rounded-xl
                                           bg-emerald-700
                                           text-white
                                           text-sm
                                           font-semibold
                                           hover:bg-emerald-800
                                           transition"
                                >

                                    <svg
                                        class="w-4 h-4"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 4v16m8-8H4"
                                        />

                                    </svg>

                                    Add Category

                                </a>

                            </div>

                        </div>

                    @endforelse

                </div>



                {{-- ================================================= --}}
                {{-- PAGINATION --}}
                {{-- ================================================= --}}

                @if ($categories->hasPages())

                    <div
                        class="px-6 py-4
                               border-t border-emerald-200
                               bg-emerald-100/50"
                    >

                        {{ $categories->links() }}

                    </div>

                @endif

            </div>



            {{-- ================================================= --}}
            {{-- INFORMATION CARD --}}
            {{-- ================================================= --}}

            <div
                class="mt-6
                       rounded-2xl
                       border border-emerald-200
                       bg-emerald-100/70
                       px-5 py-4"
            >

                <div class="flex items-start gap-3">

                    <div
                        class="w-9 h-9 rounded-lg
                               bg-emerald-200
                               text-emerald-800
                               flex items-center justify-center
                               flex-shrink-0"
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
                                d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z"
                            />

                        </svg>

                    </div>


                    <div>

                        <p class="text-sm font-semibold text-emerald-900">
                            Category deletion policy
                        </p>

                        <p class="mt-1 text-sm text-emerald-800">
                            Categories that are currently being used by food donations
                            cannot be deleted.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>