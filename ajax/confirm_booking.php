<?php
require_once('../inc/db_config.php');
require_once('../inc/essentials.php');

date_default_timezone_set("Europe/Tirane");
header('Content-Type: application/json');

if(!isset($_POST['action'])) {
    echo json_encode(['status' => 'error', 'message' => 'No action specified']);
    exit;
}

$action = $_POST['action'];
  
if($action == 'check_availability') {
    $room_id = (int)$_POST['room_id'];
    $checkin = mysqli_real_escape_string($con, $_POST['checkin']);
    $checkout = mysqli_real_escape_string($con, $_POST['checkout']);
    $rooms_count = (int)$_POST['rooms_count'];
    
    $checkin_date = new DateTime($checkin);
    $checkout_date = new DateTime($checkout);
    $interval = $checkin_date->diff($checkout_date);
    $nights = $interval->days;

    $room_res = mysqli_query($con, "SELECT * FROM `rooms` WHERE `id` = $room_id AND `status` = 1");
    
    if(mysqli_num_rows($room_res) == 0) {
        echo json_encode(['status' => 'error', 'message' => 'Room not available']);
        exit;
    }
    
    $room_data = mysqli_fetch_assoc($room_res);

    $booking_query = "SELECT COALESCE(SUM(`rooms_count`), 0) as booked_rooms 
                      FROM `booking_order` 
                      WHERE `room_id` = $room_id 
                      AND `booking_status` IN ('booked', 'confirmed')
                      AND (
                          (check_in < '$checkout' AND check_out > '$checkin') OR
                          (check_in >= '$checkin' AND check_in < '$checkout')
                      )";
    
    $booking_res = mysqli_query($con, $booking_query);        
    $booking_data = mysqli_fetch_assoc($booking_res);
    $booked_rooms = $booking_data['booked_rooms'] ?? 0;
    $available_rooms = $room_data['quantity'] - $booked_rooms;
    
    if($available_rooms < $rooms_count) {
        echo json_encode(['status' => 'error', 'message' => "Only $available_rooms room(s) available"]);
        exit;
    }

    $total_price = $room_data['price'] * $nights * $rooms_count;
    
    echo json_encode([
        'status' => 'success',
        'message' => 'Room available',
        'data' => [
            'room_id' => $room_id,
            'room_name' => $room_data['name'],
            'checkin' => $checkin,
            'checkout' => $checkout,
            'nights' => $nights,
            'rooms_count' => $rooms_count,
            'price_per_night' => $room_data['price'],
            'total_price' => number_format($total_price, 2),
            'available_rooms' => $available_rooms
        ]
    ]);
    
} elseif($action == 'confirm_booking') {
    session_start();

    $room_id = (int)$_POST['room_id'];
    $checkin = mysqli_real_escape_string($con, $_POST['checkin']);
    $checkout = mysqli_real_escape_string($con, $_POST['checkout']);
    $rooms_count = (int)$_POST['rooms_count'];
    $user_id = $_SESSION['uid'] ?? 1;

    $room_res = mysqli_query($con, "SELECT price, name FROM rooms WHERE id = $room_id");
    $room_data = mysqli_fetch_assoc($room_res);
    $price_per_night = $room_data['price'];

    $checkin_date = new DateTime($checkin);
    $checkout_date = new DateTime($checkout);
    $interval = $checkin_date->diff($checkout_date);
    $nights = $interval->days;
    
    $total_price = $price_per_night * $nights * $rooms_count;

    $order_id = 'ORD' . time() . rand(1000, 9999);
    $query = "INSERT INTO booking_order (user_id, room_id, check_in, check_out, rooms_count, total_price, order_id, booking_status) 
              VALUES ($user_id, $room_id, '$checkin', '$checkout', $rooms_count, $total_price, '$order_id', 'confirmed')";
    
    if(mysqli_query($con, $query)) {
        $booking_id = mysqli_insert_id($con);
        
        $_SESSION['booking'] = [
            'id' => $booking_id,
            'order_id' => $order_id,
            'room_id' => $room_id,
            'room_name' => $room_data['name'],
            'checkin' => $checkin,
            'checkout' => $checkout,
            'rooms_count' => $rooms_count,
            'total_price' => $total_price,
            'nights' => $nights
        ];
        
        echo json_encode([
            'status' => 'success',
            'message' => 'Booking confirmed!',
            'booking_id' => $booking_id,
            'order_id' => $order_id,
            'redirect' => 'booking_success.php'
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Booking failed']);
    }
}

?>