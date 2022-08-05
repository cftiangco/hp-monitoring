<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

require_once(dirname(__FILE__) . '/models/User.php');
require_once(dirname(__FILE__) . '/func/helpers.php');
$user = new User();

$errors = [];

if (isset($_POST['login'])) {
    $errors = [];
    if ($_POST['username'] === "") {
        array_push($errors, "Username is required field");
    }

    if ($_POST['password'] === "") {
        array_push($errors, "Password is required field");
    }

    if (count($errors) === 0) {
        $result = $user->login($_POST['username'], $_POST['password']);
        if (!$result) {
            array_push($errors, "The username that you've entered doesn't belong to an account");
        } else {
            if (checkPassword($_POST['password'], $result->pword)) {
                userSession($result);
                if($_SESSION['role_id'] != 3) {
                    header('Location: index.php');
                } else {
                    header('Location: form.php?active=myapplication&id=' . md5($_SESSION['user_id']));
                }
                exit();
            } else {
                array_push($errors, "Incorrect Password");
            }
        }
    }
}

function checkPassword($loginPassword, $sytemPassword)
{
    return md5($loginPassword) === $sytemPassword;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="assets/images/main-logo2.png">
    <script defer src="https://unpkg.com/alpinejs@3.10.3/dist/cdn.min.js"></script>
    <title>HP Monitoring System / Login</title>
</head>

<body class="font-mono">
    <div class="grid grid-cols-1 lg:grid-cols-2 mt-16 lg:mt-0" x-data="{
        registerOpen:false,
        firstname:'',
        lastname:'',
        username:'',
        password:'',
        confirmPassword:'',
        errors:[],
        handleSubmit() {

            this.errors = [];

            if(this.lastname === '') {
                this.errors.push('Last name cannot be empty');
            }

            if(this.lastname.length === 1) {
                this.errors.push('Last name must be 2 characters long');
            }

            if(this.firstname === '') {
                this.errors.push('First name cannot be empty');
            }

            if(this.firstname.length === 1) {
                this.errors.push('First name must be 2 characters long');
            }


            if(this.username === '') {
                this.errors.push('User name cannot be empty');
            }
            

            if(this.username.length < 5 && this.username.length !== 0) {
                this.errors.push('User name must be 5 characters long');
            }

            if(this.password === '') {
                this.errors.push('Password cannot be empty');
            }
            

            if(this.password.length < 5 && this.password.length !== 0) {
                this.errors.push('Password must be 5 characters long');
            }

            if(this.password.length && this.password !== this.confirmPassword) {
                this.errors.push('Password did not matched the confirm password');
            }

            let payload = {
                lastname:this.lastname,
                firstname:this.firstname,
                username:this.username,
                password:this.password,
                role_id:3,
            }

            if(this.errors.length === 0) {
                postData('api/users.php?action=create', payload)
                .then((data) => {
                    if(data.status === 409) {
                        this.errors.push('User name is already exists');
                    }
                    if (data.status === 201) {
                        alert('You have successfully registered, Please login your account');
                        this.registerOpen = false;
                    }
                });
            }

        }
    }">

        <div class="h-fit lg:h-screen w-full  lg:flex border-r flex-col justify-center items-center gap-y-2 bg-white lg:bg-gray-100">
            <h1 class="text-lg lg:text-4xl text-gray-700 text-center"><span class="text-green-600 font-bold">Household Profiling Monitoring System</span> <br /><span class="text-sm lg:text-xl">Barangay Marinig Heath Center</span></h1>
            <div class="flex justify-center">
                <img src="assets/images/main-logo2.png" class="w-28 h-auto lg:w-auto lg:h-auto" alt="Main Logo">
            </div>
        </div>

        <div class="h-fit lg:h-screen bg-gray-50 lg:bg-white">
            <div class="flex flex-col items-center justify-center h-full gap-y-10">

                <?php if (count($errors) > 0) : ?>
                    <ul class="flex flex-col gap-y-0 list-disc">
                        <?php foreach ($errors as $error) : ?>
                            <li class="text-red-400"><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>


                <template x-if="!registerOpen">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-700 text-center text-green-500 mb-10">LOGIN</h1>
                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                            <div class="flex flex-col gap-y-2 mb-3">
                                <label for="">Username</label>
                                <input type="text" placeholder="Enter username" name="username" class="bg-gray-50 outline-none border px-3 py-2 rounded w-96 hover:border-2 hover:border-blue-300 hover:bg-white">
                            </div>

                            <div class="flex flex-col gap-y-2 mb-3">
                                <label for="">Password</label>
                                <input type="password" placeholder="Enter password" name="password" class="bg-gray-50 outline-none border px-3 py-2 rounded w-96 hover:border-2 hover:border-blue-300 hover:bg-white">
                            </div>

                            <div>
                                <button type="submit" name="login" class="bg-green-600 text-white py-2 px-5 rounded flex items-center gap-x-1 hover:bg-green-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    <span>Login</span>
                                </button>
                            </div>

                            <div class="flex justify-end items-center">
                                <button class="text-green-600 font-semibold hover:text-green-500" type="button" @click="registerOpen = true">Register an account</button>
                            </div>
                        </form>
                    </div>
                </template>

                <template x-if="registerOpen">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-700 text-center text-yellow-500 mb-10">Register</h1>

                        <template x-if="errors.length > 0">
                            <ul class="flex flex-col gap-y-0 list-disc">
                                <template x-for="error in errors">
                                    <li x-text="error" class="text-red-400"></li>
                                </template>
                            </ul>
                        </template>

                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" @submit.prevent="handleSubmit()">

                            <div class="flex flex-col gap-y-2 mb-3">
                                <label for="">Last Name</label>
                                <input type="text" placeholder="Enter lastname" name="lastname" x-model="lastname" class="bg-gray-50 outline-none border px-3 py-2 rounded w-96 hover:border-2 hover:border-blue-300 hover:bg-white">
                            </div>

                            <div class="flex flex-col gap-y-2 mb-3">
                                <label for="">First Name</label>
                                <input type="text" placeholder="Enter firstname" name="firstname" x-model="firstname" class="bg-gray-50 outline-none border px-3 py-2 rounded w-96 hover:border-2 hover:border-blue-300 hover:bg-white">
                            </div>

                            <hr class="my-2 bg-yellow-600 h-0.5">

                            <div class="flex flex-col gap-y-2 mb-3">
                                <label for="">Username</label>
                                <input type="text" placeholder="Enter username" name="username" x-model="username" class="bg-gray-50 outline-none border px-3 py-2 rounded w-96 hover:border-2 hover:border-blue-300 hover:bg-white">
                            </div>

                            <div class="flex flex-col gap-y-2 mb-3">
                                <label for="">Password</label>
                                <input type="password" placeholder="Enter password" name="password" x-model="password" class="bg-gray-50 outline-none border px-3 py-2 rounded w-96 hover:border-2 hover:border-blue-300 hover:bg-white">
                            </div>

                            <div class="flex flex-col gap-y-2 mb-3">
                                <label for="">Confirm Password</label>
                                <input type="password" placeholder="Confirm Password" name="confirm_password" x-model="confirmPassword" class="bg-gray-50 outline-none border px-3 py-2 rounded w-96 hover:border-2 hover:border-blue-300 hover:bg-white">
                            </div>

                            <div>
                                <button type="submit" name="register" class="bg-yellow-600 text-white py-2 px-5 rounded flex items-center gap-x-1 hover:bg-yellow-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    <span>Submit</span>
                                </button>
                            </div>

                            <div class="flex justify-end items-center">
                                <button class="text-yellow-600 font-semibold hover:text-yellow-500" type="button" @click="registerOpen = false">Back to login</button>
                            </div>
                        </form>
                    </div>
                </template>

            </div>
        </div>
    </div>

    <script>
        async function postData(url = '', data = {}) {
            // Default options are marked with *
            const response = await fetch(url, {
                method: 'POST', // *GET, POST, PUT, DELETE, etc.
                mode: 'cors', // no-cors, *cors, same-origin
                cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                credentials: 'same-origin', // include, *same-origin, omit
                headers: {
                    'Content-Type': 'application/json'
                    // 'Content-Type': 'application/x-www-form-urlencoded',
                },
                redirect: 'follow', // manual, *follow, error
                referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
                body: JSON.stringify(data) // body data type must match "Content-Type" header
            });
            return response.json(); // parses JSON response into native JavaScript objects
        }
    </script>
</body>

</html>