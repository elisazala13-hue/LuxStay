<?php
require_once('../inc/db_config.php');
require_once('../inc/essentials.php');
require_once('../config/paypal_config.php');

date_default_timezone_set("Europe/Tirane");
header('Content-Type: application/json');
session_start();

if(!isset($_POST['action'])){
    echo json_encode(['status'=>'error']);
    exit;
}

if($_POST['action'] == 'confirm_booking'){

    $room_id = $_POST['room_id'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $rooms_count = $_POST['rooms_count'];
    $user_id = $_SESSION['uid'] ?? 1;

    $room = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM rooms WHERE id=$room_id"));

    $nights = (new DateTime($checkin))->diff(new DateTime($checkout))->days;
    $total_price = $room['price'] * $nights * $rooms_count;

    $order_id = 'ORD'.time();

    mysqli_query($con,"
        INSERT INTO booking_order
        (user_id,room_id,check_in,check_out,rooms_count,total_price,order_id,booking_status)
        VALUES
        ($user_id,$room_id,'$checkin','$checkout',$rooms_count,$total_price,'$order_id','pending')
    ");

    $booking_id = mysqli_insert_id($con);

    $_SESSION['booking'] = [
        'id'=>$booking_id,
        'total'=>$total_price
    ];

    $ch = curl_init();
    curl_setopt_array($ch,[
        CURLOPT_URL => PAYPAL_API_BASE.'/v2/checkout/orders',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_USERPWD => PAYPAL_CLIENT_ID.':'.PAYPAL_SECRET,
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        CURLOPT_POSTFIELDS => json_encode([
            'intent'=>'CAPTURE',
            'purchase_units'=>[[
                'amount'=>[
                    'currency_code'=>'EUR',
                    'value'=>number_format($total_price,2,'.','')
                ]
            ]],
            'application_context'=>[
                'return_url'=>'http://localhost/LuxStay/paypal_success.php'
            ]
        ])
    ]);

    $res = json_decode(curl_exec($ch),true);

    foreach($res['links'] as $l){
        if($l['rel']=='approve'){
            echo json_encode([
                'status'=>'success',
                'paypal_url'=>$l['href']
            ]);
            exit;
        }
    }

    echo json_encode(['status'=>'error']);
}
