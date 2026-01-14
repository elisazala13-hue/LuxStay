<?php
require_once('inc/essentials.php');
require_once('inc/db_config.php');
adminLogin();
global $con;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
                     <thead class="table-dark">
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
            <div class="modal" id="add-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1">
            <div class="modal-dialog">
               <form id="add_room_form" autocomplete="off" enctype="multipart/form-data" method="post">
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
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">Room Image</label>
                            <input type="file" name="images" accept=".jpg,.jpeg,.png,.webp" 
                                class="form-control shadow-none" required id="imageInput">
                            <small class="text-muted" id="imageStatus">No file selected</small></div>
                             <div class="col-12 mb-3">
                        <label class="form-label fw-bold">Features</label>
                        <div class="row">
                        <?php
                            $res= selectAll('features');
                            while($opt=mysqli_fetch_assoc($res)){
                            echo"
                            <div class='col-md-3 mb-1'>
                                <label>
                                <input type='checkbox' name='features[]' value='$opt[id]' class='form-check-input'>
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
                        <?php
                            $res= selectAll('facilities');
                            while($opt=mysqli_fetch_assoc($res)){
                            echo"
                            <div class='col-md-3 mb-1'>
                                <label>
                                <input type='checkbox' name='facilities[]' value='$opt[id]' class='form-check-input'>
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
                <button type="submit" class="btn btn-primary">Add Room</button>
                </div>

                </div>
                </form>
            </div>
            </div>

        <!--Edit room Modal -->
            <div class="modal" id="edit-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1">
            <div class="modal-dialog">
                <form id="edit_room_form" autocomplete="off" enctype="multipart/form-data" method="post">
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
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">Room Image</label>
                            <input 
                                type="file" 
                                name="images" 
                                accept=".jpg, .png, .webp, .jpeg" 
                                class="form-control shadow-none">
                            <small class="text-muted">Leave empty to keep current image</small>
                        </div>
                        <div class="col-12 mb-3">
                        <label class="form-label fw-bold">Features</label>
                        <div class="row">                        <?php
                            $res= selectAll('features');
                            while($opt=mysqli_fetch_assoc($res)){
                            echo"
                            <div class='col-md-3 mb-1'>
                                <label>
                                <input type='checkbox' name='features[]' value='$opt[id]' class='form-check-input'>
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
                                    
                        <?php
                            $res= selectAll('facilities');
                            while($opt=mysqli_fetch_assoc($res)){
                            echo"
                            <div class='col-md-3 mb-1'>
                                <label>
                                <input type='checkbox' name='facilities[]' value='$opt[id]' class='form-check-input'>
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
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </div>
                </form>
            </div>
            </div>
         </div>
      </div>
   </div>
    
    <?php require('inc/scripts.php');?>

    <script>
        let add_room_form = document.getElementById('add_room_form');
        add_room_form.addEventListener('submit', function(e){
            e.preventDefault();
            add_room();
        })
        
        function add_room() {
            let form = document.getElementById('add_room_form');
            let data = new FormData(form);

            data.append('add_room', '');

            let xhr = new XMLHttpRequest();
            xhr.open('POST', "ajax/rooms.php", true);

            xhr.onload = function () {
                var myModal = document.getElementById('add-room');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if (this.responseText == 1) {
                    alert('success', 'New room added!');
                    form.reset();
                    get_all_rooms();
                } else {
                    alert('error', 'Server Down!');
                }
            };

            xhr.send(data);
        }

        //eshte sakte
        function get_all_rooms(){
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax/rooms.php", true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onload = function(){
                    document.getElementById('room-data').innerHTML = this.responseText;
                }

                xhr.send('get_all_rooms');
            }
        window.onload = function() {
            get_all_rooms();
        }

        //eshte sakte
        function toggle_status(id,val){
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax/rooms.php", true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function(){
                     if(this.responseText == 1){
                        alert('success', 'Status changed!');
                        get_all_rooms();
                    }
                    else{
                        alert('error', 'Server Down!');
                    }
                }
                xhr.send('toggle_status='+id+'&value='+val);
            }

        
        //fotoja, fac, fea nuk funks sakte
        let edit_room_form = document.getElementById('edit_room_form');
        edit_room_form.addEventListener('submit', function(e){
            e.preventDefault();
            add_edit_room();
        });
        
        function edit_room(id){
            let xhr= new XMLHttpRequest();
            xhr.open('POST', "ajax/rooms.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {        
                    let response = JSON.parse(this.responseText);
                    if (response.success) {
                        let data = response.roomdata;                         
                        if (data && data.name) {
                            edit_room_form.elements['name'].value = data.name;
                            edit_room_form.elements['area'].value = data.area;
                            edit_room_form.elements['price'].value = data.price;
                            edit_room_form.elements['quantity'].value = data.quantity;
                            edit_room_form.elements['adults'].value = data.adults;
                            edit_room_form.elements['children'].value = data.children;
                            edit_room_form.elements['room_id'].value = data.id;
                            
                            let featureCheckboxes = edit_room_form.querySelectorAll('input[name="features[]"]');
                            featureCheckboxes.forEach(el => {
                                el.checked = response.features.includes(parseInt(el.value));
                            });
                            
                            let facilityCheckboxes = edit_room_form.querySelectorAll('input[name="facilities[]"]');
                            facilityCheckboxes.forEach(el => {
                                el.checked = response.facilities.includes(parseInt(el.value));
                            });

                            var myModal = new bootstrap.Modal(document.getElementById('edit-room'));
                            myModal.show();
                        } else {
                            alert('error', 'Room data not found!');
                        }
                    } else {
                        alert('error', 'Failed to get room data!');
                    }
                
            }

            xhr.send('get_room=' + id);
        }
        
        function add_edit_room() {
            let xhr = new XMLHttpRequest();
            xhr.open('POST', "ajax/rooms.php", true);
            let form = document.getElementById('edit_room_form');
            let data = new FormData(form);

            const formElements = form.elements;
            for (let element of formElements) {
                if (element.name && element.type !== 'checkbox') {
                    data.append(element.name, element.value);
                }
            }

            let features = [];
            let featureCheckboxes = form.querySelectorAll('input[name="features[]"]');
            featureCheckboxes.forEach((checkbox, index) => {
            if (checkbox.checked) {
                features.push(checkbox.value);
            }
            });
                
            let facilities = [];
            let facilityCheckboxes = form.querySelectorAll('input[name="facilities[]"]');
            facilityCheckboxes.forEach((checkbox, index) => {
            if (checkbox.checked) {
                facilities.push(checkbox.value);}});        
                
            data.append('features', JSON.stringify(features));
            data.append('facilities', JSON.stringify(facilities));
            data.append('edit_room', '');

            xhr.onload = function () {
                    if (this.responseText == 1) {
                        alert('success', 'Room updated successfully!');
                        get_all_rooms();
                        var modal = bootstrap.Modal.getInstance(document.getElementById('edit-room'));
                        if(modal) modal.hide();
                        
                    } else if (this.responseText == 0) {
                        alert('error', 'Update failed!');
                    } else {
                        alert('error', 'Error: ' + this.responseText);
                    }
                };

            xhr.send(data);
            }

        //eshte sakte
        function rem_room(room_id) {
        if(confirm("Are you sure, you want to delete this room?")) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            
            xhr.onload = function() {
                if(this.responseText == 1) {
                    alert('success', 'Room Removed!');
                    get_all_rooms();
                } else {
                    alert('error', 'Room removal failed!');
                }
            }
            
            xhr.send('rem_room=' + room_id);
        }
    }
      
    </script>

</body>
</html>   