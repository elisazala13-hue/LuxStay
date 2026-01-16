<?php
require_once('config/paypal_config.php');
require_once('admin/inc/db_config.php');
session_start();

$token = $_GET['token'] ?? null;
if(!$token) die('Invalid payment');

$ch = curl_init();
curl_setopt_array($ch,[
    CURLOPT_URL => PAYPAL_API_BASE."/v2/checkout/orders/$token/capture",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_USERPWD => PAYPAL_CLIENT_ID.':'.PAYPAL_SECRET,
    CURLOPT_HTTPHEADER => ['Content-Type: application/json']
]);

$res = json_decode(curl_exec($ch),true);

if($res['status']=='COMPLETED'){
    $booking_id = $_SESSION['booking']['id'];
    mysqli_query($con,"UPDATE booking_order SET booking_status='confirmed' WHERE id=$booking_id");
    header("Location: booking_success.php");
    exit;
}

echo "Payment failed";
?>