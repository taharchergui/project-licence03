<!doctype html>
<html lang="en">

<head>
  <title>Sidebar 04</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="../index.css">
</head>

<body>
  <?php
  include "./NavBar/NavBar.php";
  ?>

  <div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar" class="min-h-screen">
      <div class="custom-menu z-10">
        <button type="button" id="sidebarCollapse" class=" btn z-10 btn-primary">
          <i class="z-10 fa fa-bars"></i>
          <span class="z-10 sr-only">Toggle Menu</span>
        </button>
      </div>
      <ul class="list-unstyled components mb-5">
        <li class="active">
          <a href="DashboardDonnateur.php?p=profile"><span class="fa fa-home mr-3"></span> Profile</a>
        </li>
        <li class="active">
          <a href="DashboardDonnateur.php?p=historique"><span class="fa fa-home mr-3"></span> Donnation History</a>
        </li>
      </ul>

    </nav>

    <?php
    if (isset($_GET["p"]) && $_GET["p"] == "profile")
      include "profileuser.php";

    if (isset($_GET["p"]) && $_GET["p"] == "historique")
      include "donnationHistorique.php";

    if (isset($_GET["p"]) && $_GET["p"] == "Donnation")
      include "Donnation.php";
    ?>
  </div>
  <?php include "Footer/Footer.php"; ?>


  <script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
</body>

</html>