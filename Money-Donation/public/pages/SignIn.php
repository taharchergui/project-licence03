<?php
session_start();


if (isset($_SESSION['email'])) {
    if ($_SESSION['role'] == "donnator") {
        header("Location:DashboardDonnateur.php?p=profile");
    } else if ($_SESSION['role'] == "beneficiary") {
        header("location:DashboardBenificateur.php?p=profile");

    } 
}
include_once "conndatabase.php";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $valide = mysqli_query($connfig, "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1");
    if (mysqli_num_rows($valide) == 1) {
        $row = mysqli_fetch_assoc($valide);
        $_SESSION['email'] = $row['email'];
        $_SESSION['id'] = $row['id_user'];
        $_SESSION['role'] = $row['role'];


        if ($row['role'] === "donnator") {
            header('location:DashboardDonnateur.php?p=profile');
            die;
        } else if ($row['role'] === "beneficiary") {
            header('location:DashboardBenificateur.php?p=profile');
            die;
        }else if($row['role']==="admin")
        {
            header('location:admin.php');
            die;
        }
    } else {
        $_SESSION['back'] = "Invalid email or password";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <?php

    include "NavBar/NavBar.php";


    ?>

    <div class="flex flex-col items-center justify-center h-screen">
        <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
            <?php if (isset($_SESSION['back']) && !empty($_SESSION['back'])): ?>
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">

                    <?php {
                        echo '
                    
                        <span class="font-medium"></span>' . $_SESSION['back'] . '';
                    }
                    unset($_SESSION['back']);
                    ?>
                </div>

            <?php endif; ?>


            <?php if (isset($_SESSION['Go']) && !empty($_SESSION['Go'])): ?>
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                    role="alert">
                    <?php {
                        echo '
                    
                        <span class="font-medium">Success Sign up!</span>' . $_SESSION['Go'] . '';
                    }
                    unset($_SESSION['Go']);
                    ?>
                </div>
            <?php endif; ?>




            <h2 class="text-2xl text-center font-bold text-gray-900 mb-4">Sign In</h2>
            <form class="flex flex-col" action="#" method="post">
                <input type="email" name="email"
                    class="bg-gray-100 text-gray-900 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
                    placeholder="Email address" required>
                <p class="text-red-600"><?php if (isset($error))
                    echo $error; ?></p>

                <input type="password" name="password"
                    class="bg-gray-100 text-gray-900 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
                    placeholder="Password" required>
                <p class="text-red-600"><?php if (isset($error))
                    echo $error; ?></p>

                <div class="flex items-center justify-between flex-wrap">

                    <p class="text-gray-900 mt-4"> Vous n’avez pas de compte ? <a href="SignUp.php"
                            class="text-sm text-blue-500 -200 hover:underline mt-4">Signup</a></p>
                </div>
                <button type="submit" name="login"
                    class="bg-gradient-to-r from-indigo-500 to-blue-500 text-white font-bold py-2 px-4 rounded-md mt-4 hover:bg-indigo-600 hover:to-blue-600 transition ease-in-out duration-150">Sign
                    In</button>
            </form>
        </div>
    </div>

    <?php include "Footer/Footer.php"; ?>



</body>

</html>