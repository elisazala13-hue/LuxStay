
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compitable" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Admin Panel- Rooms</title>
     <?php require('inc/links.php');?>
</head>
<body class="bg-light">
   <?php require('inc/header.php');?>
   <div class="container-fluid" id="main-content">
      <div class="row">
         <div class="col-lg-10 p-4" style="margin-left:220px;  max-width:900px;">
            <h3 class="mb-4">ROOMS</h3>

            <div class="card border-0 shadow-sm mb-4">
               <div class="card-body">
               <div class="text-end mb-4">
                 <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-room">
                    <i class="bi bi-plus-square"></i> Add
                 </button>
                </div>
                <div class="table-responsive-lg" >
                  <table class="table table-hover border">
                     <thead>
                      <tr class="bg-dark text-light">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Area</th>
                        <th scope="col">Guests</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                     </thead>
                     <tbody id="room-data">
                     </tbody>
                     </table>
                </div>
               </div>
            </div>

          <!--Add room Modal -->
            <div class="modal fade" id="add-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form id="add_room_form" autocomplete="off">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add room</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Name</label>
                        <input type="text" name="name" class="form-control shadow-none" required></div>
                        <div class="col-md-6 mb-3"><label class="form-label fw-bold">Area</label>
                        <input type="number" name="area" min="1" class="form-control shadow-none" required></div>
                        <div class="col-md-6 mb-3"><label class="form-label fw-bold">Adults (Max.)</label>
                        <input type="number" name="adults" class="form-control shadow-none" required></div>
                        <div class="col-md-6 mb-3"><label class="form-label fw-bold">Children (Max.)</label>
                        <input type="number" name="children" class="form-control shadow-none" required></div>
                        <div class="col-md-6 mb-3"><label class="form-label fw-bold">Price</label>
                        <input type="number" name="price" class="form-control shadow-none" required></div>
                        <div class="col-md-6 mb-3"><label class="form-label fw-bold">Quantity</label>
                        <input type="text" name="quantity" class="form-control shadow-none" required></div>
                        <div class="col-md-6 mb-3"><label class="form-label fw-bold">Status</label>
                        <input type="text" name="status" class="form-control shadow-none" required></div>
                        <div class="col-md-6 mb-3"><label class="form-label fw-bold">Action</label>
                        <input type="text" name="action" class="form-control shadow-none" required></div>
                        <div class="col-12 mb-3">
                        <label class="form-label fw-bold">Features</label>
                        <div class="row">
                                      <!--KRIJO TABELEN FEATURES??-->
                        <?php
                            $res= selectAll('features');
                            while($opt=mysqli_fetch_assoc($res)){
                            echo"
                            <div class='col-md-3 mb-1'>
                                <label>
                                <input type='checkbox' name='features' value='$opt[id]' class='form-check-input'>
                                $opt[name]
                                </label>
                            </div>
                            ";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label fw-bold">Facilities</label>
                        <div class="row">
                                      <!--KRIJO TABELEN FACILITIES??-->
                        <?php
                            $res= selectAll('facilities');
                            while($opt=mysqli_fetch_assoc($res)){
                            echo"
                            <div class='col-md-3 mb-1'>
                                <label>
                                <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input'>
                                $opt[name]
                                </label>
                            </div>
                            ";
                            }
                            ?>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="add_room()">Add Room</button>
                </div>

                </div>
                </form>
            </div>
            </div>

        <!--Edit room Modal -->
            <div class="modal fade" id="edit-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form id="edit_room_form" autocomplete="off">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit room</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Name</label>
                        <input type="text" name="name" class="form-control shadow-none" required></div>
                        <div class="col-md-6 mb-3"><label class="form-label fw-bold">Area</label>
                        <input type="number" name="area" min="1" class="form-control shadow-none" required></div>
                        <div class="col-md-6 mb-3"><label class="form-label fw-bold">Adults (Max.)</label>
                        <input type="number" name="adults" class="form-control shadow-none" required></div>
                        <div class="col-md-6 mb-3"><label class="form-label fw-bold">Children (Max.)</label>
                        <input type="number" name="children" class="form-control shadow-none" required></div>
                        <div class="col-md-6 mb-3"><label class="form-label fw-bold">Price</label>
                        <input type="number" name="price" class="form-control shadow-none" required></div>
                        <div class="col-md-6 mb-3"><label class="form-label fw-bold">Quantity</label>
                        <input type="text" name="quantity" class="form-control shadow-none" required></div>
                        <div class="col-md-6 mb-3"><label class="form-label fw-bold">Status</label>
                        <input type="text" name="status" class="form-control shadow-none" required></div>
                        <div class="col-md-6 mb-3"><label class="form-label fw-bold">Action</label>
                        <input type="text" name="action" class="form-control shadow-none" required></div>
                        <div class="col-12 mb-3">
                        <label class="form-label fw-bold">Features</label>
                        <div class="row">
                                      <!--KRIJO TABELEN FEATURES??-->
                        <?php
                            $res= selectAll('features');
                            while($opt=mysqli_fetch_assoc($res)){
                            echo"
                            <div class='col-md-3 mb-1'>
                                <label>
                                <input type='checkbox' name='features' value='$opt[id]' class='form-check-input'>
                                $opt[name]
                                </label>
                            </div>
                            ";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label fw-bold">Facilities</label>
                        <div class="row">
                                      <!--KRIJO TABELEN FACILITIES??-->
                        <?php
                            $res= selectAll('facilities');
                            while($opt=mysqli_fetch_assoc($res)){
                            echo"
                            <div class='col-md-3 mb-1'>
                                <label>
                                <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input'>
                                $opt[name]
                                </label>
                            </div>
                            ";
                            }
                            ?>
                        </div>
                    </div>
                    <input type="hidden" name="room_id">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
                </div>
                </form>
            </div>
            </div>

        <!-- Manage Room Image -->
        <div class="modal fade" id="room-image" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Room Name</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="image-alert">     </div>
                    <form id="add_image_form">
                        <label class="form-label fw-bold">Add Image</label>
                        <input 
                            type="file" 
                            name="image" 
                            accept=".jpg, .png, .webp, .jpeg" 
                            class="form-control shadow-none mb-3" 
                            required>
                        <button class="btn custom-bg text-white shdow-none">ADD</button>
                        <input type="hidden" name="room_id">
                    </form>
                </div>
                 <div class="table-responsive-lg" style="height:350px; overflow-y: scroll;">
                  <table class="table table-hover border">
                     <thead>
                      <tr class="bg-dark text-light">>
                        <th scope="col" width="60%">Image</th>
                        <th scope="col">Delete</th>
                      </tr>
                     </thead>
                     <tbody id="room-image-data">
                     </tbody>
                     </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
        </div>

         </div>
      </div>
   </div>

    <?php require('inc/scripts.php');?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="scripts/rooms.js"> </script>
    </body>
</html>   