<x-app-layout>
    <x-slot name="header">
        <h2>Edit Report Status</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">

                <h3 class="text-2xl font-bold mb-6">
                    Edit Report Status
                </h3>

                <form action="{{ route('admin.reports.update', $report) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-4">

                        <label class="block font-medium text-sm text-gray-700">
                            Reporter
                        </label>

                        <input
                            type="text"
                            value="{{ $report->reporter->name }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100"
                            readonly>

                    </div>

                    <div class="mb-4">

                        <label class="block font-medium text-sm text-gray-700">
                            Reported User
                        </label>

                        <input
                            type="text"
                            value="{{ $report->reportedUser->name }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100"
                            readonly>

                    </div>

                    <div class="mb-4">

                        <label class="block font-medium text-sm text-gray-700">
                            Reason
                        </label>

                        <textarea
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100"
                            rows="4"
                            readonly>{{ $report->reason }}</textarea>

                    </div>

                    <div class="mb-4">

                        <label class="block font-medium text-sm text-gray-700">
                            Status
                        </label>

                        <select
                            name="status"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">

                            <option value="pending"
                                {{ $report->status == 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="reviewed"
                                {{ $report->status == 'reviewed' ? 'selected' : '' }}>
                                Reviewed
                            </option>

                            <option value="resolved"
                                {{ $report->status == 'resolved' ? 'selected' : '' }}>
                                Resolved
                            </option>

                        </select>

                    </div>

                    <div class="mt-6">

                        <button
                            type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            Update Status
                        </button>

                        <a href="{{ route('admin.reports') }}"
                            class="ml-2 bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                            Cancel
                        </a>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>