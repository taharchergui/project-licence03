<?php 
//session_start();
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

$_SESSION['project']=$_GET['projet'];
$_SESSION['id_project']=$_GET['v'];



if(isset($_POST['save']))
{
        $e=0;
        $donnationType=$_POST['donnationType'];
        if(!in_array($donnationType,['penctuel Donnation','Mensuel Donnation']))
        {
            $e=1;
        }

        
        if(empty($_POST['amount']))
        {

            $_SESSION['back']="Required!";
    
            $e=1;
        }else
        {
            if (!preg_match('/^\d{1,9}$/', $_POST['amount'])) {
                $_SESSION['back']=" Enter A Valid Amount!";
                $e= 1; 
             } else {
            $amount=$_POST['amount'];
            
            }

        }


        if(empty($_POST['cardtype']))
        {
            $e=1;
            $_SESSION['back']="Required!";

        }else
        {
            $cardtype=$_POST['cardtype'];
            if(!in_array($cardtype,['Dahabiya Card','Societe Generale Card','Cpa Card','BNA Card']))
            {
                    $e=1;
                    $_SESSION['back']="Invalid Type Card!";
            }
        }

        

        if(empty($_POST['cardnumber']))
        {
            $e=1;
            $_SESSION['back']="Required!";

        }else
        {
            
            if (!preg_match('/^\d{12}$/', $_POST['cardnumber'])) {
                $_SESSION['back']=" Invalid card number!";
                $e= 1; 
             } else {
                $cardnumber=$_POST['cardnumber'];
            
            }
           
        }

        

        if(empty($_POST['expirationdate']))
        {
            $e=1;
            $_SESSION['back']="Required!";

        }else
        {
            
            if (!preg_match('/^(0[1-9]|1[0-2])\/\d{2}$/', $_POST['expirationdate'])) {
                $_SESSION['back']=" Invalid expiration date!";
                $e= 1; 
             } else {
                $expirationdate=$_POST['expirationdate'];
            
            }
           
        }

        


        if(empty($_POST['ccv']))
        {
            $e=1;
            $_SESSION['back']="Required!";

        }else
        {
            if (!preg_match('/^\d{3}$/', $_POST['ccv'])) {
                $_SESSION['back']=" Invalid CCV!";
                $e=1; 
             } else {
                $ccv=$_POST['ccv'];
            
            }
               
           
        }

        if($e==0)
        {
            $date=date("Y-m-d H:i:s");
            $sql=mysqli_query($connfig,"INSERT INTO `donation`(`id_user`, `id_projects`, `donation_type`, `amount`, `card_type`, `card_number`, `expiration_date`, `ccv`, `date_donation`) VALUES
             ('$id','{$_SESSION['id_project']}','$donnationType','$amount','$cardtype','$cardnumber','$expirationdate','$ccv','$date')");
             if($sql)
             {
                $_SESSION['Go']="Thank you for your donnation!";
                $e=1;
                
                

             }
        }


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make Donnation</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
   
    <div class="w-full sm:w-3/5  mx-auto  my-16 bg-white border-2 rounded-lg shadow-md p-6">
        <h2 class="text-2xl text-center font-bold text-gray-800 mb-4">Make Donnation</h2>
        
      
        <?php   if(isset($_SESSION['Go']) && !empty($_SESSION['Go'])): ?>
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <?php
                {
                    echo'
                    
                        <span class="font-medium text-center">Success !</span>'.$_SESSION['Go'].'';
                 }
                unset($_SESSION['Go']);
            ?>
            </div>
             <?php endif;?>

             
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



    
        <form class="flex flex-col" method="POST">
            <!-- Project Name -->
            <label for="projectname" class="block text-sm my-2 mx-2 font-medium text-gray-700">
                Project Name
            </label>
            <input type="text"
            name="projectname"
            id="projectname"
            
            required
            value="<?= $_GET['projet']?>"
            disabled
            class="bg-gray-100 text-gray-800 border-0 rounded-md p-2 mb-2 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
            >
          
            <!-- Full Name -->
            <label for="fullname" class="block text-sm my-2 mx-2 font-medium text-gray-700">
                Full Name
            </label>
            <input type="text"
            name="fullname"
            id="fullname"
            value="<?php echo $infos['firstname'].' '.$infos['lastname'] ?>"
            disabled
            required
            class="bg-gray-100 text-gray-800 border-0 rounded-md p-2 mb-2 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
            placeholder="Full Name">

            <!-- Email  -->
            <label for="email" class="block text-sm my-2 mx-2 font-medium text-gray-700">
                Email
            </label>
            <input type="email"
            id="email"
            name="email"
            disabled
            value="<?php echo $infos['email'] ?>"
            required
            class="bg-gray-100 text-gray-800 border-0 rounded-md p-2 mb-2 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
            placeholder="Email">

            <!-- Donnation Type -->
            <label for="donnationType" class="block text-sm my-2 mx-2 font-medium text-gray-700">
                Donnation Type
            </label>
            <select name="donnationType" required id="donnationType" class=" w-full p-2 rounded-md border border-gray-300 bg-white text-sm text-gray-700 shadow-sm" required>
                <option value="" selected disabled>Donnation Type</option>
                <option value="penctuel Donnation" >Penctuel Donnation</option>
                <option value="Mensuel Donnation" >Mensuel Donnation</option>
            </select>

            <!-- Amount -->
            <label for="amount" class="block text-sm my-2 mx-2 font-medium text-gray-700">
                Amount
            </label>
            <input type="text"
            name="amount"
            id="amount"
            required
            class="bg-gray-100 text-gray-800 border-0 rounded-md p-2 mb-2 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
            placeholder="Amount">

            <!-- Paiement Mode -->
            <label for="donnationType" class="block text-sm my-2 mx-2 font-medium text-gray-700">
                Paiement Mode
            </label>
            <select name="cardtype" required id="donnationType" class=" w-full p-2 rounded-md border border-gray-300 bg-white text-sm text-gray-700 shadow-sm" required>
                <option value="" selected disabled>Select A Card</option>
                <option value="Dahabiya Card" >Eddahabiya Card</option>
                <option value="Societe Generale Card" >Société Generale Card</option>
                <option value="Cpa Card" >CPA Card</option>
                <option value="BNA Card" >BNA Card</option>
            </select>

            <!-- Card Information -->
            <label for="" class="block text-sm mt-6 mb-2 mx-2 font-medium text-gray-700">
                Card Information
            </label>
            <input type="number"
            name="cardnumber"
            id="cardnumber"
            required
            class="bg-gray-100 text-gray-800 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
            placeholder="Card Number">

            <input type="text"
            name="expirationdate"
            id="expirationdate"
            required
            class="bg-gray-100 text-gray-800 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
            placeholder="Expiration Date  Ex : 12/24">
            
            <input type="number"
            name="ccv"
            id="ccv"
            required
            class="bg-gray-100 text-gray-800 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
            placeholder="CCV">

            
            
    
            <button type="submit" name="save"
                class="bg-gradient-to-r from-indigo-500 to-blue-500 text-white font-bold py-2 px-4 rounded-md mt-4 hover:bg-indigo-600 hover:to-blue-600 transition ease-in-out duration-150">Confirm</button>
        </form>
    </div>
    
</body>
</html>