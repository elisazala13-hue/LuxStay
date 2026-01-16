<?php
//require_once $_SERVER['DOCUMENT_ROOT'] . '/LuxStay/admin/inc/db_config.php';

  // require_once('inc/essentials.php');
   //session_start();

   //if(!isset($_SESSION['adminlogin']) || $_SESSION['adminlogin'] !== true){
     // redirect('index.php');
   //}
   require('inc/essentials.php');
   require('inc/db_config.php');
   adminlogin();

   if(isset($_GET['seen']))
   {
      $frm_data=filteration($_GET);

      if($frm_data['seen']=='all'){
         $q="UPDATE `user_queries` SET `seen`=?";
         $values=[1];
         if(update($q,$values,'i')){
            alert('success','Marked all as read');

         }
         else{
            alert('error','Operation failed!');
             }

      }
      else{
         $q="UPDATE `user_queries` SET `seen`=? WHERE `user_id`=?";
         $values=[1,$frm_data['seen']];
         if(update($q,$values,'ii')){
            alert('success','Marked as read');

         }
         else{
            alert('error','Operation failed!');

         }
      }
   }

   
   
   if(isset($_GET['del'])){
      $frm_data=filteration($_GET);

    if ($frm_data['del'] == 'all') {
        $q = "DELETE FROM `user_queries`";
        mysqli_query($con, $q);
        alert('success', 'All data deleted');
    } else {
        $q = "DELETE FROM `user_queries` WHERE `user_id`=?";
        $values = [$frm_data['del']];
        delete($q, $values, 'i');
        alert('success', 'Data deleted');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Contact</title>
    <?php require('inc/links.php'); ?>
</head>

<body class="bg-light">
   <?php require('inc/header.php');?>
   <div class="container-fluid" id="main-content">
      <div class="row">
         <div class="col-lg-10 ms-auto p-4 overflow-hidden">
            <h3 class="mb-4">CONTACT</h3>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">

                    <div class="text-end mb-4">
                        <a href="?seen=all" class="btn btn-dark btn-sm rounded-pill">
                            <i class="bi bi-check-all"></i> Mark all read
                        </a>
                        <a href="?del=all" class="btn btn-danger btn-sm rounded-pill">
                            <i class="bi bi-trash"></i> Delete all
                        </a>
                    </div>

                <div class="table-responsive-md" style="max-height: 400px; overflow-y: auto;">
                  <table class="table table-hover border table-sm">
                     <thead class="sticky-top bg-dark text-light">
                      <tr>
                         <th scope="col" style="width: 5%;">#</th>
                         <th scope="col" style="width: 10%;">Name</th>
                         <th scope="col" style="width: 15%;">Email</th>
                         <th scope="col" style="width: 12%;">Subject</th>
                         <th scope="col" style="width: 20%;">Message</th>
                         <th scope="col" style="width: 10%;">Date</th>
                         <th scope="col" style="width: 18%;">Action</th>
                      </tr>
                     </thead>
                     <tbody>
                        <?php 
                           $q="SELECT * FROM `user_queries` ORDER BY `user_id` DESC";
                           $data=mysqli_query($con,$q);
                           $i=1;
                           if($data && mysqli_num_rows($data) > 0){
                           while($row=mysqli_fetch_assoc($data)){
                                  $actions='';
                              if($row['seen']!=1){
                                     $actions.="<a href='?seen={$row['user_id']}' class='btn btn-sm rounded-pill btn-primary mb-1'>Mark as read</a><br>";
                              }
                                  $actions.="<a href='?del={$row['user_id']}' class='btn btn-sm rounded-pill btn-danger'>Delete</a>";

                                echo "
                                <tr>
                                    <td>$i</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['email']}</td>
                                    <td>" . htmlspecialchars(substr($row['subject'], 0, 25)) . (strlen($row['subject']) > 25 ? '...' : '') . "</td>
                                    <td>" . htmlspecialchars(substr($row['message'], 0, 40)) . (strlen($row['message']) > 40 ? '...' : '') . "</td>
                                    <td>{$row['date']}</td>
                                    <td>$actions</td>
                                </tr>";

                                $i++;
                                }
                           } else {
                               echo "<tr><td colspan='7' class='text-center'>No messages found.</td></tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<?php require('inc/scripts.php'); ?>
</body>
</html>
   