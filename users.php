<?php
require_once('./models/User.php');
$user = new User();
$users = $user->fetchAll();
?>


<?php include './partials/header.php'; ?>
<div x-data="{
    errors: [],
    isModalOpen: false,
    firstName: '',
    lastName: '',
    userName: '',
    password: '',
    confirmPassword: '',
    role: '1',
    userId:0,
    users: [],
    alert: {
        open:false,
        message:'',
        type:''
    },
    resetFields() {
        this.firstName = '';
        this.lastName = '';
        this.userName = '';
        this.password = '';
        this.confirmPassowrd = '';
        this.role = 1;
        this.userId = 0;
    },
    openModal() {
        this.resetFields();
        this.isModalOpen = true;
    },
    onSave() {

        this.errors = [];

        if (this.firstName === '') {
            this.errors.push('First Name is required');
        }

        if (this.lastName === '') {
            this.errors.push('Last Name is required');
        }

        if (this.userName === '') {
            this.errors.push('Username is required');
        }

        if (this.password === '' && this.userId === 0) {
            this.errors.push('Password is required');
        }

        if (this.password !== this.confirmPassword && this.userId === 0) {
            this.errors.push('Password didnt matched the confirm password');
        }

        if (this.errors.length === 0) {

            let payload = {
                firstname: this.firstName,
                lastname: this.lastName,
                role_id: this.role,
                username: this.userName,
                password: this.password,
                id:this.userId,
            };

            if(this.userId > 0) {
                postData('api/users.php?action=update', payload)
                .then((data) => {
                    if (data.status === 201) {
                        this.isModalOpen = false;
                        alert('Record has been successfully updated');
                        window.top.location = window.top.location;
                        return;
                    }
                });
            } else {
                postData('api/users.php?action=create', payload)
                .then((data) => {
                    if (data.status === 201) {
                        this.isModalOpen = false;
                        alert('Record has been successfully added');
                        window.top.location = window.top.location;
                        return;
                    }
                });
            }
        }
    },
    onEdit({lastname,firstname,role_id,username,id}) {
        this.lastName = lastname;
        this.firstName = firstname;
        this.role = role_id;
        this.userName = username;
        this.isModalOpen = true;
        this.userId = id;
    },
    onDelete(id) {
        if (confirm('Are you sure you want to delete this record?') == true) {
            postData(`api/users.php?action=delete&id=${id}`)
                .then((data) => {
                    if (data.status === 200) {
                        window.top.location = window.top.location;
                        alert('Record has been successfully delete');
                        return;
                    }
                });
        } 
    }
}">
    <section>
        <div class="h-16 w-full bg-white shadow rounded flex justify-between items-center">
            <h4 class="mx-5 font-semibold">Users Account</h4>
            <div class="flex justify-end mx-5 text-sm">
                <button type="submit" @click="openModal()" class="bg-blue-400 text-white py-2 px-5 rounded flex items-center gap-x-1 hover:bg-blue-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Add User</span>
                </button>
            </div>
        </div>
    </section>

    <section x-show="alert.open" x-cloak>
        <div class="h-16 w-full text-white shadow rounded flex justify-between items-center my-5" x-bind:class="alert.type === 'success' ? 'bg-green-400':'bg-red-400'">
            <h6 class="mx-5" x-text="alert.message"></h6>
            <svg xmlns="http://www.w3.org/2000/svg" @click="alert.open = false" class="h-6 w-6 mx-5 hover:cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>
    </section>

    <section x-show="isModalOpen" x-cloak>
        <div class="h-screen w-full bg-gray-600 top-0 left-0 right-0 bg-opacity-75 absolute flex flex-row justify-center items-center z-50">
            <div class="bg-white rounded shadow">
                <div class="border-b p-3 flex justify-between items-center bg-blue-400 text-white font-semibold">
                    <h4>User Form</h4>
                    <svg xmlns="http://www.w3.org/2000/svg" @click="isModalOpen = false" class="h-6 w-6 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <div class="p-3 max-full overflow-scroll">
                    <form action="">

                        <div class="text-xs text-red-400" x-show="errors.length > 0">
                            <template x-for="error in errors">
                                <li x-text="error"></li>
                            </template>
                        </div>

                        <div class="flex flex-col gap-y-2 mb-3">
                            <label for="">Last Name</label>
                            <input type="text" x-model="lastName" class="bg-gray-50 outline-none border px-3 py-2 rounded w-96 hover:border-2 hover:border-blue-300 hover:bg-white">
                        </div>

                        <div class="flex flex-col gap-y-2 mb-3">
                            <label for="">First Name</label>
                            <input type="text" x-model="firstName" class="bg-gray-50 outline-none border px-3 py-2 rounded w-96 hover:border-2 hover:border-blue-300 hover:bg-white">
                        </div>

                        <div class="flex flex-col gap-y-2 mb-3">
                            <label for="">Role</label>
                            <select x-model="role" class="bg-gray-50 outline-none border px-3 py-2 rounded w-96 hover:border-2 hover:border-blue-300 hover:bg-white">
                                <option value="1">User</option>
                                <option value="2">Admin</option>
                            </select>
                        </div>

                        <div class="flex flex-col gap-y-2 mb-3">
                            <label for="">Username</label>
                            <input type="text" x-model="userName" class="bg-gray-50 outline-none border px-3 py-2 rounded w-96 hover:border-2 hover:border-blue-300 hover:bg-white">
                        </div>

                        <div class="flex flex-col gap-y-2 mb-3" x-show="userId === 0">
                            <label for="">Password</label>
                            <input type="password" x-model="password" class="bg-gray-50 outline-none border px-3 py-2 rounded w-96 hover:border-2 hover:border-blue-300 hover:bg-white">
                        </div>

                        <div class="flex flex-col gap-y-2 mb-3" x-show="userId === 0">
                            <label for="">Confirm Password</label>
                            <input type="password" x-model="confirmPassword" class="bg-gray-50 outline-none border px-3 py-2 rounded w-96 hover:border-2 hover:border-blue-300 hover:bg-white">
                        </div>

                        <div class="flex justify-end">
                            <button type="button" @click="onSave" class="bg-blue-400 text-white py-2 px-5 rounded flex items-center gap-x-1 hover:bg-blue-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                </svg>
                                <span x-text="userId === 0 ? 'Save':'Update'"></span>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-5">
        <div class="w-full bg-white p-4 rounded shadow">
            <table id="table_id" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?= $user['lastname'] ?></td>
                            <td><?= $user['firstname'] ?></td>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['role_id'] == 1 ? 'User' : 'Admin' ?></td>
                            <td class="flex gap-x-1">
                                <button type="button" @click="() => onEdit({
                                    id:<?= $user['id'] ?>,
                                    firstname:'<?= $user['firstname'] ?>',
                                    lastname:'<?= $user['lastname'] ?>',
                                    username:'<?= $user['username'] ?>',
                                    role_id:<?= $user['role_id'] ?>,
                                })" class="bg-yellow-500 text-sm text-white px-2 py-1 rounded hover:bg-yellow-400 flex items-center gap-x-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    <span>Edit</span>
                                </button>
                                <button type="button" @click="() => onDelete(<?= $user['id'] ?>)" class="bg-red-500 text-sm text-white px-2 py-1 rounded hover:bg-red-400 flex items-center gap-x-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    <span>Delete</span>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

</div>
<?php include './partials/footer.php'; ?>