<?php
require __DIR__ . '/admin/inc/db_config.php';
require __DIR__ . '/admin/inc/essentials.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LuxStay Hotel - CONTACT</title>
    <link rel="stylesheet" href="css/common.css">

<!--SHIKONI SI E KENI LINK E DIR-->
    <?php require __DIR__ . '/inc/links.php'; ?>

  
</head>
<body class="bg-Light">

<?php require __DIR__ . '/inc/header.php'; ?>

<div class="my-5 px-4 text-center">
    <h2 class="fw-bold h-font text-center">CONTACT US</h2>
    <div class="h-line bg-dark mx-auto"></div>
</div>

<div class="container">
  <div class="row">

    <div class="col-lg-6 col-md-6 mb-5 px-4">
      <div class="bg-white rounded shadow p-4 ">
        <iframe class="w-100 rounded mb-4" height="320px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d383570.64090558223!2d19.91638170000001!3d41.31657210000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x135030c34ce830bf%3A0x77cd46003dc6a25c!2sTirana%2C%20Albania!5e0!3m2!1sen!2s!4v1767898663961!5m2!1sen!2s" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
        
          <h5>Adress</h5>
        <a href ="https://maps.app.goo.gl/nMHvYSLn5pADkxfa7" target="_blank" class="d-inline-block text-decoration-none text dark mb-2">
           <i class="bi bi-geo-alt"></i> XYZ,BLLOK,TIRANE
        </a>
        <h5 class="mt-4">Call Us!</h5>
        <a href="tel: +355699817747" class="d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-telephone-fill"></i>+355699817747
        </a> 
        <br>  
        <a href="tel: +355699817747" class="d-inline-block  text-decoration-none text-dark">
            <i class="bi bi-telephone-fill"></i>+355699817747
        </a> 


        <h5 class ="mt-4">Email</h5>
        <a href ="mailto: ask.luxstay@gmail.com" class="d-inline-block  text-decoration-none text-dark">
          <i class="bi bi-envelope-fill"></i>ask.luxstay@gmail.com
        </a>


        <h5 class="mt-4">Follow Us!</h5>
        <a href="#" class="d-inline-block  text-dark fs-6 m-2">
          <i class="bi bi-twitter me-1"></i>
        </a>
        <a href="#" class="d-inline-block text-dark fs-6 m-2">
          <i class="bi bi-instagram me-1"></i></i>
        </a>
        <a href="#" class="d-inline-block  text-dark fs-6 ">
          <i class="bi bi-facebook me-1"></i></i>
        </a>

        
      </div>
    </div>

    <div class="col-lg-6 col-md-6 mb-5 px-4">
      <div class="bg-white rounded shadow p-4 ">
        <form method="POST">
          <h5>Send a message</h5>
           <div class="mt-3">
             <label class="form-label" style ="font-weight:500">Name</label>
             <input name ="name" required  type="text" class="form-control shadow-none">
           </div>
           <div class="mt-3">
             <label class="form-label" style ="font-weight:500">Email</label>
             <input name ="email" required type="email" class="form-control shadow-none">
           </div>
           <div class="mt-3">
             <label class="form-label" style ="font-weight:500">Subject</label>
             <input name ="subject" required type="text" class="form-control shadow-none">
           </div>
           <div class="mt-3">
             <label class="form-label" style ="font-weight:500">Message</label>
             <textarea name ="message" required  class="form-control shadow-none" rows="5" style="resize: none;"></textarea>
           </div>
           <button type="submit" name="send" class="btn text-white custom-bg mt-3 ">SEND</button>

           

        </form>

      </div>
    </div>

  

  </div>
</div>
<?php
   if(isset($_POST['send'])) {
     $frm_data=filteration($_POST);
     $q="INSERT INTO `user_queries`( `name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
     $values=[$frm_data['name'], $frm_data['email'], $frm_data['subject'], $frm_data['message']];
     $res=insert($q,$values,'ssss');
     
     if($res==1){
        alert('success', 'Mail sent!');
     }
     else{
        // Check for database errors
        if(isset($GLOBALS['con'])) {
            $error = mysqli_error($GLOBALS['con']);
            if($error) {
                alert('error', 'Error: ' . $error);
            } else {
                alert('error','Server Down! Try again later.');
            }
        } else {
            alert('error','Database connection failed!');
        }
     }
    }




?>

<?php require __DIR__ . '/inc/footer.php'; ?>

</body>
</html>