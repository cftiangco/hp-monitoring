<?php include './partials/header.php'; ?>
<div x-data="addUser">
    <section>
        <div class="h-16 w-full bg-white shadow rounded flex justify-between items-center">
            <input type="text" x-model="search" x-on:change="searchUser"placeholder="Search..." class="ml-3 bg-gray-50 outline-none border px-3 py-1 rounded w-96 hover:border-2 hover:border-blue-300 hover:bg-white">
            <div class="flex justify-end mx-5 text-sm">
                <button type="submit" @click="isModalOpen = true" class="bg-blue-400 text-white py-2 px-5 rounded flex items-center gap-x-1 hover:bg-blue-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Add User</span>
                </button>
            </div>
        </div>
    </section>

    <section x-show="isModalOpen" x-cloak>
        <div class="h-screen w-full bg-gray-600 top-0 left-0 right-0 bg-opacity-75 absolute flex flex-row justify-center items-center">
            <div class="bg-white rounded shadow">
                <div class="border-b p-3 flex justify-between items-center bg-blue-400 text-white font-semibold">
                    <h4>User Form</h4>
                    <svg xmlns="http://www.w3.org/2000/svg" @click="isModalOpen = false" class="h-6 w-6 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <div class="p-3 max-h-[420px] overflow-scroll">
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

                        <div class="flex flex-col gap-y-2 mb-3">
                            <label for="">Password</label>
                            <input type="password" x-model="password" class="bg-gray-50 outline-none border px-3 py-2 rounded w-96 hover:border-2 hover:border-blue-300 hover:bg-white">
                        </div>

                        <div class="flex flex-col gap-y-2 mb-3">
                            <label for="">Confirm Password</label>
                            <input type="password" x-model="confirmPassword" class="bg-gray-50 outline-none border px-3 py-2 rounded w-96 hover:border-2 hover:border-blue-300 hover:bg-white">
                        </div>

                        <div class="flex justify-end">
                            <button type="button" @click="onSave" class="bg-blue-400 text-white py-2 px-5 rounded flex items-center gap-x-1 hover:bg-blue-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                </svg>
                                <span>Save</span>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <section x-init="console.log(users)" class="mt-5">

        <div class="w-full bg-white p-4 rounded shadow">
            <table class="table-auto w-full text-left rounded mt-3">
                <thead class="border-b">
                    <tr>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="user in users">
                        <tr class="hover:bg-gray-100 hover:font-semibold">
                            <td x-text="user.lastname"></td>
                            <td x-text="user.firstname"></td>
                            <td x-text="user.username"></td>
                            <td x-text="user.role_id === 1 ? 'User':'Admin'"></td>
                            <td>
                                <button class="bg-yellow-400 rounded text-xs px-2 py-1 text-white hover:bg-yellow-300">Edit</button>
                                <button class="bg-red-400 rounded text-xs px-2 py-1 text-white hover:bg-red-300">Delete</button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

    </section>

</div>
<?php include './partials/footer.php'; ?>