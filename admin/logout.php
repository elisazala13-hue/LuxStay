<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . '/LuxStay/admin/inc/db_config.php';

  require('inc/essentials.php');
  session_start();
  session_destroy();
  redirect('index.php');
?>