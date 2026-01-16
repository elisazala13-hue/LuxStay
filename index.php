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

<!--Our Rooms-->   
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR ROOMS</h2>
    <div class="container">
        <div class="row">
         <?php
        require('admin/inc/db_config.php');
        require('admin/inc/essentials.php');

        $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=? LIMIT 3 ORDER BY `id` DESC",[1,0], 'ii');

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
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow">
                        <div class="p-3">
                            <img src="{$room_thumb}" class="img-fluid rounded mb-3">

                            <h5 class="mb-2">{$room_data['name']}</h5>

                            <div class="features mb-2">
                                <h6 class="mb-1">Features</h6>
                                {$features_data}
                            </div>

                            <div class="facilities mb-2">
                                <h6 class="mb-1">Facilities</h6>
                                {$facilities_data}
                            </div>

                            <div class="guests mb-3">
                                <h6 class="mb-1">Guests</h6>
                                <span class='badge rounded-pill bg-light text-dark'>{$room_data['adults']} Adults</span>
                                <span class='badge rounded-pill bg-light text-dark'>{$room_data['children']} Children</span>
                            </div>

                            <h6 class="mb-3">{$room_data['price']}€ per night</h6>

                            <a href="#" class="btn btn-sm btn-primary shadow-none w-100">Book Now</a>
                        </div>
                    </div>
                </div>
                data;

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


            <!-- Password reset modal and code -->

        <div class="modal fade" id="recoveryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="recovery-form">
                        <div class="modal-header">
                            <h5 class="modal-title d-flex align-items-center">
                                <i class="bi bi-shield-lock fs-3 me-2"></i> Set up New Password
                            </h5>
                        </div>
                        <div class="modal-body">
                            <div class="mb-4">
                                <label class="form-label">New Password</label>
                                <input type="password" name="pass" required class="form-control shadow-none">
                                <input type="hidden" name="email">
                                <input type="hidden" name="token">

                           
                            </div>

                            <div class="mb-2 text-end">
                                <button type="button" class="btn shadow-none me-2" data-bs-dismiss="modal">CANCEL</button>
                                <button type="submit" class="btn btn-dark shadow-none">SUBMIT</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


            <!-- Password reset modal and code -->

        <div class="modal fade" id="recoveryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="recovery-form">
                        <div class="modal-header">
                            <h5 class="modal-title d-flex align-items-center">
                                <i class="bi bi-shield-lock fs-3 me-2"></i> Set up New Password
                            </h5>
                        </div>
                        <div class="modal-body">
                            <div class="mb-4">
                                <label class="form-label">New Password</label>
                                <input type="password" name="pass" required class="form-control shadow-none">
                                <input type="hidden" name="email">
                                <input type="hidden" name="token">

                           
                            </div>

                            <div class="mb-2 text-end">
                                <button type="button" class="btn shadow-none me-2" data-bs-dismiss="modal">CANCEL</button>
                                <button type="submit" class="btn btn-dark shadow-none">SUBMIT</button>
                            </div>
                        </div>
                    </form>
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
      
                    // recover account
            let recovery_form = document.getElementById('recovery-form');

            recovery_form.addEventListener('submit', (e)=>{
                e.preventDefault();

                let data = new FormData();

                data.append('email',recovery_form.elements['email'].value);
                data.append('token',recovery_form.elements['token'].value);
                data.append('pass',recovery_form.elements['pass'].value);
                data.append('recover_user','');

                var myModal = document.getElementById('recoveryModal');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                let xhr = new XMLHttpRequest();
                xhr.open("POST","ajax/login_register.php",true);

                xhr.onload = function(){
                    if(this.responseText == 'failed'){
                        alert('error',"Account reset failed!");
                    }
                    else{
                        alert('success',"Account Reset Successful !");
                        recovery_form.reset();
                    }
                }

                xhr.send(data);
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

<?php 
if(isset($_GET['account_recovery']))
{
    $data = filteration($_GET);
    $t_date = date("Y-m-d");

    $query = select(
        "SELECT * FROM `user_cred` WHERE `email`=? AND `token`=? AND `t_expire`=? LIMIT 1",
        [$data['email'], $data['token'], $t_date],
        'sss'
    );

    if(mysqli_num_rows($query) == 1)
    {
        ?>
        <script>
            // Ky script është në fund të faqes, DOM është gati → mund të ekzekutohet direkt
            var myModal = document.getElementById('recoveryModal');

            if(myModal){
                myModal.querySelector("input[name='email']").value = '<?= $data['email'] ?>';
                myModal.querySelector("input[name='token']").value = '<?= $data['token'] ?>';

                var modal = new bootstrap.Modal(myModal);
                modal.show();
            }
        </script>
        <?php
    }
    else{
        ?>
        <script>
            // Thirr direkt funksionin alert që e ke te footer.php
            alert('error',"Invalid or Expired Link !");
        </script>
        <?php
    }
}
?>

</body>
</html>