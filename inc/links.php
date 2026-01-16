<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Merienda&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css"/>

    <?php 
    require_once('admin/inc/db_config.php');
    require_once('admin/inc/essentials.php');

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    date_default_timezone_set("Europe/Podgorica");  


if(isset($_SESSION['login']) && $_SESSION['login'] === true){
    $timeout = 15 * 60; // 15 min në sekonda

    if(isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout){
        // skado sessionin
        session_unset();
        session_destroy();
        // mund të pastrosh dhe cookie nëse do
        setcookie('remember_token', '', time() - 3600, '/');
        header('Location: index.php'); // faqja e login-it / home
        exit;
    }

    $_SESSION['last_activity'] = time();
}
else{
    // nëse nuk është loguar, nuk bëjmë gjë këtu
} 
//$contact_q  = "SELECT * FROM `contact_details` WHERE `sr_no` = ?";
 //$settings_q = "SELECT * FROM 'settings' WHERE 'sr_no' = ?";

//$values = [1];

//$contact_r = mysqli_fetch_assoc(select($contact_q, $values, 'i'));

//$settings_r = mysqli_fetch_assoc(select($settings_q, $values, 'i'));
?>


