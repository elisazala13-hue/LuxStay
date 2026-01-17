<?php
require_once('admin/inc/db_config.php');
require_once('admin/inc/essentials.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$booking_id = $_SESSION['booking']['id'];
$booking = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM booking_order WHERE id=$booking_id"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmed</title>
    <?php require('inc/links.php'); ?>
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-success text-center">
            <h2>Booking Confirmed!</h2>
            <p>Your booking has been successfully completed.</p>
        </div>
        
        <div class="card">
            <div class="card-body">
                <h5>Booking Details:</h5>
                <p><strong>Booking ID:</strong> <?php echo $booking['order_id']; ?></p>
                <p><strong>Check-in:</strong> <?php echo $booking['check_in']; ?></p>
                <p><strong>Check-out:</strong> <?php echo $booking['check_out']; ?></p>
                <p><strong>Rooms:</strong> <?php echo $booking['rooms_count']; ?></p>
                <p><strong>Total Price:</strong><?php echo number_format($booking['total_price'], 2);?> €</p>
            </div>
        </div>
        
        <div class="text-center mt-3">
            <a href="rooms.php" class="btn btn-primary">Book Another Room</a>
            <a href="index.php" class="btn btn-secondary">Go to Home</a>
        </div>
    </div>
</body>
</html>
