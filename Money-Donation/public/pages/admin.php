<?php include_once "conndatabase.php"; ?>
<?php
session_start();
if(!isset($_SESSION['id']) || $_SESSION['role']!=="admin")
{
  header('location:index.php');
  die;
}

if (isset($_POST['signup'])) {
  $erreur = 0;
  $firstname = $_POST['first_name'];
  $lastname = $_POST['last_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $password = $_POST['password'];
  if (isset($_POST['role']) && !empty($_POST['role'])) {

      $role = $_POST['role'];
  }

  if (!in_array($role, ['donnator', 'beneficiary'])) {
      $erreur = 1;
      $_SESSION['back'] = "Email already exist !";


  }

  $check_unique = mysqli_query($connfig, "SELECT * FROM users WHERE email='$email' LIMIT 1");
  if (mysqli_num_rows($check_unique) > 0) {
      $erreur = 1;
  }



  if ($erreur == 0) {
      $date = date("Y-m-d H:i:s");
      $insert_data = mysqli_query($connfig, "INSERT INTO `users`(`firstname`, `lastname`, `email`, `phone`, `password`, `role`, `date`) VALUES
       ('$firstname','$lastname','$email','$phone','$password','$role','$date')");

      if ($insert_data) {
          $_SESSION['Go'] = "Account created succesfully !";
          
      }
  }
}


?>



<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Suivi des Dons</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=MFITTL9Tl-rQS4YPnvjRtaC7u35s5MLEd7AXA1lL-2bVreyXA17gtFnxXIrrU_3HwMWyc8HQwRhszQURxPL7xMe_8Vp_U1D7rgeLfguxh0vAiNIQMfwi3goMWyuCsBXW9ti9Ps2eRRZlFzHA8NWkdnaOmiv9mmsqLO3JPeMpOtsy16t375fXw-BopVT2HxkuAKGcdP9ChlVXBuUseHtr2UdLCDeE8PC6oEDFZK6iabd9vdDLswaN34Xkc7TOy92-zXMaMlNxWNS1C46vSEEhr4mIpDqw2_v96IG4Qb6MEoTaNbg4PXl5Xg_xqrvvuyDoFoV5R1OwzwHopy7XKbNmZbbRlA0hsIk7OeW2Y8yBWd04MRNMz_XnBZs8TuhZQhcmwOz1bxhj8dr_YSJgrNQX6fMTJdp7IX_nx8ACXZQUDBfPXCYGCL99XVRi1A26gbAu8uyBZtXmbQbDMvukmSmkzsu7XbNAk1jXsrn32pbJ-VtVcFy_EZIynJaUETCnAHs7Ol1TMisRUFqS_rMpBtBexmiUnXV1SWWQysGCUlbfsuQr9QeSV2eMEXt9DBz8DbqZoJ20b9Vf6O6T0MTsFQWHB-78_Pu0A3rSjTCe0VEhUzqUR4t3WdoIjkjxr14xXl_bUMil6HI4vapKRdR3ICiUT_n7gBd76MyeyqtK2mMUJ8S9zNLUkjEsVoybCclkk5Dv8UeQwgvJ72ol_7gkFJCaYd8ACwS7oxQwwyqeMvjtyBlpmVEeDbLgXXqr0-lKD8l8jFs1YWSEqCfSochXXh_hCZ9gM2x97CP_gqWq8OvwsCKBIFHTWJ1_6Gc0CNiE9A99b3Iqlssuo8qqUPrENsQPkSPksbdeY0MG3wUNE6VEwS7z0wT_d9gikrnqQqFaEq_RYErotULluMT_A3i5CpuiU4Ea1X8azrxx6ts0bohPzBxVPLbI5eFtkQKxJO2JPssoJF3fxevSNwqXOFpP2Y7Jj68rsgJ1vDSVDJOTEs98w7qpm34Mh1erbCz8qQzngbQdxjb-iWjwY5oVoTdgPxj1XQRv7nK44ojvIDO7ZC7bqJn-WmrtyXVxGIKUBIEEfLEKQvAYW0ibFOMdLyL5kbRbOKjQ1yD8ALw_2YXa_cevAZk7Soix9oEqjQhwg12VVF_tKhlkXY2ddiUpHSEEuYLskuJiaQNIRtYjdNCmgGk2iN290hDkec3FL2ttzsuBYHQZpbNgBhn5PkWpJkLxQMrK7UzLF4uqRvdCEo__B6gJvX5ksoxON2P8LKVAqYDSd8_ZmxbKsF3SapGiz1UeuVYeKdxbuXAhyp6q6Xyd-dfZ8bagZ0LbSgd8Dkm9Lg9cG8nI-Rf2tWU5ZM6aInwcf0ojEeTKl6qHUGnHMi44ofHYAb3TEdQfBm9DrmH6KpC7XFpRxhiSk7UnG7re03T6tKt3Vdx_bro8uGSePimewMRD0RAup8AL8nDHzo3dIa3JdCVc0KKhRQPxYTlDyHlcC_yVDdmIspPzK5st6eirWk1qy1uVDE3jLnjJOM1KeTJbkN0cEAxNO2W16o4HNNMqIQ1MjsT3509Nw76GjdsD6Xnq2wrSesnRI7GpnpgC2XUgMm8ADjT7DFZpY9zH9Ps55iIiTkdW8JpT0UTW5sWY1wVLJufbYNt6m81WHvQX1KuMRIfih71n3UAbcN4RucmrxdQolK0z-8nCgHkyFKJknuS94Xo" nonce="593232529412d8c99796f9db7db8b86c" charset="UTF-8"></script><link rel="stylesheet" crossorigin="anonymous" href="https://gc.kis.v2.scr.kaspersky-labs.com/E3E8934C-235A-4B0E-825A-35A08381A191/abn/main.css?attr=aHR0cHM6Ly9tYWlsLWF0dGFjaG1lbnQuZ29vZ2xldXNlcmNvbnRlbnQuY29tL2F0dGFjaG1lbnQvdS8wLz91aT0yJmlrPWU4YjhhNGFkYmImYXR0aWQ9MC4yJnBlcm1tc2dpZD1tc2ctZjoxNzk5Nzk1NTMwNTQxNzQ2ODAxJnRoPTE4ZmEyODdmZDI0NmNhNzEmdmlldz1hdHQmZGlzcD1zYWZlJnJlYWxhdHRpZD1mX2x3aWRhY2FyMiZzYWRkYmF0PUFOR2pkSl9haTcxUnJVWWVjeXlaZVNlN2Q5VklvcmlxTXg1anliU2lWUm1Jc3IxQ285RWdFY0dxN09MMExtVk5IMXdFbFNVSzNSSkVDaUx1aV9GOHVsVk1laHVDd01mQlRwYVJUR2pBckswTXd2cmxuUlMzeXhYUkhScGlFN2tGVXNsQ0RNODBKMEl1b3lBeHRFQlAzenJNZlo2ZVB5clBiZkcyRkQ1NTI1TjZpekhSZWUtcDdLYmh4UWFKWlRoSV9sZ3dCN0NmVnJTU1MwdHc4VXhQNDY3eDJmTmR6NmMydmdGcmdRQ194dlRIck1XemhLdGMwWlZaaHM5WF9acXZHbjZmZXU5ODFWRGxiX2RzWks5VUJFV0dPdjUyQ0tlT0MtNFhZQ21BOEZiUHV2dE00aFZpTGhINWJsYjVRejJzVXpLSnQzMzNUcXJyV2xkUG1UY1hVT1N0SGwwZTc2c0k4b2d5WUZMMEwyOUJTSXdJSkcycG00V3gzamNDNjdIUzNxSVRqNUd0ZnBNeENvWVpqUURjd090QXpuQUxmSFFTUkd2Nmt6UjZrQlE2N0FCRXFfTDJJVWFtdVZ4UVVIdmZZb0djU2VTREZDbEpVVmZ5MUR5dTNvaENnX0Uxcktzbldnc1dOQzJFVzBXa0EtYkhBVHh3NDBZdjh6aV8zbzVXOEVtYlZGVk14dkNMTTBIMnUtbWtsRXJsTjhRc01Zd0hHZ3F5anBVZ1U5X1V5NFVDdUVzdjZnVEZWWWpwbWRjS2laaEx2U3FVZ0VyRTd5UjJIc1hZaDFEQVF2X0J3ZmxlR0ZBal9iazBWUENlRFRyNEV5UWhaeWxheWNkVk1MeU9pLWFDQjB2eUhUVlFucHotNXBzQjBLbURaYTF2c2hTM2l2N2R3OXM3Q1pIZUhEaWE5SXBUaUZEQk9UWnQ3dUNQbGcyaGV1MnFkV2daREpvVmwzbE1xOVJTb2VNbWIxOEJiaFZldUJ2MUYxSWpFWDVsckN0ZU1VTC1PNHFkTUd0eXNuSEp1OXh0NEYza0p2SzlpX1VGQkxEUWxIVDdpc3pyWDhyMjE2emQyc0VXRTJicERqcjRkaHlmRndNWlFaVkpfUXIzT0lXSFdEUHduSkhJYnRmemFjdEcwSllIei1VTzVHbl9NRnZjTzNueFJUOWppZXI4eGtuQWdPTW1MOGVLS3I1d0tldV82ZkY1VHpKZVcyUG1XYXdkSTMxY0xManltOEdsbVJRRXdXWHdscGttcTRyN1B6VnhsY2pReUlaak9aR2Nyd3Z4NzFZSFd0NExvc1Q0VHZtazBjMzhyU05YVnVwRUdoNV9ZWW1XSHBRam9lUmphM08yOWY5QVJKWXk2akxwWmh4T05mVEZVMVVkYVdLNkNYeGVNOWtybThSU1ZsSU9ET3laZGc"/><style>
  
    body {
      font-family: Arial, sans-serif;
    }
  </style>
  
</head>
<body class="bg-light">

  <div class="container my-4">
    <h1 class="text-center mb-5">Page d'Administration                        <a href="logout.php" class="btn btn-danger" >Log out</a></h1>                 

    <section class="mb-5">
      <h2 class="mb-3">Suivi des Dons</h2>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Nom Utilisateur</th>
            <th>Projet</th>
            <th>Montant</th>
            <th>Mode de Paiement</th>
            <th>Date de Don</th>
          </tr>
        </thead>
        <tbody id="donationsTable">
          <?php $get_dons=mysqli_query($connfig,"SELECT 
    u.firstname AS 'First Name',
    u.lastname AS 'Last Name',
    p.project_name AS 'Project Name',
    d.card_type AS 'Card Type',
    d.amount AS 'Amount',
    d.date_donation AS 'Donation Date'
FROM 
    donation d
JOIN 
    users u ON d.id_user = u.id_user
JOIN 
    projects p ON d.id_projects = p.id_projects ORDER BY d.date_donation"); ?>
          <?php 
          if(mysqli_num_rows($get_dons)> 0)
          {
              while($row=mysqli_fetch_assoc($get_dons))
              { 
                echo'<tr><td>'.$row['First Name'].' '.$row['Last Name'].'</td>';
                echo'<td>'.$row['Project Name'].'</td>';
                echo'<td>'.$row['Amount'].' DA</td>';
                echo'<td>'.$row['Card Type'].'</td>';
                echo'<td>'.$row['Donation Date'].'</td></tr>';
              }
          }


          ?>
          
        </tbody>
      </table>
    </section>

    <section>
      <h2 class="mb-3">Gestion des Utilisateurs</h2>
      <?php if (isset($_SESSION['Go']) && !empty($_SESSION['Go'])): ?>
        <div class="alert alert-success" role="alert">
       
      
                
                    <?php {
                        echo  $_SESSION['Go'] ;
                    }
                    unset($_SESSION['Go']);
                    ?>
                </div>
            <?php endif; ?>


            <?php if (isset($_SESSION['back']) && !empty($_SESSION['back'])): ?>
        <div class="alert alert-success" role="alert">
       
      
                
                    <?php {
                        echo  $_SESSION['back'] ;
                    }
                    unset($_SESSION['back']);
                    ?>
                </div>
            <?php endif; ?>
      <form id="userForm" class="mb-3" method="post">
        <div class="form-row">
          <div class="form-group col-md-6">
            <input type="text" id="first_name" name="first_name" placeholder="first name" class="form-control" required>
          </div>
          <div class="form-group col-md-6">
            <input type="text" id="last_name" name="last_name" placeholder="last name" class="form-control" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <input type="email" id="email" name="email" placeholder="Email" class="form-control" required>
          </div>
          <div class="form-group col-md-6">
            <select id="role" name="role" class="form-control" required>
              <option value="">Sélectionner un rôle</option>
              <option value="beneficiary">beneficiary</option>
              <option value="donnator">donnator</option>
            </select>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <input type="text" id="phone" name="phone" placeholder="Phone" class="form-control" required>
          </div>
          <div class="form-group col-md-6">
            <input type="password" name="password" id="password" placeholder="Mot de passe" class="form-control" required>
          </div>
        </div>
        <button type="submit" name="signup" class="btn btn-primary">Add User</button>
      </form>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Utilisateur</th>
            <th>Rôle</th>
            <th>Action</th>
          </tr>
        </thead>
          
          
        <tbody id="usersTable">
          <?php $get_all=mysqli_query($connfig,"SELECT * FROM users WHERE NOT  role='admin'");


if(mysqli_num_rows($get_all) > 0)
{
    while($row = mysqli_fetch_assoc($get_all))
    {
        echo "<tr>
                <td>".$row['firstname']." ".$row['lastname']."</td>
                <td>".$row['role']."</td>
                <td><a class='btn btn-danger' href='delete_user.php?d=".$row['id_user']."' onclick=\"return confirm('Are you sure you want to delete this user?');\">Delete</a></td>
              </tr>";
    }
}

          
          ?>
        </tbody>
      </table>
    </section>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="scripts.js"></script>
  
  
</body>
</html>
