<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Al Ihsan - Home</title>
</head>

<body class="bg-gray-100">
    <?php include "NavBar/NavBar.php"; ?>

    <!-- Hero Section -->
    <section class="bg-cover bg-center h-screen" style="background-image: url('icons/2.jpg');">
        <div class="flex items-center justify-center h-full bg-black bg-opacity-50">
            <div class="text-center text-white">
                <h1 class="text-5xl font-bold mb-4">Bienvenue à Al-Ihsan</h1>
                <p class="text-2xl w-3/4 mx-auto mb-8">
                Nous nous engageons à améliorer des vies à travers une variété de projets visant à résoudre les problèmes clés dans nos communautés. Nous croyons au pouvoir de l’action collective et fournissons une plate-forme aux donateurs pour contribuer à des causes significatives</p>

                <a href="projects.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    View Projects
                </a>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="py-12 bg-blue-500 text-white text-center">
        <h2 class="text-4xl font-bold mb-4">Aidez-nous à faire une différence</h2>
        <p class="text-lg mb-8">Notre objectif est d'améliorer les conditions de vie des personnes en difficulté grâce à votre générosité.
.</p>
        <a href="signup.php" class="bg-white text-blue-500 font-bold py-2 px-4 rounded">Sign Up Now !</a>
    </section>

    <?php include "Footer/Footer.php"; ?>
</body>

</html>