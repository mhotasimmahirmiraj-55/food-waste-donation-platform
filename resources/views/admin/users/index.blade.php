<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                    User Management
                </h2>

                <p class="mt-1 text-sm text-emerald-800">
                    Manage platform users, roles and account access
                </p>

            </div>

        </div>

    </x-slot>


    {{-- ================================================= --}}
    {{-- MAIN PAGE --}}
    {{-- Darker emerald/green background theme --}}
    {{-- ================================================= --}}

    <div class="min-h-screen bg-gradient-to-br from-emerald-100 via-white to-green-100">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


            {{-- ================================================= --}}
            {{-- PAGE HEADER --}}
            {{-- ================================================= --}}

            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6">

                <div>

                    @if (request('role') === 'Admin')

                        <h1 class="text-2xl font-bold text-gray-900">
                            Administrators
                        </h1>

                        <p class="mt-1 text-sm text-emerald-800">
                            Showing users with the Administrator role.
                        </p>

                    @elseif (request('role') === 'Donor')

                        <h1 class="text-2xl font-bold text-gray-900">
                            Donors
                        </h1>

                        <p class="mt-1 text-sm text-emerald-800">
                            Showing users registered as donors.
                        </p>

                    @elseif (request('role') === 'Receiver')

                        <h1 class="text-2xl font-bold text-gray-900">
                            Receivers
                        </h1>

                        <p class="mt-1 text-sm text-emerald-800">
                            Showing users registered as receivers.
                        </p>

                    @elseif (request('role') === 'Volunteer')

                        <h1 class="text-2xl font-bold text-gray-900">
                            Volunteers
                        </h1>

                        <p class="mt-1 text-sm text-emerald-800">
                            Showing users registered as volunteers.
                        </p>

                    @elseif (request('status') === 'blocked')

                        <h1 class="text-2xl font-bold text-gray-900">
                            Blocked Users
                        </h1>

                        <p class="mt-1 text-sm text-red-600">
                            Showing users whose accounts are currently blocked.
                        </p>

                    @else

                        <h1 class="text-2xl font-bold text-gray-900">
                            All Users
                        </h1>

                        <p class="mt-1 text-sm text-gray-600">
                            View and manage all registered users.
                        </p>

                    @endif

                </div>


                {{-- Clear Filter --}}

                @if (request('role') || request('status'))

                    <a
                        href="{{ route('admin.users') }}"
                        class="inline-flex items-center justify-center gap-2
                               px-4 py-2.5
                               rounded-xl
                               bg-white
                               border border-emerald-200
                               text-sm font-semibold
                               text-emerald-800
                               hover:bg-emerald-100
                               hover:border-emerald-300
                               transition
                               shadow-sm"
                    >

                        <svg
                            class="w-4 h-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M6 6l12 12M6 18L18 6"
                            />

                        </svg>

                        Clear Filter

                    </a>

                @endif

            </div>



            {{-- ================================================= --}}
            {{-- SUCCESS MESSAGE --}}
            {{-- ================================================= --}}

            @if (session('success'))

                <div
                    class="mb-6 flex items-start gap-3
                           rounded-xl
                           bg-emerald-100
                           border border-emerald-200
                           text-emerald-900
                           px-4 py-3
                           shadow-sm"
                >

                    <svg
                        class="w-5 h-5 mt-0.5 flex-shrink-0 text-emerald-700"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M5 13l4 4L19 7"
                        />

                    </svg>

                    <span class="text-sm font-medium">
                        {{ session('success') }}
                    </span>

                </div>

            @endif



            {{-- ================================================= --}}
            {{-- ERROR MESSAGE --}}
            {{-- ================================================= --}}

            @if (session('error'))

                <div
                    class="mb-6 flex items-start gap-3
                           rounded-xl
                           bg-red-50
                           border border-red-200
                           text-red-800
                           px-4 py-3
                           shadow-sm"
                >

                    <svg
                        class="w-5 h-5 mt-0.5 flex-shrink-0 text-red-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 9v4m0 4h.01M5.07 19h13.86a2 2 0 001.73-3L13.73 4a2 2 0 00-3.46 0L3.34 16a2 2 0 001.73 3z"
                        />

                    </svg>

                    <span class="text-sm font-medium">
                        {{ session('error') }}
                    </span>

                </div>

            @endif



            {{-- ================================================= --}}
            {{-- USER TABLE CARD --}}
            {{-- ================================================= --}}

            <div
                class="bg-white
                       rounded-2xl
                       border border-emerald-200
                       shadow-sm
                       overflow-hidden"
            >


                {{-- ================================================= --}}
                {{-- TABLE HEADER --}}
                {{-- ================================================= --}}

                <div
                    class="px-6 py-5
                           border-b border-emerald-200
                           bg-gradient-to-r
                           from-emerald-100
                           via-white
                           to-green-100"
                >

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                        <div>

                            <h3 class="text-lg font-bold text-gray-900">
                                User Accounts
                            </h3>

                            <p class="mt-1 text-sm text-gray-600">

                                @if (request('role') === 'Admin')

                                    {{ $users->total() }}
                                    administrator{{ $users->total() == 1 ? '' : 's' }}
                                    found.

                                @elseif (request('role') === 'Donor')

                                    {{ $users->total() }}
                                    donor{{ $users->total() == 1 ? '' : 's' }}
                                    found.

                                @elseif (request('role') === 'Receiver')

                                    {{ $users->total() }}
                                    receiver{{ $users->total() == 1 ? '' : 's' }}
                                    found.

                                @elseif (request('role') === 'Volunteer')

                                    {{ $users->total() }}
                                    volunteer{{ $users->total() == 1 ? '' : 's' }}
                                    found.

                                @elseif (request('status') === 'blocked')

                                    {{ $users->total() }}
                                    blocked user{{ $users->total() == 1 ? '' : 's' }}
                                    found.

                                @else

                                    {{ $users->total() }}
                                    user{{ $users->total() == 1 ? '' : 's' }}
                                    registered.

                                @endif

                            </p>

                        </div>


                        {{-- Active Filter --}}

                        @if (request('role') || request('status'))

                            <div
                                class="inline-flex items-center gap-2
                                       px-3 py-1.5
                                       rounded-full
                                       bg-emerald-200
                                       text-emerald-900
                                       text-xs font-semibold"
                            >

                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>

                                Filter active

                            </div>

                        @endif

                    </div>

                </div>



                {{-- ================================================= --}}
                {{-- TABLE --}}
                {{-- ================================================= --}}

                <div class="overflow-x-auto">

                    <table class="min-w-full">


                        {{-- ================================================= --}}
                        {{-- TABLE HEADER --}}
                        {{-- ================================================= --}}

                        <thead class="bg-emerald-100 border-b border-emerald-200">

                            <tr>

                                <th
                                    class="px-6 py-4
                                           text-left
                                           text-xs
                                           font-semibold
                                           uppercase
                                           tracking-wider
                                           text-emerald-900"
                                >
                                    ID
                                </th>


                                <th
                                    class="px-6 py-4
                                           text-left
                                           text-xs
                                           font-semibold
                                           uppercase
                                           tracking-wider
                                           text-emerald-900"
                                >
                                    User
                                </th>


                                <th
                                    class="px-6 py-4
                                           text-left
                                           text-xs
                                           font-semibold
                                           uppercase
                                           tracking-wider
                                           text-emerald-900"
                                >
                                    Email
                                </th>


                                <th
                                    class="px-6 py-4
                                           text-left
                                           text-xs
                                           font-semibold
                                           uppercase
                                           tracking-wider
                                           text-emerald-900"
                                >
                                    Role
                                </th>


                                <th
                                    class="px-6 py-4
                                           text-center
                                           text-xs
                                           font-semibold
                                           uppercase
                                           tracking-wider
                                           text-emerald-900"
                                >
                                    Status
                                </th>


                                <th
                                    class="px-6 py-4
                                           text-right
                                           text-xs
                                           font-semibold
                                           uppercase
                                           tracking-wider
                                           text-emerald-900"
                                >
                                    Actions
                                </th>

                            </tr>

                        </thead>



                        {{-- ================================================= --}}
                        {{-- TABLE BODY --}}
                        {{-- ================================================= --}}

                        <tbody class="divide-y divide-emerald-100">

                            @forelse ($users as $user)

                                <tr class="hover:bg-emerald-100/70 transition">


                                    {{-- ================================================= --}}
                                    {{-- ID --}}
                                    {{-- ================================================= --}}

                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <span class="text-sm font-medium text-emerald-800">
                                            #{{ $user->id }}
                                        </span>

                                    </td>



                                    {{-- ================================================= --}}
                                    {{-- USER --}}
                                    {{-- ================================================= --}}

                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <div class="flex items-center gap-3">

                                            <div
                                                class="w-10 h-10 rounded-xl
                                                       bg-emerald-100
                                                       text-emerald-800
                                                       border border-emerald-200
                                                       flex items-center justify-center
                                                       font-bold text-sm"
                                            >

                                                {{ strtoupper(substr($user->name, 0, 1)) }}

                                            </div>


                                            <div>

                                                <p class="text-sm font-semibold text-gray-900">
                                                    {{ $user->name }}
                                                </p>

                                                <p class="text-xs text-gray-400">
                                                    User #{{ $user->id }}
                                                </p>

                                            </div>

                                        </div>

                                    </td>



                                    {{-- ================================================= --}}
                                    {{-- EMAIL --}}
                                    {{-- ================================================= --}}

                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <span class="text-sm text-gray-600">
                                            {{ $user->email }}
                                        </span>

                                    </td>



                                    {{-- ================================================= --}}
                                    {{-- ROLE --}}
                                    {{-- ================================================= --}}

                                    <td class="px-6 py-4 whitespace-nowrap">

                                        @if ($user->role)

                                            @php

                                                $roleName = strtolower($user->role->name);

                                                $roleClasses = match ($roleName) {

                                                    'admin' =>
                                                        'bg-slate-100 text-slate-700',

                                                    'donor' =>
                                                        'bg-emerald-100 text-emerald-800 border border-emerald-200',

                                                    'receiver' =>
                                                        'bg-blue-50 text-blue-700',

                                                    'volunteer' =>
                                                        'bg-amber-50 text-amber-700',

                                                    default =>
                                                        'bg-gray-100 text-gray-700',

                                                };

                                            @endphp


                                            <span
                                                class="inline-flex items-center
                                                       px-2.5 py-1
                                                       rounded-full
                                                       text-xs font-semibold
                                                       {{ $roleClasses }}"
                                            >

                                                {{ $user->role->name }}

                                            </span>

                                        @else

                                            <span class="text-sm text-gray-400">
                                                No role
                                            </span>

                                        @endif

                                    </td>



                                    {{-- ================================================= --}}
                                    {{-- STATUS --}}
                                    {{-- ================================================= --}}

                                    <td class="px-6 py-4 text-center whitespace-nowrap">

                                        @if ($user->status === 'active')

                                            <span
                                                class="inline-flex items-center gap-1.5
                                                       px-2.5 py-1
                                                       rounded-full
                                                       bg-emerald-100
                                                       text-emerald-800
                                                       border border-emerald-200
                                                       text-xs font-semibold"
                                            >

                                                <span
                                                    class="w-1.5 h-1.5
                                                           rounded-full
                                                           bg-emerald-600"
                                                ></span>

                                                Active

                                            </span>

                                        @else

                                            <span
                                                class="inline-flex items-center gap-1.5
                                                       px-2.5 py-1
                                                       rounded-full
                                                       bg-red-50
                                                       text-red-700
                                                       border border-red-100
                                                       text-xs font-semibold"
                                            >

                                                <span
                                                    class="w-1.5 h-1.5
                                                           rounded-full
                                                           bg-red-500"
                                                ></span>

                                                Blocked

                                            </span>

                                        @endif

                                    </td>



                                    {{-- ================================================= --}}
                                    {{-- ACTIONS --}}
                                    {{-- ================================================= --}}

                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <div class="flex items-center justify-end gap-2">


                                            {{-- ================================================= --}}
                                            {{-- EDIT --}}
                                            {{-- ================================================= --}}

                                            <a
                                                href="{{ route('admin.users.edit', $user) }}"
                                                class="inline-flex items-center gap-1.5
                                                       px-3 py-2
                                                       rounded-lg
                                                       bg-emerald-100
                                                       text-emerald-800
                                                       border border-emerald-200
                                                       hover:bg-emerald-200
                                                       text-xs font-semibold
                                                       transition"
                                            >

                                                <svg
                                                    class="w-4 h-4"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="1.8"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"
                                                    />

                                                </svg>

                                                Edit

                                            </a>



                                            {{-- ================================================= --}}
                                            {{-- BLOCK / UNBLOCK --}}
                                            {{-- ================================================= --}}

                                            <form
                                                action="{{ route('admin.users.toggle-status', $user) }}"
                                                method="POST"
                                                class="inline"
                                            >

                                                @csrf

                                                @method('PUT')


                                                @if ($user->status === 'active')

                                                    <button
                                                        type="submit"
                                                        class="inline-flex items-center gap-1.5
                                                               px-3 py-2
                                                               rounded-lg
                                                               bg-red-50
                                                               text-red-700
                                                               border border-red-100
                                                               hover:bg-red-100
                                                               text-xs font-semibold
                                                               transition"
                                                        onclick="return confirm('Are you sure you want to block this user?')"
                                                    >

                                                        <svg
                                                            class="w-4 h-4"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            viewBox="0 0 24 24"
                                                        >

                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                stroke-width="1.8"
                                                                d="M6 6l12 12M6 18L18 6M12 3a9 9 0 100 18 9 9 0 000-18z"
                                                            />

                                                        </svg>

                                                        Block

                                                    </button>

                                                @else

                                                    <button
                                                        type="submit"
                                                        class="inline-flex items-center gap-1.5
                                                               px-3 py-2
                                                               rounded-lg
                                                               bg-emerald-100
                                                               text-emerald-800
                                                               border border-emerald-200
                                                               hover:bg-emerald-200
                                                               text-xs font-semibold
                                                               transition"
                                                        onclick="return confirm('Are you sure you want to unblock this user?')"
                                                    >

                                                        <svg
                                                            class="w-4 h-4"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            viewBox="0 0 24 24"
                                                        >

                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                stroke-width="1.8"
                                                                d="M5 13l4 4L19 7"
                                                            />

                                                        </svg>

                                                        Unblock

                                                    </button>

                                                @endif

                                            </form>

                                        </div>

                                    </td>

                                </tr>


                            @empty

                                {{-- ================================================= --}}
                                {{-- NO USERS --}}
                                {{-- ================================================= --}}

                                <tr>

                                    <td
                                        colspan="6"
                                        class="px-6 py-16 text-center"
                                    >

                                        <div class="flex flex-col items-center">


                                            <div
                                                class="w-14 h-14 rounded-2xl
                                                       bg-emerald-100
                                                       text-emerald-700
                                                       border border-emerald-200
                                                       flex items-center justify-center"
                                            >

                                                <svg
                                                    class="w-7 h-7"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="1.8"
                                                        d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 100-8 4 4 0 000 8z"
                                                    />

                                                </svg>

                                            </div>


                                            <h4 class="mt-4 text-sm font-bold text-gray-900">
                                                No users found
                                            </h4>


                                            <p class="mt-1 text-sm text-gray-500">
                                                No users match the current filter.
                                            </p>


                                            @if (request('role') || request('status'))

                                                <a
                                                    href="{{ route('admin.users') }}"
                                                    class="mt-4 text-sm font-semibold text-emerald-700 hover:text-emerald-900"
                                                >
                                                    Clear filter
                                                </a>

                                            @endif

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>



                {{-- ================================================= --}}
                {{-- PAGINATION --}}
                {{-- ================================================= --}}

                @if ($users->hasPages())

                    <div
                        class="px-6 py-4
                               border-t border-emerald-200
                               bg-emerald-100/50"
                    >

                        {{ $users->withQueryString()->links() }}

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>