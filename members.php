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
    lastname:'',
    firstname:'',
    middlename:'',
    birthday:'',
    age:'',
    studying:'n',
    grade:'',
    occupation:'',
    salary:'',
    breast_feeding:'n',
    bottle_feeding:'n',
    mix_feeding:'n',
    philhealth_member:'n',
    disability:'n',
    disability_type:'',
    sex:'m',
    scholarship_member:'No',
    forps_member:'n',
    errors:[],
    members:[],
    member_id:0,
    income:0,
    other_work:'',
    isInfant:false,
    init() {
        fetch(`api/members.php?action=fetch&survey_id=${<?= $surveyId ?>}`)
            .then((response) => response.json())
            .then((data) => {
                this.members = data.data;
                this.income = this.members.map((m) => {
                    if(m.salary != '') {
                        console.log(`salary :`,m.salary);
                        return m.salary.split('-')[0].replace(/[-,<>]/g,'');
                    }
                }).reduce((a,b) => parseInt(a)+parseInt(b))
            });

            console.log(`income`,this.income);
    },
    resetFields() {
        this.lastname = '';
        this.firstname = '';
        this.middlename = '';
        this.birthday = '';
        this.age = '';
        this.studying = 'n';
        this.grade = '';
        this.occupation = 'Unemployed';
        this.salary = '';
        this.breast_feeding = 'n';
        this.bottle_feeding = 'n';
        this.mix_feeding = 'n';
        this.philhealth_member = 'n';
        this.disability = 'n';
        this.disability_type = '';
        this.sex = 'm';
        this.scholarship_member = 'No';
        this.forps_member = 'n';
        this.type_id = 1;
        this.member_id = 0;
        this.other_work = '';
    },
    saveChildren() {

        this.errors = [];

        let payload = {
            survey_id:this.survey_id,
            lastname:this.lastname,
            firstname:this.firstname,
            middlename:this.middlename,
            birthday:this.birthday,
            age:this.age,
            studying:this.studying,
            grade:this.grade,
            occupation:this.occupation,
            salary:this.salary ?? 0,
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
            member_id:this.member_id,
            other_work:this.occupation === 'Other (Please specify)' ? this.other_work:'',
            user_id : <?= $_SESSION['user_id'] ? $_SESSION['user_id'] : 0 ?>
        };

        console.log('payload',payload);

        if(this.lastname === '') {
            this.errors.push('lastname is required');
        }

        if(this.firstname === '') {
            this.errors.push('firstname is required');
        }

        if(this.birthday === '') {
            this.errors.push('Birthday is required');
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
        this.other_work = data.other_work;
        this.survey_id = data.survey_id;
        this.firstname = data.firstname;
        this.lastname = data.lastname;
        this.middlename = data.middlename;
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
    },
    handleStudyingChange() {
        console.log(this.studying);
    },
    handleOccupationChange() {
        this.salary = '';
    },
    handleDisabilityChange() {
        this.disability_type = '';
    },
    getRelationship(id) {
        switch(id) {
            case 1:
                return 'Son';
            break;
            case 2:
                return 'Daughter';
            break;
            case 3:
                return 'Mother';
            break;
            case 4:
                return 'Father';
            break;
            case 5:
                return 'Grandfather';
            break;
            case 6:
                return 'Grandmother';
            break;
            case 7:
                return 'Cousin';
            break;
            case 8:
                return 'Aunt';
            break;
            case 9:
                return 'Uncle';
            break;
            case 10:
                return 'Other Member';
            break;
        }
    },
    currencyFormat(price) {
        var formatter = new Intl.NumberFormat('fil-PH', {
            style: 'currency',
            currency: 'PHP',
        });
        return formatter.format(price ?? 0); 
    },
    getAge(dateString) {
        console.log('date string',dateString)
        var today = new Date();
        var birthDate = new Date(dateString);
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        return age;
    },
    handleChangeBirthday() {
        if(this.getAge(this.birthday) <= 6) {
            this.isInfant = true;
        } else {
            this.isInfant = false;
        }
        console.log(`is infant: `,this.isInfant);
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
                            <th>Edad</th>
                            <th>4PS Member</th>
                            <th>Scholarship</th>
                            <th>Income</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="member in members">
                            <tr>
                                <td x-text="getRelationship(member.type_id)" class="text-xs font-semibold text-green-700"></td>
                                <td x-text='member.firstname'></td>
                                <td x-text="member.sex"></td>
                                <td x-text="moment(member.birthday).format('MM-DD-YYYY')"></td>
                                <td x-text="getAge(moment(member.birthday).format('YYYY-MM-DD'))"></td>
                                <td x-text="member.forps_member"></td>
                                <td x-text="truncateString(member.scholarship_member,15)"></td>
                                <td x-text="member.salary ? member.salary : 0"></td>
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
                                            lastname:member.lastname,
                                            firstname:member.firstname,
                                            middlename:member.middlename,
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
                                            other_work:member.other_work
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

                                <div class="flex flex-col gap-y-2 mb-3">
                                    <label for="birthday">Kapanganakan</label>
                                    <input type="date"  @change="handleChangeBirthday" name="birthday" max="<?= date('Y-m-d'); ?>" id="birthday" x-model="birthday" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                                </div>

                            </div>


                            <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                                <div class="flex flex-col gap-y-2 mb-3">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" name="lastname" id="lastname" x-model="lastname" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                                </div>

                                <div class="flex flex-col gap-y-2 mb-3">
                                    <label for="firstname">First Name</label>
                                    <input type="text" name="firstname" id="firstname" x-model="firstname" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                                </div>

                                <div class="flex flex-col gap-y-2 mb-3">
                                    <label for="middlename">Middle Name</label>
                                    <input type="text" name="middlename" id="middlename" x-model="middlename" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                                </div>

                            </div>

                            <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                                <div class="flex flex-col gap-y-2 mb-3">
                                    <label for="studying">Nag-aral</label>
                                    <div class="flex gap-x-3 py-2 px-2 shadow rounded">
                                        <div>
                                            <label for="studying_n">Yes</label>
                                            <input type="radio" name="studying" id="studying_y" x-model="studying" @change="handleStudyingChange" value="y">
                                        </div>
                                        <div>
                                            <label for="studying_y">No</label>
                                            <input type="radio" name="studying" id="studying_n" x-model="studying" @change="handleStudyingChange" value="n" checked="checked">
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-col gap-y-2 mb-3" x-show="studying === 'y'">
                                    <label for="grade">Grade</label>
                                    <select name="grade" id="grade" x-model="grade" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                                        <?php foreach ($grades as $key => $value) : ?>
                                            <option value="<?= $value ?>"><?= $value ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                            </div>

                            <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                                <div class="flex flex-col gap-y-2 mb-3">
                                    <label for="occupation">Trabaho</label>
                                    <select name="occupation" id="occupation" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?> x-model="occupation" :change="handleOccupationChange">
                                        <?php foreach ($occupations as $key => $value) : ?>
                                            <option value="<?= $value ?>"><?= $value ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="flex flex-col gap-y-2 mb-3" x-show="occupation === 'Other (Please specify)'">
                                    <label for="other_work">Specify here</label>
                                    <input type="text" name="other_work" id="other_work" x-model="other_work" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white">
                                </div>

                                <div class="flex flex-col gap-y-2 mb-3" x-show="occupation !== 'Unemployed'">
                                    <label for="salary">Buwanang Sahod</label>
                                    <select name="salary" id="salary" x-model="salary" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                                        <option value="" disabled>Select</option>
                                        <?php foreach ($salaries as $key => $value) : ?>
                                            <option value="<?= $value ?>"><?= $value ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                            </div>

                            <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5" x-show="isInfant">

                                <div class="flex flex-col gap-y-2 mb-3">
                                    <label for="breast_feeding">Sumususo sa Ina</label>
                                    <div class="flex gap-x-3 py-2 px-2 shadow rounded">
                                        <div>
                                            <label for="breast_feeding_y">Yes</label>
                                            <input type="radio" name="breast_feeding" id="breast_feeding_y" x-model="breast_feeding" value="y">
                                        </div>
                                        <div>
                                            <label for="breast_feeding_n">No</label>
                                            <input type="radio" name="breast_feeding" id="breast_feeding_n" x-model="breast_feeding" value="n" checked="checked">
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-col gap-y-2 mb-3">
                                    <label for="bottle_feeding">Dumedede sa Bote</label>
                                    <div class="flex gap-x-3 py-2 px-2 shadow rounded">
                                        <div>
                                            <label for="bottle_feeding_y">Yes</label>
                                            <input type="radio" name="bottle_feeding" id="bottle_feeding_y" x-model="bottle_feeding" value="y">
                                        </div>
                                        <div>
                                            <label for="bottle_feeding_n">No</label>
                                            <input type="radio" name="bottle_feeding" id="bottle_feeding_n" x-model="bottle_feeding" value="n" checked="checked">
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-col gap-y-2 mb-3">
                                    <label for="mix_feeding">Mixed sa Bote</label>
                                    <div class="flex gap-x-3 py-2 px-2 shadow rounded">
                                        <div>
                                            <label for="mix_feeding_y">Yes</label>
                                            <input type="radio" name="mix_feeding" id="mix_feeding_y" x-model="mix_feeding" value="y">
                                        </div>
                                        <div>
                                            <label for="mix_feeding_n">No</label>
                                            <input type="radio" name="mix_feeding" id="mix_feeding_n" x-model="mix_feeding" value="n" checked="checked">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                                <div class="flex flex-col gap-y-2 mb-3">
                                    <label for="philhealth_member">Miyembro ng PhilHealth</label>
                                    <div class="flex gap-x-3 py-2 px-2 shadow rounded">
                                        <div>
                                            <label for="philhealth_member_y">Yes</label>
                                            <input type="radio" name="philhealth_member" id="philhealth_member_y" x-model="philhealth_member" value="y">
                                        </div>
                                        <div>
                                            <label for="philhealth_member_n">No</label>
                                            <input type="radio" name="philhealth_member" id="philhealth_member_y" x-model="philhealth_member" value="n" checked="checked">
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-col gap-y-2 mb-3">
                                    <label for="disability">May disability</label>
                                    <div class="flex gap-x-3 py-2 px-2 shadow rounded">
                                        <div>
                                            <label for="disability_y">Yes</label>
                                            <input type="radio" name="disability" id="disability_y" x-model="disability" @change="handleDisabilityChange" value="y">
                                        </div>
                                        <div>
                                            <label for="disability_n">No</label>
                                            <input type="radio" name="disability" id="disability_n" x-model="disability" @change="handleDisabilityChange" value="n" checked="checked">
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-col gap-y-2 mb-3" x-show="disability === 'y'">
                                    <label for="disability_type">Anong Disability</label>
                                    <input type="text" name="disability_type" id="disability_type" x-model="disability_type" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                                </div>

                            </div>

                            <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                                <div class="flex flex-col gap-y-2 mb-3">
                                    <label for="sex">Sex</label>
                                    <div class="flex gap-x-3 py-2 px-2 shadow rounded">
                                        <div>
                                            <label for="sex_m">Male</label>
                                            <input type="radio" name="sex" id="sex_m" x-model="sex" value="m" checked="checked">
                                        </div>
                                        <div>
                                            <label for="sex_f">Female</label>
                                            <input type="radio" name="sex" id="sex_f" x-model="sex" value="f">
                                        </div>
                                    </div>
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
                                    <div class="flex gap-x-3 py-2 px-2 shadow rounded">
                                        <div>
                                            <label for="forps_member_y">Yes</label>
                                            <input type="radio" name="forps_member" id="forps_member_y" x-model="forps_member" value="y">
                                        </div>
                                        <div>
                                            <label for="forps_member_n">No</label>
                                            <input type="radio" name="forps_member" id="forps_member_n" x-model="forps_member" value="n">
                                        </div>
                                    </div>
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

    <div class="fixed bottom-0 left-0 right-1 w-screen z-50 p-3 bg-black bg-opacity-25">
        <div class="flex justify-end mr-10">
            <h3 class="text-xl border px-5 bg-white rounded">Estimated Family income: <span x-text="currencyFormat(income)"></span></h3>
        </div>
        <!-- <button type="submit" name="submit" class="bg-green-600 text-white py-2 px-5 rounded flex items-center gap-x-1 hover:bg-green-400 float-right mr-5 md:mr-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
            </svg>
            <span>Submit Survey</span>
        </button> -->
    </div>
</div>
<?php include './partials/footer.php'; ?>