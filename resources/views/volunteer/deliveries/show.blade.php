<x-app-layout>

    <div class="min-h-screen bg-slate-50">

        <!-- Header -->
        <div class="border-b border-slate-200 bg-white">
            <div class="mx-auto max-w-7xl px-6 py-6">

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <p class="text-sm font-medium text-emerald-600">
                            Volunteer Portal
                        </p>

                        <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-900">
                            Delivery #{{ $delivery->id }}
                        </h1>

                        <p class="mt-2 text-sm text-slate-500">
                            Review the delivery details and manage its progress.
                        </p>
                    </div>

                    <a href="{{ route('volunteer.deliveries.index') }}">
                       class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                        ← Back to Deliveries
                    </a>

                </div>

            </div>
        </div>


        <main class="mx-auto max-w-7xl px-6 py-8">


            <!-- Flash Messages -->
            @if(session('success'))

                <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-800">
                    {{ session('success') }}
                </div>

            @endif


            @if(session('error'))

                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm font-medium text-red-800">
                    {{ session('error') }}
                </div>

            @endif


            <!-- Validation Errors -->
            @if($errors->any())

                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4">

                    <p class="text-sm font-semibold text-red-800">
                        Please fix the following:
                    </p>

                    <ul class="mt-2 list-disc pl-5 text-sm text-red-700">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <!-- Status Banner -->
            <div class="mb-8 overflow-hidden rounded-2xl bg-gradient-to-r from-emerald-600 to-teal-500 p-6 text-white shadow-sm">

                <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                    <div>

                        <p class="text-sm font-semibold text-emerald-100">
                            DELIVERY STATUS
                        </p>

                        @php
                            $statusLabel = match ($delivery->status) {
                                'pending' => 'Waiting for Volunteer',
                                'accepted' => 'Accepted',
                                'picked_up' => 'Picked Up',
                                'delivered' => 'Delivered',
                                default => ucfirst($delivery->status),
                            };
                        @endphp

                        <h2 class="mt-1 text-2xl font-bold">
                            {{ $statusLabel }}
                        </h2>

                    </div>


                    <div class="rounded-2xl bg-white/10 px-5 py-4 text-center backdrop-blur-sm">

                        <p class="text-2xl font-bold">
                            #{{ $delivery->id }}
                        </p>

                        <p class="mt-1 text-xs text-emerald-100">
                            Delivery ID
                        </p>

                    </div>

                </div>

            </div>


            <!-- Progress -->
            <div class="mb-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <h2 class="text-lg font-bold text-slate-900">
                    Delivery Progress
                </h2>

                <div class="mt-7 grid grid-cols-4 gap-2">

                    @php
                        $steps = [
                            'pending' => 'Pending',
                            'accepted' => 'Accepted',
                            'picked_up' => 'Picked Up',
                            'delivered' => 'Delivered',
                        ];

                        $statusOrder = [
                            'pending' => 1,
                            'accepted' => 2,
                            'picked_up' => 3,
                            'delivered' => 4,
                        ];

                        $currentStep = $statusOrder[$delivery->status] ?? 1;
                    @endphp


                    @foreach($steps as $key => $label)

                        @php
                            $stepNumber = $statusOrder[$key];

                            $isCompleted = $stepNumber <= $currentStep;

                            $circleClass = $isCompleted
                                ? 'bg-emerald-600 text-white'
                                : 'bg-slate-100 text-slate-400';

                            $textClass = $isCompleted
                                ? 'text-emerald-700'
                                : 'text-slate-400';
                        @endphp

                        <div class="text-center">

                            <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full text-sm font-bold {{ $circleClass }}">
                                {{ $stepNumber }}
                            </div>

                            <p class="mt-2 text-xs font-semibold {{ $textClass }}">
                                {{ $label }}
                            </p>

                        </div>

                    @endforeach

                </div>

            </div>


            <div class="grid gap-8 lg:grid-cols-3">


                <!-- Left -->
                <div class="space-y-8 lg:col-span-2">


                    <!-- Food Information -->
                    <section class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                        <div class="border-b border-slate-100 px-6 py-5">

                            <h2 class="text-lg font-bold text-slate-900">
                                Food Information
                            </h2>

                        </div>


                        <div class="grid gap-4 p-6 sm:grid-cols-2">

                            <div class="rounded-xl bg-slate-50 p-4">

                                <p class="text-xs font-medium text-slate-400">
                                    Food
                                </p>

                                <p class="mt-1 font-semibold text-slate-900">
                                    {{ $delivery->claim?->foodDonation?->title ?? 'Food Donation' }}
                                </p>

                            </div>


                            <div class="rounded-xl bg-slate-50 p-4">

                                <p class="text-xs font-medium text-slate-400">
                                    Category
                                </p>

                                <p class="mt-1 font-semibold text-slate-900">
                                    {{ $delivery->claim?->foodDonation?->category?->name ?? 'N/A' }}
                                </p>

                            </div>


                            <div class="rounded-xl bg-slate-50 p-4">

                                <p class="text-xs font-medium text-slate-400">
                                    Donor
                                </p>

                                <p class="mt-1 font-semibold text-slate-900">
                                    {{ $delivery->claim?->foodDonation?->donor?->name ?? 'N/A' }}
                                </p>

                            </div>


                            <div class="rounded-xl bg-slate-50 p-4">

                                <p class="text-xs font-medium text-slate-400">
                                    Quantity
                                </p>

                                <p class="mt-1 font-semibold text-slate-900">
                                    {{ $delivery->claim?->foodDonation?->quantity ?? 'N/A' }}
                                </p>

                            </div>

                        </div>

                    </section>


                    <!-- Receiver Information -->
                    <section class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                        <div class="border-b border-slate-100 px-6 py-5">

                            <h2 class="text-lg font-bold text-slate-900">
                                Receiver Information
                            </h2>

                        </div>


                        <div class="p-6">

                            <div class="grid gap-4 sm:grid-cols-2">

                                <div class="rounded-xl bg-slate-50 p-4">

                                    <p class="text-xs font-medium text-slate-400">
                                        Receiver
                                    </p>

                                    <p class="mt-1 font-semibold text-slate-900">
                                        {{ $delivery->claim?->receiver?->name ?? 'N/A' }}
                                    </p>

                                </div>


                                <div class="rounded-xl bg-slate-50 p-4">

                                    <p class="text-xs font-medium text-slate-400">
                                        Email
                                    </p>

                                    <p class="mt-1 break-all font-semibold text-slate-900">
                                        {{ $delivery->claim?->receiver?->email ?? 'N/A' }}
                                    </p>

                                </div>

                            </div>

                        </div>

                    </section>


                    <!-- Delivery Timeline -->
                    <section class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                        <div class="border-b border-slate-100 px-6 py-5">

                            <h2 class="text-lg font-bold text-slate-900">
                                Delivery Timeline
                            </h2>

                        </div>


                        <div class="space-y-6 p-6">

                            <div class="flex gap-4">

                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-slate-100 text-slate-600">
                                    ✓
                                </div>

                                <div>

                                    <p class="font-semibold text-slate-900">
                                        Delivery Created
                                    </p>

                                    <p class="mt-1 text-sm text-slate-500">
                                        {{ $delivery->created_at?->format('d M Y, h:i A') ?? 'N/A' }}
                                    </p>

                                </div>

                            </div>


                            @if($delivery->accepted_at)

                                <div class="flex gap-4">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-50 text-blue-600">
                                        ✓
                                    </div>

                                    <div>

                                        <p class="font-semibold text-slate-900">
                                            Delivery Accepted
                                        </p>

                                        <p class="mt-1 text-sm text-slate-500">
                                            {{ $delivery->accepted_at->format('d M Y, h:i A') }}
                                        </p>

                                    </div>

                                </div>

                            @endif


                            @if($delivery->picked_up_at)

                                <div class="flex gap-4">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-amber-50 text-amber-600">
                                        ✓
                                    </div>

                                    <div>

                                        <p class="font-semibold text-slate-900">
                                            Food Picked Up
                                        </p>

                                        <p class="mt-1 text-sm text-slate-500">
                                            {{ $delivery->picked_up_at->format('d M Y, h:i A') }}
                                        </p>

                                    </div>

                                </div>

                            @endif


                            @if($delivery->delivered_at)

                                <div class="flex gap-4">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-green-50 text-green-600">
                                        ✓
                                    </div>

                                    <div>

                                        <p class="font-semibold text-slate-900">
                                            Delivery Completed
                                        </p>

                                        <p class="mt-1 text-sm text-slate-500">
                                            {{ $delivery->delivered_at->format('d M Y, h:i A') }}
                                        </p>

                                    </div>

                                </div>

                            @endif

                        </div>

                    </section>


                    <!-- Existing Proof -->
                    @if($delivery->deliveryProof)

                        <section class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                            <div class="border-b border-slate-100 px-6 py-5">

                                <h2 class="text-lg font-bold text-slate-900">
                                    Delivery Proof
                                </h2>

                            </div>


                            <div class="p-6">

                                <img src="{{ Storage::url($delivery->deliveryProof->proof_image) }}"
                                     alt="Delivery proof"
                                     class="max-h-[500px] w-full rounded-2xl object-cover shadow-sm">


                                @if($delivery->deliveryProof->notes)

                                    <div class="mt-4 rounded-xl bg-slate-50 p-4">

                                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                            Volunteer Notes
                                        </p>

                                        <p class="mt-2 text-sm leading-6 text-slate-700">
                                            {{ $delivery->deliveryProof->notes }}
                                        </p>

                                    </div>

                                @endif

                            </div>

                        </section>

                    @endif

                </div>


                <!-- Right -->
                <div class="space-y-8">


                    <!-- Action Card -->
                    <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                        <h2 class="text-lg font-bold text-slate-900">
                            Delivery Actions
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Manage this delivery from here.
                        </p>


                        @if($isAvailable)

                            <form method="POST"
                                  action="{{ route('volunteer.deliveries.accept', $delivery) }}"
                                  class="mt-6">

                                @csrf

                                <button type="submit"
                                        class="w-full rounded-xl bg-emerald-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-emerald-700">
                                    Accept Delivery
                                </button>

                            </form>


                        @elseif($isOwner && $delivery->status === 'accepted')

                            <form method="POST"
                                  action="{{ route('volunteer.deliveries.status', $delivery) }}"
                                  class="mt-6">

                                @csrf
                                @method('PATCH')

                                <input type="hidden"
                                       name="status"
                                       value="picked_up">

                                <button type="submit"
                                        class="w-full rounded-xl bg-amber-500 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-amber-600">
                                    Mark as Picked Up
                                </button>

                            </form>


                        @elseif($isOwner && $delivery->status === 'picked_up')

                            <form method="POST"
                                  action="{{ route('volunteer.deliveries.status', $delivery) }}"
                                  class="mt-6">

                                @csrf
                                @method('PATCH')

                                <input type="hidden"
                                       name="status"
                                       value="delivered">

                                <button type="submit"
                                        class="w-full rounded-xl bg-emerald-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-emerald-700">
                                    Mark as Delivered
                                </button>

                            </form>


                        @elseif($delivery->status === 'delivered')

                            <div class="mt-6 rounded-xl bg-green-50 p-4 text-center">

                                <p class="font-semibold text-green-800">
                                    Delivery Completed ✓
                                </p>

                                <p class="mt-1 text-xs text-green-600">
                                    This delivery has been successfully completed.
                                </p>

                            </div>

                        @else

                            <div class="mt-6 rounded-xl bg-slate-50 p-4 text-center">

                                <p class="text-sm font-medium text-slate-600">
                                    No action available.
                                </p>

                            </div>

                        @endif

                    </section>


                    <!-- Proof Upload -->
                    @if($isOwner && $delivery->status === 'delivered')

                        <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                            <h2 class="text-lg font-bold text-slate-900">
                                Upload Delivery Proof
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                Upload a photo confirming successful delivery.
                            </p>


                            <form method="POST"
                                  action="{{ route('volunteer.deliveries.proof', $delivery) }}"
                                  enctype="multipart/form-data"
                                  class="mt-6 space-y-5">

                                @csrf


                                <div>

                                    <label for="proof_image"
                                           class="block text-sm font-semibold text-slate-700">
                                        Proof Image
                                    </label>

                                    <input type="file"
                                           name="proof_image"
                                           id="proof_image"
                                           accept="image/jpeg,image/png,image/webp"
                                           required
                                           class="mt-2 block w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-3 text-sm text-slate-600 file:mr-4 file:rounded-lg file:border-0 file:bg-emerald-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-emerald-700 hover:file:bg-emerald-100">

                                    <p class="mt-2 text-xs text-slate-400">
                                        JPG, PNG or WEBP. Maximum size: 4MB.
                                    </p>

                                </div>


                                <div>

                                    <label for="notes"
                                           class="block text-sm font-semibold text-slate-700">
                                        Notes
                                    </label>

                                    <textarea name="notes"
                                              id="notes"
                                              rows="4"
                                              placeholder="Add any useful delivery notes..."
                                              class="mt-2 block w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">{{ old('notes') }}</textarea>

                                </div>


                                <button type="submit"
                                        class="w-full rounded-xl bg-slate-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-slate-800">
                                    Upload Proof
                                </button>

                            </form>

                        </section>

                    @endif


                    <!-- Delivery Info -->
                    <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                        <h2 class="text-lg font-bold text-slate-900">
                            Delivery Information
                        </h2>


                        <div class="mt-5 space-y-4">

                            <div>
                                <p class="text-xs font-medium text-slate-400">
                                    Delivery ID
                                </p>

                                <p class="mt-1 text-sm font-semibold text-slate-800">
                                    #{{ $delivery->id }}
                                </p>
                            </div>


                            <div>
                                <p class="text-xs font-medium text-slate-400">
                                    Claim ID
                                </p>

                                <p class="mt-1 text-sm font-semibold text-slate-800">
                                    #{{ $delivery->claim_id }}
                                </p>
                            </div>


                            <div>
                                <p class="text-xs font-medium text-slate-400">
                                    Assigned Volunteer
                                </p>

                                <p class="mt-1 text-sm font-semibold text-slate-800">
                                    {{ $delivery->volunteer?->name ?? 'Not assigned' }}
                                </p>
                            </div>

                        </div>

                    </section>

                </div>

            </div>

        </main>

    </div>

</x-app-layout>