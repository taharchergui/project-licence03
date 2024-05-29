
<?php 
include_once "conndatabase.php";

//session_start();

$id=$_SESSION['id'];
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
    
    <div class="grid gap-6 w-full h-full p-4 mt-16 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3">
        <?php   if(isset($_SESSION['Go']) && !empty($_SESSION['Go'])): ?>
                        <div class="p-4 mb-4 text-sm text-green-800 w-full rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                        <?php
                        {
                            echo'
                            
                                <span class="font-medium text-center">Success !</span>'.$_SESSION['Go'].'';
                         }
                        unset($_SESSION['Go']);
                    ?>
                    </div>
                     <?php endif;?>
        <!-- Project Card -->

        <?php $get_projects=mysqli_query($connfig,"SELECT p.* , u.* FROM `projects` p JOIN `users` u ON p.id_user=u.id_user WHERE u.id_user='$id' order by p.date desc");
            if(mysqli_num_rows($get_projects) > 0)
            {
                while($row=mysqli_fetch_assoc($get_projects))
                 {
                    echo'
                    <div class="bg-white rounded-lg shadow-md relative">
                    <img class="w-full  sm:h-60 lg:h-80 object-cover rounded-t-lg" alt="Card Image" src="./pfp_project/'.$row['project_photo'].'">
                    <div class="p-4 ">
                    <h2 class="font-bold text-base">Project : '.$row['project_name'].'</h2> 
                    <h3 class=" mt-2 font-semibold ">Montant : <span class="text-green-600"> '.$row['Objectif'].'</span>DA</h3>
                    <div class="flex justify-end gap-2 flex-col items-end sm:items-center sm:flex-row mt-4">
                    <a href="deleteproject.php?d=' . $row['id_projects'] . '" onclick="return confirm(\'Are you sure you want to delete your Project?\');">
                    <button class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-green-400">
                        Delete
                    </button>
                </a>
                    <a href="DashboardBenificateur.php?p=detailproject&d='.$row['id_projects'].'"><button class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-green-400">Details</button></a>
                    </div>
                    </div>
                    </div>';
                }
           }
       ?>
        
       
    </div>
</body>
</html>
