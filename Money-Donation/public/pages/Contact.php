<?php
session_start();
if(isset($_POST['contacter']))
{
    $k=0;
    if(isset($_POST['fullname']) && !empty($_POST['fullname']))
    {

        $nom = $_POST['fullname'];
    }else
    {
        $k=1;
    }


    if(isset($_POST['email']) && !empty($_POST['email']))
    {

        $email = $_POST['email'];
    }else
    {
        $k=1;
    }


    if(isset($_POST['message']) && !empty($_POST['message']))
    {

        $message = $_POST['message'];
    }else
    {
        $k=1;
    }


    if($k==0)
    {
      $_SESSION['envoyer']="Message sent successfully!";
      header("Location: contact.php");
      die;
    }
   
    


}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link href="index.css" rel="stylesheet">
</head>

<body>
    <?php

    include "NavBar/NavBar.php";


    ?>

    <br><br>
    <div class="max-w-md mx-auto mb-16 mt-8 bg-white border-2 rounded-lg shadow-md p-6">
        <h2 class="text-3xl text-center font-bold text-gray-800 mb-4">Contact Us</h2>
        <h4 class="text-md text-center font-medium text-gray-500 mb-4">Help Us To Improve</h4>
        <?php if (isset($_SESSION['envoyer']) && !empty($_SESSION['envoyer'])): ?>
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                    role="alert">
                    <?php {
                        echo '
                    
                        <span class="font-medium">Success </span>' . $_SESSION['envoyer'] . '';
                    }
                    unset($_SESSION['envoyer']);
                    ?>
                </div>
            <?php endif; ?>
        <form class="flex flex-col" method="post">
            <label for="fullname" class="block text-sm my-2 mx-2 font-medium text-gray-700">
                Full Name
            </label>
            <input type="text" id="fullname" name="fullname"
                class="bg-gray-100 text-gray-800 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
             required   placeholder="Full Name">

            <label for="projectname" class="block text-sm my-2 mx-2 font-medium text-gray-700">
                Email
            </label>
            <input type="email" id="email" name="email"
                class="bg-gray-100 text-gray-800 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
              required  placeholder="Email">


            <label for="message" class="block text-sm my-2 mx-2 font-medium text-gray-700">
                Your Message
            </label>
            <textarea name="message" id="message" name="message"
                class="bg-gray-100 text-gray-800 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
             required   placeholder="Message"></textarea>

            <button type="submit" name="contacter"
                class="bg-gradient-to-r from-indigo-500 to-blue-500 text-white font-bold py-2 px-4 rounded-md mt-4 hover:bg-indigo-600 hover:to-blue-600 transition ease-in-out duration-150">Submit</button>
        </form>
    </div>

    <?php include "Footer/Footer.php"; ?>

</body>

</html>