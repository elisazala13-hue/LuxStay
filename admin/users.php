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
    <meta http-equiv="X-UA-Compatible" contect="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <?php require('inc/links.php'); ?>
</head>

<body>
  <?php require('inc/header.php');?>
  <?php require('inc/scripts.php'); ?>    
</body>
</html>