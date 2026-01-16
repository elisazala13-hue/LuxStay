<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/LuxStay/admin/inc/db_config.php';
  require_once('inc/essentials.php');
  session_start();
  if(!isset($_SESSION['adminlogin']) || $_SESSION['adminlogin'] !== true){
      redirect('index.php');
  }
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" contect="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel- Management team</title>
    <?php require('inc/links.php');
     require('inc/scripts.php');?>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">


 <?php require('inc/header.php'); ?>

<div class="container-fluid" id="main-content">
  <div class="row">
    <div class="col-log-10 ms-auto p-4 overflow-hidden" style="margin-left:120px;  max-width:1050px;">
      <h3 class="mb-4">MANAGEMENT TEAM</h3>
      </div>
  </div>
</div>
  

  <!-- Management Team section -->
<div class="card border-0 shadow-sm mb-4" style="margin-left:240px;  max-width:900px;">
  <div class="card-body">
    <div class="text-end mb-4">
                 <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#team-s">
                    <i class="bi bi-plus-square"></i> Add
                 </button>
                </div>
     <div class="row" id="team-data">
      <div class="col-md-2 mb-3">
        <div class="card bg-dark text-white">
          <img src="../images/about/team.jpg" class="card-img">
          <div class="card-img-overlay text-end">
            <button type="button" class="btn btn-danger btn-sm shadow-none"><i class="bi bi-trash"></i>
              Delete
            </button>
          </div>
          <p class="card-text text-center px-3 py-2">Random Name</p>
        </div>
      </div>
    </div>

  </div>
</div>


    </div>
  
  </div>
</div>

<!-- Management Team modal -->
<div class="modal fade" id="team-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1">
  <div class="modal-dialog">
    <form id="team_s_form" >
      <div class="modal-content">
        
        <div class="modal-header">
          <h5 class="modal-title">Add Team Member</h5>
          <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">

          <div class="mb-3">
            <label class="form-label fw-bold">Name</label>
            <input 
              type="text" 
              name="member_name" 
              id="member_name_inp" 
              class="form-control shadow-none" 
              required>
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">Picture</label>
            <input 
              type="file" 
              name="member_picture" 
              id="member_picture_inp" 
              accept=".jpg, .png, .webp, .jpeg" 
              class="form-control shadow-none" 
              required>
          </div>

        </div>

        <div class="modal-footer">
          <button 
            type="button" onclick="member_name.value='',member_picture.value=''"
            class="btn text-secondary shadow-none" 
            data-bs-dismiss="modal">
            CANCEL
          </button>

          <button 
            type="submit" 
            class="btn custom-bg text-white shadow-none">
            SUBMIT
          </button>
        </div>

      </div>
    </form>
  </div>
</div>



</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  let general_data,contacts_data;
  let team_s_form = document.getElementById('team_s_form');

  let member_name_inp=document.getElementById('member_name_inp');
  let member_picture_inp=document.getElementById('member_picture_inp');

  


team_s_form.addEventListener('submit',function(e){
  e.preventDefault();
  add_member();
});

function add_member(){
  let data = new FormData();
  data.append('name', member_name_inp.value);
  data.append('picture', member_picture_inp.files[0]);
  data.append('add_member', '');

  let xhr = new XMLHttpRequest();

  xhr.open("POST", "ajax/settings_crud.php", true);
 

  
    xhr.onload = function(){
        console.log('RESPONSE:', this.responseText);
         var myModal = document.getElementById('team-s');
         var modal = bootstrap.Modal.getInstance(myModal);
         modal.hide();

         if(this.responseText == 'inv_img'){
             alert('error','Only JPG and PNG images are allowed!');
         }
         else if(this.responseText == 'inv_size'){
             alert('error','Image should be less than 2MB!');
         }
         else if(this.responseText == 'upd_failed'){
             alert('error','Image upload failed. Server Down!');
         }
         else{
             alert('success','New member added!');
             member_name_inp.value='';
             member_picture_inp.value='';
             get_members();
         }
    }

  xhr.send(data);


}

function get_members()
{
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/settings_crud.php",true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

    xhr.onload = function(){
     document.getElementById('team-data').innerHTML = this.responseText;
    }

    xhr.send('get_members');
}

function rem_member(val)
{
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/settings_crud.php",true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

    xhr.onload = function(){
        if(this.responseText==1){
            alert('success','Member removed!');
            get_members();
        }
        else{
            alert('error','Server down!');
        }
    }

    xhr.send('rem_member='+val);
}

window.onload = function(){
    get_members();
}
</script>

    
</body>
</html>