<?php

require_once('../admin/inc/db_config.php');
require_once('../admin/inc/essentials.php');
date_default_timezone_set("Europe/Podgorica"); 

if(isset($_POST['info_form'])){
    $firm_data=filteration($_POST);
    session_start();

      $u_exist = select(
        "SELECT * FROM `user_cred`WHERE`phonenum`=? AND `id`!=? LIMIT 1",
        [$data['phonenum'], $_SESSION['uId']],
        "ss"
    );

    if (mysqli_num_rows($u_exist) != 0) {
        echo 'phone_already';
        exit;
    }
    $query="UPDATE `user_cred` SET `name`=?,`phone`=?,`dob`=?,`pincode`=?,`address`=? WHERE `id`=?";
    $values=[
        $firm_data['name'],
        $firm_data['phonenum'],
        $firm_data['dob'],
        $firm_data['pincode'],
        $firm_data['address'],
        $_SESSION['uId']
    ];
    if(update($query,$values,'sssssi')){
        $_SESSION['uName']=$firm_data['name'];
        echo 1;
    }
    else{
        echo 0;
    }



}




?>