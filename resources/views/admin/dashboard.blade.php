<x-app-layout>
    <x-slot name="header">
        <h2>Admin Dashboard</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                <h3 class="text-xl font-bold mb-4">
                    Welcome Admin!
                </h3>
                
                <div class="grid grid-cols-2 md:grid-cols-3 gap-6">

                    <div class="bg-blue-100 rounded-lg shadow p-6">

                        <h4 class="text-gray-600 text-sm">
                            Total Users
                        </h4>

                        <p class="text-3xl font-bold mt-2">
                            {{ $totalUsers }}
                        </p>
                    </div>

                    <div class="bg-green-100 rounded-lg shadow p-6">

                        <h4 class="text-gray-600 text-sm">
                            Total Donations
                        </h4>

                        <p class="text-3xl font-bold mt-2">
                            {{ $totalDonations }}
                        </p>
                    </div>
                    
                    <div class="bg-yellow-100 rounded-lg shadow p-6">

                        <h4 class="text-gray-600 text-sm">
                            Total Admins
                        </h4>

                        <p class="text-3xl font-bold mt-2">
                            {{ $totalAdmins }}
                        </p>
                    </div>

                    <div class="bg-emerald-200 rounded-lg shadow p-6">

                        <h4 class="text-gray-600 text-sm">
                            Total Donors
                        </h4>

                        <p class="text-3xl font-bold mt-2">
                            {{ $totalDonors }}
                        </p>
                    </div>

                    <div class="bg-teal-200 rounded-lg shadow p-6">

                        <h4 class="text-gray-600 text-sm">
                            Total Receivers
                        </h4>

                        <p class="text-3xl font-bold mt-2">
                            {{ $totalReceivers }}
                        </p>
                    </div>

                    <div class="bg-red-100 rounded-lg shadow p-6">

                        <h4 class="text-gray-600 text-sm">
                            Total Volunteers
                        </h4>

                        <p class="text-3xl font-bold mt-2">
                            {{ $totalVolunteers }}
                        </p>
                    </div>

                </div>

                <div class="mt-8">
                    <a href="{{ route('admin.users') }}"
                    class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        Manage Users
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>