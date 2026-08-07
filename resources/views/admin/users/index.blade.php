<x-app-layout>
    <x-slot name="header">
        <h2>User Management</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">

                <h3 class="text-xl font-bold mb-4">
                    User Management
                </h3>

                @if (session('success'))

                    <div class="mb-4 rounded-lg bg-green-100 border border-green-400 text-green-700 px-4 py-3">
                        {{ session('success') }}
                    </div>

                @endif

                @if (session('error'))

                    <div class="mb-4 rounded-lg bg-red-100 border border-red-400 text-red-700 px-4 py-3">
                        {{ session('error') }}
                    </div>

                @endif

                <div class="overflow-x-auto mt-6">

                    <table class="min-w-full border border-gray-300">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="border px-4 py-2">ID</th>

                                <th class="border px-4 py-2">Name</th>

                                <th class="border px-4 py-2">Email</th>

                                <th class="border px-4 py-2">Role</th>

                                <th class="border px-4 py-2">Status</th>

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

                                    <td class="border px-4 py-2 text-center">

                                        @if ($user->status == 'active')

                                            <span class="text-green-600 font-semibold">
                                                Active
                                            </span>

                                        @else

                                            <span class="text-red-600 font-semibold">
                                                Blocked
                                            </span>

                                        @endif

                                    </td>

                                    <td class="border px-4 py-2">

                                        <a
                                            href="{{ route('admin.users.edit', $user) }}"
                                            class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('admin.users.toggle-status', $user) }}"
                                            method="POST"
                                            class="inline"
                                        >
                                            @csrf
                                            @method('PUT')

                                            <button
                                                type="submit"
                                                class="{{ $user->status == 'active'
                                                    ? 'bg-red-600 hover:bg-red-700'
                                                    : 'bg-green-600 hover:bg-green-700' }}
                                                    text-white px-3 py-1 rounded ml-2"
                                            >
                                                {{ $user->status == 'active' ? 'Block' : 'Unblock' }}
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>