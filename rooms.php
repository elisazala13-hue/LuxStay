<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LuxStay Hotel - Rooms</title>
    <link rel="stylesheet" href="css/common.css">
    <?php require('inc/links.php'); ?>
</head>

<body class="bg-light">

<?php require('inc/header.php'); ?>

<div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center my-4">OUR ROOMS</h2>
    <div class="h-line bg-dark mx-auto"></div>
</div>

<div class="container">
  <div class="row">
        <?php
        require_once('admin/inc/db_config.php');
        require_once('admin/inc/essentials.php');

        $isLoggedIn = isset($_SESSION['login']) && $_SESSION['login'] === true;

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
            while($fea_row = mysqli_fetch_assoc($fea_q)) {
                $features_data .= "<span class='badge rounded-pill bg-light text-dark me-1 mb-1'>{$fea_row['name']}</span>";
            }

            $facilities_data = "";
            $fac_q = mysqli_query($con, "SELECT f.name FROM facilities f
                INNER JOIN room_facilities rfac ON f.id = rfac.facilities_id
                WHERE rfac.room_id = $room_id");
            while($fac_row = mysqli_fetch_assoc($fac_q)) {
                $facilities_data .= "<span class='badge rounded-pill bg-light text-dark me-1 mb-1'>{$fac_row['name']}</span>";
            }

            $room_thumb = !empty($room_data['images']) ? ROOMS_IMG_PATH . $room_data['images'] : ROOMS_IMG_PATH . 'default.jpg';
        ?>
        <div class="card mb-4 border-0 shadow">
            <div class="row g-0 align-items-center p-3">
                <div class="col-md-5 mb-3 mb-md-0">
                    <img src="<?= $room_thumb ?>" 
                         class="img-fluid rounded" 
                         style="height: 250px; width: 100%; object-fit: cover;" 
                         alt="<?= htmlspecialchars($room_data['name']) ?>"
                         onerror="this.src='<?= ROOMS_IMG_PATH ?>default.jpg'">
                </div>
                <div class="col-md-5 px-3">
                    <h5><?= htmlspecialchars($room_data['name']) ?></h5>
                    <p class="mb-2 text-muted"><i class="bi bi-rulers"></i> <?= $room_data['area'] ?> m²</p>

                    <?php if($features_data): ?>
                    <div class="mb-2">
                        <h6 class="mb-1"><i class="bi bi-stars"></i> Features</h6>
                        <div><?= $features_data ?></div>
                    </div>
                    <?php endif; ?>

                    <?php if($facilities_data): ?>
                    <div class="mb-2">
                        <h6 class="mb-1"><i class="bi bi-building"></i> Facilities</h6>
                        <div><?= $facilities_data ?></div>
                    </div>
                    <?php endif; ?>

                    <div class="mb-2">
                        <h6 class="mb-1"><i class="bi bi-people"></i> Guests</h6>
                        <span class='badge rounded-pill bg-light text-dark me-1'><i class="bi bi-person"></i> <?= $room_data['adults'] ?> Adults</span>
                        <span class='badge rounded-pill bg-light text-dark'><i class="bi bi-person-arms-up"></i> <?= $room_data['children'] ?> Children</span>
                    </div>
                </div>
                <div class="col-md-2 text-center">
                    <h6 class="text-primary mb-3"><i class="bi bi-currency-euro"></i> <?= number_format($room_data['price'], 2) ?> / night</h6>
                    <?php if($isLoggedIn): ?>
                        <a href="confirm_booking.php?id=<?= $room_data['id'] ?>" class="btn btn-sm btn-primary w-100 shadow-none">Book Now</a>
                    <?php else: ?>
                        <button type="button" onclick="alert('error','LOG IN!')" class="btn btn-sm btn-primary w-100 shadow-none">Book Now</button>
                    <?php endif; ?>
                </div>
            </div>
        <?php } ?>
    </div>
  </div>
</div>

</script>

<?php require('inc/footer.php'); ?>
</body>
</html>
