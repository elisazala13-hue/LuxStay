<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/LuxStay/admin/inc/db_config.php';

require_once('inc/essentials.php');
session_start();
// Kontrollo nëse admin është loguar
if(!isset($_SESSION['adminlogin']) || $_SESSION['adminlogin'] !== true){
redirect('index.php'); // ridrejto te login page nëse nuk është loguar
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compitable" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Admin Panel- Users</title>
     <?php require('inc/links.php');?>
</head>
<body class="bg-light">
   <?php require('inc/header.php');?>
   <div class="col-lg-10 offset-lg-2 p-4" id="main-content" >
      <div class="row mx-0">

         <div class="col-12" >
            <h3 class="mb-4">USERS</h3>

            <div class="card border-0 shadow-sm mb-4 ">
               <div class="card-body">
               <div class="text-end mb-4">
                  <input type="text" oninput="search_user(this.value)" class="form-control shadow-none w-25 ms-auto" placeholder="Type to search..">
               
                </div>
                <div class="table-responsive" >
                  <table class="table table-hover border text-center w-100" >
                     <thead>
                      <tr class="bg-dark text-light">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone no.</th>
                        <th scope="col">Location</th>
                        <th scope="col">DOB</th>
                        <th scope="col">Verified</th>
                        <th scope="col">Status</th>
                         <th scope="col">Date</th>
                        <th scope="col">Action</th>
                      </tr>
                     </thead>
                     <tbody id="users-data">
                     </tbody>
                     </table>
                </div>
               </div>
            </div>
      </div>
   </div>

    <?php require('inc/scripts.php');?>
    <script src="scripts/users.js"> </script>
    </body>
</html> 