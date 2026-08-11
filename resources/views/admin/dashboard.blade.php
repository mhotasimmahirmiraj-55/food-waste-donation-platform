<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">

            <div>
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                    Admin Dashboard
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Overview of your food-waste donation platform
                </p>
            </div>

            <div class="hidden sm:flex items-center gap-2 text-sm text-gray-500">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                System Overview
            </div>

        </div>
    </x-slot>


    <div class="min-h-screen bg-slate-50">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <div
                x-data="{ sidebarOpen: true }"
                class="flex flex-col lg:flex-row gap-8"
            >

                {{-- ================================================= --}}
                {{-- SIDEBAR --}}
                {{-- ================================================= --}}

                <aside
                    class="flex-shrink-0 transition-all duration-300"
                    :class="sidebarOpen ? 'lg:w-64' : 'lg:w-20'"
                >

                    <div class="lg:sticky lg:top-6">

                        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">

                            {{-- Sidebar Header --}}
                            <div class="px-3 py-4 border-b border-gray-100">

                                <div class="flex items-center justify-between gap-2">

                                    <div
                                        class="min-w-0"
                                        x-show="sidebarOpen"
                                        x-transition
                                    >

                                        <p class="text-xs font-semibold uppercase tracking-wider text-emerald-600">
                                            Administration
                                        </p>

                                        <h3 class="mt-1 text-lg font-bold text-gray-900 whitespace-nowrap">
                                            Quick Actions
                                        </h3>

                                        <p class="mt-1 text-xs text-gray-500 whitespace-nowrap">
                                            Manage platform resources
                                        </p>

                                    </div>


                                    {{-- Sidebar Toggle --}}
                                    <button
                                        type="button"
                                        @click="sidebarOpen = !sidebarOpen"
                                        class="flex-shrink-0 w-10 h-10 rounded-xl bg-gray-100 text-gray-600 hover:bg-gray-200 hover:text-gray-900 flex items-center justify-center transition"
                                        :title="sidebarOpen ? 'Collapse sidebar' : 'Expand sidebar'"
                                    >

                                        <svg
                                            class="w-5 h-5 transition-transform duration-300"
                                            :class="sidebarOpen ? '' : 'rotate-180'"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.8"
                                                d="M11 19l-7-7 7-7M4 12h16"
                                            />

                                        </svg>

                                    </button>

                                </div>

                            </div>


                            {{-- Navigation --}}
                            <nav class="p-3 space-y-1">

                                {{-- Users --}}
                                <a
                                    href="{{ route('admin.users') }}"
                                    class="group flex items-center gap-3 px-3 py-3 rounded-xl justify-center lg:justify-start text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 transition"
                                >

                                    <span class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-600 group-hover:bg-emerald-100 flex items-center justify-center flex-shrink-0">

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
                                                d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 100-8 4 4 0 000 8z"
                                            />

                                        </svg>

                                    </span>

                                    <span
                                        x-show="sidebarOpen"
                                        x-transition
                                        class="text-sm font-medium whitespace-nowrap"
                                    >
                                        Manage Users
                                    </span>

                                </a>


                                {{-- Donations --}}
                                <a
                                    href="{{ route('admin.donations') }}"
                                    class="group flex items-center gap-3 px-3 py-3 rounded-xl justify-center lg:justify-start text-gray-600 hover:bg-green-50 hover:text-green-700 transition"
                                >

                                    <span class="w-9 h-9 rounded-lg bg-green-50 text-green-600 group-hover:bg-green-100 flex items-center justify-center flex-shrink-0">

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
                                                d="M3 7h18M5 7l1 12h12l1-12M9 7V5a3 3 0 016 0v2"
                                            />

                                        </svg>

                                    </span>

                                    <span
                                        x-show="sidebarOpen"
                                        x-transition
                                        class="text-sm font-medium whitespace-nowrap"
                                    >
                                        Manage Donations
                                    </span>

                                </a>


                                {{-- Categories --}}
                                <a
                                    href="{{ route('admin.categories') }}"
                                    class="group flex items-center gap-3 px-3 py-3 rounded-xl justify-center lg:justify-start text-gray-600 hover:bg-purple-50 hover:text-purple-700 transition"
                                >

                                    <span class="w-9 h-9 rounded-lg bg-purple-50 text-purple-600 group-hover:bg-purple-100 flex items-center justify-center flex-shrink-0">

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
                                                d="M4 6h16M4 12h16M4 18h10"
                                            />

                                        </svg>

                                    </span>

                                    <span
                                        x-show="sidebarOpen"
                                        x-transition
                                        class="text-sm font-medium whitespace-nowrap"
                                    >
                                        Food Categories
                                    </span>

                                </a>


                                {{-- Reports --}}
                                <a
                                    href="{{ route('admin.reports') }}"
                                    class="group flex items-center gap-3 px-3 py-3 rounded-xl justify-center lg:justify-start text-gray-600 hover:bg-rose-50 hover:text-rose-700 transition"
                                >

                                    <span class="w-9 h-9 rounded-lg bg-rose-50 text-rose-600 group-hover:bg-rose-100 flex items-center justify-center flex-shrink-0">

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
                                                d="M9 17h6M9 13h6M9 9h2m-5 12h10a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"
                                            />

                                        </svg>

                                    </span>

                                    <span
                                        x-show="sidebarOpen"
                                        x-transition
                                        class="text-sm font-medium whitespace-nowrap"
                                    >
                                        Manage Reports
                                    </span>

                                </a>


                                {{-- Claims --}}
                                <a
                                    href="{{ route('admin.claims') }}"
                                    class="group flex items-center gap-3 px-3 py-3 rounded-xl justify-center lg:justify-start text-gray-600 hover:bg-indigo-50 hover:text-indigo-700 transition"
                                >

                                    <span class="w-9 h-9 rounded-lg bg-indigo-50 text-indigo-600 group-hover:bg-indigo-100 flex items-center justify-center flex-shrink-0">

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
                                                d="M9 12l2 2 4-4M5 5h14v14H5z"
                                            />

                                        </svg>

                                    </span>

                                    <span
                                        x-show="sidebarOpen"
                                        x-transition
                                        class="text-sm font-medium whitespace-nowrap"
                                    >
                                        Manage Claims
                                    </span>

                                </a>


                                {{-- Deliveries --}}
                                <a
                                    href="{{ route('admin.deliveries') }}"
                                    class="group flex items-center gap-3 px-3 py-3 rounded-xl justify-center lg:justify-start text-gray-600 hover:bg-orange-50 hover:text-orange-700 transition"
                                >

                                    <span class="w-9 h-9 rounded-lg bg-orange-50 text-orange-600 group-hover:bg-orange-100 flex items-center justify-center flex-shrink-0">

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
                                                d="M3 7h11v10H3zM14 10h4l3 3v4h-7zM7 20a2 2 0 100-4 2 2 0 000 4zm10 0a2 2 0 100-4 2 2 0 000 4z"
                                            />

                                        </svg>

                                    </span>

                                    <span
                                        x-show="sidebarOpen"
                                        x-transition
                                        class="text-sm font-medium whitespace-nowrap"
                                    >
                                        Manage Deliveries
                                    </span>

                                </a>

                            </nav>

                        </div>

                    </div>

                </aside>


                {{-- ================================================= --}}
                {{-- MAIN CONTENT --}}
                {{-- ================================================= --}}

                <main class="flex-1 min-w-0">


                    {{-- Welcome Banner --}}
                    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-900 via-slate-800 to-emerald-900 shadow-xl mb-8">

                        <div class="absolute inset-0 opacity-10">

                            <div class="absolute -top-24 -right-24 w-72 h-72 rounded-full bg-emerald-400"></div>

                            <div class="absolute -bottom-32 -left-20 w-80 h-80 rounded-full bg-indigo-400"></div>

                        </div>

                        <div class="relative px-6 py-8 sm:px-8">

                            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 border border-white/10 text-emerald-300 text-xs font-semibold uppercase tracking-wider">

                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>

                                Administration

                            </div>

                            <h1 class="mt-4 text-3xl font-bold text-white tracking-tight">
                                Welcome back, Admin
                            </h1>

                            <p class="mt-3 text-sm sm:text-base text-slate-300 max-w-2xl">
                                Monitor your platform and keep the food redistribution
                                process running smoothly.
                            </p>

                        </div>

                    </div>


                    {{-- Analytics Header --}}
                    <div class="mb-5">

                        <h3 class="text-lg font-bold text-gray-900">
                            Platform Analytics
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Click any metric to open its management page.
                        </p>

                    </div>


                    {{-- ================================================= --}}
                    {{-- PRIMARY ANALYTICS --}}
                    {{-- ================================================= --}}

                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-5">


                        {{-- Total Users --}}
                        <a
                            href="{{ route('admin.users') }}"
                            class="group bg-white rounded-2xl border border-gray-200 p-5 shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-emerald-200 transition-all duration-200"
                        >

                            <div class="flex items-start justify-between">

                                <div>

                                    <p class="text-sm font-medium text-gray-500">
                                        Total Users
                                    </p>

                                    <p class="mt-3 text-3xl font-bold text-gray-900">
                                        {{ $totalUsers }}
                                    </p>

                                    <p class="mt-1 text-xs text-gray-400">
                                        Registered accounts
                                    </p>

                                </div>

                                <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">

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
                                            d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 100-8 4 4 0 000 8z"
                                        />

                                    </svg>

                                </div>

                            </div>

                            <div class="mt-4 text-xs font-semibold text-emerald-600 opacity-0 group-hover:opacity-100 transition">
                                View users →
                            </div>

                        </a>


                        {{-- Total Donations --}}
                        <a
                            href="{{ route('admin.donations') }}"
                            class="group bg-white rounded-2xl border border-gray-200 p-5 shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-green-200 transition-all duration-200"
                        >

                            <div class="flex items-start justify-between">

                                <div>

                                    <p class="text-sm font-medium text-gray-500">
                                        Total Donations
                                    </p>

                                    <p class="mt-3 text-3xl font-bold text-gray-900">
                                        {{ $totalDonations }}
                                    </p>

                                    <p class="mt-1 text-xs text-gray-400">
                                        Food donations
                                    </p>

                                </div>

                                <div class="w-11 h-11 rounded-xl bg-green-50 text-green-600 flex items-center justify-center">

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
                                            d="M3 7h18M5 7l1 12h12l1-12M9 7V5a3 3 0 016 0v2"
                                        />

                                    </svg>

                                </div>

                            </div>

                            <div class="mt-4 text-xs font-semibold text-green-600 opacity-0 group-hover:opacity-100 transition">
                                View donations →
                            </div>

                        </a>


                        {{-- Total Claims --}}
                        <a
                            href="{{ route('admin.claims') }}"
                            class="group bg-white rounded-2xl border border-gray-200 p-5 shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-indigo-200 transition-all duration-200"
                        >

                            <div class="flex items-start justify-between">

                                <div>

                                    <p class="text-sm font-medium text-gray-500">
                                        Total Claims
                                    </p>

                                    <p class="mt-3 text-3xl font-bold text-gray-900">
                                        {{ $totalClaims }}
                                    </p>

                                    <p class="mt-1 text-xs text-gray-400">
                                        Donation claims
                                    </p>

                                </div>

                                <div class="w-11 h-11 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">

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
                                            d="M9 12l2 2 4-4M5 5h14v14H5z"
                                        />

                                    </svg>

                                </div>

                            </div>

                            <div class="mt-4 text-xs font-semibold text-indigo-600 opacity-0 group-hover:opacity-100 transition">
                                View claims →
                            </div>

                        </a>


                        {{-- Total Reports --}}
                        <a
                            href="{{ route('admin.reports') }}"
                            class="group bg-white rounded-2xl border border-gray-200 p-5 shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-rose-200 transition-all duration-200"
                        >

                            <div class="flex items-start justify-between">

                                <div>

                                    <p class="text-sm font-medium text-gray-500">
                                        Total Reports
                                    </p>

                                    <p class="mt-3 text-3xl font-bold text-gray-900">
                                        {{ $totalReports }}
                                    </p>

                                    <p class="mt-1 text-xs text-gray-400">
                                        Submitted reports
                                    </p>

                                </div>

                                <div class="w-11 h-11 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center">

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

                            </div>

                            <div class="mt-4 text-xs font-semibold text-rose-600 opacity-0 group-hover:opacity-100 transition">
                                View reports →
                            </div>

                        </a>

                    </div>


                    {{-- ================================================= --}}
                    {{-- SECONDARY ANALYTICS --}}
                    {{-- ================================================= --}}

                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">


                        {{-- Admins --}}
                        <a
                            href="{{ route('admin.users', ['role_id' => 1]) }}"
                            class="group bg-white rounded-2xl border border-gray-200 p-5 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-200"
                        >

                            <div class="flex items-center gap-4">

                                <div class="w-11 h-11 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center">

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
                                            d="M12 3l7 4v5c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V7l7-4z"
                                        />

                                    </svg>

                                </div>

                                <div class="flex-1">

                                    <p class="text-sm text-gray-500">
                                        Total Admins
                                    </p>

                                    <p class="text-2xl font-bold text-gray-900">
                                        {{ $totalAdmins }}
                                    </p>

                                </div>

                                <span class="text-gray-300 group-hover:text-slate-600 text-lg">
                                    →
                                </span>

                            </div>

                        </a>


                        {{-- Donors --}}
                        <a
                            href="{{ route('admin.users', ['role_id' => 2]) }}"
                            class="group bg-white rounded-2xl border border-gray-200 p-5 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-200"
                        >

                            <div class="flex items-center gap-4">

                                <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">

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
                                            d="M12 21s-7-4.35-9-8.5C1.5 9.5 3.5 6 7 6c2 0 3.5 1.2 5 3 1.5-1.8 3-3 5-3 3.5 0 5.5 3.5 4 6.5C19 16.65 12 21 12 21z"
                                        />

                                    </svg>

                                </div>

                                <div class="flex-1">

                                    <p class="text-sm text-gray-500">
                                        Total Donors
                                    </p>

                                    <p class="text-2xl font-bold text-gray-900">
                                        {{ $totalDonors }}
                                    </p>

                                </div>

                                <span class="text-gray-300 group-hover:text-emerald-600 text-lg">
                                    →
                                </span>

                            </div>

                        </a>


                        {{-- Receivers --}}
                        <a
                            href="{{ route('admin.users', ['role_id' => 3]) }}"
                            class="group bg-white rounded-2xl border border-gray-200 p-5 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-200"
                        >

                            <div class="flex items-center gap-4">

                                <div class="w-11 h-11 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">

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
                                            d="M5 20h14M7 20V8l5-4 5 4v12M10 12h4"
                                        />

                                    </svg>

                                </div>

                                <div class="flex-1">

                                    <p class="text-sm text-gray-500">
                                        Total Receivers
                                    </p>

                                    <p class="text-2xl font-bold text-gray-900">
                                        {{ $totalReceivers }}
                                    </p>

                                </div>

                                <span class="text-gray-300 group-hover:text-blue-600 text-lg">
                                    →
                                </span>

                            </div>

                        </a>


                        {{-- Volunteers --}}
                        <a
                            href="{{ route('admin.users', ['role_id' => 4]) }}"
                            class="group bg-white rounded-2xl border border-gray-200 p-5 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-200"
                        >

                            <div class="flex items-center gap-4">

                                <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">

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
                                            d="M12 12a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 0114 0"
                                        />

                                    </svg>

                                </div>

                                <div class="flex-1">

                                    <p class="text-sm text-gray-500">
                                        Total Volunteers
                                    </p>

                                    <p class="text-2xl font-bold text-gray-900">
                                        {{ $totalVolunteers }}
                                    </p>

                                </div>

                                <span class="text-gray-300 group-hover:text-amber-600 text-lg">
                                    →
                                </span>

                            </div>

                        </a>


                        {{-- Blocked Users --}}
                        <a
                            href="{{ route('admin.users', ['status' => 'blocked']) }}"
                            class="group bg-white rounded-2xl border border-gray-200 p-5 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-200"
                        >

                            <div class="flex items-center gap-4">

                                <div class="w-11 h-11 rounded-xl bg-red-50 text-red-600 flex items-center justify-center">

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
                                            d="M6 6l12 12M6 18L18 6M12 3a9 9 0 100 18 9 9 0 000-18z"
                                        />

                                    </svg>

                                </div>

                                <div class="flex-1">

                                    <p class="text-sm text-gray-500">
                                        Blocked Users
                                    </p>

                                    <p class="text-2xl font-bold text-gray-900">
                                        {{ $blockedUsers }}
                                    </p>

                                </div>

                                <span class="text-gray-300 group-hover:text-red-600 text-lg">
                                    →
                                </span>

                            </div>

                        </a>


                        {{-- Categories --}}
                        <a
                            href="{{ route('admin.categories') }}"
                            class="group bg-white rounded-2xl border border-gray-200 p-5 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-200"
                        >

                            <div class="flex items-center gap-4">

                                <div class="w-11 h-11 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">

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
                                            d="M4 6h16M4 12h16M4 18h10"
                                        />

                                    </svg>

                                </div>

                                <div class="flex-1">

                                    <p class="text-sm text-gray-500">
                                        Food Categories
                                    </p>

                                    <p class="text-2xl font-bold text-gray-900">
                                        {{ $totalCategories }}
                                    </p>

                                </div>

                                <span class="text-gray-300 group-hover:text-purple-600 text-lg">
                                    →
                                </span>

                            </div>

                        </a>

                    </div>

                </main>

            </div>

        </div>

    </div>

</x-app-layout>