<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="sidebar/css/bootstrap.min.css">
</head>

<body>
    <?php include "NavBar/NavBar.php"; ?>
    <section class="py-5">
        <div class="container">
            <div class="row gx-4 align-items-center justify-content-between">
                <div class="col-md-5 order-2 order-md-1">
                    <div class="mt-5 mt-md-0">
                        <h2 class="display-5 fw-bold">About Us</h2>
                        <p class="lead">
                        Bienvenue à Al Ihsan, un phare d’espoir et de compassion dans le monde de la philanthropie. À 
                   Ihsan, nous croyons au pouvoir de l’effort collectif et à l’impact profond de la générosité.
                            Notre plateforme est dédiée à combler le fossé entre ceux qui sont dans le besoin et ceux qui sont prêts à
                            aider, fournir un moyen transparent et transparent pour vous de faire une différence..</p>
                    </div>
                </div>
                <div class="col-md-6 offset-md-1 order-1 order-md-2">
                    <div class="row gx-2 gx-lg-3">
                        <div class="col-6">
                            <div class="mb-2"><img loading="lazy" class="img-fluid rounded-3" src="icons/1.jpg"></div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2"><img loading="lazy" class="img-fluid rounded-3" src="icons/2.jpg"></div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2"><img loading="lazy" class="img-fluid rounded-3" src="icons/3.jpg"></div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2"><img loading="lazy" class="img-fluid rounded-3" src="icons/4.jpg"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include "Footer/Footer.php"; ?>
</body>

</html>