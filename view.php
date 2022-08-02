<?php
require_once('./models/Survey.php');
$survey = new Survey();
?>
<?php include './partials/header.php'; ?>
<section>
    <div>
        <div class="bg-white shadow p-2 rounded mb-5 flex justify-between">
            <h4 class="mx-2 font-bold text-xl text-gray-600">View</h4>
            <a href="edit-survey.php?active=surveys&id=<?= $_GET['id'] ?>" class="bg-yellow-500 text-sm text-white px-2 py-1 rounded hover:bg-yellow-400 flex items-center gap-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                <span class="hidden md:block">Edit</span>
            </a>
        </div>

        <div class="grid grid-cols-2 gap-2 md:grid-cols-4 md:gap-4 bg-white shadow p-2 rounded">

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">Barangay / Purok</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">HH No.</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">Family A/B/C/D</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">Miyembro ng HH [dami]</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">Kompletong Address</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">Household Head</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">Birthday</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">Bday</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">Edad</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">Nag-aral</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">Level</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">Trabaho</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">Buwanang Sahod</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">PhilHealth Member</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">May Disability</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">Anong Disability</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">Kasarian</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

        </div>

        <hr class="w-40 h-3 bg-green-600 my-5">

        <div class="grid grid-cols-2 gap-2 md:grid-cols-4 md:gap-4 bg-white shadow p-2 rounded mt-3">

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">Asawa</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">Birthday</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">Edad</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">Nag Aral</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">Level</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">Trabaho</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">Buwanang Sahod</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">PhilHealth Member</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">Buntis</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">Age of Gestatopm</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">LMP</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">EDC</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">Nagpapasuso</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">Gumagamit ng Family Planning Method</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">Anong Method</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">My Disability</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">Anong Disability</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

        </div>

        <hr class="w-40 h-3 bg-green-600 my-5 hidden md:block">

        <div class="bg-white shadow p-2 rounded mt-3 hidden md:block">
            <div class="w-full">
                <table class="table-auto text-xs">
                    <thead class="text-cemter">
                        <tr>
                            <th>Type</th>
                            <th>Pangalan</th>
                            <th>Kapanganakan</th>
                            <th>Edad</th>
                            <th>Nagaaral / Grade</th>
                            <th>Trabaho/Buwanang Sahod</th>
                            <th>Sumususo sa Ina</th>
                            <th>Dumedede sa Bote</th>
                            <th>Mixed Feeding</th>
                            <th>Miyembro ng PhilHealth</th>
                            <th>May Disability / Disability</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr>
                            <th>Anak</th>
                            <td>Crismon F. Tiangco</td>
                            <td>01/01/1991</td>
                            <td>23</td>
                            <td>Y / HS</td>
                            <td>Y/120,000</td>
                            <td>Y</td>
                            <td>Y</td>
                            <td>Y</td>
                            <td>Y</td>
                            <td>Y</td>
                        </tr>
                        <tr>
                            <th>Anak</th>
                            <td>Crismon F. Tiangco</td>
                            <td>01/01/1991</td>
                            <td>23</td>
                            <td>Y / HS</td>
                            <td>Y/120,000</td>
                            <td>Y</td>
                            <td>Y</td>
                            <td>Y</td>
                            <td>Y</td>
                            <td>Y</td>
                        </tr>
                        <tr>
                            <th>Anak</th>
                            <td>Crismon F. Tiangco</td>
                            <td>01/01/1991</td>
                            <td>23</td>
                            <td>Y / HS</td>
                            <td>Y/120,000</td>
                            <td>Y</td>
                            <td>Y</td>
                            <td>Y</td>
                            <td>Y</td>
                            <td>Y</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <hr class="w-40 h-3 bg-green-600 my-5">

        <div class="grid grid-cols-2 gap-2 md:grid-cols-4 md:gap-4 bg-white shadow p-2 rounded mt-3">

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">Toilet Type</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">Dwelling Unit</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">Water Source</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">Meron Vagetable Garden</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">Nag-aalaga ng Hayop</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

            <div class="flex flex-col">
                <p class="text-xs text-gray-400">Anu-anong Hayop</p>
                <p class="font-semibold text-lg text-gray-800">value</p>
            </div>

        </div>


    </div>
</section>
<?php include './partials/footer.php'; ?>