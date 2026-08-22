<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Volunteer Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
                    <div class="text-gray-500 text-sm">Available Requests</div>
                    <div class="text-3xl font-bold mt-2">{{ $availableDeliveries }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-yellow-500">
                    <div class="text-gray-500 text-sm">My Active Deliveries</div>
                    <div class="text-3xl font-bold mt-2">{{ $myActiveDeliveries }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500">
                    <div class="text-gray-500 text-sm">Completed Deliveries</div>
                    <div class="text-3xl font-bold mt-2">{{ $completedDeliveries }}</div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm">
                <a href="{{ route('volunteer.deliveries.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                    View & Manage Deliveries
                </a>
            </div>
        </div>
    </div>
</x-app-layout>