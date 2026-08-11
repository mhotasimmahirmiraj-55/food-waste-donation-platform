<x-app-layout>
    <x-slot name="header">
        <h2>Report Details</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">

                <h3 class="text-2xl font-bold mb-6">
                    Report Details
                </h3>

                <table class="w-full">

                    <tr class="border-b">
                        <td class="py-3 font-semibold w-1/3">
                            Reporter
                        </td>

                        <td class="py-3">
                            {{ $report->reporter->name }}
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="py-3 font-semibold">
                            Reported User
                        </td>

                        <td class="py-3">
                            {{ $report->reportedUser->name }}
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="py-3 font-semibold">
                            Reason
                        </td>

                        <td class="py-3">
                            {{ $report->reason }}
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="py-3 font-semibold">
                            Status
                        </td>

                        <td class="py-3">
                            {{ ucfirst($report->status) }}
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="py-3 font-semibold">
                            Created At
                        </td>

                        <td class="py-3">
                            {{ $report->created_at ? $report->created_at->format('d M Y h:i A') : 'N/A' }}
                        </td>
                    </tr>

                </table>

                <div class="mt-6">

                    <a href="{{ route('admin.reports') }}"
                        class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                        Back to Reports
                    </a>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>
