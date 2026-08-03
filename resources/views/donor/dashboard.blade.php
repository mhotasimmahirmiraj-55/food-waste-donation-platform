<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Donor Dashboard
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <!-- Welcome -->
            <div class="bg-white shadow rounded-lg p-6 mb-6">

                <h3 class="text-3xl font-bold">
                    Welcome Donor!
                </h3>

                <p class="text-gray-600 mt-2">
                    You are logged in as Donor.
                </p>

            </div>



            <!-- Cards -->

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">


                <!-- Donate Food -->

                <div class="bg-white shadow rounded-lg p-6">

                    <h3 class="text-xl font-bold mb-2">
                        Donate Food
                    </h3>

                    <p class="text-gray-600 mb-4">
                        Share extra food with people who need it.
                    </p>


                    <a href="{{ route('donations.create') }}"
                       class="block text-center bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700">

                        Donate Now

                    </a>

                </div>



                <!-- My Donations -->

                <div class="bg-white shadow rounded-lg p-6">

                    <h3 class="text-xl font-bold mb-2">
                        My Donations
                    </h3>

                    <p class="text-gray-600 mb-4">
                        View and manage your donated food.
                    </p>


                    <a href="{{ route('donations.index') }}"
                      class="block text-center bg-green-600 text-white py-3 rounded-lg hover:bg-green-700">

                         View Donations

                    </a>

                </div>



                <!-- Edit Donations -->

               <div class="bg-white shadow rounded-lg p-6">

                  <h3 class="text-xl font-bold mb-2">
                      Edit Donations
                  </h3>

                 <p class="text-gray-600 mb-4">
                     Edit your previous food donations.
                 </p>


               <a href="{{ route('donations.edit.list') }}"
                        class="block text-center bg-yellow-500 text-black py-3 rounded-lg hover:bg-yellow-600">

                          Edit Donations

                </a>
                
                  </div>
                    <div class="bg-white shadow rounded-lg p-6">

                <h3 class="text-xl font-bold mb-2">
                    Delete Donations
                </h3>

              <p class="text-gray-600 mb-4">
                    Delete your available food donations.
                </p>

                <a href="{{ route('donations.delete.list') }}"
                   class="block text-center bg-red-600 text-white py-3 rounded-lg hover:bg-red-700">

                         Delete Donations

                       </a>

                        </div>


            </div>


        </div>

    </div>


</x-app-layout>