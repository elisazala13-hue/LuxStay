<?php
require_once('admin/inc/essentials.php');

session_start();
session_unset();    // fshin të gjitha variablat e sesionit
session_destroy();  // mbyll sesionin

redirect('index.php');   // funksioni është te essentials.php
