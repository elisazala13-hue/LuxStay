<?php
require_once('admin/inc/db_config.php');
require_once('admin/inc/essentials.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if(!isset($_SESSION['login']) || $_SESSION['login'] != true) {
    redirect('rooms.php');
}

$room_id = $_GET['id'];
$room_data = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `rooms` WHERE `id` = $room_id AND `status` = 1"));

$_SESSION['room'] = [
    "id" => $room_data['id'],
    "name" => $room_data['name'],
    "price" => $room_data['price'],
    "payment" => null,
    "available" => false,
];
if(isset($_SESSION['uId'])) {
    $user_id = $_SESSION['uId'];
}

$user_res = mysqli_query($con, "SELECT * FROM `user_cred` WHERE `id` = $user_id");

$features_data = "";
$fea_q = mysqli_query($con, "SELECT f.name FROM features f
    INNER JOIN room_features rfea ON f.id = rfea.features_id
    WHERE rfea.room_id = $room_id");

if(mysqli_num_rows($fea_q) > 0) {
    while($fea_row = mysqli_fetch_assoc($fea_q)) {
        $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>{$fea_row['name']}</span>";
    }
}

$facilities_data = "";
$fac_q = mysqli_query($con, "SELECT f.name FROM facilities f
    INNER JOIN room_facilities rfac ON f.id = rfac.facilities_id
    WHERE rfac.room_id = $room_id");

if(mysqli_num_rows($fac_q) > 0) {
    while($fac_row = mysqli_fetch_assoc($fac_q)) {
        $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>{$fac_row['name']}</span>";
    }
}

if(!empty($room_data['images'])) {
    $room_pic = "images/rooms/" . $room_data['images'];
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Booking - <?php echo $room_data['name']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>
<body>

<?php require('inc/header.php'); ?>

<div class="container">
    <div class="row">
        
        <div class="col-12 my-5 mb-4 px-4">
            <h2 class="fw-bold">CONFIRM BOOKING</h2>
            <div style="font-size: 14px;">
                <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
                <span class="text-secondary"> > </span>
                <a href="rooms.php" class="text-secondary text-decoration-none">ROOMS</a>
                <span class="text-secondary"> > </span>
                <a href="#" class="text-secondary text-decoration-none">CONFIRM BOOKING</a>
            </div>
        </div>
    
        <div class="col-lg-7 col-md-12 px-4 mb-4">
            <div class="card border-0 shadow">
                <img src="<?php echo $room_pic; ?>" 
                     class="card-img-top rounded" 
                     style="height: 400px; object-fit: cover;"
                     alt="<?php echo $room_data['name']; ?>">
                
                <div class="card-body">
                    <h3 class="card-title"><?php echo $room_data['name']; ?></h3>
                    <p class="text-muted mb-3">
                        <i class="bi bi-rulers"></i> <?php echo $room_data['area']; ?> m²
                    </p>
                    
                    <?php if(!empty($features_data)): ?>
                    <div class="features mb-3">
                        <h5><i class="bi bi-stars"></i> Features</h5>
                        <div class="d-flex flex-wrap"><?php echo $features_data; ?></div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if(!empty($facilities_data)): ?>
                    <div class="facilities mb-3">
                        <h5><i class="bi bi-building"></i> Facilities</h5>
                        <div class="d-flex flex-wrap"><?php echo $facilities_data; ?></div>
                    </div>
                    <?php endif; ?>
                    
                    <div class="guests mb-3">
                        <h5><i class="bi bi-people"></i> Guests</h5>
                        <span class='badge bg-light text-dark me-2 p-2'>
                            <i class="bi bi-person"></i> <?php echo $room_data['adults']; ?> Adults
                        </span>
                        <span class='badge bg-light text-dark p-2'>
                            <i class="bi bi-person-arms-up"></i> <?php echo $room_data['children']; ?> Children
                        </span>
                    </div>
                </div>
            </div>
        </div>
      
        <div class="col-lg-5 col-md-12 px-4">
            <div class="card border-0 shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-calendar-check"></i> Booking Details</h4>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h5 class="text-primary">
                            <?php echo number_format($room_data['price'], 2); ?><i class="bi bi-currency-euro"></i>  per night
                        </h5>
                    </div>
                    
                    <form id="bookingForm" method="POST">
                        <input type="hidden" name="room_id" id="roomId" value="<?php echo $room_data['id']; ?>">
                        <input type="hidden" name="room_price" value="<?php echo $room_data['price']; ?>">
                        
                        <div class="mb-3">
                            <label for="checkin" class="form-label">Check-in Date</label>
                            <input type="date" class="form-control" id="checkin" name="checkin" required 
                                   min="<?php echo date('Y-m-d'); ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="checkout" class="form-label">Check-out Date</label>
                            <input type="date" class="form-control" id="checkout" name="checkout" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Number of Rooms</label>
                            <select class="form-select" name="rooms_count" id="roomsCount" required>
                                <?php for($i = 1; $i <= min(3, $room_data['quantity']); $i++): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?> Room<?php echo $i > 1 ? 's' : ''; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Total Price</label>
                            <div class="alert alert-info">
                                <h4 class="mb-0" id="totalPrice">0.00€</h4>
                                </div>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                <i class="bi bi-credit-card"></i> Confirm & Pay Now
                            </button>
                            <a href="rooms.php" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Back to Rooms
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
        
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const pricePerNight = <?php echo $room_data['price']; ?>;
    const checkinInput = document.getElementById('checkin');
    const checkoutInput = document.getElementById('checkout');
    const roomsSelect = document.getElementById('roomsCount');
    const total = document.getElementById('totalPrice');
    const submitBtn = document.getElementById('submitBtn');
    const bookingForm = document.getElementById('bookingForm');

    function calculateNights() {
        const nights = (Date.parse(checkoutInput.value) - Date.parse(checkinInput.value)) / (1000*60*60*24);
        return nights > 0 ? nights : 0;
    }

    function updateTotal() {
        const nights = calculateNights();
        const t = pricePerNight * nights * parseInt(roomsSelect.value);
        total.textContent = t.toFixed(2) + '€';
    }

    bookingForm.addEventListener('submit', function(e){
        e.preventDefault();
        const formData = new FormData(this);
        formData.append('action', 'confirm_booking');

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Processing...';

        fetch('ajax/confirm_booking.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === 'success'){
                window.location.href = data.paypal_url;
            } else {
                alert('Something went wrong: ' + (data.msg ?? ''));
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="bi bi-credit-card"></i> Confirm & Pay Now';
            }
        });
    });

    checkinInput.addEventListener('change', function(){
        if(this.value){
            const nextDay = new Date(this.value);
            nextDay.setDate(nextDay.getDate()+1);
            checkoutInput.min = nextDay.toISOString().split('T')[0];
            if(checkoutInput.value && new Date(checkoutInput.value) < nextDay) checkoutInput.value = '';
        }
        updateTotal();
    });

    checkoutInput.addEventListener('change', updateTotal);
    roomsSelect.addEventListener('change', updateTotal);

    updateTotal();
});
</script>


<?php require('inc/footer.php'); ?>

</body>
</html>