<!-- fushat e regjistrimit jane vetem: name, email, phone num, date of birth, password-->
 <!-- DUHET SHTUAR PICTURE-->

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

        $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=?",[1,0], 'ii');

        while($room_data = mysqli_fetch_assoc($room_res)) {

          // Features
          $fea_q = mysqli_query($con,"SELECT f.name FROM `features` f
              INNER JOIN `room_features` rfea ON f.id = rfea.features_id
              WHERE rfea.room_id = '{$room_data['id']}'");

          $features_data = "";
          while($fea_row = mysqli_fetch_assoc($fea_q)){
              $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap'>{$fea_row['name']}</span> ";
          }

          // Facilities
          $fac_q = mysqli_query($con,"SELECT f.name FROM `facilities` f
              INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id
              WHERE rfac.room_id = '{$room_data['id']}'");

          $facilities_data = "";
          while($fac_row = mysqli_fetch_assoc($fac_q)){
              $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap'>{$fac_row['name']}</span> ";
          }

          // Image
          $img_q = mysqli_query($con,"SELECT * FROM `room_images`
              WHERE `room_id`='{$room_data['id']}'
              ORDER BY `id` ASC
              LIMIT 1");

          $room_thumb = ROOMS_IMG_PATH."default.jpg";
          if(mysqli_num_rows($img_q) > 0){
              $img_res = mysqli_fetch_assoc($img_q);
              $room_thumb = ROOMS_IMG_PATH.$img_res['image'];
          }

          // HTML
          echo <<<data
          <div class="card mb-4 border-0 shadow">
              <div class="row g-0 p-3 align-items-center">
                  <div class="col-md-5 mb-lg-0 mb-3">
                      <img src="{$room_thumb}" class="img-fluid rounded">
                  </div>
                  <div class="col-md-5 px-lg-3 px-md-3 px-0">
                      <h5 class="mb-2">{$room_data['name']}</h5>
                      <div class="features mb-0">
                          <h6 class="mb-0">Features</h6>
                          {$features_data}
                      </div>
                      <div class="facilities mb-0">
                          <h6 class="mb-0">Facilities</h6>
                          {$facilities_data}
                      </div>
                      <div class="guests mb-0">
                          <h6 class="mb-0">Guests</h6>
                          <span class='badge rounded-pill bg-light text-dark text-wrap'>{$room_data['adults']} Adults</span>
                          <span class='badge rounded-pill bg-light text-dark text-wrap'>{$room_data['children']} Children</span>
                      </div>
                  </div>
                  <div class="col-md-2 text-center">
                      <h6 class="mb-4">{$room_data['price']}€ per night</h6>
                      <a href="#" class="btn btn-sm btn-primary shadow-none mb-2 w-100">Book Now</a>
                  </div>
              </div>
          </div>
          data;
      }

      ?>


       
    </div>


  </div>
</div>


<?php require('inc/footer.php'); ?>

    
    
</body>
</html>