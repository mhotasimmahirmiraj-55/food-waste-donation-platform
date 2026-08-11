<x-app-layout>
    <x-slot name="header">
        <h2>Edit User</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">

                <h3 class="text-xl font-bold mb-4">
                    Edit User
                </h3>

                <form action="{{ route('admin.users.update', $user) }}" method="POST">

                    @csrf
                    @method('PUT')
                    <div class="mb-4">

                        <label class="block font-medium text-sm text-gray-700">
                            Name
                        </label>

                        <input
                            type="text"
                            value="{{ $user->name }}"
                            disabled
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                        >

                    </div>
                    <div class="mb-4">

                        <label class="block font-medium text-sm text-gray-700">
                            Email
                        </label>

                        <input
                            type="email"
                            value="{{ $user->email }}"
                            disabled
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                        >

                    </div>
                    
                    <div class="mb-4">

                        <label for="role_id"
                            class="block font-medium text-sm text-gray-700"
                        >
                            Role
                        </label>
    
                        <select 
                            id="role_id"
                            name="role_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                        >

                            @foreach ($roles as $role)

                                <option
                                    value="{{ $role->id }}"
                                    @selected($user->role_id == $role->id)
                                >
                                    {{ $role->name }}
                                </option>

                            @endforeach

                        </select>
                        
                    </div>

                    <div class="mt-6">
                        <button
                            type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700"
                        >
                            Save Changes
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>