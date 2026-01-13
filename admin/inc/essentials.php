<?php 

define("ROOMS_IMG_PATH", "images/rooms/");
define("ROOMS_FOLDER", "rooms/");
define("SITE_URL", "http://127.0.0.1/LuxStay/");
define("ABOUT_IMG_PATH", SITE_URL . "images/about/");
define("UPLOAD_IMAGE_PATH", $_SERVER['DOCUMENT_ROOT'] . "/LuxStay/images/"); // rregulluar
define("ABOUT_FOLDER", "about/");

function adminlogin()
{

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


function deleteImage($image, $folder)
{
    // provo ta fshish foton nga serveri
    if(unlink(UPLOAD_IMAGE_PATH.$folder.$image)){
        // nqs u fshi me sukses kthe true
        return true;
    }
    else{
        // nqs deshton, kthe false
        return false;
    }
}

function selectAll($table)
{
    global $con;
    $res = mysqli_query($con, "SELECT * FROM $table");
    return $res;
}

?>
