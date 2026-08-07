<x-app-layout>
    <x-slot name="header">
        <h2>Report Management</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">

                <h3 class="text-2xl font-bold mb-6">
                    Report Management
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

                <div class="overflow-x-auto">

                    <table class="min-w-full border border-gray-300">

                        <thead class="bg-gray-200">

                            <tr>

                                <th class="border px-4 py-2">
                                    ID
                                </th>

                                <th class="border px-4 py-2">
                                    Reporter
                                </th>

                                <th class="border px-4 py-2">
                                    Reported User
                                </th>

                                <th class="border px-4 py-2">
                                    Reason
                                </th>

                                <th class="border px-4 py-2">
                                    Status
                                </th>

                                <th class="border px-4 py-2">
                                    Action
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse ($reports as $report)

                                <tr>

                                    <td class="border px-4 py-2">
                                        {{ $report->id }}
                                    </td>

                                    <td class="border px-4 py-2">
                                        {{ $report->reporter->name }}
                                    </td>

                                    <td class="border px-4 py-2">
                                        {{ $report->reportedUser->name }}
                                    </td>

                                    <td class="border px-4 py-2">
                                        {{ $report->reason }}
                                    </td>

                                    <td class="border px-4 py-2">
                                        {{ ucfirst($report->status) }}
                                    </td>

                                    <td class="border px-4 py-2">

                                        <a href="{{ route('admin.reports.show', $report) }}"
                                            class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                            View
                                        </a>

                                        <a href="{{ route('admin.reports.edit', $report) }}"
                                            class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 ml-2">
                                            Edit
                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6" class="border px-4 py-4 text-center text-gray-500">
                                        No reports found.
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="mt-6">
                    {{ $reports->links() }}
                </div>

            </div>

        </div>
    </div>
</x-app-layout>