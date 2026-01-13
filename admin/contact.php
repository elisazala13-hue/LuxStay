<?php
   require('inc/essentials.php');
   require('inc/db_config.php');
   adminLogin();

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
         $id = intval($frm_data['seen']);
         // Detect ID column - try common names
         $id_cols = ['id', 'sr_no', 'user_id'];
         $success = false;
         foreach($id_cols as $col) {
             $q="UPDATE `user_queries` SET `seen`=? WHERE `$col`=?";
             $values=[1, $id];
             if(update($q,$values,'ii')){
                alert('success','Marked as read');
                $success = true;
                break;
             }
         }
         if(!$success){
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
        $id = intval($frm_data['del']);
        // Use the same ID column detected from SELECT query
        // Default to 'id' if not detected yet
        $id_col = 'id';
        $test_q = "SELECT * FROM `user_queries` LIMIT 1";
        $test_res = mysqli_query($con, $test_q);
        if($test_res && $row = mysqli_fetch_assoc($test_res)){
            if(isset($row['sr_no'])) $id_col = 'sr_no';
            elseif(isset($row['user_id'])) $id_col = 'user_id';
            elseif(isset($row['id'])) $id_col = 'id';
        }
        $q = "DELETE FROM `user_queries` WHERE `$id_col`=?";
        $values = [$id];
        if(delete($q, $values, 'i')){
            alert('success', 'Data deleted');
        } else {
            alert('error', 'Failed to delete');
        }
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
         <div class="col-lg-10-ms-auto p-4 overflow-hidden">
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

                <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                  <table class="table table-hover border table-sm">
                     <thead class="sticky-top bg-dark text-light">
                      <tr>
                         <th scope="col" style="width: 5%;">#</th>
                         <th scope="col" style="width: 12%;">Name</th>
                         <th scope="col" style="width: 15%;">Email</th>
                         <th scope="col" style="width: 15%;">Subject</th>
                         <th scope="col" style="width: 25%;">Message</th>
                         <th scope="col" style="width: 12%;">Date</th>
                         <th scope="col" style="width: 16%;">Action</th>
                      </tr>
                     </thead>
                     <tbody>
                        <?php 
                           $q="SELECT * FROM `user_queries` ORDER BY `id` DESC";
                           $data=mysqli_query($con,$q);
                           $i=1;
                           // Detect ID column name from first row
                           $id_column = 'id';
                           if($data && mysqli_num_rows($data) > 0){
                               $temp_row = mysqli_fetch_assoc($data);
                               if(isset($temp_row['sr_no'])) $id_column = 'sr_no';
                               elseif(isset($temp_row['user_id'])) $id_column = 'user_id';
                               elseif(isset($temp_row['id'])) $id_column = 'id';
                               mysqli_data_seek($data, 0); // Reset to beginning
                               
                           while($row=mysqli_fetch_assoc($data)){
                                  $id = $row[$id_column] ?? 0;
                                  $actions='';
                              if(($row['seen'] ?? 0) != 1){
                                     $actions.="<a href='?seen=$id' class='btn btn-sm rounded-pill btn-primary mb-1'>Mark as read</a><br>";
                              }
                                  $actions.="<a href='?del=$id' class='btn btn-sm rounded-pill btn-danger'>Delete</a>";

                                echo "
                                <tr>
                                    <td>$i</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['email']}</td>
                                    <td>" . htmlspecialchars(substr($row['subject'], 0, 30)) . (strlen($row['subject']) > 30 ? '...' : '') . "</td>
                                    <td>" . htmlspecialchars(substr($row['message'], 0, 50)) . (strlen($row['message']) > 50 ? '...' : '') . "</td>
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
   