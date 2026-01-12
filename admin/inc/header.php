  <link rel="stylesheet" href="css/common.css">
  <body class="bg-light">

  <!-- HEADER -->
  <header class="container-fluid bg-dark text-light p-3 d-flex align-items-center justify-content-between shadow-sm fixed-top">
    <h3 class="mb-0">LuxStay ADMIN</h3>
    <a href="logout.php" class="btn btn-light btn-sm fw-bold">LOG OUT</a>
  </header>

  <div class="container-fluid" style="padding-top: 70px;"> 
    <div class="row">

      <!-- SIDEBAR -->
      <nav class="col-lg-2 bg-dark vh-100 border-end border-secondary p-3 position-fixed" style="top:0;">
        <h5 class="text-light mb-4">ADMIN PANEL</h5>
        <ul class="nav nav-pills flex-column">
          <li class="nav-item mb-2">
            <a href="users.php" class="nav-link text-light fw-semibold">User Management</a>
          </li>
          <li class="nav-item mb-2">
            <a href="rooms.php" class="nav-link text-light fw-semibold" onclick="get_all_rooms()">Rooms</a>
          </li>
          <li class="nav-item mb-2">
            <a href="contact.php" class="nav-link text-light fw-semibold">Contact</a>
          </li>
          <li class="nav-item mb-2">
            <a href="team.php" class="nav-link text-light fw-semibold">Management Team</a>
          </li>
        </ul>
      </nav>

      <!-- MAIN CONTENT -->
      <main class="col-lg-10 offset-lg-2 p-4" id="main-content">
        <!-- Content i faqes ndryshon sipas menù klik -->
      </main>

    </div>
  </div>

</body>
