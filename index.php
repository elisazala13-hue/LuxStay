<!-- fushat e regjistrimit jane vetem: name, email, phone num, date of birth, password-->
<!-- stilizimet: bootstrap, swiper.js-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LuxStay Hotel - HOME</title>
    <link rel="stylesheet" href="css/common.css">
    
    <?php require('inc/links.php'); ?>
    <style>
        .swiper,
        .swiper-wrapper,
        .swiper-slide {
            pointer-events: auto;
        }

        .swiper-slide {
            cursor: grab;
        }
        .swiper-slide img {
            width: 100%;         
            height: 400px;        
            object-fit: cover;     
        }
        </style>
</head>
<body>

<?php require('inc/header.php'); ?>

<!--Picture Crousel-->
    <div class="container-fluid">
        <div class="swiper swiper-container">
            <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="images/carousel/1.png" class="w-100 d-block" />
            </div>
            <div class="swiper-slide">
                <img src="images/carousel/2.png" class="w-100 d-block"/>
            </div>
            <div class="swiper-slide">
                <img src="images/carousel/3.png" class="w-100 d-block"/>
            </div>
            <div class="swiper-slide">
                <img src="images/carousel/4.png" class="w-100 d-block"/>
            </div>
            <div class="swiper-slide">
                <img src="images/carousel/5.png" class="w-100 d-block"/>
                </div>
            </div>
        </div>
    </div>

<!--Check Availablity-->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 bg-white shadow p-4 rounded">
            <h5>Check Booking Availability</h5>
            <form>
                <div class="row">
                    <div class="col-lg-3">
                        <label class="form-label" style="font-weight: 500;">Check-in</label>
                        <input type="date" class="form-control shadow-none">
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label" style="font-weight: 500;">Check-out</label>
                        <input type="date" class="form-control shadow-none">
                    </div>
                    <div class="col-lg-3">
                        <label class="form-label" style="font-weight: 500;">Adults</label>
                        <select class="form-select shadow-none">
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <label class="form-label" style="font-weight: 500;">Children</label>
                        <select class="form-select shadow-none">
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col-lg-1">
                        <button type="submit" class="btn text-white shadow-none custom-bg">Submit</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

<!--Our Rooms-->   
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR ROOMS</h2>
    <div class="container">
        <div class="row">
             <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="images/rooms/1.png" class="card-img-top" >
                    <div class="card-body">
                        <h5>Deluxe Room</h5>
                        <h6 class="mb-4">500€ per night</h6>
                        <div class="features mb-4">
                            <h6 class="mb-1">Features</h6>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">1 Bedroom</span>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">1 Bathroom</span>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">1 Balcony</span>
                        </div>
                        <div class="facilities mb-4">
                            <h6 class="mb-1">Facilities</h6>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">Wifi</span>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">AC</span>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">Room heater</span>
                        </div>
                        <div class="guests mb-4">
                            <h6 class="mb-1">Guests</h6>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">2 Adults</span>
                        </div>
                        <div class="rating mb-4">
                            <h6 class="mb-1">Rating</h6>
                            <span class="badge rounded-pill bg-light">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </span>
                        </div>
                        <div class="d-flex justify-content-evenly mb-2">
                            <a href="#" class="btn btn-sm btn-primary shadow-none mb-2 h-100">Book Now</a>
                            <a href="#" class="btn btn-sm btn-outline-dark shadow-none h-100">More Details...</a>
                        </div>
                    </div>
                </div>
            </div>
              <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="images/rooms/2.png" class="card-img-top" >
                    <div class="card-body">
                        <h5>Luxury Room</h5>
                        <h6 class="mb-4">600€ per night</h6>
                        <div class="features mb-4">
                            <h6 class="mb-1">Features</h6>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">1 Bedroom</span>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">1 Bathroom</span>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">1 Balcony</span>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">2 Sofas</span>
                        </div>
                        <div class="facilities mb-4">
                            <h6 class="mb-1">Facilities</h6>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">Wifi</span>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">AC</span>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">Room heater</span>
                        </div>
                        <div class="guests mb-4">
                            <h6 class="mb-1">Guests</h6>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">3 Adults</span>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">1 Child</span>
                        </div>
                        <div class="rating mb-4">
                            <h6 class="mb-1">Rating</h6>
                            <span class="badge rounded-pill bg-light">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </span>
                        </div>
                        <div class="d-flex justify-content-evenly mb-2">
                            <a href="#" class="btn btn-sm btn-primary shadow-none mb-2 h-100">Book Now</a>
                            <a href="#" class="btn btn-sm btn-outline-dark shadow-none h-100">More Details...</a>
                        </div>
                    </div>
                </div>
            </div>
              <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="images/rooms/3.png" class="card-img-top" >
                    <div class="card-body">
                        <h5>Supreme Deluxe Room</h5>
                        <h6 class="mb-4">900€ per night</h6>
                        <div class="features mb-4">
                            <h6 class="mb-1">Features</h6>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">2 Bedrooms</span>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">1 Bathroom</span>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">1 Balcony</span>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">3 Sofas</span>
                        </div>
                        <div class="facilities mb-4">
                            <h6 class="mb-1">Facilities</h6>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">Wifi</span>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">Television</span>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">AC</span>
                        </div>
                         <div class="guests mb-4">
                            <h6 class="mb-1">Guests</h6>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">5 Adults</span>
                            <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap">2 Children</span>
                        </div>
                        <div class="rating mb-4">
                            <h6 class="mb-1">Rating</h6>
                            <span class="badge rounded-pill bg-light">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </span>
                        </div>
                        <div class="d-flex justify-content-evenly mb-2">
                            <a href="#" class="btn btn-sm btn-primary shadow-none mb-2 h-100">Book Now</a>
                            <a href="#" class="btn btn-sm btn-outline-dark shadow-none h-100">More Details...</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 text-end mt-5">
            <a href="#" class="btn btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms >>></a>
            </div>
        </div>
    </div>

