function registerUser(e) {
    e.preventDefault();

    const name = document.getElementById('name-input-register').value.trim();
    const email = document.getElementById('email-input-register').value.trim();
    const phone = document.getElementById('phone-input-register').value.trim();
    const profile = document.getElementById('profile-input-register').files[0];
    const address = document.getElementById('address-input-register').value.trim();
    const pincode = document.getElementById('pincode-input-register').value.trim();
    const dob = document.getElementById('dob-input-register').value;
    const pass = document.getElementById('pass-input-register').value;
    const cpass = document.getElementById('cpass-input-register').value;

    if (name === '' || email === '' || phone === '' || address === '' || pincode === '' || dob === '' || pass === '' || cpass === '') {
        alert("danger", "All fields are required!", "#registerModal");
        return;
    }

    if (pass !== cpass) {
        alert("danger", "Passwords do not match!", "#registerModal");
        return;
    }

    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/i;
    const phonePattern = /^[0-9]{10}$/;

    if (!emailPattern.test(email)) {
        alert("danger", "Invalid email format!", "#registerModal");
        return;
    }

    if (!profile) {
        alert("danger", "Please upload your picture", "#registerModal");
        return;
    }

    if (!phonePattern.test(phone)) {
        alert("danger", "Phone number must be 10 digits!", "#registerModal");
        return;
    }

    const form = document.getElementById('register-form');
    const formData = new FormData(form);
    formData.append('register_user', true);

    fetch('server/api/user.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.text())
        .then(data => {
            if (data === '1') {
                window.location.href = "index.php?register_success=1";
            } else if (data === 'img_upload_failed') {
                alert("danger", "Image upload failed! Try again", "#registerModal");
            } else if (data === 'invalid_img') {
                alert("danger", "Only JPG, PNG, JPEG, WEBP, SVG images allowed", "#registerModal");
            } else {
                alert("danger", "Registration failed! Try again", "#registerModal");
            }
        })
        .catch(err => {
            console.error('Registration error:', err);
        });
}

function resetPassword(e) {
    e.preventDefault();

    const email = document.getElementById('email-input-reset').value.trim();
    const pinCode = document.getElementById('pin-code-input-reset').value.trim();
    const newpass = document.getElementById('new-pass-input-reset').value;
    const cfpass = document.getElementById('cf-pass-input-reset').value;

    if (email === '' || pinCode === '' || newpass === '' || cfpass === '') {
        alert("danger", "All fields are required!", "#forgotPasswordModal");
        return;
    }

    if (newpass !== confirmPassword) {
        alert("danger", "Passwords do not match!", "#forgotPasswordModal");
        return;
    }

    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/i;
    if (!emailPattern.test(email)) {
        alert("danger", "Invalid email format!", "#forgotPasswordModal");
        return;
    }

    const formData = new FormData();
    formData.append('email', email);
    formData.append('pinCode', pinCode);
    formData.append('newPassword', newpass);
    formData.append('reset_password', true);

    fetch('server/api/user.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.text())
        .then(data => {
            if (data === '1') {
                window.location.href = "index.php?reset_success=1";
            } else if (data === 'invalid_email') {
                alert("danger", "Email not found!", "#forgotPasswordModal");
            } else if (data === 'invalid_pin') {
                alert("danger", "Incorrect PIN code!", "#forgotPasswordModal");
            } else {
                alert("danger", "Password reset failed! Try again", "#forgotPasswordModal");
            }
        })
        .catch(err => {
            console.error('Resetting password error:', err);
        });
}