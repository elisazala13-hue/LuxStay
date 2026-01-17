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
            <a class="nav-link active me-2" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link me-2" href="rooms.php">Rooms</a>
            </li>
             <li class="nav-item">
            <a class="nav-link me-2" href="contact.php">Contact us</a>
            </li>
             <li class="nav-item">
            <a class="nav-link me-2" href="about.php">About</a>
            </li>
        </ul>
        <div class="d-flex">  
           
           <?php
           
           if(isset($_SESSION['login']) && $_SESSION['login']==true)
                {
                    $path = USERS_IMG_PATH;
                    echo<<<data
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-dark shadow-none dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                            <img src="$path$_SESSION[uPic]" style="width: 25px; height: 25px;" class="me-1 rounded-circle">
                            $_SESSION[uName]
                        </button>
                        <ul class="dropdown-menu dropdown-menu-lg-end">
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            <li><a class="dropdown-item" href="bookings.php">Bookings</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                    data;
                }
            else{
                echo<<<data
            <button type="button" class="btn btn-outline-dark shadow-none me-lg-2 me-3" data-bs-toggle="modal" data-bs-target="#loginModal">
            Login
            </button>
            <button type="button" class="btn btn-outline-dark shadow-none me-lg-2 me-3" data-bs-toggle="modal" data-bs-target="#registerModal">
            Register
            </button>
            data;
            }
            
            ?>
           
        </div>
        </div>
    </div>
    </nav>

<!--Login Button-->
    <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="login-form">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center">
                            <i class="bi bi-person-circle fs-3 me-2"></i>
                            User Login</h5>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Email / Mobile</label>
                        <input type="text" name="email_mob"  required class="form-control shadow-none"
                        placeholder="Enter email or mobile">
                           
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
        <input type="password" name="pass" required  minlength="6" class="form-control shadow-none" placeholder="Enter your password">
                           
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="rememberMe" name="remember_me">
                    <label class="form-check-label" for="rememberMe">
                        Remember me
                    </label>
                </div>

                <div class="d-flex align-items-center">
                    <button type="submit" class="btn btn-dark shadow-none me-3">LOGIN</button>
                    <button type="button" 
                            class="btn text-secondary text-decoration-none shadow-none p-0"
                            data-bs-toggle="modal" data-bs-target="#forgotModal" data-bs-dismiss="modal">
                        Forgot Password?
                    </button>
                </div>

            </div>


                    </div>
                </form>
            </div>
        </div>
    </div>

<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="register-form" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-lines-fill fs-3 me-2"></i>
                        User Registration
                    </h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                         <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control shadow-none" required>

                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control shadow-none" required>
                            </div>

                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="number" name="phonenum" class="form-control shadow-none">

                                <label class="form-label">Date of Birth</label>
                                <input type="date" name="dob" class="form-control shadow-none">
                            </div>

                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="pass" class="form-control shadow-none" required>

                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="cpass" class="form-control shadow-none" required>
                            </div>

                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Address</label>
                                <textarea name="address" class="form-control shadow-none" rows="2"></textarea>

                                <label class="form-label">Pincode</label>
                                <input type="text" name="pincode" class="form-control shadow-none">

                                <label class="form-label">Profile Picture</label>
                                <input type="file" name="profile" class="form-control shadow-none" accept="image/*" required>
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

 <div class="modal fade" id="forgotModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="forgot-form">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center">
                            <i class="bi bi-person-circle fs-3 me-2"></i>
                            Forgot Password</h5>
                    </div>
                       <div class="modal-body">

                        <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                            Note: A link will be sent to your email to reset your password!
                        </span>

                        <div class="mb-4">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" required class="form-control shadow-none">
                        </div>

                        <div class="mb-2 text-end">
                           
                            <button type="button" class="btn shadow-none p-0 me-2" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">
                                CANCEL
                            </button>
                             <button type="submit" class="btn btn-dark shadow-none">SEND LINK</button>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-dark shadow-none">REGISTER</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<!-- Email Verification Modal -->
<div class="modal fade" id="verifyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="verify-form">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-shield-check fs-3 me-2"></i>
                        Verify Your Email
                    </h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control shadow-none" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Verification Code</label>
                        <input type="text" name="otp" class="form-control shadow-none" required>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary shadow-none me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-dark shadow-none">Verify</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


   
