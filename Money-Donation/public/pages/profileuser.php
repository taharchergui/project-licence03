<?php

include_once "conndatabase.php";
// session_start();

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



if(isset($_POST['changer']))
{

    $error=0;

    if(isset($_POST['password']) && !empty($_POST['password']))
    {


        $password =mysqli_real_escape_string($connfig,$_POST['password']);

        if(strpos($password, ' ') !== false)
        {
            $error=1;
            $e_password="le Mot de passe ne doit pas contenir des espaces!";


        }else if(strlen($password) < 8)
        {
            $error=1;
            $e_password="Le mot de passe doit contenir au moins 8 caractères!";
        }

    }else
    {
    $error=1;
        $e_password="Obligatoire!";
    }

    if(isset($_POST['new_password']) && !empty($_POST['new_password']))
    {


        $new_password =mysqli_real_escape_string($connfig,$_POST['new_password']);
        

        if(strpos($new_password, ' ') !== false)
        {
            $error=1;
            $e_new_password="le Mot de passe ne doit pas contenir des espaces!";


        }elseif(strlen($new_password) < 8)
        {
            $error=1;
            $e_new_password="Le mot de passe doit contenir au moins 8 caractères!";
        }

    }else
    {
    $error=1;
        $e_new_password="Obligatoire!";
    }

    if($error==0)
    {
        $stmt = $connfig->prepare("SELECT `password` FROM `users` WHERE `email` = ? AND `id_user`= ? LIMIT 1");
        $stmt->bind_param("ss", $email,$id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $old_password = $row['password'];
        if ($password=== $old_password) {
            if($new_password!==$old_password)
            {   
                $stmt = $connfig->prepare("UPDATE `users` SET `password` = ? WHERE `email` = ? AND `password`= ? AND `id_user`=?  LIMIT 1");
                $stmt->bind_param("ssss", $new_password, $email,$old_password,$id);
                $stmt->execute();
                $stmt->close();
                $_SESSION['Go']= "Votre mot de passe a été modifié avec succès.";
                // header('location:profileuser.php');
                die;
            }
            else
            {
              $_SESSION['back']="Vous etes deja utiliser ce mot de passe!";
              header('location:profileuser.php');
              die;
                
            }
        }else
        {
          $_SESSION['back']="Mot de pass incorect!";
          header('location:profileuser.php');
          die;
         
           
        }

        }
    }



}


