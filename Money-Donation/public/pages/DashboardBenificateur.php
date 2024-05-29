<?php 
session_start();
if(isset($_SESSION['email']))
{
   if($_SESSION['role']=="donnator")
    {
        header("location:DashboardDonnateur.php?p=profile");

    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="SideBar/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
	<link rel="stylesheet" href="SideBar/css/style.css">
</head>
<body>
    
    <?php 
        include "SideBar/sidebarBen.php";
    ?>
</body>
<script src="SideBar/js/jquery.min.js"></script>
    <script src="SideBar/js/popper.js"></script>
    <script src="SideBar/js/bootstrap.min.js"></script>
    <script src="SideBar/js/main.js"></script>
</html>