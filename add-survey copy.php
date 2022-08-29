<?php
session_start();
require_once(dirname(__FILE__) . '/func/helpers.php');
require_once(dirname(__FILE__) . '/models/Survey.php');
$required = true;

if (isset($_POST['submit'])) {
    $survey = new Survey();
    $result = $survey->create([
        'purok' => $_POST['purok'],
        'hh_no' => $_POST['hh_no'],
        'family_type' => $_POST['family_type'],
        'family_members' => $_POST['family_members'],
        'complete_address' => $_POST['complete_address'],
        'household_head' => $_POST['household_head'],
        'household_head_birthday' => $_POST['household_head_birthday'],
        'household_head_age' => $_POST['household_head_age'],
        'household_head_student' => $_POST['household_head_student'],
        'household_head_student_grade' => $_POST['household_head_student_grade'],
        'household_head_occupation' => $_POST['household_head_occupation'],
        'household_head_salary' => $_POST['household_head_salary'],
        'household_head_philhealth_member' => $_POST['household_head_philhealth_member'],
        'household_head_disability' => $_POST['household_head_disability'],
        'household_head_disability_type' => $_POST['household_head_disability_type'],
        'household_head_gender' => $_POST['household_head_gender'],
        'partner_name' => $_POST['partner_name'],
        'partner_birthday' => $_POST['partner_birthday'],
        'partner_age' => $_POST['partner_age'],
        'partner_student' => $_POST['partner_student'],
        'partner_grade' => $_POST['partner_grade'],
        'partner_occupation' => $_POST['partner_occupation'],
        'partner_salary' => $_POST['partner_salary'],
        'partner_philhealth_member' => $_POST['partner_philhealth_member'],
        'partner_pregnant' => $_POST['partner_pregnant'],
        'partner_age_of_gestation' => $_POST['partner_age_of_gestation'],
        'lmp' => $_POST['lmp'],
        'edc' => $_POST['edc'],
        'breast_feeding' => $_POST['breast_feeding'],
        'family_planning_method' => $_POST['family_planning_method'],
        'family_planning_methodtype' => $_POST['family_planning_methodtype'],
        'disability' => $_POST['disability'],
        'disability_type' => $_POST['disability_type'],
        'toilet_type' => $_POST['toilet_type'],
        'dwelling_unit' => $_POST['dwelling_unit'],
        'water_source' => $_POST['water_source'],
        'vagetable_garden' => $_POST['vagetable_garden'],
        'has_animals' => $_POST['has_animals'],
        'type_of_animals' => $_POST['type_of_animals'],
        'using_iodized_salt' => $_POST['using_iodized_salt'],
        'using_fortified_foods' => $_POST['using_fortified_foods'],
    ]);

    if ($result) {
        header('Location: members.php?active=surveys&id=' . $result->id);
    }
}

?>
<?php include './partials/header.php'; ?>


<section>
    <div class="h-12 w-full bg-green-600 text-white shadow rounded flex justify-between items-center">
        <h4 class="mx-5 font-semibold text-xl text-gray-300">Survey Form - Part 1</h4>
    </div>
</section>

