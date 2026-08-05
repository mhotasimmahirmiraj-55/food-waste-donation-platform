@php
    use Carbon\Carbon;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2>Donation Details</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">

                <h3 class="text-2xl font-bold mb-6">
                    Donation Details
                </h3>

                <table class="min-w-full">

                    <tbody>

                        <tr>
                            <td class="font-semibold py-2 w-48">
                                Title
                            </td>

                            <td>
                                {{ $donation->title }}
                            </td>
                        </tr>

                        <tr>
                            <td class="font-semibold py-2">
                                Donor
                            </td>

                            <td>
                                {{ $donation->donor->name }}
                            </td>
                        </tr>

                        <tr>
                            <td class="font-semibold py-2">
                                Category
                            </td>

                            <td>
                                {{ $donation->category->name }}
                            </td>
                        </tr>

                        <tr>
                            <td class="font-semibold py-2">
                                Quantity
                            </td>

                            <td>
                                {{ $donation->quantity }}
                            </td>
                        </tr>

                        <tr>
                            <td class="font-semibold py-2">
                                Status
                            </td>

                            <td>
                                {{ ucfirst($donation->status) }}
                            </td>
                        </tr>

                        <tr>
                            <td class="font-semibold py-2">
                                Pickup Address
                            </td>

                            <td>
                                {{ $donation->pickup_address }}
                            </td>
                        </tr>

                        <tr>
                            <td class="font-semibold py-2">
                                Pickup Date
                            </td>

                            <td>
                                {{ $donation->pickup_date
                                    ? Carbon::parse($donation->pickup_date)->format('d M Y')
                                    : '-' }}
                            </td>
                        </tr>

                        <tr>
                            <td class="font-semibold py-2">
                                Pickup Time
                            </td>

                            <td>
                                {{ $donation->pickup_time
                                    ? Carbon::parse($donation->pickup_time)->format('g:i A')
                                    : '-' }}
                            </td>
                        </tr>

                        <tr>
                            <td class="font-semibold py-2">
                                Expiry Time
                            </td>

                            <td>
                                {{ Carbon::parse($donation->expiry_time)->format('d M Y, g:i A') }}
                            </td>
                        </tr>

                        <tr class="align-top">
                            <td class="font-semibold py-2">
                                Description
                            </td>

                            <td>
                                {{ $donation->description }}
                            </td>
                        </tr>

                    </tbody>

                </table>

                <div class="mt-8">

                    <a href="{{ route('admin.donations') }}"
                        class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                        Back to Donations
                    </a>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>