if (isset($_POST['delete'])) {
    $error_delete=0;

    if(isset($_POST['password_delete']) && !empty($_POST['password_delete']))
    {


        $password_delete =mysqli_real_escape_string($connfig,$_POST['password_delete']);

        if(strpos($password_delete, ' ') !== false)
        {
            $error_delete=1;
            $_SESSION['back']="le Mot de passe ne doit pas contenir des espaces!";
            header('location:profileuser.php');
            die;


        }else if(strlen($password_delete) < 8)
        {
            $error_delete=1;
            $_SESSION['back']="Le mot de passe doit contenir au moins 8 caractères!";
            header('location:profileuser.php');
            die;
        }

    }else
    {
    $error_delete=1;
    $_SESSION['back']="Obligatoire!";
    }

    if($error_delete==0)
    {   
        if(!empty($password_delete))
        {

            $stmt = $connfig->prepare("SELECT  `password` FROM `users` WHERE `email` = ? AND `id_user`=? LIMIT 1");
            $stmt->bind_param("ss", $email,$id);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $row_delete = $result->fetch_assoc();
            $pass=$row_delete['password'];
        if ($password_delete===$pass) {
            
            $stmt = $connfig->prepare("DELETE FROM `users` WHERE `email` = ? AND `id_user`=? AND `password`=? LIMIT 1");
            $stmt->bind_param("sss", $email,$id,$pass);
            
            
            

            $stmt->execute();
            
            
            $stmt->close();
            
              
            header('location:logout.php');
            die;
            
        }else{
            $_SESSION['back']="Mot de passe  incorrect!";
            header('location:profileuser.php');
            die;

        }
        }else
        {
          $_SESSION['back'] = "Obligatoire!";
          header('location:profileuser.php');
          die;
            

        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
    <title>Profile</title>
</head>
<body>
<main class="profile-page w-full">


<?php   if(isset($_SESSION['back']) && !empty($_SESSION['back'])): ?>
            <div class="fixed z-10 w-full top-0 p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">

            <?php
                {
                    echo'
                    
                        <span class="font-medium"></span>'.$_SESSION['back'].' ';
                }
                      unset($_SESSION['back']);
                 ?>    
            </div>
            
            
            <?php endif; ?>





            <?php   if(isset($_SESSION['Go']) && !empty($_SESSION['Go'])): ?>
            <div class="fixed z-10 w-full top-0 p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">

            <?php
                {
                    echo'
                    
                        <span class="font-medium"></span>'.$_SESSION['Go'].' ';
                }
                      unset($_SESSION['Go']);
                 ?>    
            </div>
            
            
            <?php endif; ?>



            
  <section class="relative block z-0  h-500-px">
    <div class="absolute top-0 z-0 w-full h-full bg-center bg-cover" style="
            background-image: url('https://images.unsplash.com/photo-1499336315816-097655dcfbda?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=2710&amp;q=80');
          ">
      <span id="blackOverlay" class="w-full h-full absolute opacity-50 bg-black"></span>
    </div>
    <div class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden h-70-px" style="transform: translateZ(0px)">
      <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
        <polygon class="text-blueGray-200 fill-current" points="2560 0 2560 100 0 100"></polygon>
      </svg>
    </div>
  </section>
  <section class="relative py-16 bg-blueGray-200">
    <div class="container w-full mx-auto px-4">
      <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg -mt-64">
        <div class="px-6">
          <div class="flex flex-wrap justify-center">
            <div class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center">
              <div class="relative">
                <img alt="..." src="icons/employe.png" class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-150-px">
              </div>
            </div>
            <div class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center">
              <div class="py-6 px-3 mt-32 sm:mt-0">
                <a href="logout.php">
                  <button  class="bg-pink-500 active:bg-pink-600 uppercase text-white font-bold hover:shadow-md shadow text-xs px-4 py-2 rounded outline-none focus:outline-none sm:mr-2 mb-1 ease-linear transition-all duration-150" type="button">
                    Logout
                  </button>
                </a>
              </div>
            </div>
            <div class="w-full lg:w-4/12 px-4 lg:order-1">
              <div class="flex justify-center py-4 lg:pt-4 pt-8">
                <?php
                    if($_SESSION['role']=="donnator")
                    {
                      $get_don=mysqli_query($connfig,"SELECT * FROM `donation` WHERE id_user='{$_SESSION['id']}'");
                      $num_don=mysqli_num_rows($get_don);

                      echo' <div class="mr-4 p-3 text-center">
                        <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">'.$num_don.'</span><span class="text-sm text-blueGray-400">My donation</span>
                      </div>';
                    }else if($_SESSION['role']=="beneficiary")
                    {
                      $get_project=mysqli_query($connfig,"SELECT * FROM `projects` WHERE id_user='{$_SESSION['id']}'");
                      $num_project=mysqli_num_rows($get_project);
                        echo'
                        <div class="mr-4 p-3 text-center">
                          <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">'.$num_project.'</span><span class="text-sm text-blueGray-400">Projects</span>
                        </div>';
                    }
                ?>
              
              </div>
            </div>
          </div>
          <div class="text-center mt-12">
            <h3 class="text-4xl font-semibold leading-normal text-blueGray-700 mb-2">
              <?php echo $infos['firstname'].' '.$infos['lastname'] ; ?>
            </h3>
            <div class="text-sm leading-normal mt-0 mb-2 text-blueGray-400 font-bold uppercase">
            <img src="icons/email.png" width="20px" alt=""
               class="fas fa-map-marker-alt mr-2 text-lg text-blueGray-400">
              <?php echo $infos['email'] ; ?>
            </div>
            <div class="text-sm leading-normal mt-0 mb-2 text-blueGray-400 font-bold uppercase">
            <img src="icons/conversation.png" width="20px" alt=""
               class="fas fa-map-marker-alt mr-2 text-lg text-blueGray-400">
              <?php echo $infos['phone']; ?>

            </div>
            
            
        </div>
          <div class="mt-10 py-10 border-t border-blueGray-200 text-center">
            <div class="flex flex-wrap justify-center">
              <div class="w-full lg:w-9/12 px-4">
              <h6 class="text-2xl text-center font-bold text-gray-900 mb-4">Change Password</h6>
              <form class="flex flex-col" action="#" method="post">
                <input type="password"
                   name="password" class="bg-gray-100 text-gray-900 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
                    placeholder="Password" required>
                    <p class="text-red-600"><?php if(isset($e_change)) echo $e_change;  ?></p>

                <input type="password"
                   name="new_password"  class="bg-gray-100 text-gray-900 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
                    placeholder="New Password" required>
                <p class="text-red-600"><?php if(isset($e_cha)) echo $e_cha; ?></p>

                
                <button type="submit"
                  name="changer"  class="w-1/2 mx-auto mb-20 bg-black text-white font-bold py-2 px-4 rounded-md mt-4 hover:bg-gray-700 transition ease-in-out duration-150">Change</button>
            </form>
            <h6 class="text-2xl text-center font-bold text-gray-900 mb-4">Delete Account</h6>
            <form class="flex flex-col" action="#" method="post">
                <input type="password"
                   name="password_delete" class="bg-gray-100 text-gray-900 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
                    placeholder="Password" required>
                    <p class="text-red-600 font-medium mb-8 text-start"><?php if(isset($e_password_delete)) echo $e_password_delete;  ?></p>


                
                <button type="submit"
                  name="delete"  class="bg-red-500 w-1/2 mx-auto text-white font-bold py-2 px-4 rounded-md mt-4 hover:bg-red-600 border-red-500 transition ease-in-out duration-150" onclick="return confirm('Are you sure want to delete you account ?');">Delete</button>
            </form>
               
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
</main>
</body>
</html>

