<?php
session_start();
require_once('./models/Survey.php');
require_once('./func/helpers.php');
$survey = new Survey();
$data = "";
$hasData = $survey->checkIfUserHasRecord($_SESSION['user_id']);
if ($hasData > 0) {
    $data = $survey->getData($hasData);
}

?>
<?php include './partials/header.php'; ?>
<section>
    <?php if ($data) : ?>
        <div>
            <!-- content -->
            <div class="bg-white shadow p-2 rounded mb-5 flex justify-between">
                <h4 class="mx-2 font-bold text-xl text-gray-600">Survey View</h4>
                <div class="flex gap-x-1">
                    <a href="report.php?user_id=<?= $_GET['id'] ?>" target="_blank" class="bg-red-500 text-sm text-white px-2 py-1 rounded hover:bg-red-400 flex items-center gap-x-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        <span class="hidden md:block">Print Report</span>
                    </a>
                </div>
            </div>

            <?php if($data->picture): ?>
                <div class="bg-white shadow p-2 rounded mb-5 flex justify-center">
                    <img src="<?= $data->picture ?>" width="180">
                </div>
            <?php endif; ?>

            <div class="grid grid-cols-2 gap-2 md:grid-cols-4 md:gap-4 bg-white shadow p-2 rounded">

                <div class="flex flex-col">
                    <p class="text-xs text-gray-400">Barangay / Purok</p>
                    <p class="font-semibold text-lg text-gray-800"><?= $data->purok ?></p>
                </div>

                <div class="flex flex-col">
                    <p class="text-xs text-gray-400">HH No.</p>
                    <p class="font-semibold text-lg text-gray-800"><?= $data->hh_no ?></p>
                </div>

                <div class="flex flex-col">
                    <p class="text-xs text-gray-400">Family A/B/C/D</p>
                    <p class="font-semibold text-lg text-gray-800"><?= $data->family_type ?></p>
                </div>

                <div class="flex flex-col">
                    <p class="text-xs text-gray-400">Miyembro ng HH [dami]</p>
                    <p class="font-semibold text-lg text-gray-800"><?= $data->family_members ?></p>
                </div>

                <div class="flex flex-col">
                    <p class="text-xs text-gray-400">Kompletong Address</p>
                    <p class="font-semibold text-lg text-gray-800"><?= $data->complete_address ?></p>
                </div>

                <div class="flex flex-col">
                    <p class="text-xs text-gray-400">Household Head</p>
                    <p class="font-semibold text-lg text-gray-800"><?= $data->household_head ?></p>
                </div>

                <div class="flex flex-col">
                    <p class="text-xs text-gray-400">Birthday</p>
                    <p class="font-semibold text-lg text-gray-800"><?= dateFormat($data->household_head_birthday) ?></p>
                </div>

                <div class="flex flex-col">
                    <p class="text-xs text-gray-400">Edad</p>
                    <p class="font-semibold text-lg text-gray-800"><?= getAge($data->household_head_birthday) ?></p>
                </div>

                <div class="flex flex-col">
                    <p class="text-xs text-gray-400">Nag-aral</p>
                    <p class="font-semibold text-lg text-gray-800"><?= $data->household_head_student ?></p>
                </div>

                <div class="flex flex-col">
                    <p class="text-xs text-gray-400">Level</p>
                    <p class="font-semibold text-lg text-gray-800"><?= $data->household_head_student_grade ?></p>
                </div>

                <div class="flex flex-col">
                    <p class="text-xs text-gray-400">Trabaho</p>
                    <p class="font-semibold text-lg text-gray-800"><?= $data->household_head_occupation ?></p>
                </div>

                <div class="flex flex-col">
                    <p class="text-xs text-gray-400">Buwanang Sahod</p>
                    <p class="font-semibold text-lg text-gray-800"><?= $data->household_head_salary ?></p>
                </div>

                <div class="flex flex-col">
                    <p class="text-xs text-gray-400">PhilHealth Member</p>
                    <p class="font-semibold text-lg text-gray-800"><?= $data->household_head_philhealth_member ?></p>
                </div>

                <div class="flex flex-col">
                    <p class="text-xs text-gray-400">May Disability</p>
                    <p class="font-semibold text-lg text-gray-800"><?= $data->household_head_disability ?></p>
                </div>

                <div class="flex flex-col">
                    <p class="text-xs text-gray-400">Anong Disability</p>
                    <p class="font-semibold text-lg text-gray-800"><?= $data->household_head_disability_type ?></p>
                </div>

                <div class="flex flex-col">
                    <p class="text-xs text-gray-400">Kasarian</p>
                    <p class="font-semibold text-lg text-gray-800"><?= $data->household_head_gender ?></p>
                </div>

            </div>

            
            
            <?php if($data->partner_name): ?>
                    <hr class="w-40 h-3 bg-green-600 my-5">

                    <div class="grid grid-cols-2 gap-2 md:grid-cols-4 md:gap-4 bg-white shadow p-2 rounded mt-3">

                    <div class="flex flex-col">
                        <p class="text-xs text-gray-400">Asawa</p>
                        <p class="font-semibold text-lg text-gray-800"><?= $data->partner_name ?></p>
                    </div>

                    <div class="flex flex-col">
                        <p class="text-xs text-gray-400">Birthday</p>
                        <p class="font-semibold text-lg text-gray-800"><?= dateFormat($data->partner_birthday) ?></p>
                    </div>

                    <div class="flex flex-col">
                        <p class="text-xs text-gray-400">Edad</p>
                        <p class="font-semibold text-lg text-gray-800"><?= getAge($data->partner_birthday) ?></p>
                    </div>

                    <div class="flex flex-col">
                        <p class="text-xs text-gray-400">Nag Aral</p>
                        <p class="font-semibold text-lg text-gray-800"><?= $data->partner_student ?></p>
                    </div>

                    <div class="flex flex-col">
                        <p class="text-xs text-gray-400">Level</p>
                        <p class="font-semibold text-lg text-gray-800"><?= $data->partner_grade ?></p>
                    </div>

                    <div class="flex flex-col">
                        <p class="text-xs text-gray-400">Trabaho</p>
                        <p class="font-semibold text-lg text-gray-800"><?= $data->partner_occupation ?></p>
                    </div>

                    <div class="flex flex-col">
                        <p class="text-xs text-gray-400">Buwanang Sahod</p>
                        <p class="font-semibold text-lg text-gray-800"><?= $data->partner_salary ?></p>
                    </div>

                    <div class="flex flex-col">
                        <p class="text-xs text-gray-400">PhilHealth Member</p>
                        <p class="font-semibold text-lg text-gray-800"><?= $data->partner_philhealth_member ?></p>
                    </div>

                    <div class="flex flex-col">
                        <p class="text-xs text-gray-400">Buntis</p>
                        <p class="font-semibold text-lg text-gray-800"><?= $data->partner_pregnant ?></p>
                    </div>

                    <div class="flex flex-col">
                        <p class="text-xs text-gray-400">Age of Gestation</p>
                        <p class="font-semibold text-lg text-gray-800"><?= dateFormat($data->partner_age_of_gestation) ?></p>
                    </div>

                    <div class="flex flex-col">
                        <p class="text-xs text-gray-400">LMP</p>
                        <p class="font-semibold text-lg text-gray-800"><?= dateFormat($data->lmp) ?></p>
                    </div>

                    <div class="flex flex-col">
                        <p class="text-xs text-gray-400">EDC</p>
                        <p class="font-semibold text-lg text-gray-800"><?= dateFormat($data->edc) ?></p>
                    </div>

                    <div class="flex flex-col">
                        <p class="text-xs text-gray-400">Nagpapasuso</p>
                        <p class="font-semibold text-lg text-gray-800"><?= $data->breast_feeding ?></p>
                    </div>

                    <div class="flex flex-col">
                        <p class="text-xs text-gray-400">Gumagamit ng Family Planning Method</p>
                        <p class="font-semibold text-lg text-gray-800"><?= $data->family_planning_method ?></p>
                    </div>

                    <div class="flex flex-col">
                        <p class="text-xs text-gray-400">Anong Method</p>
                        <p class="font-semibold text-lg text-gray-800"><?= $data->family_planning_methodtype ?></p>
                    </div>

                    <div class="flex flex-col">
                        <p class="text-xs text-gray-400">My Disability</p>
                        <p class="font-semibold text-lg text-gray-800"><?= $data->disability ?></p>
                    </div>

                    <div class="flex flex-col">
                        <p class="text-xs text-gray-400">Anong Disability</p>
                        <p class="font-semibold text-lg text-gray-800"><?= $data->disability_type ?></p>
                    </div>

                </div>

            <?php endif; ?>

            <div class="flex justify-end my-2">
                    <a href="edit.php?active=myapplication&id=<?= md5($_SESSION['user_id']) ?>" class="bg-yellow-500 text-xs text-white px-2 py-1 rounded hover:bg-yellow-400 flex items-center gap-x-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        <span class="hidden md:block">Edit Survey</span>
                    </a>
            </div>
    
            <?php if (property_exists($data, 'members')) : ?>
                <hr class="w-40 h-3 bg-green-600 my-5 hidden md:block">
                <div class="bg-white shadow p-2 rounded mt-3 hidden md:block">
                    <div class="w-full">
                        <table class="table-auto text-xs w-full border-collapse border border-slate-400">
                            <thead class="text-cemter">
                                <tr>
                                    <th class="border border-slate-300">Type</th>
                                    <th class="border border-slate-300">Pangalan</th>
                                    <th class="border border-slate-300">Kapanganakan</th>
                                    <th class="border border-slate-300">Edad</th>
                                    <th class="border border-slate-300">Nagaaral / Grade</th>
                                    <th class="border border-slate-300">Trabaho/Buwanang Sahod</th>
                                    <th class="border border-slate-300">Sumususo sa Ina</th>
                                    <th class="border border-slate-300">Dumedede sa Bote</th>
                                    <th class="border border-slate-300">Mixed Feeding</th>
                                    <th class="border border-slate-300">Miyembro ng PhilHealth</th>
                                    <th class="border border-slate-300">May Disability / Disability</th>
                                    <th class="border border-slate-300">4PS Member</th>
                                    <th class="border border-slate-300">Scholar</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php foreach ($data->members as $member) : ?>
                                    <tr>
                                        <td class="border border-slate-300"><?= getRelationship($member->type_id)  ?></td>
                                        <td class="border border-slate-300"><?= $member->lastname ?>, <?= $member->firstname ?> <?= $member->middlename ?></td>
                                        <td class="border border-slate-300"><?= dateFormat($member->birthday) ?></td>
                                        <td class="border border-slate-300"><?= $member->age ?></td>
                                        <td class="border border-slate-300"><?= $member->studying ?>/<?= $member->grade ?></td>
                                        <td class="border border-slate-300"><?= $member->occupation ? $member->occupation : 'N' ?>/<?= $member->salary ?></td>
                                        <td class="border border-slate-300"><?= $member->breast_feeding ?></td>
                                        <td class="border border-slate-300"><?= $member->bottle_feeding ?></td>
                                        <td class="border border-slate-300"><?= $member->mix_feeding ?></td>
                                        <td class="border border-slate-300"><?= $member->philhealth_member ?></td>
                                        <td class="border border-slate-300"><?= $member->disability ?> / <?= $member->disability_type ?></td>
                                        <td class="border border-slate-300"><?= $member->forps_member ?></td>
                                        <td class="border border-slate-300"><?= $member->scholarship_member ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>

            <div class="flex justify-end my-2">
                <a href="members.php?active=surveys&user_id=<?= $_GET['id'] ?>" class="bg-yellow-500 text-xs text-white px-2 py-1 rounded hover:bg-yellow-400 flex items-center gap-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <span class="hidden md:block">Edit Members</span>
                </a>
            </div>

            <hr class="w-40 h-3 bg-green-600 my-5">

            <div class="grid grid-cols-2 gap-2 md:grid-cols-4 md:gap-4 bg-white shadow p-2 rounded mt-3">

                <div class="flex flex-col">
                    <p class="text-xs text-gray-400">Toilet Type</p>
                    <p class="font-semibold text-lg text-gray-800"><?= $data->toilet_type ?></p>
                </div>

                <div class="flex flex-col">
                    <p class="text-xs text-gray-400">Dwelling Unit</p>
                    <p class="font-semibold text-lg text-gray-800"><?= $data->dwelling_unit ?></p>
                </div>

                <div class="flex flex-col">
                    <p class="text-xs text-gray-400">Water Source</p>
                    <p class="font-semibold text-lg text-gray-800"><?= $data->water_source ?></p>
                </div>

                <div class="flex flex-col">
                    <p class="text-xs text-gray-400">Meron Vegetable Garden</p>
                    <p class="font-semibold text-lg text-gray-800"><?= $data->vagetable_garden ?></p>
                </div>

                <div class="flex flex-col">
                    <p class="text-xs text-gray-400">Nag-aalaga ng Hayop</p>
                    <p class="font-semibold text-lg text-gray-800"><?= $data->has_animals ?></p>
                </div>

                <div class="flex flex-col">
                    <p class="text-xs text-gray-400">Anu-anong Hayop</p>
                    <p class="font-semibold text-lg text-gray-800"><?= $data->type_of_animals ?></p>
                </div>

            </div>

            <div class="flex justify-end my-2">
                <a href="additional-info.php?active=myapplication&user_id=<?= md5($_SESSION['user_id']) ?>" class="bg-yellow-500 text-xs text-white px-2 py-1 rounded hover:bg-yellow-400 flex items-center gap-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <span class="hidden md:block">Edit Additonal Info</span>
                </a>
            </div>

        </div> <!-- end content -->
    <?php else : ?>
        <div class="bg-white shadow p-2 rounded mb-5 flex justify-between">
            <h4 class="mx-2 font-bold text-xl text-gray-600">Survey View</h4>
            <div class="flex gap-x-1">
                <a href="new.php" class="bg-green-500 text-sm text-white px-2 py-1 rounded hover:bg-green-400 flex items-center gap-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <span class="hidden md:block">New Survey</span>
                </a>
            </div>
        </div>
    <?php endif; ?>

</section>
<?php include './partials/footer.php'; ?>