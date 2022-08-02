<?php 
    session_start();

    if(isset($_SESSION['user_id'])) {
        header('Location: index.php');
        exit();
    }

    require_once(dirname(__FILE__) . '/models/User.php');
    require_once(dirname(__FILE__) . '/func/helpers.php');
    $user = new User();

    $errors = [];

    if(isset($_POST['login'])) {
       $errors = [];
       if($_POST['username'] === "") {
            array_push($errors,"Username is required field");
       }

       if($_POST['password'] === "") {
            array_push($errors,"Password is required field");
       }

       if(count($errors) === 0) {
            $result = $user->login($_POST['username'],$_POST['password']);
            if(!$result) {
                array_push($errors,"The username that you've entered doesn't belong to an account");
            } else {
                if(checkPassword($_POST['password'],$result->pword)) {
                    userSession($result);
                    header('Location: index.php');
                    exit();
                } else {
                    array_push($errors,"Incorrect Password");
                }
            }
       }
    }

    function checkPassword($loginPassword,$sytemPassword) {
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
    <title>HP Monitoring System / Login</title>
</head>
<body class="font-mono">
    <div class="grid grid-cols-1 lg:grid-cols-2">

        <div class="h-screen w-full hidden lg:flex border-r flex-col justify-center items-center gap-y-2 bg-gray-100">
            <h1 class="text-4xl text-gray-700 text-center"><span class="text-green-600 font-bold">Household Profiling Monitoring System</span> <br/><span class="text-xl">Barangay Marinig Heath Center</span></h1>
            <div>
                <img src="assets/images/main-logo2.png" alt="Main Logo">
            </div>
        </div>

        <div class="h-screen bg-gray-50 lg:bg-white">
            <div class="flex flex-col items-center justify-center h-full gap-y-10">
                <h1 class="text-2xl font-bold text-gray-700 text-center text-yellow-500">LOGIN</h1>
                <?php if(count($errors) > 0): ?>
                    <ul class="flex flex-col gap-y-0 list-disc">
                        <?php foreach($errors as $error): ?>
                                <li class="text-red-400"><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

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
                </form>
            </div>
        </div>
    </div>
</body>
</html>