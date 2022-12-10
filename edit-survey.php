<?php
session_start();
require_once(dirname(__FILE__) . '/func/helpers.php');
require_once(dirname(__FILE__) . '/models/Survey.php');
$required = true;

$survey = new Survey();

$data = "";

if (isset($_GET['id']) && $_GET['id']) {
    $data = $survey->getById($_GET['id']);
    // print_r($data);
}

if (isset($_POST['update'])) {
    $survey = new Survey();

    $values = [
        'purok' => $_POST['purok'],
        'hh_no' => $_POST['hh_no'],
        'family_type' => $_POST['family_type'],
        'family_members' => $_POST['family_members'],
        'complete_address' => $_POST['complete_address'],
        'household_head' => $_POST['household_head'],
        'household_head_birthday' => $_POST['household_head_birthday'],
        'household_head_student' => $_POST['household_head_student'],
        'household_head_student_grade' => $_POST['household_head_student_grade'] ?? '',
        'household_head_occupation' => $_POST['household_head_occupation'],
        'household_head_salary' => $_POST['household_head_salary'] ?? '',
        'household_head_occupation_other' => $_POST['household_head_occupation_other'] ?? '',
        'household_head_philhealth_member' => $_POST['household_head_philhealth_member'],
        'household_head_disability' => $_POST['household_head_disability'],
        'household_head_disability_type' => $_POST['household_head_disability_type'] ?? '',
        'household_head_gender' => $_POST['household_head_gender'],
        'partner_name' => $_POST['partner_name'],
        'partner_gender' => $_POST['partner_gender'],
        'partner_birthday' => $_POST['partner_birthday'],
        'partner_student' => $_POST['partner_student'],
        'partner_grade' => $_POST['partner_grade'] ?? '',
        'partner_occupation' => $_POST['partner_occupation'],
        'partner_occupation_other' => $_POST['partner_occupation_other'] ?? '',
        'partner_salary' => $_POST['partner_salary'] ?? '',
        'partner_philhealth_member' => $_POST['partner_philhealth_member'],
        'partner_pregnant' => $_POST['partner_pregnant'],
        'partner_age_of_gestation' => $_POST['partner_age_of_gestation'],
        'disability' => $_POST['disability'],
        'disability_type' => $_POST['disability_type'] ?? '',
        'lmp' => $_POST['lmp'],
        'edc' => $_POST['edc'],
        'breast_feeding' => $_POST['breast_feeding'],
        'family_planning_method' => $_POST['family_planning_method'],
        'family_planning_methodtype' => $_POST['family_planning_methodtype'] ?? '',
        'civil_status' => $_POST['civil_status'] ?? '',
        'id' => $_POST['id']
    ];


    $result = $survey->update($values);

    if ($result) {

        if($_FILES['picture']['name']) {
            $target_dir = "public/images/";
            $fileName = $_FILES['picture']['name'];
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);;
            $uploadPath = $target_dir . uniqid() . '.' . $fileExtension;
            $fileTmpName  = $_FILES['picture']['tmp_name'];
            $survey->updatePicture($_POST['id'],$uploadPath);
            move_uploaded_file($fileTmpName, $uploadPath); 
        }

        header('Location: members.php?id=' . $_POST['id']);
    }
}

?>
<?php include './partials/header.php'; ?>


<section>
    <div class="h-12 w-full bg-yellow-600 text-white shadow rounded flex justify-between items-center">
        <h4 class="mx-5 font-semibold text-xl">Update Survey Form</h4>
    </div>
</section>

