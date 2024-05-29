<?php

include_once "conndatabase.php";
session_start();
if(!isset($_SESSION['id']) || $_SESSION['role']!=="admin")
{
  header('location:index.php');
  die;
}

if(isset($_GET['d']) && !empty($_GET['d']))
{
    $deleteuser=$_GET['d'];
    $delete=mysqli_query($connfig,"DELETE FROM `users` WHERE id_user='$deleteuser' LIMIT 1");
    if($delete)
    {
        header('location:admin.php');
        die;
    }
}

?>