<?php
include_once "conndatabase.php";

session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <?php include "NavBar/NavBar.php"; ?>


    <h1 class="text-center text-4xl font-bold my-12">Our Projects</h1>



    <div class="grid gap-6 h-full p-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">
        <!-- Project Card -->

        <?php $get_projects = mysqli_query($connfig, "SELECT p.* , u.* FROM `projects` p JOIN `users` u ON p.id_user=u.id_user order by p.date desc");
        if (mysqli_num_rows($get_projects) > 0) {
            while ($row = mysqli_fetch_assoc($get_projects)) {
                echo '
                    <div class="bg-white rounded-lg shadow-md relative">
                    <img class="w-full sm:h-60 lg:h-80 object-cover rounded-t-lg" alt="Card Image" src="./pfp_project/' . $row['project_photo'] . '">
                    <div class="p-4 ">
                    <h2 class="text-xl font-bold">Project : ' . $row['project_name'] . '</h2> 
                    <p class="text-gray-600">' . $row['Description'] . '</p>
                    <h3 class="text-lg font-semibold mt-3 ">Montant : <span class="text-green-600"> ' . $row['Objectif'] . '</span>DA</h3>
                    <p class="text-gray-600 mb-16">Owner : ' . $row['firstname'] . ' ' . $row['lastname'] . '</p>
                    <div class="flex justify-end items-center mt-4">';
                if (isset($_SESSION['email'])) {

                    if ($_SESSION['role'] == "donnator") {
                        echo '
                            <a href="DashboardDonnateur.php?p=Donnation&projet=' . $row['project_name'] . '&v=' . $row['id_projects'] . '"><button class="absolute bottom-4 right-4 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-green-400">Donate</button></a>';
                    }
                } else {
                    echo ' <a href="SignIn.php"><button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-green-400">Donate</button></a>';
                }
                echo '
                    </div>
                    </div>
                    </div>';
            }
        }
        ?>


    </div>
    <?php include "Footer/Footer.php"; ?>

</body>

</html>