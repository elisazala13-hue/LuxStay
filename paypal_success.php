<?php
require_once('paypal_config.php'); 
require_once('admin/inc/db_config.php');
require_once('admin/inc/essentials.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$token = $_SESSION['booking']['paypal_order_id'];

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => PAYPAL_API_BASE . "/v2/checkout/orders/$token/capture",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_USERPWD => PAYPAL_CLIENT_ID . ':' . PAYPAL_SECRET,
    CURLOPT_HTTPHEADER => ['Content-Type: application/json']
]);

$response = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$res = json_decode($response, true);

if (isset($res['status']) && $res['status'] === 'COMPLETED'){
    $booking_id = $_SESSION['booking']['id'];
    if ($booking_id) {
        mysqli_query($con, "UPDATE booking_order SET booking_status='confirmed' WHERE id=$booking_id");
        echo '<script>
                window.location.href = "booking_success.php";
              </script>';
        exit;
    }
} else{
    echo "<script>alert('Payment failed'); window.location.href='rooms.php';</script>";
exit;
}
?>
