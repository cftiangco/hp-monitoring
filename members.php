<?php
    session_start();
    require_once(dirname(__FILE__) . '/func/helpers.php');
    require_once('./models/Survey.php');
    
    $required = false;
    $survey = new Survey();
    
    $surveyId = isset($_GET['id']) && $_GET['id'] ? $_GET['id'] : $survey->getSurveyId($_GET['user_id']);
    $data = $survey->getById($surveyId); 
?>
<?php include './partials/header.php'; ?>

<div x-data="{
    isModalChildrenOpen: false,
    addMember() {
        this.resetFields();
        this.isModalChildrenOpen = true
    },
    editMember() {
        this.isModalChildrenOpen = true
    },
    type_id:'1',
    survey_id:'',
    fullname:'',
    birthday:'',
    age:'',
    studying:'N',
    grade:'',
    occupation:'',
    salary:'',
    breast_feeding:'N',
    bottle_feeding:'N',
    mix_feeding:'N',
    philhealth_member:'N',
    disability:'N',
    disability_type:'',
    sex:'M',
    scholarship_member:'No',
    forps_member:'N',
    errors:[],
    members:[],
    member_id:0,
    init() {
        fetch(`api/members.php?action=fetch&survey_id=${<?= $surveyId ?>}`)
            .then((response) => response.json())
            .then((data) => {
                this.members = data.data;
                console.log(this.members);
            });
    },
    resetFields() {
        this.fullname = '';
        this.birthday = '';
        this.age = '';
        this.studying = 'N';
        this.grade = '';
        this.occupation = '';
        this.salary = '';
        this.breast_feeding = 'N';
        this.bottle_feeding = 'N';
        this.mix_feeding = 'N';
        this.philhealth_member = 'N';
        this.disability = 'N';
        this.disability_type = '';
        this.sex = 'M';
        this.scholarship_member = 'No';
        this.forps_member = 'N';
        this.type_id = 1;
        this.member_id = 0;
    },
    saveChildren() {

        this.errors = [];

        let payload = {
            survey_id:this.survey_id,
            fullname:this.fullname,
            birthday:this.birthday,
            age:this.age,
            studying:this.studying,
            grade:this.grade,
            occupation:this.occupation,
            salary:this.salary,
            breast_feeding:this.breast_feeding,
            bottle_feeding:this.bottle_feeding,
            mix_feeding:this.mix_feeding,
            philhealth_member:this.philhealth_member,
            disability:this.disability,
            disability_type:this.disability_type,
            sex:this.sex,
            scholarship_member:this.scholarship_member,
            forps_member:this.forps_member,
            type_id:this.type_id,
            member_id:this.member_id
        };

        if(this.fullname === '') {
            this.errors.push('Full Name is required');
        }

        if(this.birthday === '') {
            this.errors.push('Birthday is required');
        }

        if(this.age === '') {
            this.errors.push('Age is required');
        }

        if (this.errors.length === 0) { 
            if(this.member_id == 0) {
                postData('api/members.php?action=create', payload)
                .then((data) => {
                    if (data.status === 201) {
                        this.isModalChildrenOpen = false;
                        this.resetFields();
                        alert('Record has been successfully added');
                        this.members = [...this.members,data.data];
                        return;
                    }
                });
            } else {
                console.log('trigger update')
                postData('api/members.php?action=update', payload)
                .then((data) => {
                    this.isModalChildrenOpen = false;
                    this.resetFields();
                    this.members = this.members.filter(member => member.id != data.data.id);
                    this.members = [...this.members,data.data];
                    alert('Record has been successfully updated');
                });
            }
            
        }

    },
    handleEdit(data) {
        console.log(data);
        this.survey_id = data.survey_id;
        this.fullname = data.fullname;
        this.birthday = data.birthday;
        this.age = data.age;
        this.studying = data.studying;
        this.grade = data.grade;
        this.occupation = data.occupation;
        this.salary = data.salary;
        this.breast_feeding = data.breast_feeding;
        this.bottle_feeding = data.bottle_feeding;
        this.mix_feeding = data.mix_feeding;
        this.philhealth_member = data.philhealth_member;
        this.disability = data.disability;
        this.disability_type = data.disability_type;
        this.sex = data.sex;
        this.scholarship_member = data.scholarship_member;
        this.forps_member = data.forps_member;
        this.type_id = data.type_id;
        this.member_id = data.member_id;
        this.editMember();
    },
    handleDelete(id) {
        if (confirm('Are you sure you want to delete this record?') == true) {
            postData(`api/members.php?action=delete&id=${id}`)
                .then((data) => {
                   if(data) {
                        this.members = this.members.filter(member => member.id != data.data);
                        alert('Record has been successfully delete');
                        return;
                   }
                });
        } 
    },
    truncateString(str, num) {
        if (str.length > num) {
            return str.slice(0, num) + '...';
        } else {
            return str;
        }
    }
}">
    <section>
        <div class="h-12 w-full bg-green-600 text-white shadow rounded flex justify-between items-center">
            <h4 class="mx-5 font-semibold text-sm lg:text-xl text-gray-300">Survey Form - Part 2</h4>
            <h4 class="mx-5 font-semibold text-sm lg:text-xl"><?= ucfirst($data->household_head) ?></h4>
        </div>
    </section>

    <section class="mt-5">
        <div class="h-fit w-full bg-white shadow py-5">

            <div class="flex justify-between items-center w-full border-b pb-2">
                <h4 class="mx-5 text-md font-sm-bold md:text-xl">Children / Other Members</h4>
                <div class="flex justify-end mx-5 text-sm">
                    <button type="submit" @click="addMember" class="bg-green-600 text-white py-1 px-3 rounded flex items-center gap-x-1 hover:bg-green-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                        </svg>
                        <span>Add</span>
                    </button>
                </div>
            </div>

            <div class="mx-5  lg:w-full h-screen mt-5 overflow-x-scroll">
                <table class="table-auto w-full text-start text-sm">
                    <thead class="text-left">
                        <tr>
                            <th>Relationship</th>
                            <th>Pangalan</th>
                            <th>Kasarian</th>
                            <th>Kapanganakan</th>
                            <th>4PS Member</th>
                            <th>Scholarship</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="member in members">
                            <tr>
                                <td x-text="member.type_id === 1 ? 'Children':'Other Member'" class="text-xs font-semibold" :class="member.type_id === 1 ? 'text-green-700':'text-red-700'"></td>
                                <td x-text="member.fullname"></td>
                                <td x-text="member.sex"></td>
                                <td x-text="moment(member.birthday).format('MM-DD-YYYY')"></td>
                                <td x-text="member.forps_member"></td>
                                <td x-text="truncateString(member.scholarship_member,15)"></td>
                                <td class="flex gap-x-1">
                                    
                                    <?php if ($isAdmin) : ?>
                                        <button type="button" @click="handleDelete(member.id)" class="bg-red-500 text-sm text-white px-2 py-1 rounded hover:bg-red-400 flex items-center gap-x-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M11 6a3 3 0 11-6 0 3 3 0 016 0zM14 17a6 6 0 00-12 0h12zM13 8a1 1 0 100 2h4a1 1 0 100-2h-4z" />
                                            </svg>
                                            <span class="hidden lg:block">Delete</span>
                                        </button>
                                    <?php endif; ?>

                                    <button type="button" @click="handleEdit({
                                            member_id:member.id,
                                            survey_id:member.survey_id,
                                            fullname:member.fullname,
                                            birthday:member.birthday,
                                            age:member.age,
                                            studying:member.studying,
                                            grade:member.grade,
                                            occupation:member.occupation,
                                            salary:member.salary,
                                            breast_feeding:member.breast_feeding,
                                            bottle_feeding:member.bottle_feeding,
                                            mix_feeding:member.mix_feeding,
                                            philhealth_member:member.philhealth_member,
                                            disability:member.disability,
                                            disability_type:member.disability_type,
                                            sex:member.sex,
                                            scholarship_member:member.scholarship_member,
                                            forps_member:member.forps_member,
                                            type_id:member.type_id,
                                        })" class="bg-yellow-500 text-sm text-white px-2 py-1 rounded hover:bg-yellow-400 flex items-center gap-x-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        <span class="hidden lg:block">Edit</span>
                                    </button>
                                </td>
                            </tr>
                        </template>

                    </tbody>
                </table>
            </div>

        </div>

    </section>

    <section x-show="isModalChildrenOpen" x-cloak>
        <div class="h-full w-full bg-gray-600 top-0 left-0 right-0 bg-opacity-75 absolute flex flex-row justify-center items-center z-50">
            <div class="bg-white rounded shadow w-auto max-w-3xl">
                <div class="border-b p-3 flex justify-between items-center bg-green-600 text-white font-semibold">
                    <h4>Chilren / Other Members </h4>
                    <svg xmlns="http://www.w3.org/2000/svg" @click="isModalChildrenOpen = false" class="h-6 w-6 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <div class="p-3">
                    <form action="">
                        <input type="hidden" value="123" name="survey_id" x-init="survey_id = <?= $surveyId ?>" x-model="survey_id">
                        <div class="text-xs text-red-400" x-show="errors.length > 0">
                            <template x-for="error in errors">
                                <li x-text="error"></li>
                            </template>
                        </div>

                        <div class="p-3">

                            <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">
                                <div class="flex flex-col gap-y-2 mb-3">
                                    <label for="type_id">Type</label>
                                    <select name="type_id" id="type_id" x-model="type_id" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                                        <?php foreach ($memberTypes as $key => $value) : ?>
                                            <option value="<?= $key ?>"><?= $value ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>


                            <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">
                                <div class="flex flex-col gap-y-2 mb-3">
                                    <label for="fullname">Pangalan</label>
                                    <input type="text" name="fullname" id="fullname" x-model="fullname" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                                </div>

                                <div class="flex flex-col gap-y-2 mb-3">
                                    <label for="birthday">Kapanganakan</label>
                                    <input type="date" name="birthday" max="<?= date('Y-m-d'); ?>"  id="birthday" x-model="birthday" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                                </div>

                                <div class="flex flex-col gap-y-2 mb-3">
                                    <label for="age">Edad</label>
                                    <input type="number" name="age" id="age" x-model="age" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">
                                <div class="flex flex-col gap-y-2 mb-3">
                                    <label for="studying">Nag-aaral</label>
                                    <select name="studying" id="studying" x-model="studying" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                                        <?php foreach ($yesNo as $key => $value) : ?>
                                            <option value="<?= $value ?>"><?= $value ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="flex flex-col gap-y-2 mb-3" x-show="studying === 'Y'">
                                    <label for="grade">Grade</label>
                                    <input type="text" name="grade" x-model="grade" placeholder="Grade/HS/College Level" id="grade" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                                </div>

                            </div>

                            <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                                <div class="flex flex-col gap-y-2 mb-3">
                                    <label for="occupation">Trabaho</label>
                                    <input type="text" name="occupation" id="occupation" x-model="occupation" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                                </div>

                                <div class="flex flex-col gap-y-2 mb-3" x-show="occupation.length > 0">
                                    <label for="salary">Buwanang Sahod</label>
                                    <input type="number" name="salary" id="salary" x-model="salary" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                                <div class="flex flex-col gap-y-2 mb-3">
                                    <label for="breast_feeding">Sumususo sa Ina</label>
                                    <select name="breast_feeding" id="breast_feeding" x-model="breast_feeding" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                                        <?php foreach ($yesNo as $key => $value) : ?>
                                            <option value="<?= $value ?>"><?= $value ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="flex flex-col gap-y-2 mb-3">
                                    <label for="bottle_feeding">Dumedede sa Bote</label>
                                    <select name="bottle_feeding" id="bottle_feeding" x-model="bottle_feeding" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                                        <?php foreach ($yesNo as $key => $value) : ?>
                                            <option value="<?= $value ?>"><?= $value ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="flex flex-col gap-y-2 mb-3">
                                    <label for="mix_feeding">Mixed sa Bote</label>
                                    <select name="mix_feeding" id="mix_feeding" x-model="mix_feeding" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                                        <?php foreach ($yesNo as $key => $value) : ?>
                                            <option value="<?= $value ?>"><?= $value ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                            </div>

                            <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                                <div class="flex flex-col gap-y-2 mb-3">
                                    <label for="philhealth_member">Miyembro ng PhilHealth</label>
                                    <select name="philhealth_member" id="philhealth_member" x-model="philhealth_member" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                                        <?php foreach ($yesNo as $key => $value) : ?>
                                            <option value="<?= $value ?>"><?= $value ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="flex flex-col gap-y-2 mb-3">
                                    <label for="disability">May disability</label>
                                    <select name="disability" id="disability" x-model="disability" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                                        <?php foreach ($yesNo as $key => $value) : ?>
                                            <option value="<?= $value ?>"><?= $value ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="flex flex-col gap-y-2 mb-3" x-show="disability === 'Y'">
                                    <label for="disability_type">Anong Disability</label>
                                    <input type="text" name="disability_type" id="disability_type" x-model="disability_type" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                                </div>

                            </div>

                            <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                                <div class="flex flex-col gap-y-2 mb-3">
                                    <label for="sex">Sex</label>
                                    <select name="sex" id="sex" x-model="sex" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                                        <?php foreach ($gender as $key => $value) : ?>
                                            <option value="<?= $value ?>"><?= $value ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="flex flex-col gap-y-2 mb-3">
                                    <label for="scholarship_member">Scholarship Member</label>
                                    <select name="scholarship_member" id="scholarship_member" x-model="scholarship_member" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                                        <?php foreach ($scholarships as $key => $value) : ?>
                                            <option value="<?= $value ?>"><?= $value ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="flex flex-col gap-y-2 mb-3">
                                    <label for="forps_member">4PS Member</label>
                                    <select name="forps_member" id="forps_member" x-model="forps_member" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                                        <?php foreach ($yesNo as $key => $value) : ?>
                                            <option value="<?= $value ?>"><?= $value ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                            </div>

                            <div class="flex justify-end">
                                <button type="button" @click="saveChildren()" class="bg-green-600 text-white py-2 px-5 rounded flex items-center gap-x-1 hover:bg-green-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                    </svg>
                                    <span x-text="member_id === 0 ? 'Save':'Update'"></span>
                                </button>
                            </div>


                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>

</div>
<?php include './partials/footer.php'; ?>