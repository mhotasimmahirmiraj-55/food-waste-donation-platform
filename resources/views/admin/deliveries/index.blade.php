<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">

                {{-- Header --}}
                <div class="px-6 py-5 border-b border-gray-200">

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                        <div>
                            <h3 class="text-xl font-bold text-gray-800">
                                Delivery Management
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Monitor food delivery operations and their current status.
                            </p>
                        </div>

                        <div class="bg-orange-100 text-orange-700 px-4 py-2 rounded-lg text-sm font-semibold">
                            Total Deliveries: {{ $deliveries->total() }}
                        </div>

                    </div>

                </div>


                {{-- Success Message --}}
                @if (session('success'))

                    <div class="mx-6 mt-5 rounded-lg bg-green-100 border border-green-300 text-green-700 px-4 py-3">
                        {{ session('success') }}
                    </div>

                @endif


                {{-- Delivery Table --}}
                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead class="bg-gray-50 border-b border-gray-200">

                            <tr>

                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    ID
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Donation
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Receiver
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Volunteer
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Status
                                </th>

                                <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-200">

                            @forelse ($deliveries as $delivery)

                                <tr class="hover:bg-gray-50 transition">

                                    {{-- ID --}}
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <span class="font-semibold text-gray-800">
                                            #{{ $delivery->id }}
                                        </span>

                                    </td>


                                    {{-- Donation --}}
                                    <td class="px-6 py-4">

                                        <div class="font-medium text-gray-800">
                                            {{ $delivery->claim->foodDonation->title ?? 'N/A' }}
                                        </div>

                                    </td>


                                    {{-- Receiver --}}
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <div class="text-gray-800">
                                            {{ $delivery->claim->receiver->name ?? 'N/A' }}
                                        </div>

                                    </td>


                                    {{-- Volunteer --}}
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        @if ($delivery->volunteer)

                                            <div class="text-gray-800">
                                                {{ $delivery->volunteer->name }}
                                            </div>

                                        @else

                                            <span class="text-gray-400 italic">
                                                Not assigned
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Status --}}
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        @if ($delivery->status === 'available')

                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                                Available
                                            </span>

                                        @elseif ($delivery->status === 'accepted')

                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                                                Accepted
                                            </span>

                                        @elseif ($delivery->status === 'picked_up')

                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-700">
                                                Picked Up
                                            </span>

                                        @elseif ($delivery->status === 'delivered')

                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                                Delivered
                                            </span>

                                        @else

                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">
                                                {{ ucfirst($delivery->status) }}
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Action --}}
                                    <td class="px-6 py-4 text-center">

                                        <div class="flex items-center justify-center gap-2">

                                            <a
                                                href="{{ route('admin.deliveries.show', $delivery) }}"
                                                class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition"
                                            >
                                                View Details
                                            </a>

                                            @if (in_array($delivery->status, ['accepted', 'picked_up']))

                                                <form
                                                    action="{{ route('admin.deliveries.release', $delivery) }}"
                                                    method="POST"
                                                    class="inline"
                                                    onsubmit="return confirm('Are you sure you want to release this delivery for another volunteer?');"
                                                >
                                                    @csrf
                                                    @method('PUT')

                                                    <button
                                                        type="submit"
                                                        class="inline-flex items-center bg-orange-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-orange-700 transition"
                                                    >
                                                        Release
                                                    </button>

                                                </form>

                                            @endif

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6" class="px-6 py-16 text-center">

                                        <div class="flex flex-col items-center">

                                            <div class="w-14 h-14 bg-gray-100 rounded-full flex items-center justify-center mb-4">

                                                <svg
                                                    class="w-7 h-7 text-gray-400"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 17v-2a4 4 0 014-4h4m0 0V7m0 4l-3-3m3 3l3-3M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2h-3.5l-2-2h-5l-2 2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                                    />
                                                </svg>

                                            </div>

                                            <h4 class="text-lg font-semibold text-gray-700">
                                                No deliveries found
                                            </h4>

                                            <p class="text-sm text-gray-500 mt-1">
                                                Delivery records will appear here when they are created.
                                            </p>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- Pagination --}}
                @if ($deliveries->hasPages())

                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $deliveries->links() }}
                    </div>

                @endif

            </div>

        </div>
    </div>
</x-app-layout>
