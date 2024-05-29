<?php 
// session_start();
    include_once "conndatabase.php";

if(!isset($_SESSION['email']) || !isset($_SESSION['id']))
{
    header("Location:SignIn.php");
    die;
}else
{
    $email = $_SESSION['email'];
    $id = $_SESSION['id'];
    $get_infos=mysqli_query($connfig,"SELECT * FROM users WHERE email='$email' AND id_user='$id' LIMIT 1");
    if(mysqli_num_rows($get_infos) > 0)
    {
        $infos = mysqli_fetch_assoc($get_infos);
    }
}


if(isset($_POST['enregistrer']))
{
    $er=0;
    if(empty($_POST['nomprojet']))
    {
        $_SESSION['back']="Required!";

        $er=1;
    }else
    {

        $nomprojet = $_POST['nomprojet'];

    }

    if(empty($_POST['description']))
    {
        $_SESSION['back']="Required!";

        $er=1;
    }else
    {
         $description = $_POST['description'];

    }

    if(empty($_POST['objectif']))
    {

        $_SESSION['back']="Required!";
    
        $er=1;
    }else
    {
        if (!preg_match('/^\d{1,9}$/', $_POST['objectif'])) {
        $_SESSION['back']=" Enter a valid Amount!";
        $er = 1; 
        } else {
            $objectif=$_POST['objectif'];
            
        }

    }

    if(isset($_FILES['pic_profile'])) {

        $image_name = $_FILES['pic_profile']['name'];
        $image_size = $_FILES['pic_profile']['size'];
        $image_error = $_FILES['pic_profile']['error'];
        
        $ex = explode('.', $image_name);   
        $end_name = strtolower(end($ex));  
        $allowed = array('png', 'jpg', 'jpeg', 'svg', 'gif'); 

        if(in_array($end_name, $allowed)) {
            if($image_error === 0) {
                if($image_size < 4000000) { 
                    $new_name = uniqid('',true) . '_' . $image_name;
                    $dir = "./pfp_project/".$new_name;

                 
                    

                        if(move_uploaded_file($_FILES['pic_profile']['tmp_name'], $dir)) {
                            
                            
                        } else {
                            $_SESSION['back'] = "Error uploading the image!";
                            $er=1;
                        }
                   
                    
                    
                } else {
                    $_SESSION['back'] = "Your image is too large. !";
                    $er=1;

                }
            } else {
                $_SESSION['back'] = "We have an error with your image !";
                $er=1;

            }
        } else {
            $_SESSION['back'] = "Choose an image with the correct type !";
            $er=1;

        }
    }else
    {
        $_SESSION['back']=" Image Required!";
        $er=1;

    }


    if($er==0)
    {
        $date=date("Y-m-d H:i:s");
        $projet=mysqli_query($connfig,"INSERT INTO `projects`(`id_user`, `project_name`, `Description`, `Objectif`, `date`, `project_photo`) VALUES
         ('$id','$nomprojet','$description','$objectif','$date','$new_name')");

         if($projet)
         {
            $_SESSION['Go']= "Project Added successfully!";
           
         }
    }


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Launch Project</title>
    <!-- <link rel="stylesheet" href="index.css"> -->
</head>
<body>
    <div class=" w-full sm:w-3/5  mx-auto my-16 bg-white border-2 rounded-lg shadow-md p-6">
        <h2 class="text-2xl text-center font-bold text-gray-800 mb-4">Launch Project</h2>


        <?php   if(isset($_SESSION['back']) && !empty($_SESSION['back'])): ?>
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">

            <?php
                {
                    echo'
                    
                        <span class="font-medium"></span>'.$_SESSION['back'].'';
                 }
                unset($_SESSION['back']);
            ?>    
            </div>

        <?php endif;?>



        <?php   if(isset($_SESSION['Go']) && !empty($_SESSION['Go'])): ?>
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <?php
                {
                    echo'
                    
                        <span class="font-medium">Success !</span>'.$_SESSION['Go'].'';
                 }
                unset($_SESSION['Go']);
            ?>
            </div>
             <?php endif;?>

        <form class="flex flex-col" method="POST" enctype="multipart/form-data">
            <!-- Project Name -->
            <label for="nomprojet" class="block text-sm my-2 mx-2 font-medium text-gray-700">
                Project Name  <?php if(isset($erreur)) echo $erreur; ?>
            </label>
            <input type="text"
            name="nomprojet"
            id="nomprojet"
            required
            class="bg-gray-100 text-gray-800 border-0 rounded-md p-2 mb-2 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
            placeholder="Project Name">

            <!-- Decription  -->
            <label for="description" class="block text-sm my-2 mx-2 font-medium text-gray-700">
                Project Description
            </label>
            <textarea 
                name="description"
                id="description"
                required
                class="bg-gray-100 text-gray-800 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
                placeholder="Project Description"></textarea>

            

            <!-- Amount -->
            <label for="objectif" class="block text-sm my-2 mx-2 font-medium text-gray-700">
                Objectif (En DZD)
            </label>
            <input type="text"
            name="objectif"
            id="objectif"
            required
            class="bg-gray-100 text-gray-800 border-0 rounded-md p-2 mb-2 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
            placeholder="Objectif Amount">

            <!-- Beneficiaries Name -->
            <label for="beneficiaryname" class="block text-sm my-2 mx-2 font-medium text-gray-700">
                Beneficiary Full Name
            </label>
            <input type="text"
            name="beneficiaryname"
            id="beneficiaryname"
            value="<?=$infos['firstname'].' '.$infos['lastname'];?>"
            disabled
            required
            class="bg-gray-100 text-gray-800 border-0 rounded-md p-2 mb-2 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
            placeholder="Beneficiary Full name">

            <!-- Beneficiary Email  -->
            <label for="beneficiaryemail" class="block text-sm my-2 mx-2 font-medium text-gray-700">
                Beneficiary Email
            </label>
            <input type="email"
            id="beneficiaryemail"
            name="beneficiaryemail"
            value="<?=$infos['email'];?>"
            disabled
            required
            class="bg-gray-100 text-gray-800 border-0 rounded-md p-2 mb-2 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
            placeholder="Beneficiary Email">
            

            <!-- Project Picture -->
            <label for="picture" class="block text-sm my-2 mx-2 font-medium text-gray-700">
                Project Picture
            </label>
            <input type="file"
            name="pic_profile"
            id="picture"
            required
            class="bg-gray-100 text-gray-800 border-0 rounded-md p-2 mb-2 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
            placeholder="Project Picture">

            
            <button type="submit" name="enregistrer"
            class="bg-gradient-to-r from-indigo-500 to-blue-500 text-white font-bold py-2 px-4 rounded-md mt-4 hover:bg-indigo-600 hover:to-blue-600 transition ease-in-out duration-150">Launch Project</button>
        </form>
    </div>
    <br><br><br><br><br>
</body>
</html>