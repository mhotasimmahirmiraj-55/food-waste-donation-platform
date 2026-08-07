<x-app-layout>
    <x-slot name="header">
        <h2>Edit Claim Status</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">

                <h3 class="text-2xl font-bold mb-6">
                    Edit Claim Status
                </h3>

                <form action="{{ route('admin.claims.update', $claim) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-4">

                        <label class="block font-medium text-sm text-gray-700">
                            Donation
                        </label>

                        <input
                            type="text"
                            value="{{ $claim->foodDonation->title }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100"
                            readonly>

                    </div>

                    <div class="mb-4">

                        <label class="block font-medium text-sm text-gray-700">
                            Receiver
                        </label>

                        <input
                            type="text"
                            value="{{ $claim->receiver->name }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100"
                            readonly>

                    </div>

                    <div class="mb-4">

                        <label class="block font-medium text-sm text-gray-700">
                            Status
                        </label>

                        <select
                            name="status"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">

                            <option value="pending"
                                {{ $claim->status == 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="approved"
                                {{ $claim->status == 'approved' ? 'selected' : '' }}>
                                Approved
                            </option>

                            <option value="rejected"
                                {{ $claim->status == 'rejected' ? 'selected' : '' }}>
                                Rejected
                            </option>

                            <option value="completed"
                                {{ $claim->status == 'completed' ? 'selected' : '' }}>
                                Completed
                            </option>

                        </select>

                    </div>

                    <div class="mt-6">

                        <button
                            type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            Update Status
                        </button>

                        <a href="{{ route('admin.claims') }}"
                            class="ml-2 bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                            Cancel
                        </a>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>