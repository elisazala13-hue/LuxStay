<?php 

define("ROOMS_IMG_PATH", "images/rooms/");
define("ROOMS_FOLDER", "rooms/");
define("SITE_URL", "http://127.0.0.1/LuxStay/");
define("ABOUT_IMG_PATH", SITE_URL . "images/about/");
define("UPLOAD_IMAGE_PATH", $_SERVER['DOCUMENT_ROOT'] . "/LuxStay/images/"); // rregulluar
define("ABOUT_FOLDER", "about/");


function adminlogin()
{
    session_start();
    if (!(isset($_SESSION['adminlogin']) && $_SESSION['adminlogin'] === true)) {
        echo "<script>window.location.href='index.php';</script>";
        exit;
    }
    session_regenerate_id(true);
}


function redirect($url)
{
    echo "<script>window.location.href='$url';</script>";
    exit;
}


function alert($type, $msg, $timeout = 1000)
{
    // Zgjidh klasin bootstrap sipas tipit
    $bs_class = ($type === "success") ? "alert-success" : "alert-danger";

    // Shfaq alert-in
    echo <<<alert
<div class="alert $bs_class fade show custom-alert" role="alert">
    <strong class="me-3">$msg</strong>
</div>

<script>
// Pasi faqja të ngarkohet
setTimeout(() => {
    const el = document.querySelector('.custom-alert');
    if(el) {
        // heq 'show' për animacion fade-out
        el.classList.remove('show');
        // largon alert nga DOM pas 500ms për t'i dhënë kohë animacionit
        setTimeout(() => el.remove(), 500);
    }
}, $timeout);
</script>
alert;
}




function uploadImage($image, $folder)
{
    $valid_mime = ['image/jpeg', 'image/png', 'image/webp'];
    $img_mime = $image['type'];

    if (!in_array($img_mime, $valid_mime)) {
        return 'inv_img';
    } elseif (($image['size'] / (1024 * 1024)) > 2) {
        return 'inv_size';
    } else {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $rname = 'IMG_' . random_int(11111, 99999) . ".$ext";
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
    $path = UPLOAD_IMAGE_PATH . $folder . $image;
    if (file_exists($path)) {
        return unlink($path);
    }
    return false;
}


function selectAll($table)
{
    global $con;
    $res = mysqli_query($con, "SELECT * FROM $table");
    return $res;
}

function insert($query, $values, $types) {
    global $con; 

    $stmt = mysqli_prepare($con, $query);
    if(!$stmt){
        die("Prepared statement failed: " . mysqli_error($con));
    }

    if(!empty($values)){
        mysqli_stmt_bind_param($stmt, $types, ...$values);
    }

    $res = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return $res; 
}

function update($query, $values = [], $types = "") {
    global $con; // përdor lidhjen globale me DB

    $stmt = mysqli_prepare($con, $query);
    if(!$stmt){
        die("Prepared statement failed: " . mysqli_error($con));
    }

    if(!empty($values)){
        mysqli_stmt_bind_param($stmt, $types, ...$values);
    }

    $res = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return $res; // true nëse punoi, false nëse dështoi
}



?>
