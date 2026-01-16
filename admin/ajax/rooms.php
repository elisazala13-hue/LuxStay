<?php
require_once('../inc/db_config.php');
require_once('../inc/essentials.php');
adminLogin();

if (isset($_POST['add_room'])) {
    $features = isset($_POST['features']) ? filteration($_POST['features']) : [];
    $facilities = isset($_POST['facilities']) ? filteration($_POST['facilities']) : [];
    
    $frm_data = filteration($_POST);
    $flag = 0;
    $con = $GLOBALS['con'];

    $image_name = '';
    if(isset($_FILES['images']) && $_FILES['images']['error'] == 0) {
        $upload_result = uploadImageRooms($_FILES['images'], ROOMS_FOLDER);
        
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
        $q3 = "INSERT INTO `room_features` (`room_id`, `features_id`) VALUES (?, ?)"; 
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
            $images = explode(',', $row['images']);
            if(!empty($images[0])) {
                $first_image = trim($images[0]);
                $image_path = ROOMS_IMG_PATH . $first_image;
                $image_html = "<img src='$image_path' width='50' height='50' class='rounded-circle me-2' style='object-fit: cover;'>";
            }
        }

        if($row['status'] == 1){
            $status = "<button onclick='toggle_status($row[id],0)' class='btn btn-dark btn-sm shadow-none'>active</button>";
        } else {
            $status = "<button onclick='toggle_status($row[id],1)' class='btn btn-warning btn-sm shadow-none'>inactive</button>";
        }

        $data .= "
            <tr class='align-middle'>
                <td>$i</td>
                <td>
                    $image_html 
                    <strong>$row[name]</strong>
                </td>
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

    // Debug: shiko strukturën e rooms
    if(empty($data)) {
        echo "No rooms found or error. Structure of rooms table:<br>";
        $res_test = mysqli_query($con, "DESCRIBE rooms");
        while($col = mysqli_fetch_assoc($res_test)) {
            echo $col['Field'] . " - " . $col['Type'] . "<br>";
        }
    } else {
        echo $data;
    }
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
    $roomdata = mysqli_fetch_assoc($res1);
    
    $features = [];
    $res2 = mysqli_query($con, "SELECT `features_id` FROM `room_features` WHERE `room_id` = $room_id");
    
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

    $features = [];
    $facilities = [];
    
    if(isset($_POST['features'])) {
        if(is_string($_POST['features'])) {
            $features = json_decode($_POST['features'], true);
            if(json_last_error() !== JSON_ERROR_NONE) {
                $features = [];
            }
        } elseif(is_array($_POST['features'])) {
            $features = $_POST['features'];
        }
    }
    
    if(isset($_POST['facilities'])) {
        if(is_string($_POST['facilities'])) {
            $facilities = json_decode($_POST['facilities'], true);
            if(json_last_error() !== JSON_ERROR_NONE) {
                $facilities = [];
            }
        } elseif(is_array($_POST['facilities'])) {
            $facilities = $_POST['facilities'];
        }
    }
    
    $features = filteration($features);
    $facilities = filteration($facilities);
    $frm_data = filteration($_POST);
    
    $room_id = isset($frm_data['room_id']) ? (int)$frm_data['room_id'] : 0;
    $current_image = $frm_data['current_images'] ?? '';
    $flag = 0;
    
    if($room_id == 0) {
        echo "invalid_room_id";
        exit;
    }

    $new_image = $current_image;
    if(isset($_FILES['images']) && $_FILES['images']['error'] == 0) {
        $upload_result = uploadImageRooms($_FILES['images'], ROOMS_FOLDER);
        
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
                deleteImage($current_image, 'rooms/');
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
        $frm_data['name'] ?? '',
        $frm_data['area'] ?? 0,
        $frm_data['price'] ?? 0,
        $frm_data['quantity'] ?? 1,
        $frm_data['adults'] ?? 1,
        $frm_data['children'] ?? 0,
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
    
    delete(
        "DELETE FROM `room_features` WHERE `room_id` = ?", 
        [$room_id], 
        'i'
    );
    
    delete(
        "DELETE FROM `room_facilities` WHERE `room_id` = ?", 
        [$room_id], 
        'i'
    );
 
    if(!empty($facilities)) {
        mysqli_query($con, "SET FOREIGN_KEY_CHECKS = 0");
        
        foreach($facilities as $f) {
            $f = (int)$f;
            $sql = "INSERT IGNORE INTO room_facilities (room_id, facilities_id) VALUES ($room_id, $f)";
            mysqli_query($con, $sql);
        }
        
        mysqli_query($con, "SET FOREIGN_KEY_CHECKS = 1");
    }
    
    if(!empty($features)) {
        $room_col = 'room_id';
        $result = mysqli_query($con, "SHOW COLUMNS FROM room_features LIKE 'rm_id'");
        if(mysqli_num_rows($result) > 0) {
            $room_col = 'room_id';
        }
        
        foreach($features as $f) {
            $f = (int)$f;
            $sql = "INSERT IGNORE INTO room_features ($room_col, features_id) VALUES ($room_id, $f)";
            mysqli_query($con, $sql);
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
    
    $res1 = delete("DELETE FROM `room_features` WHERE `room_id`=?", [$room_id], 'i');
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







