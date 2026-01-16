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

    let wrapper = document.createElement('div');

    // E VENDOSIM NE CEP, LART DJATHTAS
    wrapper.style.position = 'fixed';
    wrapper.style.top = '90px';          // sa poshtë nga maja e faqes
    wrapper.style.right = '20px';        // largësia nga e djathta
    wrapper.style.zIndex = '2000';       // mbi navbar & overlay
    wrapper.style.maxWidth = '400px';

    wrapper.innerHTML = `
        <div class="alert ${bs_class} alert-dismissible fade show" role="alert">
            <strong class="me-3">${msg}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;

    if (position === 'body') {
        document.body.appendChild(wrapper);
    } else {
        document.getElementById(position).appendChild(wrapper);
    }

    setTimeout(() => {
        wrapper.remove();
    }, 2000);
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
    data.append('address', register_form.elements['address'].value);
    data.append('phonenum', register_form.elements['phonenum'].value);
    data.append('dob', register_form.elements['dob'].value);
    data.append('pincode', register_form.elements['pincode'].value);
    data.append('pass', register_form.elements['pass'].value);
    data.append('cpass', register_form.elements['cpass'].value);

    const profileInput = register_form.elements['profile'];
    if (profileInput && profileInput.files.length > 0) {
        data.append('profile', profileInput.files[0]);
    }

    data.append('register', '');

    const myModal = document.getElementById('registerModal');
    const modal = bootstrap.Modal.getInstance(myModal);
    if (modal) modal.hide();

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/login_register.php", true);

    xhr.onload = function () {
        let res = this.responseText.trim();
        console.log('REGISTER RESPONSE:', res);

        if(res === 'pass_mismatch'){
            alert('error',"Passwords do not match!");
        }
        else if(res === 'email_already'){
            alert('error',"Email already registered!");
        }
        else if(res === 'phone_already'){
            alert('error',"Phone number already registered!");
        }
        else if(res === 'inv_img'){
            alert('error',"Invalid profile image!");
        }
        else if(res === 'upd_failed'){
            alert('error',"Image upload failed!");
        }
        else if(res === 'mail_failed'){
            alert('error',"Could not send verification email!");
        }
        else if(res.startsWith('ins_failed')){
            alert('error',"DB insert error: " + res);
        }
        else if(res === '1'){
            alert('success',"Registration successful! A verification code was sent to your email.");

            // hap modalin e verifikimit dhe vendos automatikisht emailin
            let verifyFormEmail = document.querySelector('#verify-form input[name="email"]');
            if(verifyFormEmail){
                verifyFormEmail.value = register_form.elements['email'].value;
            }

            register_form.reset();

            let verifyModal = new bootstrap.Modal(document.getElementById('verifyModal'));
            verifyModal.show();
        }
        else{
            alert('error',"Unexpected response: " + res);
        }
    };

    xhr.send(data);
});


 let login_form = document.getElementById('login-form');

login_form.addEventListener('submit', (e) => {
    e.preventDefault();

    let data = new FormData();
    data.append('email_mob', login_form.elements['email_mob'].value);
    data.append('pass', login_form.elements['pass'].value);
    data.append('login', '');

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/login_register.php", true);

    xhr.onload = function () {
    let res = this.responseText.trim();
    console.log('LOGIN RESPONSE:', res);

    if(res === 'inv_email_mob'){
        alert('error',"Invalid Email or Mobile Number!");
    }
    else if(res === 'not_verified'){
        alert('error',"Email is not verified!");
    }
    else if(res === 'inactive'){
        alert('error',"Account Suspended! Please contact Admin.");
    }
    else if(res === 'invalid_pass'){
        alert('error',"Incorrect Password!");
    }
    else if(res === 'locked'){
        alert('error',"Too many failed attempts. Please try again after 30 minutes.");
    }
    else if(res === 'success'){
        const myModal = document.getElementById('loginModal');
        const modal = bootstrap.Modal.getInstance(myModal);
        if (modal) modal.hide();
        window.location = window.location.pathname;
    }
    else{
        alert('error',"Unexpected response: " + res);
    }
};


    xhr.send(data);
});


  let forgot_form = document.getElementById('forgot-form');

  forgot_form.addEventListener('submit', (e)=>{
    e.preventDefault();

    let data = new FormData();

    data.append('email',forgot_form.elements['email'].value);
    data.append('forgot_pass','');

    var myModal = document.getElementById('forgotModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/login_register.php",true);

    xhr.onload = function(){
            if(this.responseText == 'inv_email'){
                alert('error',"Invalid Email!");
            }
            else if(this.responseText == 'not_verified'){
                alert('error',"Email is not verified! Please contact Admin");
            }
            else if(this.responseText == 'inactive'){
                alert('error',"Account Suspended! Please contact Admin.");
            }
            else if(this.responseText == 'mail_failed'){
                alert('error',"Cannot send email. Server Down!");
            }
            else if(this.responseText == 'upd_failed'){
                alert('error',"Account recovery failed. Server Down!");
            }
            else{
                alert('success',"Reset link sent to email!");
                forgot_form.reset();
            }

    }
    xhr.send(data);  
  });


  let verify_form = document.getElementById('verify-form');

if(verify_form){
    verify_form.addEventListener('submit', (e) => {
        e.preventDefault();

        let data = new FormData();
        data.append('email', verify_form.elements['email'].value);
        data.append('otp', verify_form.elements['otp'].value);
        data.append('verify_otp', '');

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/login_register.php", true);

        xhr.onload = function(){
            let res = this.responseText.trim();
            console.log('VERIFY RESPONSE:', res);

            if(res === 'inv_email'){
                alert('error',"Email not found!");
            }
            else if(res === 'already_verified'){
                alert('success',"This email is already verified. You can log in.");
            }
            else if(res === 'invalid_otp'){
                alert('error',"Invalid verification code!");
            }
            else if(res === 'upd_failed'){
                alert('error',"Could not verify account. Try again later.");
            }
            else if(res === '1'){
                alert('success',"Email verified successfully! You can now log in.");

                // mbyll modalin
                let myModal = document.getElementById('verifyModal');
                let modal = bootstrap.Modal.getInstance(myModal);
                if(modal) modal.hide();

                verify_form.reset();
            }
            else{
                alert('error',"Unexpected response: " + res);
            }
        };

        xhr.send(data);
    });
}


//Inicializojmë dropdown-et manualisht (për siguri)
var dropdownTriggerList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
dropdownTriggerList.forEach(function (dropdownToggleEl) {
    new bootstrap.Dropdown(dropdownToggleEl);
});


   // setActive();

</script>