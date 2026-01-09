<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LuxStay Hotel - FACILITIES</title>

    <?php require __DIR__ . '/luxstay/inc/links.php'; ?>

    <style>
      .pop:hover{
        border-top-color: var(--teal);
        transform: scale(1.03);
        transition: all 0.3s;
      }
    </style>
</head>
<body>

<?php require __DIR__ . '/luxstay/inc/header.php'; ?>

<div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">OUR FACILITIES</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">
        Lorem ipsum
    </p>
</div>

<div class="container">
  <div class="row">

    <div class="col-lg-4 col-md-6 mb-5 px-4">
      <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
        <div class="d-flex align-items-center mb-2">
          <img src="luxstay/images/features/wifi.svg" width="40px" alt="Wifi">
          <h5 class="m-0 ms-3">Wifi</h5>
        </div>
        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 mb-5 px-4">
      <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
        <div class="d-flex align-items-center mb-2">
          <img src="luxstay/images/features/wifi.svg" width="40px" alt="Wifi">
          <h5 class="m-0 ms-3">Wifi</h5>
        </div>
        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 mb-5 px-4">
      <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
        <div class="d-flex align-items-center mb-2">
          <img src="luxstay/images/features/wifi.svg" width="40px" alt="Wifi">
          <h5 class="m-0 ms-3">Wifi</h5>
        </div>
        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>
      </div>
    </div>

  </div>
</div>

<?php require __DIR__ . '/luxstay/inc/footer.php'; ?>

</body>
</html>
