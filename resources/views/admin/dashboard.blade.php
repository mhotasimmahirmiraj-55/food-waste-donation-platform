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

                    <div class="bg-red-200 rounded-lg shadow p-6">

                        <h4 class="text-gray-600 text-sm">
                            Blocked Users
                        </h4>

                        <p class="text-3xl font-bold mt-2">
                            {{ $blockedUsers }}
                        </p>

                    </div>

                    <div class="bg-purple-100 rounded-lg shadow p-6">

                        <h4 class="text-gray-600 text-sm">
                            Food Categories
                        </h4>

                        <p class="text-3xl font-bold mt-2">
                            {{ $totalCategories }}
                        </p>

                    </div>

                    <div class="bg-indigo-100 rounded-lg shadow p-6">

                        <h4 class="text-gray-600 text-sm">
                            Total Claims
                        </h4>

                        <p class="text-3xl font-bold mt-2">
                            {{ $totalClaims }}
                        </p>

                    </div>

                    <div class="bg-pink-100 rounded-lg shadow p-6">

                        <h4 class="text-gray-600 text-sm">
                            Total Reports
                        </h4>

                        <p class="text-3xl font-bold mt-2">
                            {{ $totalReports }}
                        </p>

                    </div>

                </div>

                <div class="mt-8">

                    <a href="{{ route('admin.users') }}"
                        class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        Manage Users
                    </a>

                    <a href="{{ route('admin.donations') }}"
                        class="inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 ml-2">
                        Manage Donations
                    </a>

                    <a href="{{ route('admin.categories') }}"
                        class="inline-block bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 ml-2">
                        Food Categories
                    </a>

                    <a href="{{ route('admin.reports') }}"
                        class="inline-block bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 ml-2">
                        Manage Reports
                    </a>

                    <a href="{{ route('admin.claims') }}"
                        class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 ml-2">
                        Manage Claims
                    </a>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>