<x-app-layout>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">

                {{-- Header --}}
                <div class="px-6 py-5 border-b border-gray-200">

                    <h3 class="text-xl font-bold text-gray-800">
                        Delivery Details
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        View delivery information and current progress.
                    </p>

                </div>


                {{-- Delivery Information --}}
                <div class="p-6">

                    <div class="overflow-x-auto">

                        <table class="min-w-full border border-gray-200">

                            <tbody>

                                <tr>
                                    <th class="bg-gray-50 border px-4 py-3 text-left w-1/3">
                                        Delivery ID
                                    </th>

                                    <td class="border px-4 py-3">
                                        #{{ $delivery->id }}
                                    </td>
                                </tr>


                                <tr>
                                    <th class="bg-gray-50 border px-4 py-3 text-left">
                                        Donation
                                    </th>

                                    <td class="border px-4 py-3">
                                        {{ $delivery->claim->foodDonation->title ?? 'N/A' }}
                                    </td>
                                </tr>


                                <tr>
                                    <th class="bg-gray-50 border px-4 py-3 text-left">
                                        Receiver
                                    </th>

                                    <td class="border px-4 py-3">
                                        {{ $delivery->claim->receiver->name ?? 'N/A' }}
                                    </td>
                                </tr>


                                <tr>
                                    <th class="bg-gray-50 border px-4 py-3 text-left">
                                        Volunteer
                                    </th>

                                    <td class="border px-4 py-3">

                                        @if ($delivery->volunteer)

                                            {{ $delivery->volunteer->name }}

                                        @else

                                            <span class="text-gray-400">
                                                Not assigned
                                            </span>

                                        @endif

                                    </td>
                                </tr>


                                <tr>
                                    <th class="bg-gray-50 border px-4 py-3 text-left">
                                        Status
                                    </th>

                                    <td class="border px-4 py-3">

                                        @if ($delivery->status === 'pending')

                                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">
                                                Pending
                                            </span>

                                        @elseif ($delivery->status === 'accepted')

                                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">
                                                Accepted
                                            </span>

                                        @elseif ($delivery->status === 'picked_up')

                                            <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-semibold">
                                                Picked Up
                                            </span>

                                        @elseif ($delivery->status === 'delivered')

                                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                                Delivered
                                            </span>

                                        @else

                                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-semibold">
                                                {{ ucfirst($delivery->status) }}
                                            </span>

                                        @endif

                                    </td>
                                </tr>


                                <tr>
                                    <th class="bg-gray-50 border px-4 py-3 text-left">
                                        Accepted At
                                    </th>

                                    <td class="border px-4 py-3">
                                        {{ $delivery->accepted_at ?? 'Not yet accepted' }}
                                    </td>
                                </tr>


                                <tr>
                                    <th class="bg-gray-50 border px-4 py-3 text-left">
                                        Picked Up At
                                    </th>

                                    <td class="border px-4 py-3">
                                        {{ $delivery->picked_up_at ?? 'Not yet picked up' }}
                                    </td>
                                </tr>


                                <tr>
                                    <th class="bg-gray-50 border px-4 py-3 text-left">
                                        Delivered At
                                    </th>

                                    <td class="border px-4 py-3">
                                        {{ $delivery->delivered_at ?? 'Not yet delivered' }}
                                    </td>
                                </tr>

                            </tbody>

                        </table>

                    </div>


                    {{-- Navigation --}}
                    <div class="mt-6">

                        <a
                            href="{{ route('admin.deliveries') }}"
                            class="inline-block bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700"
                        >
                            Back to Deliveries
                        </a>

                    </div>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>