<section x-data="{
    householdHeadDisability:'n',
    householdHeadDisabilityLogic:true,
    householdHeadDisabilityText:'',
    householdHeadOccupation:'Unemployed',
    partnerGender:'f',
    householdHeadChangeDisability() {
        if(this.householdHeadDisability === 'y') {
            this.householdHeadDisabilityLogic = false;
        } else {
            this.householdHeadDisabilityLogic = true;
            this.householdHeadDisabilityText = '';
        }
    },
    householdHeadOccupationChange() {
        console.log(this.householdHeadOccupation);
    },
    handleChangePartnerGender() {
        console.log(this.partnerGender);
    },
}">
    <div class="h-auto w-full bg-white shadow rounded mt-5 mb-20">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" onsubmit="return confirm('Are you sure you want to Submit?');">
            <div class="p-3">

                <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">
                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="purok">Barangay / Purok</label>
                        <input type="text" name="purok" id="purok" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                    </div>

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="hh_no">HH No.</label>
                        <input type="text" name="hh_no" id="hh_no" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                    </div>

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="family_type">Family</label>
                        <select name="family_type" id="family_type" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                            <?php foreach ($familTypes as $key => $value) : ?>
                                <option value="<?= $value ?>"><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">
                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="family_members">Miyembro ng HH [dami]</label>
                        <input type="number" name="family_members" id="family_members" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                    </div>

                    <div class="flex flex-col gap-y-2 mb-3 col-span-2">
                        <label for="complete_address">Kompletong Address</label>
                        <input type="text" name="complete_address" id="complete_address" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="household_head">Household Head</label>
                        <input type="text" name="household_head" id="household_head" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                    </div>

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="household_head_birthday">Birthday</label>
                        <input type="date" name="household_head_birthday" id="household_head_birthday" max="<?= date('Y-m-d'); ?>" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                    </div>

                </div>

                <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="household_head_student">Nag-aral</label>
                        <div class="flex gap-x-3 py-2 px-2 shadow rounded">
                            <div>
                                <label for="household_head_student_y">Yes</label>
                                <input type="radio" name="household_head_student" id="household_head_student_y" value="y">
                            </div>
                            <div>
                                <label for="household_head_student_n">No</label>
                                <input type="radio" name="household_head_student" id="household_head_student_n" value="n" checked="checked">
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="household_head_student_grade">Grade</label>
                        <select name="household_head_student_grade" id="household_head_student_grade" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                            <?php foreach ($grades as $key => $value) : ?>
                                <option value="<?= $value ?>"><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="household_head_occupation">Trabaho</label>
                        <select name="household_head_occupation" id="household_head_occupation" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?> x-model="householdHeadOccupation" :change="householdHeadOccupationChange">
                            <?php foreach ($occupations as $key => $value) : ?>
                                <option value="<?= $value ?>"><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>

                <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5" x-show="householdHeadOccupation === 'Other (Please specify)' ">
                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="household_head_occupation_other">Other work, Please specify</label>
                        <input type="text" name="household_head_occupation_other" id="household_head_occupation_other" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white">
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="household_head_salary">Buwanang Sahod</label>
                        <select name="household_head_salary" id="household_head_salary" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" x-bind:class="householdHeadOccupation === 'Unemployed' ? 'bg-gray-100 hover:bg-gray-100 hover:cursor-not-allowed':''" x-bind:disabled="householdHeadOccupation === 'Unemployed' " <?= $required ? 'required' : '' ?>>
                            <?php foreach ($salaries as $key => $value) : ?>
                                <option value="<?= $value ?>"><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="household_head_philhealth_member">Philhealth Member</label>
                        <div class="flex gap-x-3 py-2 px-2 shadow rounded">
                            <div>
                                <label for="household_head_disability_y">Yes</label>
                                <input type="radio" name="household_head_philhealth_member" id="household_head_philhealth_member_y" value="y">
                            </div>
                            <div>
                                <label for="household_head_disability_n">No</label>
                                <input type="radio" name="household_head_philhealth_member" id="household_head_philhealth_member_n" value="n" checked="checked">
                            </div>
                        </div>
                    </div>


                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="household_head_disability">May Disability</label>
                        <div class="flex gap-x-3 py-2 px-2 shadow rounded">
                            <div>
                                <label for="household_head_disability_y">Yes</label>
                                <input type="radio" name="household_head_disability" id="household_head_disability_y" value="y" x-model="householdHeadDisability" @change="householdHeadChangeDisability()">
                            </div>
                            <div>
                                <label for="household_head_disability_n">No</label>
                                <input type="radio" name="household_head_disability" id="household_head_disability_n" checked="checked" value="n" checked="checked" x-model="householdHeadDisability" @change="householdHeadChangeDisability()">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="household_head_disability_type">Anong Disability</label>
                        <input type="text" name="household_head_disability_type" id="household_head_disability_type" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" x-model="householdHeadDisabilityText" x-bind:class="householdHeadDisabilityLogic ? 'bg-gray-100 hover:bg-gray-100 hover:cursor-not-allowed':''" x-bind:disabled="householdHeadDisabilityLogic">
                    </div>


                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="household_head_philhealth_member">Gender</label>
                        <div class="flex gap-x-3 py-2 px-2 shadow rounded">
                            <div>
                                <label for="household_head_gender">Male</label>
                                <input type="radio" name="household_head_gender" id="household_head_gender_y" value="m" checked="checked">
                            </div>
                            <div>
                                <label for="household_head_disability_n">Female</label>
                                <input type="radio" name="household_head_gender" id="household_head_gender_n" value="f">
                            </div>
                        </div>
                    </div>

                </div>

                <hr class="w-40 h-3 bg-green-600 my-5">

                <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="partner_name">Asawa</label>
                        <input type="text" name="partner_name" id="partner_name" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white">
                    </div>

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="partner_birthday">Birthday</label>
                        <input type="date" name="partner_birthday" id="partner_birthday" max="<?= date('Y-m-d'); ?>" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white">
                    </div>

                </div>

                <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="partner_student">Nag-aral</label>
                        <div class="flex gap-x-3 py-2 px-2 shadow rounded">
                            <div>
                                <label for="partner_student_y">Yes</label>
                                <input type="radio" name="partner_student" id="partner_student_y" value="y">
                            </div>
                            <div>
                                <label for="partner_student_n">No</label>
                                <input type="radio" name="partner_student" id="partner_student_n" value="n" checked="checked">
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="partner_grade">Grade</label>
                        <select name="partner_grade" id="partner_grade" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                            <?php foreach ($grades as $key => $value) : ?>
                                <option value="<?= $value ?>"><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="partner_occupation">Trabaho</label>
                        <select name="partner_occupation" id="partner_occupation" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?> x-model="householdHeadOccupation" :change="householdHeadOccupationChange">
                            <?php foreach ($occupations as $key => $value) : ?>
                                <option value="<?= $value ?>"><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>

                <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="partner_salary">Buwanang Sahod</label>
                        <input type="number" name="partner_salary" name="partner_salary" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white">
                    </div>

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="partner_philhealth_member">Philhealth Member</label>
                        <div class="flex gap-x-3 py-2 px-2 shadow rounded">
                            <div>
                                <label for="partner_philhealth_member_y">Yes</label>
                                <input type="radio" name="partner_philhealth_member" id="partner_philhealth_member_y" value="y">
                            </div>
                            <div>
                                <label for="partner_philhealth_member_n">No</label>
                                <input type="radio" name="partner_philhealth_member" id="partner_philhealth_member_n" value="n" checked="checked">
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="partner_gender">Gender</label>
                        <div class="flex gap-x-3 py-2 px-2 shadow rounded">
                            <div>
                                <label for="partner_gender_m">Male</label>
                                <input type="radio" name="partner_gender" id="partner_gender_m" x-model="partnerGender" @change="handleChangePartnerGender()" value="m" checked="checked">
                            </div>
                            <div>
                                <label for="partner_gender_f">Female</label>
                                <input type="radio" name="partner_gender" id="partner_gender_f" x-model="partnerGender" @change="handleChangePartnerGender()" value="f">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="disability">May Disability</label>
                        <div class="flex gap-x-3 py-2 px-2 shadow rounded">
                            <div>
                                <label for="disability_y">Yes</label>
                                <input type="radio" name="disability" id="disability_y" value="y">
                            </div>
                            <div>
                                <label for="disability_n">No</label>
                                <input type="radio" name="disability" id="disability_n" value="n" checked="checked">
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="disability_type">Anong Disability</label>
                        <input type="text" name="disability_type" id="disability_type" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white">
                    </div>

                </div>

                <!-- if female -->
                <div x-show="partnerGender === 'f' ">
                    <hr class="w-40 h-3 bg-green-600 my-5">

                    <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                        <div class="flex flex-col gap-y-2 mb-3">
                            <label for="partner_pregnant">Bustis</label>
                            <div class="flex gap-x-3 py-2 px-2 shadow rounded">
                                <div>
                                    <label for="partner_pregnant_y">Yes</label>
                                    <input type="radio" name="partner_pregnant" id="partner_pregnant_y" value="y">
                                </div>
                                <div>
                                    <label for="partner_pregnant_n">No</label>
                                    <input type="radio" name="partner_pregnant" id="partner_pregnant_n" value="n" checked="checked">
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col gap-y-2 mb-3">
                            <label for="partner_age_of_gestation">Age of Gestation</label>
                            <input type="number" name="partner_age_of_gestation" id="partner_age_of_gestation" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white">
                        </div>

                        <div class="flex flex-col gap-y-2 mb-3">
                            <label for="lmp">LMP</label>
                            <input type="date" name="lmp" id="lmp" max="<?= date('Y-m-d'); ?>" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white">
                        </div>

                    </div>

                    <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                        <div class="flex flex-col gap-y-2 mb-3">
                            <label for="edc">EDC</label>
                            <input type="date" name="edc" id="edc" max="<?= date('Y-m-d'); ?>" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white">
                        </div>

                        <div class="flex flex-col gap-y-2 mb-3">
                            <label for="breast_feeding">Nagpapasuso</label>
                            <div class="flex gap-x-3 py-2 px-2 shadow rounded">
                                <div>
                                    <label for="breast_feeding_y">Yes</label>
                                    <input type="radio" name="breast_feeding" id="breast_feeding_y" value="y">
                                </div>
                                <div>
                                    <label for="breast_feeding_n">No</label>
                                    <input type="radio" name="breast_feeding" id="breast_feeding_n" value="n" checked="checked">
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col gap-y-2 mb-3">
                            <label for="family_planning_method">Gumagamit ng Family Planning Method</label>
                            <div class="flex gap-x-3 py-2 px-2 shadow rounded">
                                <div>
                                    <label for="family_planning_method_y">Yes</label>
                                    <input type="radio" name="family_planning_method" id="family_planning_method_y" value="y">
                                </div>
                                <div>
                                    <label for="family_planning_method_n">No</label>
                                    <input type="radio" name="family_planning_method" id="family_planning_method_n" value="n" checked="checked">
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                        <div class="flex flex-col gap-y-2 mb-3">
                            <label for="family_planning_methodtype">Anong Method</label>
                            <input type="text" name="family_planning_methodtype" id="family_planning_methodtype" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white">
                        </div>

                        <div class="flex flex-col gap-y-2 mb-3">
                            <label for="disability">May Disability</label>
                            <select name="disability" id="disability" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                                <?php foreach ($yesNo as $key => $value) : ?>
                                    <option value="<?= $value ?>"><?= $value ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="flex flex-col gap-y-2 mb-3">
                            <label for="disability_type">Anong Disability</label>
                            <input type="text" name="disability_type" id="disability_type" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white">
                        </div>

                    </div>

                </div>
                <!-- if female -->

                <hr class="w-40 h-3 bg-green-600 my-5">

                <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="toilet_type">Toilet Type</label>
                        <select name="toilet_type" id="toilet_type" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                            <?php foreach ($toiletTypes as $key => $value) : ?>
                                <option value="<?= $value ?>"><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="dwelling_unit">Dwelling Unit</label>
                        <select name="dwelling_unit" id="dwelling_unit" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                            <?php foreach ($dwellingUnits as $key => $value) : ?>
                                <option value="<?= $value ?>"><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="water_source">Water Source</label>
                        <select name="water_source" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                            <?php foreach ($waterSources as $key => $value) : ?>
                                <option value="<?= $value ?>"><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>

                <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="vagetable_garden">Mayroong Vegetable Garden</label>
                        <select name="vagetable_garden" id="vagetable_garden" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                            <?php foreach ($yesNo as $key => $value) : ?>
                                <option value="<?= $value ?>"><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="using_iodized_salt">Gumagamit ng IODIZED SALT</label>
                        <select name="using_iodized_salt" id="using_iodized_salt" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                            <?php foreach ($yesNo as $key => $value) : ?>
                                <option value="<?= $value ?>"><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>

                <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="has_animals">Nag-aalaga ng Hayop</label>
                        <select name="has_animals" id="has_animals" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                            <?php foreach ($yesNo as $key => $value) : ?>
                                <option value="<?= $value ?>"><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="type_of_animals">Ano-anong uri ng Hayop</label>
                        <input type="text" name="type_of_animals" id="type_of_animals" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white">
                    </div>

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="using_fortified_foods">Gumagamit ng FORTIFIED FOODS with SPShe</label>
                        <select name="using_fortified_foods" id="using_fortified_foods" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                            <?php foreach ($yesNo as $key => $value) : ?>
                                <option value="<?= $value ?>"><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>

                <div class="fixed bottom-0 left-0 right-1 w-screen z-50 p-3 bg-black bg-opacity-25">
                    <button type="submit" name="submit" class="bg-green-600 text-white py-2 px-5 rounded flex items-center gap-x-1 hover:bg-green-400 float-right mr-5 md:mr-10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                        <span>Submit Survey</span>
                    </button>
                </div>


            </div>
        </form>
    </div>
</section>

<?php include './partials/footer.php'; ?>