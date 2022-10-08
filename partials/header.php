<?php

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php',true,  301);
    exit();
}

$isAdmin = $_SESSION['role_id'] == 2 ? true : false;
$role_id = $_SESSION['role_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.10.3/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js" integrity="sha512-42PE0rd+wZ2hNXftlM78BSehIGzezNeQuzihiBCvUEB3CVxHvsShF86wBWwQORNxNINlBPuq7rG4WWhNiTVHFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>HP Monitoring System</title>
    <link rel="icon" type="image/x-icon" href="assets/images/main-logo2.png">
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="font-mono bg-gray-50">

    <header class="h-20 bg-white border-b shadow-sm w-full fixed z-10">
        <div class="flex items-center justify-between h-full mx-2 md:mx-10">
            <div class="flex gap-x-2 items-center">
                <a href="<?= $role_id != 3 ? 'index.php':'form.php?active=myapplication&id=' . md5($_SESSION['user_id']) ?>">
                    <img src="assets/images/main-logo2.png" class="h-8 md:h-14 w-auto hover:scale-125 hover:duration-300" alt="Main Logo">
                </a>
                <h4 class="font-bold italic text-xs md:text-lg text-green-600 hidden md:block">Household Profiling Monitoring System</h4>
            </div>
            <div class="flex items-center gap-y-2 md:gap-x-5 hover:cursor-pointer">
                <h4 class="text-sm text-end md:text-start md:text-lg">Hi <?= ucfirst($_SESSION['lastname']) ?>, <?= ucfirst($_SESSION['firstname']) ?>!</h4>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </header>

    <div class="h-20"></div>

    <div class="container flex">

        <div class="h-screen w-20 md:w-40 bg-white border-r shadow-sm fixed z-10">
            <ul>
                <?php if ($role_id != 3) : ?>
                    <li class="px-3 py-3 md:py-4 md:gap-x-1 text-sm border-b hover:bg-gray-200 hover:text-white relative">
                        <?php if (!isset($_GET['active'])) : ?>
                            <div class="bg-green-600 h-full w-2 absolute left-0 top-0 bottom-0"></div>
                        <?php endif; ?>
                        <a href="index.php" class="flex justify-center gap-x-0 text-gray-600 md:gap-x-1 md:justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                            </svg>
                            <span class="hidden md:block">Dashboard</span>
                        </a>
                    </li>
                    <li class="px-3 py-3 md:py-4 md:gap-x-1 text-sm border-b hover:bg-gray-200 hover:text-white relative">
                        <?php if (isset($_GET['active']) && $_GET['active'] == "surveys") : ?>
                            <div class="bg-green-600 h-full w-2 absolute left-0 top-0 bottom-0"></div>
                        <?php endif; ?>
                        <a href="surveys.php?active=surveys" class="flex justify-center gap-x-0 text-gray-600 md:gap-x-1 md:justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 12v3c0 1.657 3.134 3 7 3s7-1.343 7-3v-3c0 1.657-3.134 3-7 3s-7-1.343-7-3z" />
                                <path d="M3 7v3c0 1.657 3.134 3 7 3s7-1.343 7-3V7c0 1.657-3.134 3-7 3S3 8.657 3 7z" />
                                <path d="M17 5c0 1.657-3.134 3-7 3S3 6.657 3 5s3.134-3 7-3 7 1.343 7 3z" />
                            </svg>
                            <span class="hidden md:block">Surveys</span>
                        </a>
                    </li>
                    <li class="px-3 py-3 md:py-4 md:gap-x-1 text-sm border-b hover:bg-gray-200 hover:text-white relative">
                        <?php if (isset($_GET['active']) && $_GET['active'] == "accounts") : ?>
                            <div class="bg-green-600 h-full w-2 absolute left-0 top-0 bottom-0"></div>
                        <?php endif; ?>
                        <a href="accounts.php?active=accounts" class="flex justify-center gap-x-0 text-gray-600 md:gap-x-1 md:justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                            </svg>
                            <span class="hidden md:block">Accounts</span>
                        </a>
                    </li>
                    <li class="px-3 py-3 md:py-4 md:gap-x-1 text-sm border-b hover:bg-gray-200 hover:text-white relative">
                        <?php if (isset($_GET['active']) && $_GET['active'] == "users") : ?>
                            <div class="bg-green-600 h-full w-2 absolute left-0 top-0 bottom-0"></div>
                        <?php endif; ?>
                        <a href="users.php?active=users" class="flex justify-center gap-x-0 text-gray-600 md:gap-x-1 md:justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                            </svg>
                            <span class="hidden md:block">Admin Users</span>
                        </a>
                    </li>
                    <li class="px-3 py-3 md:py-4 md:gap-x-1 text-sm border-b hover:bg-gray-200 hover:text-white relative">
                        <?php if (isset($_GET['active']) && $_GET['active'] == "logs") : ?>
                            <div class="bg-green-600 h-full w-2 absolute left-0 top-0 bottom-0"></div>
                        <?php endif; ?>
                        <a href="logs.php?active=logs" class="flex justify-center gap-x-0 text-gray-600 md:gap-x-1 md:justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            <span class="hidden md:block">Logs</span>
                        </a>
                    </li>
                <?php else : ?>
                    <li class="px-3 py-3 md:py-4 md:gap-x-1 text-sm border-b hover:bg-gray-200 hover:text-white relative">
                        <?php if (isset($_GET['active']) && $_GET['active'] == "myapplication") : ?>
                            <div class="bg-green-600 h-full w-2 absolute left-0 top-0 bottom-0"></div>
                        <?php endif; ?>
                        <a href="form.php?active=myapplication&id=<?= md5($_SESSION['user_id']) ?>" class="flex justify-center gap-x-0 text-gray-600 md:gap-x-1 md:justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                            <span class="hidden md:block">My Application</span>
                        </a>
                    </li>
                    <li class="px-3 py-3 md:py-4 md:gap-x-1 text-sm border-b hover:bg-gray-200 hover:text-white relative">
                        <?php if (isset($_GET['active']) && $_GET['active'] == "myaccount") : ?>
                            <div class="bg-green-600 h-full w-2 absolute left-0 top-0 bottom-0"></div>
                        <?php endif; ?>
                        <a href="myaccount.php?active=myaccount" class="flex justify-center gap-x-0 text-gray-600 md:gap-x-1 md:justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <span class="hidden md:block">My Account</span>
                        </a>
                    </li>
                <?php endif; ?>

                <li class="px-3 py-3 md:py-4 md:gap-x-1 text-sm border-b hover:bg-gray-200 hover:text-white">
                        <form action="logout.php" method="POST" onsubmit="return confirm('Are you sure you want to logout?');" class="flex justify-center md:justify-start">
                            <button type="submit" class="flex justify-center gap-x-0 text-gray-600 md:gap-x-1 md:justify-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                                </svg>
                                <span class="hidden md:block">Logout</span>
                            </button>
                        </form>
                </li>


            </ul>
        </div>

        <div class="h-full w-full m-5 ml-24 mx-5 md:ml-44">
            <!-- content goes here -->