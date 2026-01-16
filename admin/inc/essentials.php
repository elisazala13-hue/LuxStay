<?php 
define("ROOMS_FOLDER", "rooms/");
define("ROOMS_IMG_PATH", "/LuxStay/images/rooms/");
define("SITE_URL", "http://127.0.0.1/LuxStay/");
define("ABOUT_IMG_PATH", SITE_URL . "images/about/");
define("UPLOAD_IMAGE_PATH", $_SERVER['DOCUMENT_ROOT'] . "/LuxStay/images/");
define("ABOUT_FOLDER", "about/");
define("USERS_FOLDER","users/");

define('USERS_IMG_PATH', '../../images/users/');


define('SENDGRID_API_KEY',"");


function adminlogin()
{
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    if (!(isset($_SESSION['adminlogin']) && $_SESSION['adminlogin'] === true)) {
        echo "<script>window.location.href='index.php';</script>";
        exit;
    }
}
function redirect($url){
    echo "<script>
    window.location.href='$url';
    </script>";
    exit;
}
function alert($type,$msg){
    $bs_class = ($type == 'success') ? "alert-success" : "alert-danger";

    echo <<<alert
    <div class="alert $bs_class alert-dismissible fade show custom-alert" role="alert">
    <strong class="me-3">$msg</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
alert;

}
function uploadImage($image,$folder)
{
    $valid_mime = ['image/jpeg','image/png','image/webp'];
    $img_mime = $image['type'];

    if (!in_array($img_mime, $valid_mime)) {
        return 'inv_img';
    } elseif (($image['size'] / (1024 * 1024)) > 2) {
        return 'inv_size';
    } else {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $rname = 'IMG_' . random_int(11111, 99999) . "." . $ext;
        $img_path = UPLOAD_IMAGE_PATH . $folder . $rname;

        if (move_uploaded_file($image['tmp_name'], $img_path)) {
            return $rname;
        } else {
            return 'upd_failed';
        }
    }
}
function uploadUserImage($image)
{
    $valid_mime = ['image/jpeg', 'image/png', 'image/webp'];
    $img_mime = $image['type'];

    if (!in_array($img_mime, $valid_mime)) {
        return 'inv_img';
    }

    $ext = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
    $rname = 'IMG_' . random_int(11111, 99999) . '.' . $ext; // keep original extension
    $img_path = UPLOAD_IMAGE_PATH . USERS_FOLDER . $rname;

    // Make sure GD functions exist
    if (!function_exists('imagecreatefromjpeg')) return 'gd_missing';

    // Load image based on type
    switch ($ext) {
        case 'png':
            if (!function_exists('imagecreatefrompng')) return 'gd_missing';
            $img = imagecreatefrompng($image['tmp_name']);
            break;
        case 'webp':
            if (!function_exists('imagecreatefromwebp')) return 'gd_missing';
            $img = imagecreatefromwebp($image['tmp_name']);
            break;
        case 'jpg':
        case 'jpeg':
            $img = imagecreatefromjpeg($image['tmp_name']);
            break;
        default:
            return 'inv_img';
    }

    if (!$img) return 'upd_failed';

    // Save as JPEG to reduce size, quality 75
    $save_result = imagejpeg($img, $img_path, 75);
    imagedestroy($img); // free memory

    return $save_result ? $rname : 'upd_failed';
}


function deleteImage($image, $folder)
{
    if(unlink(UPLOAD_IMAGE_PATH.$folder.$image)){
        return true;
    }
    else{
        return false;
    }
}

function selectAll($table)
{
    global $con;
    $res = mysqli_query($con, "SELECT * FROM $table");
    return $res;
}

function uploadImageRooms($image, $folder)
{
    $valid_mime = ['image/jpeg','image/png','image/webp'];
    $img_mime = $image['type'];

    if (!in_array($img_mime, $valid_mime)) {
        return 'inv_img';
    } elseif (($image['size'] / (1024 * 1024)) > 2) {
        return 'inv_size';
    } else {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $rname = 'IMG_' . random_int(11111, 99999) . "." . $ext;

        $img_path = UPLOAD_IMAGE_PATH . $folder . $rname;

        if (move_uploaded_file($image['tmp_name'], $img_path)) {
            return $rname; 
        } else {
            return 'upd_failed';
        }
    }
}





?>
