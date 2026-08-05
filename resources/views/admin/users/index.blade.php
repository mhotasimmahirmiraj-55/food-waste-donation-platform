<x-app-layout>
    <x-slot name="header">
        <h2>User Management</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">

                <h3 class="text-xl font-bold">
                    User Management
                </h3>

                <div class="overflow-x-auto mt-6">

                    <table class="min-w-full border border-gray-300">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="border px-4 py-2">ID</th>

                                <th class="border px-4 py-2">Name</th>

                                <th class="border px-4 py-2">Email</th>

                                <th class="border px-4 py-2">Role</th>

                                <th class="border px-4 py-2">Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($users as $user)

                                <tr>

                                    <td class="border px-4 py-2">
                                        {{ $user->id }}
                                    </td>

                                    <td class="border px-4 py-2">
                                        {{ $user->name }}
                                    </td>

                                    <td class="border px-4 py-2">
                                        {{ $user->email }}
                                    </td>

                                    <td class="border px-4 py-2">
                                        {{ $user->role->name }}
                                    </td>

                                    <td class="border px-4 py-2">
                                        Edit
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>