

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LuxStay Hotel - ROOMS</title> 
    <link rel="stylesheet" href="css/common.css">
    <?php require('inc/links.php'); ?>
</head>
<body class="bg-light">

<?php require('inc/header.php'); ?>

<div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center my-4"> OUR ROOMS </h2>
    <div class="h-line bg-dark mx-auto"></div>
</div>

<div class="container">
  <div class="row">
    <!--Filters-->
    <div class="col-lg-3 col-md-12 mb-lg-0 mb-4">
      <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
        <div class="container-fluid flex-lg-column align-items-stretch">
          <h4 class="mt-2">FILTERS</h4></a>
          <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#filterDropdown" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filterDropdown">
            <div class="border bg-light p-3 rounded mb-3">
              <h5 class="mb-3" style="font-size: 18px;">CHECK AVALIBILITY</h5>
              <label class="form-label">Check-in</label>
              <input type="date" class="form-control shadow-none mb-3">
              <label class="form-label">Check-out</label>
              <input type="date" class="form-control shadow-none">
            </div>
            <div class="border bg-light p-3 rounded mb-3">
              <h5 class="mb-3" style="font-size: 18px;">FACILITIES</h5>
              <div class="mb-2">
                <input type="checkbox" id="f1" class="form-check-input shadow-none me-1">
                <label class="form-check-label" for="f1">WiFi</label>
              </div>
              <div class="mb-2">
                <input type="checkbox" id="f2" class="form-check-input shadow-none me-1">
                <label class="form-check-label" for="f2">Air Conditioner</label>
              </div>
              <div class="mb-2">
                <input type="checkbox" id="f3" class="form-check-input shadow-none me-1">
                <label class="form-check-label" for="f3">Room Heater</label>
              </div>
              <div class="mb-2">
                <input type="checkbox" id="f4" class="form-check-input shadow-none me-1">
                <label class="form-check-label" for="f4">Television</label>
              </div>
            </div>
           <div class="p-3 border bg-light rounded" style="max-width: 250px;">
            <h5 class="mb-3" style="font-size: 18px;">GUESTS</h5>
            <label class="form-label">Adults</label>
            <input type="number" class="form-control shadow-none mb-3" />
            <label class="form-label">Children</label>
            <input type="number" class="form-control shadow-none"/>
          </div>
            </div>
          </div>
      </nav>
      </div>
      <!--Rooms-->
      <div class="col-lg-9 col-md-12 px-4">
      
      <?php
require('admin/inc/db_config.php');
require('admin/inc/essentials.php');

$isLoggedIn = false;
            if(isset($_SESSION['login']) && $_SESSION['login'] == true) {
                $isLoggedIn = true;
            }

$room_res = mysqli_query($con, "SELECT * FROM rooms WHERE status = 1");

if(mysqli_num_rows($room_res) == 0) {
    echo '<div class="alert alert-info text-center">No rooms available at the moment.</div>';
}

while($room_data = mysqli_fetch_assoc($room_res)) {
    $room_id = $room_data['id'];
    
    $features_data = "";
    $fea_q = mysqli_query($con, "SELECT f.name FROM features f
        INNER JOIN room_features rfea ON f.id = rfea.features_id
        WHERE rfea.room_id = $room_id");
    
    if($fea_q && mysqli_num_rows($fea_q) > 0) {
        while($fea_row = mysqli_fetch_assoc($fea_q)) {
            $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>{$fea_row['name']}</span>";
        }
    }
    
    $facilities_data = "";
    $fac_q = mysqli_query($con, "SELECT f.name FROM facilities f
        INNER JOIN room_facilities rfac ON f.id = rfac.facilities_id
        WHERE rfac.room_id = $room_id");
    
    if($fac_q && mysqli_num_rows($fac_q) > 0) {
        while($fac_row = mysqli_fetch_assoc($fac_q)) {
            $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>{$fac_row['name']}</span>";
        }
    }
    
    
    if(!empty($room_data['images'])) {
        $image_path = ROOMS_IMG_PATH . $room_data['images'];
        $room_thumb = $image_path;
    }
    
    ?>
    <div class="card mb-4 border-0 shadow">
        <div class="row g-0 p-3 align-items-center">
  
            <div class="col-md-5 mb-lg-0 mb-3">
                <img src="<?= $room_thumb ?>" 
                     class="img-fluid rounded" 
                     style="height: 250px; width: 100%; object-fit: cover;"
                     alt="<?= htmlspecialchars($room_data['name']) ?>"
                     onerror="this.src='<?= ROOMS_IMG_PATH ?>default.jpg'">
            </div>
            
            <div class="col-md-5 px-lg-3 px-md-3 px-0">
                <h5 class="mb-2"><?= htmlspecialchars($room_data['name']) ?></h5>
                <p class="mb-2 text-muted">
                    <i class="bi bi-rulers"></i> <?= $room_data['area'] ?> m²
                </p>
                
                <!-- Features -->
                <?php if(!empty($features_data)): ?>
                <div class="features mb-3">
                    <h6 class="mb-1"><i class="bi bi-stars"></i> Features</h6>
                    <div><?= $features_data ?></div>
                </div>
                <?php endif; ?>
                
                <!-- Facilities -->
                <?php if(!empty($facilities_data)): ?>
                <div class="facilities mb-3">
                    <h6 class="mb-1"><i class="bi bi-building"></i> Facilities</h6>
                    <div><?= $facilities_data ?></div>
                </div>
                <?php endif; ?>
                
                <!-- Guests -->
                <div class="guests mb-3">
                    <h6 class="mb-1"><i class="bi bi-people"></i> Guests</h6>
                    <span class='badge rounded-pill bg-light text-dark text-wrap me-1'>
                        <i class="bi bi-person"></i> <?= $room_data['adults'] ?> Adults
                    </span>
                    <span class='badge rounded-pill bg-light text-dark text-wrap'>
                        <i class="bi bi-person-arms-up"></i> <?= $room_data['children'] ?> Children
                    </span>
                </div>
                
                <!-- Quantity -->
                <div class="availability mb-3">
                    <span class='badge bg-success text-wrap'>
                        <i class="bi bi-check-circle"></i> <?= $room_data['quantity'] ?> Rooms Available
                    </span>
                </div>
            </div>
            
            <!-- ÇMIMI & BUTONI -->
            <div class="col-md-2 text-center">
                <h6 class="mb-4 text-primary">
                    <i class="bi bi-currency-euro"></i> <?= number_format($room_data['price'], 2) ?> per night
                </h6>
               <?php if($isLoggedIn): ?>
                    <a href="#.php?id=<?php echo $room_data['id']; ?>" 
                    class="btn btn-sm btn-primary shadow-none w-100">
                        Book Now
                    </a>
                <?php else: ?>
                    <button type="button" 
                            onclick="checkLoginBeforeBooking(<?php echo $room_data['id']; ?>)" 
                            class="btn btn-sm btn-primary shadow-none w-100">
                        Book Now
                    </button>
                <?php endif; ?>
            </div>
        </div> 
    </div> 
<?php
    }
?>
</div>
</div>
</div>

<script>
    function checkLoginBeforeBooking(roomId) {
    if(confirm('You need to login to book this room. Redirect to login page?')) {
        window.location.href = 'login.php?redirect=' + 
            encodeURIComponent('confirm_booking.php?id=' + roomId);
    }
}
    </script>
<?php require('inc/footer.php'); ?>

    
    
</body>
</html>