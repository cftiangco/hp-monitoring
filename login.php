<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>HP Monitoring System / Login</title>
</head>
<body>
    <div class="grid grid-cols-1 lg:grid-cols-2">
        <div class="bg-green-100 h-screen hidden lg:block"></div>
        
        <div class="h-screen">
            <div class="flex flex-col items-center justify-center h-full">
                <h2>Login</h2>
                <form action="">

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="">Username</label>
                        <input type="text" placeholder="Enter username" class="bg-gray-50 outline-none border px-3 py-2 rounded w-96 hover:border-2 hover:border-blue-300 hover:bg-white">
                    </div>

                    <div class="flex flex-col gap-y-2 mb-3">
                        <label for="">Password</label>
                        <input type="text" placeholder="Enter password" class="bg-gray-50 outline-none border px-3 py-2 rounded w-96 hover:border-2 hover:border-blue-300 hover:bg-white">
                    </div>
                    
                    <div>
                        <button type="submit" class="bg-blue-400 text-white py-2 px-5 rounded flex items-center gap-x-1 hover:bg-blue-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span>Login</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>