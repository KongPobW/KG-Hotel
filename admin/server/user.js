function registerUser(e) {
    e.preventDefault();

    const pass = document.getElementById('pass-input').value;
    const cpass = document.getElementById('cpass-input').value;

    if (pass !== cpass) {
        alert("Passwords do not match!");
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
                alert("Registration successful!");
                form.reset();
                bootstrap.Modal.getInstance(document.getElementById('registerModal')).hide();
            } else if (data === 'img_upload_failed') {
                alert("Image upload failed! Try again");
            } else if (data === 'invalid_img') {
                alert("Only JPG, PNG, JPEG, WEBP, SVG images allowed");
            } else {
                alert("Registration failed! Try again");
            }
        })
        .catch(err => {
            console.error('Registration error:', err);
        });
}