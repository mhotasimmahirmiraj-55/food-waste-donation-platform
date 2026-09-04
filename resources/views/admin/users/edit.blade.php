<x-app-layout>

    {{-- ============================================================= --}}
    {{-- PAGE HEADER --}}
    {{-- ============================================================= --}}

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-xs font-semibold uppercase tracking-wider text-emerald-600">
                    Administration
                </p>

                <h2 class="mt-1 text-2xl font-bold tracking-tight text-gray-900">
                    Edit User
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Update user role and account information
                </p>

            </div>

        </div>

    </x-slot>


    {{-- ============================================================= --}}
    {{-- MAIN ADMIN BACKGROUND --}}
    {{-- ============================================================= --}}
    {{--

        This gradient is the main visual accent of the Admin module.

        Instead of a plain gray background, the page uses:

            emerald → white → green

        This should be reused throughout the Admin module so
        Dashboard, Users, Donations, Claims, Reports, etc.
        all feel like one system.

    --}}

    <div class="min-h-screen bg-gradient-to-br from-emerald-50 via-white to-green-50">


        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


            {{-- ================================================= --}}
            {{-- BACK TO USERS --}}
            {{-- ================================================= --}}

            <div class="mb-6">

                <a
                    href="{{ route('admin.users') }}"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-emerald-700 hover:text-emerald-800 transition"
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
                            d="M15 19l-7-7 7-7"
                        />

                    </svg>

                    Back to Users

                </a>

            </div>



            {{-- ================================================= --}}
            {{-- SUCCESS MESSAGE --}}
            {{-- ================================================= --}}

            @if (session('success'))

                <div
                    class="mb-6 flex items-start gap-3 rounded-2xl
                           bg-emerald-50 border border-emerald-200
                           text-emerald-800 px-5 py-4 shadow-sm"
                >

                    <div
                        class="w-9 h-9 rounded-xl bg-emerald-100
                               text-emerald-600 flex items-center justify-center
                               flex-shrink-0"
                    >

                        <svg
                            class="w-5 h-5"
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

                    </div>

                    <div>

                        <p class="text-sm font-bold">
                            Success
                        </p>

                        <p class="text-sm mt-0.5">
                            {{ session('success') }}
                        </p>

                    </div>

                </div>

            @endif



            {{-- ================================================= --}}
            {{-- VALIDATION ERRORS --}}
            {{-- ================================================= --}}

            @if ($errors->any())

                <div
                    class="mb-6 rounded-2xl
                           bg-red-50 border border-red-200
                           text-red-800 px-5 py-4 shadow-sm"
                >

                    <div class="flex items-start gap-3">

                        <div
                            class="w-9 h-9 rounded-xl bg-red-100
                                   text-red-600 flex items-center justify-center
                                   flex-shrink-0"
                        >

                            <svg
                                class="w-5 h-5"
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

                        </div>


                        <div>

                            <p class="text-sm font-bold">
                                Please check the following:
                            </p>

                            <ul class="mt-2 list-disc list-inside text-sm space-y-1">

                                @foreach ($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>

            @endif



            {{-- ================================================= --}}
            {{-- MAIN USER CARD --}}
            {{-- ================================================= --}}

            <div
                class="bg-white rounded-2xl
                       border border-emerald-100
                       shadow-sm overflow-hidden"
            >


                {{-- ================================================= --}}
                {{-- CARD HEADER --}}
                {{-- ================================================= --}}

                <div
                    class="relative overflow-hidden
                           px-6 sm:px-8 py-7
                           border-b border-emerald-100"
                >

                    {{-- Decorative green background --}}

                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-50 via-white to-green-50"></div>


                    {{-- Decorative circles --}}

                    <div
                        class="absolute -top-16 -right-16
                               w-48 h-48 rounded-full
                               bg-emerald-100 opacity-40"
                    ></div>

                    <div
                        class="absolute -bottom-20 -left-16
                               w-40 h-40 rounded-full
                               bg-green-100 opacity-30"
                    ></div>


                    {{-- Actual header content --}}

                    <div class="relative flex items-center gap-4">


                        {{-- User Avatar --}}

                        <div
                            class="w-16 h-16 rounded-2xl
                                   bg-emerald-100
                                   text-emerald-700
                                   flex items-center justify-center
                                   font-bold text-2xl
                                   border border-emerald-200"
                        >

                            {{ strtoupper(substr($user->name, 0, 1)) }}

                        </div>


                        <div>

                            <p class="text-xs font-semibold uppercase tracking-wider text-emerald-600">
                                User Management
                            </p>

                            <h3 class="mt-1 text-xl sm:text-2xl font-bold text-gray-900">
                                {{ $user->name }}
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                User ID: #{{ $user->id }}
                            </p>

                        </div>

                    </div>

                </div>



                {{-- ================================================= --}}
                {{-- FORM --}}
                {{-- ================================================= --}}

                <form
                    action="{{ route('admin.users.update', $user) }}"
                    method="POST"
                >

                    @csrf

                    {{--

                        HTML forms normally submit GET or POST.

                        Laravel uses:

                            @method('PUT')

                        to tell Laravel that this POST request
                        should be treated as a PUT request.

                        Route:
                            admin.users.update

                        Controller:
                            AdminUserController@update

                    --}}

                    @method('PUT')


                    <div class="px-6 sm:px-8 py-8 space-y-7">


                        {{-- ================================================= --}}
                        {{-- NAME --}}
                        {{-- ================================================= --}}

                        <div>

                            <label
                                for="name"
                                class="block text-sm font-semibold text-gray-700"
                            >
                                Full Name
                            </label>


                            <input
                                id="name"
                                type="text"
                                value="{{ $user->name }}"
                                disabled
                                class="mt-2 block w-full rounded-xl
                                       border-gray-200
                                       bg-gray-50
                                       text-gray-500
                                       shadow-sm
                                       cursor-not-allowed"
                            >


                            <p class="mt-2 text-xs text-gray-400">
                                Name is displayed for reference and cannot be changed here.
                            </p>

                        </div>



                        {{-- ================================================= --}}
                        {{-- EMAIL --}}
                        {{-- ================================================= --}}

                        <div>

                            <label
                                for="email"
                                class="block text-sm font-semibold text-gray-700"
                            >
                                Email Address
                            </label>


                            <input
                                id="email"
                                type="email"
                                value="{{ $user->email }}"
                                disabled
                                class="mt-2 block w-full rounded-xl
                                       border-gray-200
                                       bg-gray-50
                                       text-gray-500
                                       shadow-sm
                                       cursor-not-allowed"
                            >


                            <p class="mt-2 text-xs text-gray-400">
                                Email is displayed for reference and cannot be changed here.
                            </p>

                        </div>



                        {{-- ================================================= --}}
                        {{-- ACCOUNT STATUS --}}
                        {{-- ================================================= --}}

                        <div>

                            <label class="block text-sm font-semibold text-gray-700">
                                Account Status
                            </label>


                            <div class="mt-3 flex flex-wrap items-center gap-3">


                                @if ($user->status === 'active')

                                    <span
                                        class="inline-flex items-center gap-2
                                               px-4 py-2
                                               rounded-full
                                               bg-emerald-50
                                               text-emerald-700
                                               border border-emerald-100
                                               text-sm font-semibold"
                                    >

                                        <span
                                            class="w-2 h-2 rounded-full bg-emerald-500"
                                        ></span>

                                        Active

                                    </span>

                                @else

                                    <span
                                        class="inline-flex items-center gap-2
                                               px-4 py-2
                                               rounded-full
                                               bg-red-50
                                               text-red-700
                                               border border-red-100
                                               text-sm font-semibold"
                                    >

                                        <span
                                            class="w-2 h-2 rounded-full bg-red-500"
                                        ></span>

                                        Blocked

                                    </span>

                                @endif


                                <span class="text-xs text-gray-400">
                                    Manage status from the User Management page.
                                </span>

                            </div>

                        </div>



                        {{-- ================================================= --}}
                        {{-- ROLE --}}
                        {{-- ================================================= --}}

                        <div>

                            <label
                                for="role_id"
                                class="block text-sm font-semibold text-gray-700"
                            >
                                User Role
                            </label>


                            <p class="mt-1 text-xs text-gray-400">
                                Select the role assigned to this account.
                            </p>


                            {{--

                                IMPORTANT MVC FLOW:

                                The selected value is submitted as:

                                    role_id

                                ↓

                                Request

                                ↓

                                AdminUserController@update()

                                ↓

                                Validation:

                                    required
                                    exists:roles,id

                                ↓

                                $user->update()

                                ↓

                                Database

                            --}}

                            <select
                                id="role_id"
                                name="role_id"
                                required
                                class="mt-3 block w-full rounded-xl
                                       border-gray-200
                                       bg-white
                                       shadow-sm
                                       focus:border-emerald-500
                                       focus:ring-emerald-500"
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


                            @error('role_id')

                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                    </div>



                    {{-- ================================================= --}}
                    {{-- FORM FOOTER --}}
                    {{-- ================================================= --}}

                    <div
                        class="px-6 sm:px-8 py-5
                               bg-gradient-to-r
                               from-emerald-50
                               via-white
                               to-green-50
                               border-t border-emerald-100"
                    >

                        <div
                            class="flex flex-col-reverse
                                   sm:flex-row
                                   sm:items-center
                                   sm:justify-end
                                   gap-3"
                        >


                            {{-- Cancel --}}

                            <a
                                href="{{ route('admin.users') }}"
                                class="inline-flex items-center justify-center
                                       px-5 py-2.5
                                       rounded-xl
                                       border border-gray-200
                                       bg-white
                                       text-sm font-semibold
                                       text-gray-700
                                       hover:bg-gray-50
                                       transition"
                            >

                                Cancel

                            </a>


                            {{-- Save Changes --}}

                            <button
                                type="submit"
                                class="inline-flex items-center justify-center gap-2
                                       px-5 py-2.5
                                       rounded-xl
                                       bg-emerald-600
                                       text-white
                                       text-sm font-semibold
                                       hover:bg-emerald-700
                                       shadow-sm
                                       hover:shadow-md
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
                                        d="M5 12l4 4L19 6"
                                    />

                                </svg>

                                Save Changes

                            </button>

                        </div>

                    </div>

                </form>

            </div>



            {{-- ================================================= --}}
            {{-- INFORMATION CARD --}}
            {{-- ================================================= --}}

            <div
                class="mt-6
                       rounded-2xl
                       border border-emerald-100
                       bg-white/80
                       shadow-sm
                       px-5 py-4"
            >

                <div class="flex items-start gap-3">

                    <div
                        class="w-9 h-9 rounded-xl
                               bg-emerald-50
                               text-emerald-600
                               flex items-center justify-center
                               flex-shrink-0"
                    >

                        <svg
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M13 16h-1v-4h-1m1-4h.01M12 21a9 9 0 100-18 9 9 0 000 18z"
                            />

                        </svg>

                    </div>


                    <div>

                        <p class="text-sm font-semibold text-gray-800">
                            Admin Note
                        </p>

                        <p class="mt-1 text-xs leading-5 text-gray-500">
                            Changing a user's role affects which areas of the
                            platform they can access. Make sure the selected role
                            matches the user's responsibilities.
                        </p>

                    </div>

                </div>

            </div>


        </div>

    </div>

</x-app-layout>