function registerUser(e) {
    e.preventDefault();

    const pass = document.getElementById('pass-input').value;
    const cpass = document.getElementById('cpass-input').value;

    if (pass !== cpass) {
        alert("danger", "Passwords do not match!", "register");
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