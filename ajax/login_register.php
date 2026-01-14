<?php

require_once('../admin/inc/db_config.php');
require_once('../admin/inc/essentials.php');
require_once __DIR__ . '/../inc/sendgrid-php/sendgrid-php.php';

/**
 * Funksioni për të dërguar OTP në email
 */
function send_otp_mail($uemail, $name, $otp)
{
    $email = new \SendGrid\Mail\Mail();
    $email->setFrom("luxstayhotel9@gmail.com", "LuxStay");
    $email->setSubject("Your Verification PIN Code");
    $email->addTo($uemail, $name);

    $email->addContent(
        "text/html",
        "<h3>Hello {$name}</h3>
        <p>Your verification PIN is:</p>
        <h2 style='letter-spacing:3px;'>{$otp}</h2>
        <p>Please enter this code on the verification page. This code will expire soon.</p>"
    );

    $sendgrid = new \SendGrid(''); // vendos ktu API

    try {
        $response = $sendgrid->send($email);
        return ($response->statusCode() == 202); 
    } catch (Exception $e) {
        return false;
    }
}

if (isset($_POST['register'])) 
{
    $data = filteration($_POST);

    if ($data['pass'] != $data['cpass']) {
        echo 'pass_mismatch';
        exit;
    }

    $u_exist = select(
        "SELECT * FROM `user_cred` WHERE `email` = ? OR `phonenum` = ? LIMIT 1",
        [$data['email'], $data['phonenum']],
        "ss"
    );

    if (mysqli_num_rows($u_exist) != 0) {
        $u_exist_fetch = mysqli_fetch_assoc($u_exist);
        echo ($u_exist_fetch['email'] == $data['email']) ? 'email_already' : 'phone_already';
        exit;
    }

    if(isset($_FILES['profile']) && $_FILES['profile']['error'] == 0) {
        $img = uploadUserImage($_FILES['profile']);
        if ($img == 'inv_img') {
            echo 'inv_img';
            exit;
        } else if ($img == 'upd_failed') {
            echo 'upd_failed';
            exit;
        }
    } else {
        echo 'inv_img';
        exit;
    }

    $otp = random_int(100000, 999999); 

    if(!send_otp_mail($data['email'], $data['name'], $otp)){
        echo 'mail_failed';
        exit;
    }

    $enc_pass = password_hash($data['pass'], PASSWORD_BCRYPT);

    $pincode = is_numeric($data['pincode']) ? (int)$data['pincode'] : NULL;

    $query = "INSERT INTO `user_cred`
        (`name`, `email`, `address`, `phonenum`, `pincode`, `dob`, `profile`, `password`, `otp_code`)
        VALUES (?,?,?,?,?,?,?,?,?)";

    $values = [
        $data['name'],
        $data['email'],
        $data['address'],
        $data['phonenum'],
        $pincode,
        $data['dob'],
        $img,
        $enc_pass,
        $otp
    ];

    if (insert($query, $values, "ssssissss")) { 
        echo 1;
    } else {
        global $con;  
        echo 'ins_failed: ' . mysqli_error($con);
    }
}
?>
