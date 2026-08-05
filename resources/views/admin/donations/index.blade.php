@php
    use Carbon\Carbon;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2>Donation Management</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">

                <h3 class="text-2xl font-bold mb-6">
                    Donation Management
                </h3>

                @if (session('success'))

                    <div class="mb-4 rounded-lg bg-green-100 border border-green-400 text-green-700 px-4 py-3">
                        {{ session('success') }}
                    </div>

                @endif

                <div class="overflow-x-auto">

                    <table class="min-w-full border border-gray-300">

                        <thead class="bg-gray-200">

                            <tr>

                                <th class="border px-4 py-2 text-center">
                                    ID
                                </th>

                                <th class="border px-4 py-2">
                                    Title
                                </th>

                                <th class="border px-4 py-2">
                                    Donor
                                </th>

                                <th class="border px-4 py-2">
                                    Category
                                </th>

                                <th class="border px-4 py-2 text-center">
                                    Quantity
                                </th>

                                <th class="border px-4 py-2 text-center">
                                    Status
                                </th>

                                <th class="border px-4 py-2 text-center">
                                    Expiry
                                </th>

                                <th class="border px-4 py-2 text-center">
                                    Action
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($donations as $donation)

                                <tr class="hover:bg-gray-50">

                                    <td class="border px-4 py-2 text-center">
                                        {{ $donation->id }}
                                    </td>

                                    <td class="border px-4 py-2">
                                        {{ $donation->title }}
                                    </td>

                                    <td class="border px-4 py-2">
                                        {{ $donation->donor->name }}
                                    </td>

                                    <td class="border px-4 py-2">
                                        {{ $donation->category->name }}
                                    </td>

                                    <td class="border px-4 py-2 text-center">
                                        {{ $donation->quantity }}
                                    </td>

                                    <td class="border px-4 py-2 text-center">

                                        @if ($donation->status == 'available')

                                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                                Available
                                            </span>

                                        @elseif ($donation->status == 'claimed')

                                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                                                Claimed
                                            </span>

                                        @elseif ($donation->status == 'completed')

                                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                                Completed
                                            </span>

                                        @else

                                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">
                                                {{ ucfirst($donation->status) }}
                                            </span>

                                        @endif

                                    </td>

                                    <td class="border px-4 py-2 text-center">
                                        {{ Carbon::parse($donation->expiry_time)->format('d M Y, g:i A') }}
                                    </td>

                                    <td class="border px-4 py-2 text-center">

                                        <a href="{{ route('admin.donations.show', $donation) }}"
                                            class="inline-block bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                            View
                                        </a>

                                        <a href="{{ route('admin.donations.edit', $donation) }}"
                                            class="inline-block bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 ml-1">
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('admin.donations.destroy', $donation) }}"
                                            method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Are you sure you want to delete this donation?')"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 ml-1"
                                            >
                                                Delete
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                    <div class="mt-6">
                        {{ $donations->links() }}
                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>