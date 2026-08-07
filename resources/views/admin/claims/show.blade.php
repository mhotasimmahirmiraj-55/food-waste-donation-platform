<x-app-layout>
    <x-slot name="header">
        <h2>Claim Details</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">

                <h3 class="text-2xl font-bold mb-6">
                    Claim Details
                </h3>

                <table class="w-full">

                    <tr class="border-b">
                        <td class="py-3 font-semibold w-1/3">
                            Donation
                        </td>

                        <td class="py-3">
                            {{ $claim->foodDonation->title }}
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="py-3 font-semibold">
                            Receiver
                        </td>

                        <td class="py-3">
                            {{ $claim->receiver->name }}
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="py-3 font-semibold">
                            Status
                        </td>

                        <td class="py-3">
                            {{ ucfirst($claim->status) }}
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="py-3 font-semibold">
                            Created At
                        </td>

                        <td class="py-3">
                            {{ $claim->created_at ? $claim->created_at->format('d M Y h:i A') : 'N/A' }}
                        </td>
                    </tr>

                </table>

                <div class="mt-6">

                    <a href="{{ route('admin.claims') }}"
                        class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                        Back to Claims
                    </a>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>