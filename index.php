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

<?php 
require('inc/header.php');

?>

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
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <label class="form-label" style="font-weight: 500;">Children</label>
                        <select class="form-select shadow-none">
                              <option value="1">1</option>
                            <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
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

<!-- Our Rooms -->   
<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR ROOMS</h2>
<div class="container">
    <div class="row">
        <?php
        
            require_once('admin/inc/db_config.php');
            require_once('admin/inc/essentials.php');

            $isLoggedIn = false;
            if(isset($_SESSION['login']) && $_SESSION['login'] == true) {
                $isLoggedIn = true;
            }

            $query = "SELECT * FROM `rooms` WHERE `status` = 1 ORDER BY `id` ASC LIMIT 3";
            $room_res = mysqli_query($con, $query);
            
            if(!$room_res) {
                echo "<div class='alert alert-danger'>Error in SQL query: " . mysqli_error($con) . "</div>";
            } elseif(mysqli_num_rows($room_res) == 0) {
                echo "<div class='col-12 text-center'><p>No rooms available at the moment.</p></div>";
            } else {
                while($room_data = mysqli_fetch_assoc($room_res)) {
                    $features_data = "";
                    $fea_q = mysqli_query($con, 
                        "SELECT f.name FROM `features` f
                        INNER JOIN `room_features` rfea ON f.id = rfea.features_id
                        WHERE rfea.room_id = '{$room_data['id']}'");
                    
                    if($fea_q) {
                        while($fea_row = mysqli_fetch_assoc($fea_q)){
                            $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>{$fea_row['name']}</span>";
                        }
                    }
                    
                    $facilities_data = "";
                    $fac_q = mysqli_query($con,
                        "SELECT f.name FROM `facilities` f
                        INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id
                        WHERE rfac.room_id = '{$room_data['id']}'");
                    
                    if($fac_q) {
                        while($fac_row = mysqli_fetch_assoc($fac_q)){
                            $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>{$fac_row['name']}</span>";
                        }
                    }
                    
                    $room_thumb = "images/rooms/" . $room_data['images'];
                    ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 border-0 shadow">
                            <div class="p-3">
                                <img src="<?php echo $room_thumb; ?>" class="img-fluid rounded mb-3" style="height: 200px; object-fit: cover;" 
                                     alt="<?php echo htmlspecialchars($room_data['name']); ?>">
                                <h5 class="mb-2"><?php echo htmlspecialchars($room_data['name']); ?></h5>
                                
                                <?php if(!empty($features_data)): ?>
                                <div class="features mb-2">
                                    <h6 class="mb-1">Features</h6>
                                    <?php echo $features_data; ?>
                                </div>
                                <?php endif; ?>
                                
                                <?php if(!empty($facilities_data)): ?>
                                <div class="facilities mb-2">
                                    <h6 class="mb-1">Facilities</h6>
                                    <?php echo $facilities_data; ?>
                                </div>
                                <?php endif; ?>
                                
                                <div class="guests mb-3">
                                    <h6 class="mb-1">Guests</h6>
                                    <span class='badge rounded-pill bg-light text-dark me-1'>
                                        <?php echo $room_data['adults']; ?> Adults
                                    </span>
                                    <span class='badge rounded-pill bg-light text-dark'>
                                        <?php echo $room_data['children']; ?> Children
                                    </span>
                                </div>
                                
                                <h6 class="mb-3"><?php echo number_format($room_data['price'], 2); ?>€ per night</h6>
                                
                                <?php if($isLoggedIn): ?>
                                    <a href="confirm_booking.php?id=<?php echo $room_data['id']; ?>" 
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
            }
        ?>
        
        <div class="col-lg-12 text-end mt-5">
            <a href="rooms.php" class="btn btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms >>></a>
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