<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>LuxStay - ABOUT</title>
    <title>LuxStay HOTEL - ABOUT</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
    <link rel="stylesheet" href="css/common.css">

    <?php require('inc/links.php'); ?>
</head>

<body class="bg-light">

<?php require('inc/header.php'); ?>

<div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">ABOUT US</h2>
    <div class="h-line bg-dark mx-auto"></div>

    <p class="text-center mt-3">
       Në LuxStay, ne besojmë se qëndrimi juaj duhet të jetë<br>
       më shumë sesa thjesht një natë fjetjeje, duhet të jetë 
       një përvojë e paharrueshme. <br>
       I ndërtuar mbi standarde të larta komoditeti, elegance dhe mikpritjeje, 
       LuxStay ofron një ambient ku luksi dhe rehati <br> 
       takohen në harmoni të plotë.
    </p>
</div>

<div class="container">
    <div class="row justify-content-between align-items-center">
        <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
        <h3 class="mb-3">Ekipi ynë</h3>
        <p>Ekipi ynë profesional dhe mikpritës është 
            gjithmonë i gatshëm t’ju ofrojë shërbimin më të mirë, 
            duke siguruar që çdo moment i qëndrimit tuaj në LuxStay 
            të jetë i rehatshëm, i qetë dhe i veçantë.
      </p>
    </div>
    <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-md-2 order-1">
            <img src="images/about/about.jpg" class="w-100">
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">

        <div class="col-lg-3 col-md-6 mb-4 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                <img src="images/about/hotel.svg" width="70px">
                <h4 class="mt-3">100+ ROOMS</h4>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                <img src="images/about/customers.svg" width="70px">
                <h4 class="mt-3">200+ CUSTOMERS</h4>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                <img src="images/about/rating.svg" width="70px">
                <h4 class="mt-3">150+ REVIEWS </h4>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                <img src="images/about/staff.svg" width="70px">
                <h4 class="mt-3">"200 STAFF </h4>
            </div>
        </div>
    </div>
</div>

<h3 class="my-5 fw-bold h-font text-center">  MANAGEMENT TEAM</h3>

<div class="container px-4">
  <div class="swiper mySwiper">
    <div class="swiper-wrapper mb-5">

      <div class="swiper-slide bg-white text-center overflow-hidden rounded">
        <img src="images/about/team.jpg" class="w-100" alt="Team member">
        <h5 class="mt-2">Blerina Tafaj</h5>
      </div>

       <div class="swiper-slide bg-white text-center overflow-hidden rounded">
        <img src="images/about/team.jpg" class="w-100" alt="Team member">
        <h5 class="mt-2">Elisa Zala</h5>
      </div>

      <div class="swiper-slide bg-white text-center overflow-hidden rounded">
        <img src="images/about/team.jpg" class="w-100" alt="Team member">
        <h5 class="mt-2">Xhesilda Coro</h5>
      </div>

      <div class="swiper-slide bg-white text-center overflow-hidden rounded">
        <img src="images/about/team.jpg" class="w-100" alt="Team member">
        <h5 class="mt-2">Xhoana Pepa</h5>
      </div>

    </div>

<script>

    function alert(type, msg, position = 'body') {
    let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
    let element = document.createElement('div');
    element.innerHTML = 
        `<div class="alert ${bs_class} alert-dismissible fade show" role="alert">
            <strong class="me-3">${msg}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`;

    if(position == 'body') {
        document.body.append(element);
        element.classList.add('custom-alert');
    } else {
        document.getElementById(position).appendChild(element);
    }

    setTimeout(remAlert, 2000);
}

function remAlert() {
    let alerts = document.getElementsByClassName('alert');
    if(alerts.length > 0) {
        alerts[0].remove();
    }
}

   let register_form = document.getElementById('register-form');

register_form.addEventListener('submit', (e) => {
    e.preventDefault();

    let data = new FormData();

    data.append('name', register_form.elements['name'].value);
    data.append('email', register_form.elements['email'].value);
    data.append('address', register_form.elements['address'].value);
    data.append('phonenum', register_form.elements['phonenum'].value);
    data.append('dob', register_form.elements['dob'].value);
    data.append('pincode', register_form.elements['pincode'].value);
    data.append('pass', register_form.elements['pass'].value);
    data.append('cpass', register_form.elements['cpass'].value);

    const profileInput = register_form.elements['profile'];
    if (profileInput && profileInput.files.length > 0) {
        data.append('profile', profileInput.files[0]);
    }

    data.append('register', '');

    const myModal = document.getElementById('registerModal');
    const modal = bootstrap.Modal.getInstance(myModal);
    if (modal) modal.hide();

   
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/login_register.php", true);
    xhr.onload = function () {
        console.log(this.responseText); 
    };
    xhr.send(data);
});


</script>



<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 4,
        spaceBetween: 40,
        pagination: {
            el: ".swiper-pagination",
            clickable: true
        },
        breakpoints: {
            0: {
                slidesPerView: 1
            },
            768: {
                slidesPerView: 2
            },
            1024: {
                slidesPerView: 3
            }
        }
    });
</script>


</body>
</html>
