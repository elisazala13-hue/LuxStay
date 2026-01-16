<?php 
require_once('admin/inc/db_config.php');
require_once('admin/inc/essentials.php');

session_start();
session_unset();   // fshin variablat
session_destroy(); // mbyll sessionin

redirect('index.php');
