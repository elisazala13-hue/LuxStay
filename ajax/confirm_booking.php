<?php
require_once('../admin/inc/db_config.php');
require_once('../admin/inc/essentials.php');
require_once('../paypal_config.php');

date_default_timezone_set("Europe/Podgorica");


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kontrolli i request
if(!isset($_POST['action']) || $_POST['action'] != 'confirm_booking'){
    echo json_encode(['status'=>'error', 'msg'=>'Invalid request']);
    exit;
}

// Kontrolli nese user eshte i loguar
$user_id = $_SESSION['uId'] ?? null;
if(!$user_id){
    echo json_encode(['status'=>'error','msg'=>'User not logged in']);
    exit;
}

// Merr te dhenat nga POST
$room_id = intval($_POST['room_id'] ?? 0);
$checkin = $_POST['checkin'] ?? null;
$checkout = $_POST['checkout'] ?? null;
$rooms_count = intval($_POST['rooms_count'] ?? 1);

if(!$room_id || !$checkin || !$checkout){
    echo json_encode(['status'=>'error','msg'=>'Missing required fields']);
    exit;
}

// Merr te dhenat e dhomes nga DB
$room_res = mysqli_query($con,"SELECT * FROM rooms WHERE id=$room_id");
if(!$room_res){
    echo json_encode(['status'=>'error','msg'=>'Room query failed: '.mysqli_error($con)]);
    exit;
}

$room = mysqli_fetch_assoc($room_res);
if(!$room){
    echo json_encode(['status'=>'error','msg'=>'Room not found']);
    exit;
}

// Llogarit netet
$checkin_dt = new DateTime($checkin);
$checkout_dt = new DateTime($checkout);
$nights = $checkin_dt->diff($checkout_dt)->days;
if($nights <= 0){
    echo json_encode(['status'=>'error','msg'=>'Invalid check-in or check-out dates']);
    exit;
}

// Llogarit total price
$total_price = $room['price'] * $nights * $rooms_count;

// Krijo order ne DB me status pending
$order_id = 'ORD'.time();
$insert = mysqli_query($con, "
    INSERT INTO booking_order
    (user_id, room_id, check_in, check_out, rooms_count, total_price, order_id, booking_status)
    VALUES
    ($user_id, $room_id, '$checkin', '$checkout', $rooms_count, $total_price, '$order_id', 'pending')
");

if(!$insert){
    echo json_encode(['status'=>'error','msg'=>'Failed to create booking: '.mysqli_error($con)]);
    exit;
}

$booking_id = mysqli_insert_id($con);

// Ruaj ne session
$_SESSION['booking'] = [
    'id' => $booking_id,
    'total' => $total_price
];

// Krijo PayPal order
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => PAYPAL_API_BASE.'/v2/checkout/orders',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_USERPWD => PAYPAL_CLIENT_ID.':'.PAYPAL_SECRET,
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    CURLOPT_POSTFIELDS => json_encode([
        'intent' => 'CAPTURE',
        'purchase_units' => [[
            'amount' => [
                'currency_code' => 'EUR',
                'value' => number_format($total_price, 2, '.', '')
            ]
        ]],
        'application_context' => [
            'return_url' => 'http://localhost/LuxStay/paypal_success.php',
            'cancel_url' => 'http://localhost/LuxStay/booking_cancel.php'
        ]
    ])
]);

$response = curl_exec($ch);
curl_close($ch);

$res = json_decode($response, true);

// -----------------------------
// Ruaj PayPal order ID ne session dhe DB
// -----------------------------
if(isset($res['id'])){
    $paypal_order_id = $res['id'];
    $_SESSION['booking']['paypal_order_id'] = $paypal_order_id;

    $update = mysqli_query($con, "
        UPDATE booking_order 
        SET paypal_order_id='".mysqli_real_escape_string($con,$paypal_order_id)."' 
        WHERE id=$booking_id
    ");

    if(!$update){
        error_log("Failed to update paypal_order_id: " . mysqli_error($con));
    }
}

// -----------------------------
// Kthe URL aprovimi te frontend
// -----------------------------
if(isset($res['links'])){
    foreach($res['links'] as $l){
        if($l['rel'] == 'approve'){
            echo json_encode(['status'=>'success','paypal_url'=>$l['href']]);
            exit;
        }
    }
}

// Nese diçka nuk shkoi
$error_msg = $res['message'] ?? 'PayPal order creation failed';
echo json_encode(['status'=>'error','msg'=>$error_msg]);
?>

