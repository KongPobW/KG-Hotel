function registerUser(e) {
    e.preventDefault();

    const name = document.getElementById('name-input').value.trim();
    const email = document.getElementById('email-input').value.trim();
    const phone = document.getElementById('phone-input').value.trim();
    const profile = document.getElementById('profile-input').files[0];
    const address = document.getElementById('address-input').value.trim();
    const pincode = document.getElementById('pincode-input').value.trim();
    const dob = document.getElementById('dob-input').value;
    const pass = document.getElementById('pass-input').value;
    const cpass = document.getElementById('cpass-input').value;

    if (name === '' || email === '' || phone === '' || address === '' || pincode === '' || dob === '' || pass === '' || cpass === '') {
        alert("danger", "All fields are required!", "register");
        return;
    }

    if (pass !== cpass) {
        alert("danger", "Passwords do not match!", "register");
        return;
    }

    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/i;
    const phonePattern = /^[0-9]{10}$/;

    if (!emailPattern.test(email)) {
        alert("danger", "Invalid email format!", "register");
        return;
    }

    if (!profile) {
        alert("danger", "Please upload your picture", "register");
        return;
    }

    if (!phonePattern.test(phone)) {
        alert("danger", "Phone number must be 10 digits!", "register");
        return;
    }

    const form = document.getElementById('register-form');
    const formData = new FormData(form);
    formData.append('register_user', true);

    fetch('admin/api/user.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.text())
        .then(data => {
            if (data === '1') {
                window.location.href = "index.php?register_success=1";
            } else if (data === 'img_upload_failed') {
                alert("danger", "Image upload failed! Try again", "register");
            } else if (data === 'invalid_img') {
                alert("danger", "Only JPG, PNG, JPEG, WEBP, SVG images allowed", "register");
            } else {
                alert("danger", "Registration failed! Try again", "register");
            }
        })
        .catch(err => {
            console.error('Registration error:', err);
        });
}