<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Donations
        </h2>
    </x-slot>


    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="bg-white shadow rounded-lg p-6">

                <h3 class="text-2xl font-bold mb-6">
                    My Food Donations
                </h3>


                @if($donations->count() > 0)

                    <div class="space-y-4">

                        @foreach($donations as $donation)

                            <div class="border rounded-lg p-4">

                                <h4 class="text-xl font-bold">
                                    {{ $donation->title }}
                                </h4>


                                <p class="mt-2">
                                    Quantity:
                                    {{ $donation->quantity }}
                                </p>


                                <p>
                                    Expiry:
                                    {{ $donation->expiry_time }}
                                </p>


                                <p>
                                    Address:
                                    {{ $donation->pickup_address }}
                                </p>


                                <p>
                                    Status:
                                    {{ $donation->status }}
                                </p>


                            </div>

                        @endforeach

                    </div>


                @else

                    <p class="text-gray-600">
                        You have not donated any food yet.
                    </p>


                @endif


            </div>


        </div>

    </div>


</x-app-layout>