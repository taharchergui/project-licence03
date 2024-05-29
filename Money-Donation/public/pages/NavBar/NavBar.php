<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
</head>

<body>


    <?php if (isset($_SESSION['email']) && isset($_SESSION['id'])) {


        echo '

<nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                </div>
                <div class="flex flex-1 items-center justify-between sm:items-stretch sm:justify-between">
                    <div class="flex flex-shrink-0 items-center ">
                    <h5 class="text-white text-2xl ml-4 font-bold"><span class="text-blue-600">AL </span>IHSAN</h5>
                    </div>
                    <div class=" sm:ml-6 block">
                        <div class="flex space-x-4">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            <a href="index.php" class="text-gray-300 hover:bg-gray-700 rounded-md px-3 py-2 text-sm font-medium"
                                aria-current="page">Home</a>
                            <a href="Projects.php"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Projects</a>
                            <a href="AboutUs.php"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">About
                                Us</a>
                            <a href="contact.php"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Contact</a>';
        if ($_SESSION['role'] == "donnator") {

            echo '
                                <a href="DashboardDonnateur.php?p=profile"
                                    class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Dashboard</a>';
        } else if ($_SESSION['role'] == "beneficiary") {
            echo '
                                    <a href="DashboardBenificateur.php?p=profile"
                                        class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Dashboard</a>';

        }

        echo '
                        </div>
                    </div>
                </div>
                <div class="inset-y-0 right-0 flex items-center pr-2 static sm:inset-auto sm:ml-6 sm:pr-0">
    
                    <!-- Profile dropdown -->
                    <div class="relative ml-3">
                        <div>
                            <a href="logout.php" class="relative flex  text-sm text-white font-bold" id="user-menu-button"
                                aria-expanded="false" aria-haspopup="true">
                               Log out
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>';
    }


    ?>


    <?php if (!isset($_SESSION['id']) && !isset($_SESSION['email'])) {
        echo '

<nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                </div>
                <div class="flex flex-1 items-center justify-between sm:items-stretch sm:justify-between">
                    <div class="flex flex-shrink-0 items-center ">
                    <h5 class="text-white text-2xl ml-4 font-bold"><span class="text-blue-600">AL </span>IHSAN</h5>
                    </div>
                    <div class=" sm:ml-6 block">
                        <div class="flex space-x-4">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            <a href="/Money-Donation/public/pages/index.php" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium"
                                aria-current="page">Home</a>
                            <a href="/Money-Donation/public/pages/Projects.php"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Projects</a>
                            <a href="/Money-Donation/public/pages/AboutUs.php"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">About
                                Us</a>
                            <a href="/Money-Donation/public/pages/Contact.php"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Contact</a>
                        </div>
                    </div>
                </div>
                <div class="inset-y-0 right-0 flex items-center pr-2 static sm:inset-auto sm:ml-6 sm:pr-0">
    
                    <!-- Profile dropdown -->
                    <div class="relative ml-3">
                        <div>
                            <a href="SignIn.php" class="relative flex  text-sm text-white font-bold" id="user-menu-button"
                                aria-expanded="false" aria-haspopup="true">
                                Sign In
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>';
    }
    ?>

</body>

</html>