<?php
require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();

if (isset($_POST['add_room'])) {
    $features = isset($_POST['features']) ? filteration($_POST['features']) : [];
    $facilities = isset($_POST['facilities']) ? filteration($_POST['facilities']) : [];
    
    $frm_data = filteration($_POST);
    $flag = 0;
    $con = $GLOBALS['con'];

    $image_name = '';
    if(isset($_FILES['images']) && $_FILES['images']['error'] == 0) {
        $upload_result = uploadImage($_FILES['images'], ROOMS_FOLDER);
        
        if($upload_result == 'inv_img') {
            echo 'inv_img';
            exit;
        } elseif($upload_result == 'inv_size') {
            echo 'inv_size';
            exit;
        } elseif($upload_result == 'upd_failed') {
            echo 'upd_failed';
            exit;
        } else {
            $image_name = $upload_result;
        }
    } else {
        echo 'no_image';
        exit;
    }

    $q1 = "INSERT INTO `rooms` (`name`, `area`, `price`, `quantity`, `adults`, `children`, `images`) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $values = [
        $frm_data['name'],
        $frm_data['area'],
        $frm_data['price'],
        $frm_data['quantity'],
        $frm_data['adults'],
        $frm_data['children'],
        $image_name  
    ];

    if(insert($q1, $values, 'siiiiis')) { // Ndrysho në 'siiiiis' (shto një 's' për string image)
        $flag = 1;
    } else {
        echo "insert_failed:room";
        exit;
    }

    $room_id = mysqli_insert_id($con);

    if(!empty($facilities)) {
        $q2 = "INSERT INTO `room_facilities`(`room_id`, `facilities_id`) VALUES (?, ?)";
        if($stmt = mysqli_prepare($con, $q2)) {
            foreach($facilities as $f) {
                $f = (int)$f;
                mysqli_stmt_bind_param($stmt, 'ii', $room_id, $f);
                mysqli_stmt_execute($stmt);
            }
            mysqli_stmt_close($stmt);
        } else {
            $flag = 0;
            echo "facilities_prepare_failed";
            exit;
        }
    }

    if(!empty($features)) {
        $q3 = "INSERT INTO `room_features` (`rm_id`, `features_id`) VALUES (?, ?)"; 
        if($stmt = mysqli_prepare($con, $q3)) {
            foreach($features as $f) {
                $f = (int)$f; 
                mysqli_stmt_bind_param($stmt, 'ii', $room_id, $f);
                mysqli_stmt_execute($stmt);
            }
            mysqli_stmt_close($stmt);
        } else {
            $flag = 0;
            echo "features_prepare_failed";
            exit;
        }
    }

    if($flag) {
        echo 1; 
    } else {
        echo 0;
    }
    exit;
}

if (isset($_POST['get_all_rooms'])) {
    $con = $GLOBALS['con'];
    $res = selectAll('rooms');    
    $data = "";
    $i = 1;

    while($row = mysqli_fetch_assoc($res)) {
        $room_id = $row['id'];
        
        $image_html = '';
        if(!empty($row['images'])) {
            $image_path = ROOMS_IMG_PATH . $row['images'];
            $image_html = "<img src='$image_path' width='50' height='50' class='rounded-circle me-2'>";
        }

        if($row['status'] == 1){
            $status = "<button onclick='toggle_status($row[id],0)' class='btn btn-dark btn-sm shadow-none'>active</button>";
        } else {
            $status = "<button onclick='toggle_status($row[id],1)' class='btn btn-warning btn-sm shadow-none'>inactive</button>";
        }

        $data .= "
            <tr class='align-middle'>
                <td>$i</td>
                <td>$image_html $row[name]</td>
                <td>$row[area] m<sup>2</sup></td>
                <td>
                    <span class='badge rounded-pill bg-light text-dark'>
                        Adults: $row[adults]
                    </span><br>
                    <span class='badge rounded-pill bg-light text-dark'>
                        Children: $row[children]
                    </span>
                </td>
                <td>$row[price]&#8364;</td>
                <td>$row[quantity]</td>
                <td>$status</td>
                <td>
                    <button onclick='edit_room($row[id])' type='button' class='btn btn-primary shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#edit-room'>
                        <i class='bi bi-pencil-square'></i>
                    </button>
                    <button onclick='rem_room($row[id])' type='button' class='btn btn-danger shadow-none btn-sm'>
                        <i class='bi bi-trash'></i>
                    </button>
                </td>
            </tr>
        ";

        $i++;
    }

    echo $data;
    exit;
}

if (isset($_POST['toggle_status'])) {
    $frm_data = filteration($_POST);

    $q = "UPDATE `rooms` SET `status`=? WHERE `id`=?";
    $v = [$frm_data['value'], $frm_data['toggle_status']];

    if (update($q, $v, 'ii')) {
        echo 1;
    } else {
        echo 0;
    }
    exit;
}

