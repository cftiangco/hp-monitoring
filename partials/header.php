<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <title>HP Monitoring System</title>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-mono bg-gray-50">

<header class="h-20 bg-white border-b shadow-sm w-full">
    <div class="flex items-center justify-between h-full mx-10">
        <div class="flex gap-x-2">
            <h4>
                <img src="./../assets/images/main-logo.png" alt="Main Logo">
            </h4>
            <h4 class="font-bold italic">HP Monitoring System</h4>
        </div>
    </div>
</header>

<div class="container flex">

    <div class="h-screen w-20 md:w-40 bg-white border-r shadow-sm">
        <ul>
            <li class="px-3 py-3 md:py-4 md:gap-x-1 text-sm border-b border-l-8 border-l-blue-400 hover:bg-gray-200 hover:text-white">
                <a href="/" class="flex justify-center gap-x-0 text-gray-600 md:gap-x-1 md:justify-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                    <span class="hidden md:block">Dashboard</span>
                </a>
            </li>
            <li class="px-3 py-3 md:py-4 md:gap-x-1 text-sm border-b hover:bg-gray-200 hover:text-white">
                <a href="/records.php" class="flex justify-center gap-x-0 text-gray-600 md:gap-x-1 md:justify-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M3 12v3c0 1.657 3.134 3 7 3s7-1.343 7-3v-3c0 1.657-3.134 3-7 3s-7-1.343-7-3z" />
                        <path d="M3 7v3c0 1.657 3.134 3 7 3s7-1.343 7-3V7c0 1.657-3.134 3-7 3S3 8.657 3 7z" />
                        <path d="M17 5c0 1.657-3.134 3-7 3S3 6.657 3 5s3.134-3 7-3 7 1.343 7 3z" />
                    </svg>
                    <span class="hidden md:block">Records</span>
                </a>
            </li>
            <li class="px-3 py-3 md:py-4 md:gap-x-1 text-sm border-b hover:bg-gray-200 hover:text-white">
                <a href="users.php" class="flex justify-center gap-x-0 text-gray-600 md:gap-x-1 md:justify-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                    </svg>
                    <span class="hidden md:block">Users</span>
                </a>
            </li>
            <li class="px-3 py-3 md:py-4 md:gap-x-1 text-sm border-b hover:bg-gray-200 hover:text-white">
                <a href="/logout.php" class="flex justify-center gap-x-0 text-gray-600 md:gap-x-1 md:justify-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                    </svg>
                    <span class="hidden md:block">Logout</span>
                </a>
            </li>
        </ul>
    </div>
    
    <div class="h-screen w-full m-3">
    <!-- content goes here -->