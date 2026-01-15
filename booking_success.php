<?php
session_start();

if(!isset($_SESSION['booking'])) {
    header("Location: rooms.php");
    exit;
}
$booking = $_SESSION['booking'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-success text-center">
            <h2><i class="bi bi-check-circle"></i> Booking Confirmed!</h2>
            <p>Your booking has been successfully completed.</p>
        </div>
        
        <div class="card">
            <div class="card-body">
                <h5>Booking Details:</h5>
                <p><strong>Booking ID:</strong> <?php echo $booking['order_id']; ?></p>
                <p><strong>Check-in:</strong> <?php echo $booking['checkin']; ?></p>
                <p><strong>Check-out:</strong> <?php echo $booking['checkout']; ?></p>
                <p><strong>Nights:</strong> <?php echo $booking['nights']; ?></p>
                <p><strong>Rooms:</strong> <?php echo $booking['rooms_count']; ?></p>
                <p><strong>Total Price:</strong> €<?php echo number_format($booking['total_price'], 2); ?></p>
            </div>
        </div>
        
        <div class="text-center mt-3">
            <a href="rooms.php" class="btn btn-primary">Book Another Room</a>
            <a href="index.php" class="btn btn-secondary">Go to Home</a>
        </div>
    </div>
</body>
</html>