if (isset($_POST['get_room'])) {
    $con = $GLOBALS['con'];
    $room_id = (int)$_POST['get_room'];
    
    $res1 = mysqli_query($con, "SELECT * FROM `rooms` WHERE `id` = $room_id");
    
    if(!$res1) {
        echo json_encode(["error" => "Failed to fetch room data: " . mysqli_error($con)]);
        exit;
    }
    
    if(mysqli_num_rows($res1) == 0) {
        echo json_encode(["error" => "Room not found"]);
        exit;
    }
    
    $roomdata = mysqli_fetch_assoc($res1);
    
    $features = [];
    $res2 = mysqli_query($con, "SELECT `features_id` FROM `room_features` WHERE `rm_id` = $room_id");
    
    if($res2) {
        while ($row = mysqli_fetch_assoc($res2)) {
            $features[] = (int)$row['features_id'];
        }
    }
    
    $facilities = [];
    $res3 = mysqli_query($con, "SELECT `facilities_id` FROM `room_facilities` WHERE `room_id` = $room_id");
    
    if($res3) {
        while ($row = mysqli_fetch_assoc($res3)) {
            $facilities[] = (int)$row['facilities_id'];
        }
    }
    
    $data = [
        "success" => true,
        "roomdata" => $roomdata, 
        "features" => $features, 
        "facilities" => $facilities
    ];
    
    echo json_encode($data);
    exit;
}

if(isset($_POST['edit_room'])) {
    $con = $GLOBALS['con'];
    
    $features = isset($_POST['features']) ? (array)$_POST['features'] : [];
    $facilities = isset($_POST['facilities']) ? (array)$_POST['facilities'] : [];
    
    $features = filteration($features);
    $facilities = filteration($facilities);
    $frm_data = filteration($_POST);
    
    if(empty($frm_data['room_id'])) {
        echo "missing_room_id";
        exit;
    }
    
    $room_id = $frm_data['room_id'];
    $current_image = $frm_data['current_images'] ?? '';
    $flag = 0;
    
    $new_image = $current_image;
    if(isset($_FILES['images']) && $_FILES['images']['error'] == 0) {
        $upload_result = uploadImage($_FILES['images'], ROOMS_FOLDER);
        
        if($upload_result == 'inv_img') {
            echo 'inv_img';
            exit;
        } elseif($upload_result == 'inv_size') {
            echo 'inv_size';
            exit;
        } elseif($upload_result == 'upd_failed') {
            echo 'upd_failed';
            exit;
        } else {
            if(!empty($current_image)) {
                deleteImage($current_image, ROOMS_FOLDER);
            }
            $new_image = $upload_result;
        }
    }
 
    $q1 = "UPDATE `rooms` 
           SET `name` = ?, 
               `area` = ?, 
               `price` = ?, 
               `quantity` = ?, 
               `adults` = ?, 
               `children` = ?,
               `images` = ?
           WHERE `id` = ?";
    
    $values1 = [
        $frm_data['name'], 
        $frm_data['area'], 
        $frm_data['price'], 
        $frm_data['quantity'], 
        $frm_data['adults'], 
        $frm_data['children'],
        $new_image, 
        $room_id
    ];
    
    $update_result = update($q1, $values1, 'siiiiisi'); 
    
    if($update_result !== false && $update_result >= 0) {
        $flag = 1;
    } else {
        echo "update_failed:room_details";
        exit;
    }

    $del_features = delete(
        "DELETE FROM `room_features` WHERE `rm_id` = ?", 
        [$room_id], 
        'i'
    );
    
    $del_facilities = delete(
        "DELETE FROM `room_facilities` WHERE `room_id` = ?", 
        [$room_id], 
        'i'
    );

    if(!empty($facilities)) {
        foreach($facilities as $f) {
            $f = (int)$f;
            $q2 = "INSERT INTO `room_facilities`(`room_id`, `facilities_id`) VALUES (?, ?)";
            
            $insert_facility = insert($q2, [$room_id, $f], 'ii');
            
            if(!$insert_facility) {
                $flag = 0;
                echo "insert_failed:facilities";
                exit;
            }
        }
    }

    if(!empty($features)) {
        foreach($features as $f) {
            $f = (int)$f;
            $q3 = "INSERT INTO `room_features`(`rm_id`, `features_id`) VALUES (?, ?)"; 
            
            $insert_feature = insert($q3, [$room_id, $f], 'ii');
            
            if(!$insert_feature) {
                $flag = 0;
                echo "insert_failed:features";
                exit;
            }
        }
    }

    if($flag) {
        echo 1;
    } else {
        echo 0;
    }
    exit;
}

if(isset($_POST['rem_room'])) {
    
    $frm_data = filteration($_POST);
    $room_id = $frm_data['rem_room'];
    $con = $GLOBALS['con'];
    
    $room_res = select("SELECT `images` FROM `rooms` WHERE `id`=?", [$room_id], 'i');
    if($room_res && mysqli_num_rows($room_res) > 0) {
        $room_data = mysqli_fetch_assoc($room_res);
        if(!empty($room_data['images'])) {
            deleteImage($room_data['images'], ROOMS_FOLDER);
        }
    }
    
    $res1 = delete("DELETE FROM `room_features` WHERE `rm_id`=?", [$room_id], 'i');
    $res2 = delete("DELETE FROM `room_facilities` WHERE `room_id`=?", [$room_id], 'i');
    $res3 = delete("DELETE FROM `rooms` WHERE `id`=?", [$room_id], 'i'); // DELETE direkt, jo UPDATE
    
    if($res3) { 
        echo 1;
    } else {
        echo 0;
    }
    exit;
}


?>







