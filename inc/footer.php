<!--Footer-->  
    <div class="container-fluid bg-white mt-5">
        <div class="row">
            <div class="col-lg-4 p-4">
                <h3 class="h-font fw-bold fs-3 mb-2">LuxStay Hotel</h3>
                <p>Hoteli ynë është krijuar për të përmbushur 
                    nevojat e udhëtarëve modernë, qoftë për pushime,
                     udhëtime biznesi apo qëndrime afatshkurtra. 
                     Me dhoma të dizajnuara me kujdes, shërbim të personalizuar
                      dhe vëmendje ndaj çdo detaji, ne synojmë t’ju bëjmë të 
                      ndiheni si në shtëpinë tuaj – por me një prekje luksi.</p>
            </div>
            <div class="col-lg-4 p-4">
                <h5 class="mb-3">Links</h5>
                <a href="index.php" class="d-inline-block mb-2 text-dark text-decoration-none">Home</a><br>
                <a href="rooms.php" class="d-inline-block mb-2 text-dark text-decoration-none">Rooms</a><br>
                <a href="contact.php" class="d-inline-block mb-2 text-dark text-decoration-none">Contact us</a><br>
                <a href="about.php" class="d-inline-block mb-2 text-dark text-decoration-none">About</a>
            </div>
            <div class="col-lg-4 p-4">
                <h5 class="mb-3">Follow Us!</h5>
                <a href="#" class="d-inline-block text-decoration-none text-dark mb-2"><i class="bi bi-twitter me-1"></i>Twitter</a><br>
                <a href="#" class="d-inline-block text-decoration-none text-dark mb-2"><i class="bi bi-instagram me-1"></i>Instagram</a><br>
                <a href="#" class="d-inline-block text-decoration-none text-dark mb-2"><i class="bi bi-facebook me-1"></i></i>Facebook</a><br>    
            </div>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>

    function alert(type, msg, position = 'body') {
    let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
    let element = document.createElement('div');
    element.innerHTML = 
        `<div class="alert ${bs_class} alert-dismissible fade show" role="alert">
            <strong class="me-3">${msg}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`;

    if(position == 'body') {
        document.body.append(element);
        element.classList.add('custom-alert');
    } else {
        document.getElementById(position).appendChild(element);
    }

    setTimeout(remAlert, 2000);
}

function remAlert() {
    let alerts = document.getElementsByClassName('alert');
    if(alerts.length > 0) {
        alerts[0].remove();
    }
}

    function setActive()
    {
//ka kod qe nuk e di ku eshte por ecimm
    }

    let register_form = document.getElementById('register-form');
    register_form.addEventListener('submit', (e) => {
    e.preventDefault();

    let data = new FormData();

    data.append('name', register_form.elements['name'].value);
    data.append('email', register_form.elements['email'].value);
    data.append('phonenum', register_form.elements['phonenum'].value);
    data.append('address', register_form.elements['address'].value);
    data.append('pincode', register_form.elements['pincode'].value);
    data.append('dob', register_form.elements['dob'].value);
    data.append('pass', register_form.elements['pass'].value);
    data.append('cpass', register_form.elements['cpass'].value);
    data.append('profile', register_form.elements['profile'].files[0]);
    data.append('register', '');

    var myModal = document.getElementById('registerModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();


    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/login_register.php", true);
    
    xhr.onload = function () {
        if(this.responseText == 'pass_mismatch'){
            alert('error',"Password Mismatch");
        } 
        else if(this.responseText =='email_already'){
            alert('error',"Email is already registered!");
        }
        else if(this.responseText =='phone_already'){
            alert('error',"Phone number is already registered!");
        }  
        else if(this.responseText == 'inv_img'){
        alert('error',"Only JPG,WEBP & PNG images are allowed!");
        }
         else if(this.responseText == 'upd_failed'){
        alert('error',"Image upload failed!");
        }
         else if(this.responseText == 'mail_failed'){
        alert('error',"Cannot send confirmation email! Server down!");
        }
         else if(this.responseText == 'ins_failed'){
        alert('error',"Registration failed! Server down!");
        }
        else{
            alert('success',"Registration successful.Confirmation link sent to email");
            register_form.reset();
        }
    }

xhr.send(data);

    });
    setActive();

</script>

