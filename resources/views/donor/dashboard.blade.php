<x-app-layout>

    {{-- =========================================================
         HEADER
    ========================================================== --}}

    <x-slot name="header">

    <div>

        <div class="flex items-center gap-3">

            <div class="w-1.5 h-8 rounded-full bg-emerald-500"></div>

            <h2 class="font-bold text-2xl text-gray-800">
                Donor Dashboard
            </h2>

        </div>

        <p class="text-sm text-gray-500 mt-1 ml-4">
            Manage your food donations and make a meaningful impact.
        </p>

    </div>

</x-slot>


    {{-- =========================================================
         MAIN BACKGROUND
    ========================================================== --}}

    <div class="min-h-screen
            bg-gradient-to-br
            from-emerald-100
            via-teal-50
            to-cyan-100
            py-8">

        <div class="max-w-7xl mx-auto px-8">


            {{-- =================================================
                 WELCOME HERO
            ================================================== --}}

            <div class="relative overflow-hidden
                        rounded-3xl
                        bg-gradient-to-r
                        from-emerald-800
                        via-emerald-600
                        to-teal-500
                        shadow-xl
                        mb-8">


                {{-- Decorative Background --}}

                <div class="absolute -right-16 -top-24
                            w-72 h-72
                            rounded-full
                            bg-white/10">
                </div>

                <div class="absolute right-36 -bottom-28
                            w-56 h-56
                            rounded-full
                            bg-white/10">
                </div>


                <div class="relative p-10">

                    <div class="max-w-3xl">

                        <span class="inline-flex
                                     px-3 py-1
                                     rounded-full
                                     bg-white/15
                                     text-emerald-50
                                     text-xs
                                     font-semibold
                                     tracking-wide">

                            DONOR ACCOUNT

                        </span>


                        <h1 class="text-4xl
                                   font-bold
                                   text-white
                                   mt-4">

                            Welcome back, {{ auth()->user()->name }}! 👋

                        </h1>


                        <p class="mt-3
                                  text-emerald-50
                                  text-lg
                                  leading-relaxed">

                            Every donation helps reduce food waste and makes
                            surplus food available to people who need it.

                        </p>


                        <div class="flex items-center gap-3 mt-7">


                            <a href="{{ route('donations.create') }}"
                               class="inline-flex items-center gap-2
                                      px-5 py-3
                                      rounded-xl
                                      bg-white
                                      text-emerald-700
                                      font-semibold
                                      shadow-md
                                      hover:bg-emerald-50
                                      transition">

                                <span class="text-xl">
                                    +
                                </span>

                                Create Donation

                            </a>


                            <a href="{{ route('donations.index') }}"
                               class="inline-flex items-center gap-2
                                      px-5 py-3
                                      rounded-xl
                                      bg-white/10
                                      border border-white/20
                                      text-white
                                      font-semibold
                                      backdrop-blur-sm
                                      hover:bg-white/20
                                      transition">

                                View My Donations

                                <span>
                                    →
                                </span>

                            </a>

                        </div>

                    </div>

                </div>

            </div>



            {{-- =================================================
                 STATISTICS CARDS
            ================================================== --}}

            <div class="grid grid-cols-4 gap-5 mb-8">


                {{-- TOTAL DONATIONS --}}

                <div class="group
                            bg-white
                            rounded-2xl
                            border border-gray-100
                            shadow-sm
                            p-6
                            hover:shadow-xl
                            hover:-translate-y-1
                            transition-all duration-300">

                    <div class="flex items-start justify-between">


                        <div>

                            <p class="text-sm
                                      font-medium
                                      text-gray-500">

                                Total Donations

                            </p>


                            <p class="text-3xl
                                      font-bold
                                      text-gray-800
                                      mt-2">

                                {{ $totalDonations }}

                            </p>


                            <p class="text-xs
                                      text-gray-400
                                      mt-2">

                                All your donations

                            </p>

                        </div>


                        <div class="w-12 h-12
                                    rounded-xl
                                    bg-emerald-100
                                    text-emerald-600
                                    flex items-center
                                    justify-center
                                    group-hover:bg-emerald-600
                                    group-hover:text-white
                                    transition">

                            <svg class="w-6 h-6"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>

                            </svg>

                        </div>

                    </div>

                </div>



                {{-- AVAILABLE --}}

                <div class="group
                            bg-white
                            rounded-2xl
                            border border-gray-100
                            shadow-sm
                            p-6
                            hover:shadow-xl
                            hover:-translate-y-1
                            transition-all duration-300">

                    <div class="flex items-start justify-between">


                        <div>

                            <p class="text-sm
                                      font-medium
                                      text-gray-500">

                                Available

                            </p>


                            <p class="text-3xl
                                      font-bold
                                      text-blue-600
                                      mt-2">

                                {{ $availableDonations }}

                            </p>


                            <p class="text-xs
                                      text-gray-400
                                      mt-2">

                                Waiting for receivers

                            </p>

                        </div>


                        <div class="w-12 h-12
                                    rounded-xl
                                    bg-blue-100
                                    text-blue-600
                                    flex items-center
                                    justify-center
                                    group-hover:bg-blue-600
                                    group-hover:text-white
                                    transition">

                            <svg class="w-6 h-6"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M12 4v16m8-8H4"/>

                            </svg>

                        </div>

                    </div>

                </div>



                {{-- CLAIMED --}}

                <div class="group
                            bg-white
                            rounded-2xl
                            border border-gray-100
                            shadow-sm
                            p-6
                            hover:shadow-xl
                            hover:-translate-y-1
                            transition-all duration-300">

                    <div class="flex items-start justify-between">


                        <div>

                            <p class="text-sm
                                      font-medium
                                      text-gray-500">

                                Claimed

                            </p>


                            <p class="text-3xl
                                      font-bold
                                      text-amber-500
                                      mt-2">

                                {{ $claimedDonations }}

                            </p>


                            <p class="text-xs
                                      text-gray-400
                                      mt-2">

                                Donations claimed

                            </p>

                        </div>


                        <div class="w-12 h-12
                                    rounded-xl
                                    bg-amber-100
                                    text-amber-600
                                    flex items-center
                                    justify-center
                                    group-hover:bg-amber-500
                                    group-hover:text-white
                                    transition">

                            <svg class="w-6 h-6"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>

                            </svg>

                        </div>

                    </div>

                </div>



                {{-- COMPLETED --}}

                <div class="group
                            bg-white
                            rounded-2xl
                            border border-gray-100
                            shadow-sm
                            p-6
                            hover:shadow-xl
                            hover:-translate-y-1
                            transition-all duration-300">

                    <div class="flex items-start justify-between">


                        <div>

                            <p class="text-sm
                                      font-medium
                                      text-gray-500">

                                Completed

                            </p>


                            <p class="text-3xl
                                      font-bold
                                      text-green-600
                                      mt-2">

                                {{ $completedDonations }}

                            </p>


                            <p class="text-xs
                                      text-gray-400
                                      mt-2">

                                Successfully delivered

                            </p>

                        </div>


                        <div class="w-12 h-12
                                    rounded-xl
                                    bg-green-100
                                    text-green-600
                                    flex items-center
                                    justify-center
                                    group-hover:bg-green-600
                                    group-hover:text-white
                                    transition">

                            <svg class="w-6 h-6"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M5 13l4 4L19 7"/>

                            </svg>

                        </div>

                    </div>

                </div>

            </div>



            {{-- =================================================
                 CHART SECTION
            ================================================== --}}

            <div class="grid grid-cols-3 gap-6 mb-8">


                {{-- DONATION OVERVIEW --}}

                <div class="col-span-2
                            bg-white
                            rounded-2xl
                            border border-gray-100
                            shadow-sm
                            p-6">


                    <div class="flex items-center justify-between mb-6">

                        <div>

                            <h3 class="text-xl
                                       font-bold
                                       text-gray-800">

                                Donation Overview

                            </h3>

                            <p class="text-sm
                                      text-gray-500
                                      mt-1">

                                Your donation activity throughout
                                {{ now()->year }}

                            </p>

                        </div>


                        <div class="px-3 py-1.5
                                    rounded-full
                                    bg-emerald-50
                                    text-emerald-700
                                    text-xs
                                    font-semibold">

                            {{ now()->year }}

                        </div>

                    </div>


                    <div class="h-80">

                        <canvas id="donationOverviewChart"></canvas>

                    </div>

                </div>



                {{-- DONATION STATUS --}}

                <div class="bg-white
                            rounded-2xl
                            border border-gray-100
                            shadow-sm
                            p-6">


                    <div class="mb-5">

                        <h3 class="text-xl
                                   font-bold
                                   text-gray-800">

                            Donation Status

                        </h3>

                        <p class="text-sm
                                  text-gray-500
                                  mt-1">

                            Current distribution

                        </p>

                    </div>


                    <div class="h-64">

                        <canvas id="donationStatusChart"></canvas>

                    </div>


                    <div class="space-y-3 mt-4">


                        <div class="flex items-center justify-between">

                            <div class="flex items-center gap-2">

                                <span class="w-3 h-3
                                             rounded-full
                                             bg-blue-500">
                                </span>

                                <span class="text-sm text-gray-600">
                                    Available
                                </span>

                            </div>

                            <span class="font-semibold text-gray-800">
                                {{ $availableDonations }}
                            </span>

                        </div>


                        <div class="flex items-center justify-between">

                            <div class="flex items-center gap-2">

                                <span class="w-3 h-3
                                             rounded-full
                                             bg-amber-400">
                                </span>

                                <span class="text-sm text-gray-600">
                                    Claimed
                                </span>

                            </div>

                            <span class="font-semibold text-gray-800">
                                {{ $claimedDonations }}
                            </span>

                        </div>


                        <div class="flex items-center justify-between">

                            <div class="flex items-center gap-2">

                                <span class="w-3 h-3
                                             rounded-full
                                             bg-emerald-500">
                                </span>

                                <span class="text-sm text-gray-600">
                                    Completed
                                </span>

                            </div>

                            <span class="font-semibold text-gray-800">
                                {{ $completedDonations }}
                            </span>

                        </div>


                        <div class="flex items-center justify-between">

                            <div class="flex items-center gap-2">

                                <span class="w-3 h-3
                                             rounded-full
                                             bg-red-400">
                                </span>

                                <span class="text-sm text-gray-600">
                                    Expired
                                </span>

                            </div>

                            <span class="font-semibold text-gray-800">
                                {{ $expiredDonations }}
                            </span>

                        </div>

                    </div>

                </div>

            </div>



            {{-- =================================================
                 QUICK ACTIONS
            ================================================== --}}

            <div class="bg-white
                        rounded-2xl
                        border border-gray-100
                        shadow-sm
                        p-6
                        mb-8">


                <div class="flex items-center justify-between">


                    <div>

                        <h3 class="text-xl
                                   font-bold
                                   text-gray-800">

                            Quick Actions

                        </h3>

                        <p class="text-sm
                                  text-gray-500
                                  mt-1">

                            Manage your donations and account.

                        </p>

                    </div>


                    <div class="flex items-center gap-3">


                        <a href="{{ route('donations.create') }}"
                           class="inline-flex items-center gap-2
                                  px-4 py-2.5
                                  rounded-xl
                                  bg-emerald-600
                                  text-white
                                  text-sm
                                  font-semibold
                                  hover:bg-emerald-700
                                  transition">

                            <span class="text-lg">
                                +
                            </span>

                            New Donation

                        </a>


                        <a href="{{ route('donations.index') }}"
                           class="px-4 py-2.5
                                  rounded-xl
                                  bg-blue-50
                                  text-blue-700
                                  text-sm
                                  font-semibold
                                  hover:bg-blue-100
                                  transition">

                            My Donations

                        </a>


                        <a href="{{ route('donations.edit.list') }}"
                           class="px-4 py-2.5
                                  rounded-xl
                                  bg-amber-50
                                  text-amber-700
                                  text-sm
                                  font-semibold
                                  hover:bg-amber-100
                                  transition">

                            Edit Donations

                        </a>


                        <a href="{{ route('donations.delete.list') }}"
                           class="px-4 py-2.5
                                  rounded-xl
                                  bg-red-50
                                  text-red-700
                                  text-sm
                                  font-semibold
                                  hover:bg-red-100
                                  transition">

                            Delete Donations

                        </a>


                        <a href="{{ route('profile.edit') }}"
                           class="px-4 py-2.5
                                  rounded-xl
                                  bg-gray-100
                                  text-gray-700
                                  text-sm
                                  font-semibold
                                  hover:bg-gray-200
                                  transition">

                            Profile

                        </a>

                    </div>

                </div>

            </div>



            {{-- =================================================
                 RECENT DONATIONS
            ================================================== --}}

            <div class="bg-white
                        rounded-2xl
                        border border-gray-100
                        shadow-sm
                        overflow-hidden
                        mb-8">


                <div class="p-6
                            border-b
                            border-gray-100
                            flex items-center
                            justify-between">


                    <div>

                        <h3 class="text-xl
                                   font-bold
                                   text-gray-800">

                            Recent Donations

                        </h3>

                        <p class="text-sm
                                  text-gray-500
                                  mt-1">

                            Your latest food donations

                        </p>

                    </div>


                    <a href="{{ route('donations.index') }}"
                       class="text-sm
                              font-semibold
                              text-emerald-600
                              hover:text-emerald-700">

                        View All →

                    </a>

                </div>


                <table class="w-full">

                    <thead class="bg-gray-50">

                        <tr>

                            <th class="px-6 py-4
                                       text-left
                                       text-xs
                                       font-semibold
                                       text-gray-500
                                       uppercase
                                       tracking-wider">

                                Food

                            </th>


                            <th class="px-6 py-4
                                       text-left
                                       text-xs
                                       font-semibold
                                       text-gray-500
                                       uppercase
                                       tracking-wider">

                                Category

                            </th>


                            <th class="px-6 py-4
                                       text-left
                                       text-xs
                                       font-semibold
                                       text-gray-500
                                       uppercase
                                       tracking-wider">

                                Quantity

                            </th>


                            <th class="px-6 py-4
                                       text-left
                                       text-xs
                                       font-semibold
                                       text-gray-500
                                       uppercase
                                       tracking-wider">

                                Status

                            </th>


                            <th class="px-6 py-4
                                       text-left
                                       text-xs
                                       font-semibold
                                       text-gray-500
                                       uppercase
                                       tracking-wider">

                                Date

                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-100">


                        @forelse($recentDonations as $donation)

                            @php

                                $status = strtolower(
                                    $donation->status ?? 'unknown'
                                );

                                $statusClasses = [

                                    'available' =>
                                        'bg-blue-50 text-blue-700',

                                    'claimed' =>
                                        'bg-amber-50 text-amber-700',

                                    'completed' =>
                                        'bg-emerald-50 text-emerald-700',

                                    'expired' =>
                                        'bg-red-50 text-red-700',

                                ];

                                $statusClass =
                                    $statusClasses[$status]
                                    ?? 'bg-gray-100 text-gray-600';

                            @endphp


                            <tr class="hover:bg-gray-50
                                       transition">


                                <td class="px-6 py-4">

                                    <div class="font-semibold
                                                text-gray-800">

                                        {{ $donation->title }}

                                    </div>

                                </td>


                                <td class="px-6 py-4
                                           text-sm
                                           text-gray-500">

                                    {{ $donation->category->name ?? 'N/A' }}

                                </td>


                                <td class="px-6 py-4
                                           text-sm
                                           text-gray-600">

                                    {{ $donation->quantity }}

                                </td>


                                <td class="px-6 py-4">

                                    <span class="inline-flex
                                                 items-center
                                                 px-3 py-1
                                                 rounded-full
                                                 text-xs
                                                 font-semibold
                                                 {{ $statusClass }}">

                                        {{ ucfirst($status) }}

                                    </span>

                                </td>


                                <td class="px-6 py-4
                                           text-sm
                                           text-gray-500">

                                    {{ $donation->created_at->format('d M Y') }}

                                </td>

                            </tr>


                        @empty


                            <tr>

                                <td colspan="5"
                                    class="px-6 py-14
                                           text-center">


                                    <div class="text-5xl mb-3">
                                        🍽️
                                    </div>


                                    <p class="text-gray-700
                                              font-semibold">

                                        No donations yet

                                    </p>


                                    <p class="text-sm
                                              text-gray-400
                                              mt-1">

                                        Start by donating surplus food.

                                    </p>


                                    <a href="{{ route('donations.create') }}"
                                       class="inline-flex
                                              mt-4
                                              px-4 py-2
                                              rounded-lg
                                              bg-emerald-600
                                              text-white
                                              text-sm
                                              font-semibold
                                              hover:bg-emerald-700">

                                        Create Donation

                                    </a>

                                </td>

                            </tr>


                        @endforelse


                    </tbody>

                </table>

            </div>



            {{-- =================================================
                 IMPACT SECTION
            ================================================== --}}

            <div class="relative
                        overflow-hidden
                        rounded-2xl
                        bg-gradient-to-r
                        from-emerald-100
                        via-green-50
                        to-teal-100
                        border border-emerald-100
                        p-7
                        mb-8">


                <div class="flex items-center
                            justify-between">


                    <div>

                        <p class="text-xs
                                  font-bold
                                  uppercase
                                  tracking-widest
                                  text-emerald-600">

                            YOUR IMPACT

                        </p>


                        <h3 class="text-2xl
                                   font-bold
                                   text-gray-800
                                   mt-2">

                            Together, we can reduce food waste 🌱

                        </h3>


                        <p class="text-sm
                                  text-gray-600
                                  mt-2">

                            Every donation you make can help someone in need.

                        </p>

                    </div>


                    <div class="flex items-center gap-4">


                        <div class="w-16 h-16
                                    rounded-2xl
                                    bg-white
                                    shadow-sm
                                    flex items-center
                                    justify-center
                                    text-3xl">

                            🌱

                        </div>


                        <div>

                            <p class="text-3xl
                                      font-bold
                                      text-emerald-700">

                                {{ $completedDonations }}

                            </p>

                            <p class="text-xs
                                      text-gray-500">

                                Completed Donations

                            </p>

                        </div>

                    </div>

                </div>

            </div>


        </div>

    </div>



    {{-- =========================================================
         CHART.JS
    ========================================================== --}}

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script>

        document.addEventListener(
            'DOMContentLoaded',
            function () {


                // ==========================================
                // MONTHLY DONATION DATA
                // ==========================================

                const monthlyData =
                    @json($monthlyDonations);


                const months = [

                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec'

                ];


                const monthlyValues =
                    new Array(12).fill(0);


                monthlyData.forEach(
                    item => {

                        monthlyValues[
                            item.month - 1
                        ] = item.total;

                    }
                );


                // ==========================================
                // DONATION OVERVIEW CHART
                // ==========================================

                const overviewCanvas =
                    document.getElementById(
                        'donationOverviewChart'
                    );


                if (overviewCanvas) {

                    new Chart(
                        overviewCanvas,
                        {

                            type: 'line',

                            data: {

                                labels: months,

                                datasets: [{

                                    label: 'Donations',

                                    data: monthlyValues,

                                    borderColor: '#059669',

                                    backgroundColor:
                                        'rgba(5, 150, 105, 0.10)',

                                    borderWidth: 3,

                                    fill: true,

                                    tension: 0.4,

                                    pointRadius: 4,

                                    pointHoverRadius: 7,

                                    pointBackgroundColor:
                                        '#059669'

                                }]

                            },


                            options: {

                                responsive: true,

                                maintainAspectRatio: false,


                                interaction: {

                                    intersect: false,

                                    mode: 'index'

                                },


                                plugins: {

                                    legend: {

                                        display: false

                                    },


                                    tooltip: {

                                        backgroundColor:
                                            '#111827',

                                        padding: 12,

                                        cornerRadius: 8

                                    }

                                },


                                scales: {

                                    y: {

                                        beginAtZero: true,

                                        ticks: {

                                            precision: 0

                                        },

                                        grid: {

                                            color:
                                                'rgba(0,0,0,0.05)'

                                        }

                                    },


                                    x: {

                                        grid: {

                                            display: false

                                        }

                                    }

                                }

                            }

                        }
                    );

                }



                // ==========================================
                // DONATION STATUS CHART
                // ==========================================

                const statusCanvas =
                    document.getElementById(
                        'donationStatusChart'
                    );


                if (statusCanvas) {

                    new Chart(
                        statusCanvas,
                        {

                            type: 'doughnut',


                            data: {

                                labels: [

                                    'Available',

                                    'Claimed',

                                    'Completed',

                                    'Expired'

                                ],


                                datasets: [{

                                    data: [

                                        {{ $availableDonations }},

                                        {{ $claimedDonations }},

                                        {{ $completedDonations }},

                                        {{ $expiredDonations }}

                                    ],


                                    backgroundColor: [

                                        '#3B82F6',

                                        '#F59E0B',

                                        '#10B981',

                                        '#F87171'

                                    ],


                                    borderWidth: 0,

                                    hoverOffset: 8

                                }]

                            },


                            options: {

                                responsive: true,

                                maintainAspectRatio: false,

                                cutout: '72%',


                                plugins: {

                                    legend: {

                                        display: false

                                    },


                                    tooltip: {

                                        backgroundColor:
                                            '#111827',

                                        padding: 12,

                                        cornerRadius: 8

                                    }

                                }

                            }

                        }
                    );

                }

            }
        );

    </script>

</x-app-layout>