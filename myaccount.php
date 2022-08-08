<?php
session_start();
require_once('./models/User.php');

$model = new User();
$data = $model->getById($_SESSION['user_id']);
?>
<?php include './partials/header.php'; ?>
<div x-data="{
    modalChangePassword:false,
    confirmNewPassword:'',
    changePasswordUserId:'',
    changePasswordErrors:[],
    newPassword:'',
    openModalChangePassword() {
        this.newPassword = '';
        this.confirmNewPassword = '';
        this.modalChangePassword = true;
    },
    handleOpenModalChangePassword(id) {
        this.changePasswordUserId = id;
        this.openModalChangePassword();
    },
    handleChangePassword() {
        this.changePasswordErrors = [];

        if(this.newPassword === '') {
            this.changePasswordErrors.push('New password is required field');
            return;
        }

        if(this.newPassword !== this.confirmNewPassword) {
            this.changePasswordErrors.push('New password did not matched the confirm password');
            return;
        }

        postData('api/users.php?action=change-password', {
            password:this.newPassword,
            user_id:this.changePasswordUserId
        }).then((data) => {
            if(data.status === 200) {
                alert('Password has been successfully changed');            
            }
        });
        this.modalChangePassword = false;
        console.log(this.newPassword,this.confirmNewPassword,this.changePasswordUserId);   
    }
}">
    <section>
        <div class="flex flex-col md:flex-row h-screen gap-y-3 gap-x-0 md:gap-y-0 md:gap-x-2">
            <div class="w-48 h-fit md:h-full md:border-r md:shadow-r ">
                <ul>
                    <li class="font-extrabold text-green-700 hover:text-green-700">
                        <a href="">My Info</a>
                    </li>
                    <li class="font-extrabold text-gray-600 hover:text-green-700">
                        <button @click="() => handleOpenModalChangePassword(<?= $_SESSION['user_id'] ?>)">Change Password</button>
                    </li>
                </ul>
            </div>
            <div class="w-full">

                <div class="grid grid-cols-2 gap-2 md:grid-cols-4 md:gap-4 bg-white shadow p-2 rounded">
                    <div class="flex flex-col">
                        <p class="text-xs text-gray-400">Last Name</p>
                        <p class="font-semibold text-lg text-gray-800"><?= $data->lastname ?></p>
                    </div>

                    <div class="flex flex-col">
                        <p class="text-xs text-gray-400">First Name</p>
                        <p class="font-semibold text-lg text-gray-800"><?= $data->firstname ?></p>
                    </div>

                    <div class="flex flex-col">
                        <p class="text-xs text-gray-400">User Name</p>
                        <p class="font-semibold text-lg text-gray-800"><?= $data->username ?></p>
                    </div>
                </div>

            </div>
        </div>

    </section>

    <section x-show="modalChangePassword" x-cloak>
        <div class="h-full w-full bg-gray-600 top-0 left-0 right-0 bg-opacity-75 absolute flex flex-row justify-center items-center z-50">
            <div class="bg-white rounded shadow">
                <div class="border-b p-3 flex justify-between items-center bg-green-600 text-white font-semibold">
                    <h4>Change Password</h4>
                    <svg xmlns="http://www.w3.org/2000/svg" @click="modalChangePassword = false" class="h-6 w-6 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <div class="p-3 max-full">
                    <form action="">

                        <div class="text-xs text-red-400" x-show="changePasswordErrors.length > 0">
                            <template x-for="error in changePasswordErrors">
                                <li x-text="error"></li>
                            </template>
                        </div>

                        <div class="flex flex-col gap-y-2 mb-3">
                            <label for="">New Password</label>
                            <input type="password" x-model="newPassword" class="bg-gray-50 outline-none border px-3 py-2 rounded w-96 hover:border-2 hover:border-blue-300 hover:bg-white">
                        </div>

                        <div class="flex flex-col gap-y-2 mb-3">
                            <label for="">Confirm New Password</label>
                            <input type="password" x-model="confirmNewPassword" class="bg-gray-50 outline-none border px-3 py-2 rounded w-96 hover:border-2 hover:border-blue-300 hover:bg-white">
                        </div>

                        <div class="flex justify-end">
                            <button type="button" @click="handleChangePassword()" class="bg-green-600 text-white py-2 px-5 rounded flex items-center gap-x-1 hover:bg-green-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                </svg>
                                <span>Change</span>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include './partials/footer.php'; ?>