<section x-data="{
    householdHeadDisability:'<?= $data->household_head_disability ?>',
    householdHeadDisabilityLogic:true,
    householdHeadDisabilityText:'<?= $data->household_head_disability_type ?>',
    householdHeadOccupation:'<?= $data->household_head_occupation ?>',
    partnerOccupation:'<?= $data->partner_occupation ?>',
    disability:'<?= $data->disability ?>',
    disabilityText:'<?= $data->disability_type ?>',
    partnerGender:'<?= $data->partner_gender ?>',
    houseHoldHeadStudent:'<?= $data->household_head_student ?>',
    partnerStudent:'<?= $data->partner_student?>',
    familyPlanningMethod:'<?= $data->family_planning_method ?>',
    familyPlanningMethodText:'<?= $data->family_planning_methodtype ?>',
    householdHeadGender:'<?= $data->household_head_gender ?>',
    householdHeadPhilhealthMember:'<?= $data->household_head_philhealth_member ?>',
    partnerPhilhealthMember:'<?= $data->partner_philhealth_member ?>',
    partnerPregnant:'<?= $data->partner_pregnant ?>',
    partnerBreastFeeding:'<?= $data->breast_feeding ?>',
    civilStatus:'<?= $data->civil_status ?>',
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
    handlePartnerOccupationChange() {
        console.log(this.partnerOccupation);
    },
    handleDisabilityChange() {
        this.disabilityText = '';
    },
    handleChangePartnerGender() {
        console.log(this.partnerGender);
    },
    handleFamilyPlanningMethodChange() {
        this.familyPlanningMethodText = '';
    },
    handleChangeHouseholdGender() {
        if(this.householdHeadGender === 'm') {
            this.partnerGender = 'f';
        } else {
            this.partnerGender = 'm';
        }
    }
}">
    <div class="h-auto w-full bg-white shadow rounded mt-5 mb-20">
        <form action="<?= $_SERVER['PHP_SELF'] ?>?id=<?= $_GET['id'] ?>" method="POST" onsubmit="return confirm('Are you sure you want to Submit?');" enctype="multipart/form-data">
            <div class="p-3">
                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">

                <!-- ============= ROW 1 ================ -->
                <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">
                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="purok">Barangay / Purok</label>
                        <input type="text" value="<?= $data->purok ?>" name="purok" id="purok" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" required>
                    </div>

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="hh_no">HH No.</label>
                        <input type="text" value="<?= $data->hh_no ?>" name="hh_no" id="hh_no" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" required>
                    </div>

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="family_type">Family</label>
                        <select name="family_type" id="family_type" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" required>
                            <?php foreach ($familTypes as $key => $value) : ?>
                                <option value="<?= $value ?>" <?= $data->family_type == $value ? 'selected':''?> ><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">
                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="family_members">Miyembro ng HH [dami]</label>
                        <input type="number" value="<?= $data->family_members ?>" name="family_members" id="family_members" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" required>
                    </div>

                    <div class="flex flex-col gap-y-2 mb-3 col-span-2">
                        <label for="complete_address">Kompletong Address</label>
                        <input type="text" value="<?= $data->complete_address ?>" name="complete_address" id="complete_address" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="household_head">Household Head</label>
                        <input type="text" value="<?= $data->household_head ?>" name="household_head" id="household_head" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" required>
                    </div>

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="household_head_birthday">Birthday</label>
                        <input type="date" value="<?= $data->household_head_birthday ?>" name="household_head_birthday" id="household_head_birthday" max="<?= date('Y-m-d'); ?>" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" required>
                    </div>

                </div>

                <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="household_head_student">Nag-aral</label>
                        <div class="flex gap-x-3 py-2 px-2 shadow rounded">
                            <div>
                                <label for="household_head_student_y">Yes</label>
                                <input type="radio" name="household_head_student" id="household_head_student_y" x-model="houseHoldHeadStudent" value="y" checked="checked">
                            </div>
                            <div>
                                <label for="household_head_student_n">No</label>
                                <input type="radio" name="household_head_student" id="household_head_student_n" x-model="houseHoldHeadStudent" value="n" >
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-y-2 mb-3" x-show="houseHoldHeadStudent === 'y'">
                        <label for="household_head_student_grade">Grade</label>
                        <select name="household_head_student_grade" id="household_head_student_grade" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" required>
                            <?php foreach ($grades as $key => $value) : ?>
                                <option value="<?= $value ?>" <?= $data->household_head_student_grade == $value ? 'selected':''?>><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="household_head_occupation">Trabaho</label>
                        <select name="household_head_occupation" id="household_head_occupation" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" required x-model="householdHeadOccupation" :change="householdHeadOccupationChange">
                            <?php foreach ($occupations as $key => $value) : ?>
                                <option value="<?= $value ?>" <?= $data->household_head_occupation == $value ? 'selected':''?> ><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>

                <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5" x-show="householdHeadOccupation === 'Other (Please specify)' ">
                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="household_head_occupation_other">Other work, Please specify</label>
                        <input type="text" value="<?= $data->household_head_occupation_other ?>" name="household_head_occupation_other" id="household_head_occupation_other" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white">
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">
                    <div class="flex flex-col gap-y-2 mb-3" x-show="householdHeadOccupation !== 'Unemployed'">
                        <label for="household_head_salary">Buwanang Sahod</label>
                        <select name="household_head_salary" id="household_head_salary" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" x-bind:class="householdHeadOccupation === 'Unemployed' ? 'bg-gray-100 hover:bg-gray-100 hover:cursor-not-allowed':''" x-bind:disabled="householdHeadOccupation === 'Unemployed' " required>
                            <?php foreach ($salaries as $key => $value) : ?>
                                <option value="<?= $value ?>" <?= $data->household_head_salary == $value ? 'selected':''?>><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="household_head_philhealth_member">Gender</label>
                        <div class="flex gap-x-3 py-2 px-2 shadow rounded">
                            <div>
                                <label for="household_head_gender">Male</label>
                                <input type="radio" name="household_head_gender" x-model="householdHeadGender" id="household_head_gender_y" value="m" checked="checked"  @change="handleChangeHouseholdGender()">
                            </div>
                            <div>
                                <label for="household_head_disability_n">Female</label>
                                <input type="radio" name="household_head_gender" x-model="householdHeadGender" id="household_head_gender_n" value="f"  @change="handleChangeHouseholdGender()">
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="partner_occupation">Civil Status</label>
                        <select name="civil_status" id="civil_status" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?> x-model="civilStatus">
                            <?php foreach ($civilStatus as $key => $value) : ?>
                                <option value="<?= $value ?>"><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="household_head_philhealth_member">Philhealth Member</label>
                        <div class="flex gap-x-3 py-2 px-2 shadow rounded">
                            <div>
                                <label for="household_head_disability_y">Yes</label>
                                <input type="radio" name="household_head_philhealth_member" x-model="householdHeadPhilhealthMember" id="household_head_philhealth_member_y" value="y">
                            </div>
                            <div>
                                <label for="household_head_disability_n">No</label>
                                <input type="radio" name="household_head_philhealth_member" x-model="householdHeadPhilhealthMember" id="household_head_philhealth_member_n" value="n" checked="checked">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">
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
                    
                    <div class="flex flex-col gap-y-2 mb-3" x-show="householdHeadDisability === 'y'">
                        <label for="household_head_disability_type">Anong Disability</label>
                        <input type="text" name="household_head_disability_type" id="household_head_disability_type" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" x-model="householdHeadDisabilityText">
                    </div>

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="household_head_disability_type">Picture</label>
                        <input type="file" accept="image/png, image/gif, image/jpeg" name="picture" id="picture" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white">
                    </div>

                </div>

                <!-- ============= END ROW 1 ================ -->
                <div x-show="civilStatus !== 'Single' " x-init="console.log('civil status',civilStatus)">
                    <hr class="w-40 h-3 bg-yellow-600 my-5">

                    <!-- ============= ROW 2 ================ -->

                    <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                        <div class="flex flex-col gap-y-2 mb-3">
                            <label for="partner_name">Asawa</label>
                            <input type="text" value="<?= $data->partner_name ?>" name="partner_name" id="partner_name" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white">
                        </div>

                        <div class="flex flex-col gap-y-2 mb-3">
                            <label for="partner_birthday">Birthday</label>
                            <input type="date" value="<?= $data->partner_birthday ?>" name="partner_birthday" id="partner_birthday" max="<?= date('Y-m-d'); ?>" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white">
                        </div>

                    </div>

                    <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                        <div class="flex flex-col gap-y-2 mb-3">
                            <label for="partner_student">Nag-aral</label>
                            <div class="flex gap-x-3 py-2 px-2 shadow rounded">
                                <div>
                                    <label for="partner_student_y">Yes</label>
                                    <input type="radio" name="partner_student" id="partner_student_y" value="y" x-model="partnerStudent">
                                </div>
                                <div>
                                    <label for="partner_student_n">No</label>
                                    <input type="radio" name="partner_student" id="partner_student_n" value="n" checked="checked" x-model="partnerStudent">
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col gap-y-2 mb-3" x-show="partnerStudent === 'y'">
                            <label for="partner_grade">Grade</label>
                            <select name="partner_grade" id="partner_grade" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                                <?php foreach ($grades as $key => $value) : ?>
                                    <option value="<?= $value ?>" <?= $data->partner_grade == $value ? 'selected':''?> ><?= $value ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="flex flex-col gap-y-2 mb-3">
                            <label for="partner_occupation">Trabaho</label>
                            <select name="partner_occupation" id="partner_occupation" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?> x-model="partnerOccupation" :change="handlePartnerOccupationChange">
                                <?php foreach ($occupations as $key => $value) : ?>
                                    <option value="<?= $value ?>" <?= $data->partner_occupation == $value ? 'selected':''?>><?= $value ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>


                    </div>

                    <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5" x-show="partnerOccupation === 'Other (Please specify)' ">
                        <div class="flex flex-col gap-y-2 mb-3">
                            <label for="partner_occupation_other">Other work, Please specify</label>
                            <input type="text" value="<?= $data->partner_occupation_other ?>" name="partner_occupation_other" id="partner_occupation_other" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">
                        <div class="flex flex-col gap-y-2 mb-3" x-show="partnerOccupation !== 'Unemployed'">
                            <label for="partner_salary">Buwanang Sahod</label>
                            <select name="partner_salary" id="partner_salary" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" x-bind:class="partnerOccupation === 'Unemployed' ? 'bg-gray-100 hover:bg-gray-100 hover:cursor-not-allowed':''" x-bind:disabled="partnerOccupation === 'Unemployed' " <?= $required ? 'required' : '' ?> required>
                                <?php foreach ($salaries as $key => $value) : ?>
                                    <option value="<?= $value ?>" <?= $data->partner_salary == $value ? 'selected':''?>><?= $value ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>          
                    </div>

                    <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                        <div class="flex flex-col gap-y-2 mb-3">
                            <label for="partner_gender">Gender</label>
                            <div class="flex gap-x-3 py-2 px-2 shadow rounded">
                                <div>
                                    <label for="partner_gender_m">Male</label>
                                    <input type="radio" name="partner_gender" id="partner_gender_m" x-model="partnerGender" @change="handleChangePartnerGender()" value="m" checked="checked" disabled>
                                </div>
                                <div>
                                    <label for="partner_gender_f">Female</label>
                                    <input type="radio" name="partner_gender" id="partner_gender_f" x-model="partnerGender" @change="handleChangePartnerGender()" value="f" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col gap-y-2 mb-3">
                            <label for="partner_philhealth_member">Philhealth Member</label>
                            <div class="flex gap-x-3 py-2 px-2 shadow rounded">
                                <div>
                                    <label for="partner_philhealth_member_y">Yes</label>
                                    <input type="radio" x-model="partnerPhilhealthMember" name="partner_philhealth_member" id="partner_philhealth_member_y" value="y">
                                </div>
                                <div>
                                    <label for="partner_philhealth_member_n">No</label>
                                    <input type="radio" x-model="partnerPhilhealthMember" name="partner_philhealth_member" id="partner_philhealth_member_n" value="n" checked="checked">
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
                                    <input type="radio" name="disability" id="disability_y" x-model="disability" @change="handleDisabilityChange()" value="y">
                                </div>
                                <div>
                                    <label for="disability_n">No</label>
                                    <input type="radio" name="disability" id="disability_n" x-model="disability" @change="handleDisabilityChange()" value="n" checked="checked">
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col gap-y-2 mb-3" x-show="disability === 'y'">
                            <label for="disability_type">Anong Disability</label>
                            <input type="text" name="disability_type" id="disability_type" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" x-model="disabilityText">
                        </div>

                    </div>
                </div>

                <!-- ============= END ROW 2 ================ -->

                <!-- ============= ROW 3 ================ -->

                <!-- if female -->
                <div x-show="partnerGender !== 'm' && civilStatus !== 'Single' && householdHeadGender === 'm' ">
                    <hr class="w-40 h-3 bg-yellow-600 my-5">

                    <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                        <div class="flex flex-col gap-y-2 mb-3">
                            <label for="partner_pregnant">Bustis</label>
                            <div class="flex gap-x-3 py-2 px-2 shadow rounded">
                                <div>
                                    <label for="partner_pregnant_y">Yes</label>
                                    <input type="radio" x-model="partnerPregnant" name="partner_pregnant" id="partner_pregnant_y" value="y">
                                </div>
                                <div>
                                    <label for="partner_pregnant_n">No</label>
                                    <input type="radio" x-model="partnerPregnant" name="partner_pregnant" id="partner_pregnant_n" value="n" checked="checked">
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col gap-y-2 mb-3">
                            <label for="partner_age_of_gestation">Age of Gestation</label>
                            <input type="number" value="<?= $data->partner_age_of_gestation ?>" name="partner_age_of_gestation" id="partner_age_of_gestation" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white">
                        </div>

                        <div class="flex flex-col gap-y-2 mb-3">
                            <label for="lmp">LMP</label>
                            <input type="date" value="<?= $data->lmp ?>" name="lmp" id="lmp" max="<?= date('Y-m-d'); ?>" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white">
                        </div>

                    </div>

                    <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                        <div class="flex flex-col gap-y-2 mb-3">
                            <label for="edc">EDC</label>
                            <input type="date" value="<?= $data->edc ?>" name="edc" id="edc" max="<?= date('Y-m-d'); ?>" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white">
                        </div>

                        <div class="flex flex-col gap-y-2 mb-3">
                            <label for="breast_feeding">Nagpapasuso</label>
                            <div class="flex gap-x-3 py-2 px-2 shadow rounded">
                                <div>
                                    <label for="breast_feeding_y">Yes</label>
                                    <input type="radio" x-model="partnerBreastFeeding" name="breast_feeding" id="breast_feeding_y" value="y">
                                </div>
                                <div>
                                    <label for="breast_feeding_n">No</label>
                                    <input type="radio" x-model="partnerBreastFeeding" name="breast_feeding" id="breast_feeding_n" value="n" checked="checked">
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col gap-y-2 mb-3">
                            <label for="family_planning_method">Gumagamit ng Family Planning Method</label>
                            <div class="flex gap-x-3 py-2 px-2 shadow rounded">
                                <div>
                                    <label for="family_planning_method_y">Yes</label>
                                    <input type="radio" name="family_planning_method" id="family_planning_method_y" value="y" x-model="familyPlanningMethod" @change="handleFamilyPlanningMethodChange">
                                </div>
                                <div>
                                    <label for="family_planning_method_n">No</label>
                                    <input type="radio" name="family_planning_method" id="family_planning_method_n" value="n" checked="checked" x-model="familyPlanningMethod" @change="handleFamilyPlanningMethodChange">
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5" x-show="familyPlanningMethod === 'y'">

                        <div class="flex flex-col gap-y-2 mb-3">
                            <label for="family_planning_methodtype">Anong Method</label>
                            <input type="text" name="family_planning_methodtype" id="family_planning_methodtype" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" x-model="familyPlanningMethodText" x-bind:class="familyPlanningMethod === 'n' ? 'bg-gray-100 hover:bg-gray-100 hover:cursor-not-allowed':''" x-bind:disabled="familyPlanningMethod === 'n'" required>
                        </div>

                    </div>

                </div>
                <!-- if female -->

                <!-- ============= END ROW 3 ================ -->
                

                <div class="fixed bottom-0 left-0 right-1 w-screen z-50 p-3 bg-black bg-opacity-25">
                    
                    <button type="submit" name="update" class="bg-yellow-600 text-white py-2 px-5 rounded flex items-center gap-x-1 hover:bg-yellow-400 float-right mr-5 md:mr-10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                        <span>Update Survey</span>
                    </button>

                    <a href="edit-additional.php?active=surveys&id=<?= $data->id ?>" class="bg-gray-600 text-white py-2 px-5 rounded flex items-center gap-x-1 hover:bg-gray-400 float-right mr-5 md:mr-10">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                        <span>Edit Additional Info</span>
                    </a>
                    
                </div>


            </div>
        </form>
    </div>
</section>

<?php include './partials/footer.php'; ?>