<!--Our Facilities-->   
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR FACILITIES</h2>
    <div class="container">
        <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                <img src="images/features/wifi.png" width="80px">
                <h5 class="mt-3">WiFi</h5>
            </div>
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                <img src="images/features/tv.png" width="80px">
                <h5 class="mt-3">Television</h5>
            </div>
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                <img src="images/features/ac.png" width="80px">
                <h5 class="mt-3">Air Conditioner</h5>
            </div>
            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                <img src="images/features/heater.png" width="80px">
                <h5 class="mt-3">Room heaters</h5>
            </div>
        </div>
    </div>      

<!--Reviews-->   
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">REVIEWS</h2>
    <div class="container mt-5">
        <div class="swiper swiper-ratings">
            <div class="swiper-wrapper">
                <div class="swiper-slide bg-white p-4">
                    <h6>Alketa Qorri</h6>
                    <p>Qëndrim shumë i këndshëm. Dhoma ishte 
                        e pastër, e rregullt dhe shumë komode. 
                        Vendndodhja perfekte për të lëvizur në qytet. 
                        Do të kthehem përsëri. </p>
                    <div class="rating mb-4">
                                <h6 class="mb-1">Rating</h6>
                                <span class="badge rounded-pill bg-light">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                </span>
                    </div>
                </div>
                <div class="swiper-slide bg-white p-4">
                    <h6>Erald Balliu</h6>
                    <p>Hotel i qetë dhe modern. Stafi 
                        shumë i sjellshëm dhe gjithmonë 
                        i gatshëm për ndihmë. Raport shumë 
                        i mirë cilësi-çmim.</p>
                    <div class="rating mb-4">
                                <h6 class="mb-1">Rating</h6>
                                <span class="badge rounded-pill bg-light">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                </span>
                    </div>
                </div>
                <div class="swiper-slide bg-white p-4">
                    <h6>Alban Toska</h6>
                    <p>Përvojë shumë pozitive. Ambient 
                        i pastër, krevat i rehatshëm dhe 
                        zonë shumë e mirë pranë kafeneve 
                        dhe restoranteve. E rekomandoj pa 
                        hezitim. </p>
                    <div class="rating mb-4">
                                <h6 class="mb-1">Rating</h6>
                                <span class="badge rounded-pill bg-light">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                </span>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
  </div>

<!--Reach Us-->   
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">REACH US</h2>
    <div class="container">
        <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
            <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
             <iframe class="w-100 rounded" height="320px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d383570.64090558223!2d19.91638170000001!3d41.31657210000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x135030c34ce830bf%3A0x77cd46003dc6a25c!2sTirana%2C%20Albania!5e0!3m2!1sen!2s!4v1767898663961!5m2!1sen!2s" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col-lg-4 col-md-4 rounded mb-4">
                <div class="bg-white">
                    <h5>Call Us!</h5>
                    <a href="tel: +355699817747" class="d-inline-block mb-2 text-decoration-none text-dark"><i class="bi bi-telephone-fill"></i>+355699817747</a>
                    <br><br>
                    <h5>Follow Us!</h5>
                    <a href="#" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 p-2"><i class="bi bi-twitter me-1"></i>Twitter
                    </span>
                    </a>
                    <br>
                    <a href="#" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 p-2"><i class="bi bi-instagram me-1"></i></i>Instagram
                        </span>
                    </a>
                    <br>
                    <a href="#" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 p-2"><i class="bi bi-facebook me-1"></i></i>Facebook
                        </span>
                    </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require('inc/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".swiper-container", {
        spaceBetween: 30,
        effect: "fade",
        loop: true, 
        autoplay: {
            delay: 3500, 
            disableOnInteraction: false,
        }
        });
   
        var swiper = new Swiper(".swiper-ratings", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 3,
        loop: true,

        coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: false,
        },

        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        },

        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },

        breakpoints: {
            320: {
                slidesPerView: 1,
            },
            640: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        },
        });


    </script>
</body>
</html>