<!-- fushat e regjistrimit jane vetem: name, email, phone num, date of birth, password-->
<!-- stilizimet: bootstrap, swiper.js-->

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
          <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
        <!--Room 1-->
        <div class="card mb-4 border-0 shadow">
          <div class="row g-0 p-3 align-items-center">
            <div class="col-md-5 mb-lg-0 mb-mb-0 mb-3">
              <img src="images/rooms/1.png" class="img-fluid rounded">
            </div>
            <div class="col-md-5 px-lg-3 px-md-3 px-0">
              <h5 class="mb-2">Deluxe Room</h5>
               <div class="features mb-0">
                <h6 class="mb-0">Features</h6>
                <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">1 Bedroom</span>
                <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">1 Bathroom</span>
                <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">1 Balcony</span>
               </div>
               <div class="facilities mb-0">
                            <h6 class="mb-0">Facilities</h6>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">Wifi</span>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">AC</span>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">Room heater</span>
                        </div>
                <div class="guests mb-0">
                            <h6 class="mb-0">Guests</h6>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">2 Adults</span>
                        </div>
               <div class="rating mb-0">
                            <h6 class="mb-0">Rating</h6>
                            <span class="badge rounded-pill bg-light">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </span>
                        </div>
            </div>
            <div class="col-md-2 text-center">
              <h6 class="mb-4">500€ per night</h6>
              <a href="#" class="btn btn-sm btn-primary shadow-none mb-2 w-100">Book Now</a>
              <a href="#" class="btn btn-sm w-100 btn-outline-dark shadow-none w-100">More Details...</a>
            </div>
          </div>
        </div>
      <!--Room 2-->
        <div class="card mb-4 border-0 shadow">
          <div class="row g-0 p-3 align-items-center">
            <div class="col-md-5 mb-lg-0 mb-mb-0 mb-3">
              <img src="images/rooms/2.png" class="img-fluid rounded">
            </div>
            <div class="col-md-5 px-lg-3 px-md-3 px-0">
              <h5 class="mb-2">Luxury Room</h5>
               <div class="features mb-0">
                <h6 class="mb-0">Features</h6>
                <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">1 Bedroom</span>
                <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">1 Bathroom</span>
                <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">1 Balcony</span>
                <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">2 Sofas</span>
               </div>
               <div class="facilities mb-0">
                            <h6 class="mb-0">Facilities</h6>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">Wifi</span>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">AC</span>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">Room heater</span>
                        </div>
              <div class="guests mb-0">
                            <h6 class="mb-0">Guests</h6>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">3 Adults</span>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">1 Child</span>
                        </div>
               <div class="rating mb-0">
                            <h6 class="mb-0">Rating</h6>
                            <span class="badge rounded-pill bg-light">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </span>
                        </div>
            </div>
            <div class="col-md-2 text-center">
              <h6 class="mb-4">600€ per night</h6>
              <a href="#" class="btn btn-sm btn-primary shadow-none mb-2 w-100">Book Now</a>
              <a href="#" class="btn btn-sm w-100 btn-outline-dark shadow-none w-100">More Details...</a>
            </div>
          </div>
        </div>
      <!--Room 3-->
        <div class="card mb-4 border-0 shadow">
          <div class="row g-0 p-3 align-items-center">
            <div class="col-md-5 mb-lg-0 mb-mb-0 mb-3">
              <img src="images/rooms/3.png" class="img-fluid rounded">
            </div>
            <div class="col-md-5 px-lg-3 px-md-3 px-0">
              <h5 class="mb-2">Supreme Deluxe Room</h5>
               <div class="features mb-0">
                <h6 class="mb-0">Features</h6>
                <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">2 Bedrooms</span>
                <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">1 Bathroom</span>
                <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">1 Balcony</span>
                <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">3 Sofas</span>
               </div>
               <div class="facilities mb-0">
                            <h6 class="mb-0">Facilities</h6>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">Wifi</span>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">AC</span>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">Television</span>
                        </div>
                <div class="guests mb-0">
                            <h6 class="mb-0">Guests</h6>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">5 Adults</span>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">2 Children</span>
                        </div>
               <div class="rating mb-0">
                            <h6 class="mb-0">Rating</h6>
                            <span class="badge rounded-pill bg-light">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </span>
                        </div>
            </div>
            <div class="col-md-2 text-center">
              <h6 class="mb-4">900€ per night</h6>
              <a href="#" class="btn btn-sm btn-primary shadow-none mb-2 w-100">Book Now</a>
              <a href="#" class="btn btn-sm w-100 btn-outline-dark shadow-none w-100">More Details...</a>
            </div>
          </div>
      </div>
    </div>
  </div>



<?php require('inc/footer.php'); ?>

    
    
</body>
</html>