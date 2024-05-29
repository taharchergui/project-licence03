<?php

include_once "conndatabase.php";
session_start();

if(isset($_GET['d']) && !empty($_GET['d']))
{
    $deleteproject=$_GET['d'];
    $delete=mysqli_query($connfig,"DELETE FROM `projects` WHERE id_projects='$deleteproject' AND id_user='{$_SESSION['id']}' LIMIT 1");
    if($delete)
    {
        header('location:DashboardBenificateur.php?p=myProjects');
        die;
    }
}


?>