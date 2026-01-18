<?php
 
function loadEnv($path) {
    if (!file_exists($path)) return;
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        if (strpos($line, '=') !== false) {
            list($name, $value) = explode('=', $line, 2);
            if (!defined(trim($name))) {
                define(trim($name), trim($value));
            }
        }
    }
}

loadEnv(__DIR__ . '/.env');


$hname = 'localhost';
$uname = 'root';
$pass  = '';
$db    = 'hoteli';

$con = mysqli_connect($hname, $uname, $pass, $db, 3306);

if(!$con){
    $db_error = "Cannot connect to Database: " . mysqli_connect_error();
}
 
   function filteration($data){
    foreach($data as $key => $value){
        if (is_array($value)) {
            $data[$key] = $value;
        } else {
            $value = trim($value);
            $value = stripslashes($value);
            $value = strip_tags($value);
            $value = htmlspecialchars($value, ENT_QUOTES);
            $data[$key] = $value;
        }
    }
    return $data;
}

function update($sql,$values,$datatypes)
{
    $con = $GLOBALS['con'];
    if($stmt = mysqli_prepare($con,$sql))
    {
        mysqli_stmt_bind_param($stmt,$datatypes,...$values);
        if(mysqli_stmt_execute($stmt)){
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        }
        else{
            mysqli_stmt_close($stmt);
            die("Query can not be executed - Update");
        }
    }
    else{
        die("Query can not be prepared - Update");
    }
}

  function select($sql,$values,$datatypes)
  {
    $con= $GLOBALS['con'];
    if($stmt=mysqli_prepare($con,$sql)){
        mysqli_stmt_bind_param($stmt,$datatypes,...$values);
        if(mysqli_stmt_execute($stmt)){
            $res=mysqli_stmt_get_result($stmt);
            return $res;
        }
        else{
             mysqli_stmt_close($stmt);
            return false;

        }
    }
    else{
        return false;
    }
  }

  function insert($sql,$values,$datatypes)
{
    $con = $GLOBALS['con'];
    if($stmt = mysqli_prepare($con,$sql))
    {
        mysqli_stmt_bind_param($stmt,$datatypes,...$values);
        if(mysqli_stmt_execute($stmt)){
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        }
        else{
            mysqli_stmt_close($stmt);
            return false;
        }
    }
    else{
        return false;
    }
}

function delete($sql,$values,$datatypes)
{
    $con = $GLOBALS['con'];
    if($stmt = mysqli_prepare($con,$sql))
    {
        mysqli_stmt_bind_param($stmt,$datatypes,...$values);
        if(mysqli_stmt_execute($stmt)){
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        }
        else{
            mysqli_stmt_close($stmt);
            return false;
        }
    }
    else{
        return false;
    }
}


?>