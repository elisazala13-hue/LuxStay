<!-- fushat e regjistrimit jane vetem: name, email, phone num, date of birth, password-->
<!-- stilizimet: bootstrap, swiper.js-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LuxStay Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Merienda&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css"/>
    <style>
        *{
            font-family: "Poppins", sans-serif;
        }
        .h-font{
            font-family: "Merienda", cursive;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button{
            -webkit-apperance: none;
            margin: 0;
        }
        input[type=number]{
            -moz-apperance: textfield;
        }

        .custom-bg{
            background-color: #2ec1ac;
        }
        
        .custom-bg:hover{
            background-color: #279e8c;
        }

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

<!--Navigation Bar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">LuxStay</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active me-2" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link me-2" href="#">Rooms</a>
            </li>
             <li class="nav-item">
            <a class="nav-link me-2" href="#">Facilities</a>
            </li>
             <li class="nav-item">
            <a class="nav-link me-2" href="#">Contact us</a>
            </li>
             <li class="nav-item">
            <a class="nav-link me-2" href="#">About</a>
            </li>
        </ul>
        <div class="d-flex">
            <button class="btn btn-outline-success" type="submit">Search</button>
            <button type="button" class="btn btn-outlin-dark shadow-none me-lg-2 me-3" data-bs-toggle="modal" data-bs-target="#loginModal">
            Login
            </button>
            <button type="button" class="btn btn-outlin-dark shadow-none me-lg-2 me-3" data-bs-toggle="modal" data-bs-target="#registerModal">
            Register
            </button>
        </div>
        </div>
    </div>
    </nav>

<!--Login Button-->
    <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center">
                            <i class="bi bi-person-circle fs-3 me-2"></i>
                            User Login</h5>
                        <button type="reser" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control shadow-none">
                           
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control shadow-none">
                           
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <button type="submit" class="btn btn-dark shadow-none">LOGIN</button>
                            <a href="javascript: void(0)" class="text-secondary text-decoration-none">Forgot Password?</a>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!--Register Button-->
    <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center">
                            <i class="bi bi-person-lines-fill fs-3 me-2"></i>
                            User Registration</h5>
                        <button type="reser" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">Note: Your details must match your Id that will be required during check-in.</span>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control shadow-none">
                                    <br>
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control shadow-none">
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="number" class="form-control shadow-none">
                                    <br>
                                    <label class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control shadow-none">
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control shadow-none">
                                    <br>
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control shadow-none">
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-dark shadow-none">REGISTER</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

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
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Book Now</a>
                            <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More Details...</a>
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
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Book Now</a>
                            <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More Details...</a>
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
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Book Now</a>
                            <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More Details...</a>
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
                    <h6>Random user</h6>
                    <p>Lorem ipsum dolor sit amet, 
                        consectetur adipiscing elit, 
                        sed do eiusmod tempor incididunt ut 
                        labore et dolore magna aliqua. Ut 
                        enim ad minim veniam, quis nostrud 
                        exercitation ullamco laboris nisi 
                        ut aliquip ex ea commodo consequat. </p>
                    <div class="rating mb-4">
                                <h6 class="mb-1">Rating</h6>
                                <span class="badge rounded-pill bg-light">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                </span>
                    </div>
                </div>
                <div class="swiper-slide bg-white p-4">
                    <h6>Random user</h6>
                    <p>Lorem ipsum dolor sit amet, 
                        consectetur adipiscing elit, 
                        sed do eiusmod tempor incididunt ut 
                        labore et dolore magna aliqua. Ut 
                        enim ad minim veniam, quis nostrud 
                        exercitation ullamco laboris nisi 
                        ut aliquip ex ea commodo consequat. </p>
                    <div class="rating mb-4">
                                <h6 class="mb-1">Rating</h6>
                                <span class="badge rounded-pill bg-light">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                </span>
                    </div>
                </div>
                <div class="swiper-slide bg-white p-4">
                    <h6>Random user</h6>
                    <p>Lorem ipsum dolor sit amet, 
                        consectetur adipiscing elit, 
                        sed do eiusmod tempor incididunt ut 
                        labore et dolore magna aliqua. Ut 
                        enim ad minim veniam, quis nostrud 
                        exercitation ullamco laboris nisi 
                        ut aliquip ex ea commodo consequat. </p>
                    <div class="rating mb-4">
                                <h6 class="mb-1">Rating</h6>
                                <span class="badge rounded-pill bg-light">
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

<!--Footer-->  
    <div class="container-fluid bg-white mt-5">
        <div class="row">
            <div class="col-lg-4 p-4">
                <h3 class="h-font fw-bold fs-3 mb-2">LuxStay Hotel</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipiscing elit. 
                    Quisque faucibus ex sapien vitae pellentesque sem placerat. 
                    In id cursus mi pretium tellus duis convallis. Tempus 
                    leo eu aenean sed diam urna tempor. Pulvinar vivamus 
                    fringilla lacus nec metus bibendum egestas. </p>
            </div>
            <div class="col-lg-4 p-4">
                <h5 class="mb-3">Links</h5>
                <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">Home</a><br>
                <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">Rooms</a><br>
                <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">Facilities</a><br>
                <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">Contact us</a><br>
                <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">About</a>
            </div>
            <div class="col-lg-4 p-4">
                <h5 class="mb-3">Follow Us!</h5>
                <a href="#" class="d-inline-block text-decoration-none text-dark mb-2"><i class="bi bi-twitter me-1"></i>Twitter</a><br>
                <a href="#" class="d-inline-block text-decoration-none text-dark mb-2"><i class="bi bi-instagram me-1"></i>Instagram</a><br>
                <a href="#" class="d-inline-block text-decoration-none text-dark mb-2"><i class="bi bi-facebook me-1"></i></i>Facebook</a><br>    
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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