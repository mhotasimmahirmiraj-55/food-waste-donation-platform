<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Delivery Operations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 flex space-x-4">
                <a href="{{ route('volunteer.deliveries.index') }}" class="px-4 py-2 rounded-md {{ !request('tab') ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700' }}">Available Deliveries</a>
                <a href="{{ route('volunteer.deliveries.index', ['tab' => 'my_deliveries']) }}" class="px-4 py-2 rounded-md {{ request('tab') == 'my_deliveries' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700' }}">My Deliveries</a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Food Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($deliveries as $delivery)
                            <tr>
                                <td class="px-6 py-4">{{ $delivery->foodDonation->title ?? 'N/A' }}</td>
                                <td class="px-6 py-4"><span class="px-2 py-1 text-xs rounded bg-gray-100">{{ ucfirst($delivery->status) }}</span></td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('volunteer.deliveries.show', $delivery->id) }}" class="text-indigo-600 hover:text-indigo-900">View Details</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500">No deliveries found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>