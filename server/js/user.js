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

    if (newpass !== cfpass) {
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

function loginUser(e) {
    e.preventDefault();

    const email = document.querySelector('#loginModal input[type="email"]').value.trim();
    const password = document.querySelector('#loginModal input[type="password"]').value;

    if (email === '' || password === '') {
        alert("danger", "Email and Password are required!", "#loginModal");
        return;
    }

    const formData = new FormData();
    formData.append('email', email);
    formData.append('password', password);
    formData.append('login_user', true);

    fetch('server/api/user.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.text())
        .then(data => {
            if (data === '1') {
                window.location.href = "index.php?login_success=1";
            } else if (data === 'invalid_email') {
                alert("danger", "Email not found!", "#loginModal");
            } else if (data === 'invalid_password') {
                alert("danger", "Incorrect password!", "#loginModal");
            } else if (data === 'inactive_user') {
                alert("danger", "Account has been blocked!", "#loginModal");
            } else {
                alert("danger", "Login failed! Try again.", "#loginModal");
            }
        })
        .catch(err => {
            console.error('Login error:', err);
        });
}

function fetchUsers() {
    const formData = new FormData();
    formData.append('get_users', true);

    fetch('../server/api/user.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.text())
        .then(text => {
            const data = JSON.parse(text);
            return data;
        })
        .then(data => {
            const tbody = document.querySelector('.tbody-user');
            tbody.innerHTML = "";

            data.forEach((user, index) => {
                const row = `
                <tr>
                    <th scope="row">${index + 1}</th>
                    <td style="display:none;" class="user-id">${user.sr_no}</td>
                    <td>
                        <img src="../uploads/profiles/${user.profile}" 
                             class="img-fluid rounded" 
                             style="width: 60px; height: 60px; object-fit: cover;">
                    </td>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td>${user.address}</td>
                    <td>${user.pnumber}</td>
                    <td>${user.dob}</td>
                    <td>
                        ${user.status == 1
                            ? `<button class="btn btn-sm btn-success toggle-status-btn">Active</button>`
                            : `<button class="btn btn-sm btn-secondary toggle-status-btn">Inactive</button>`
                        }
                    </td>
                </tr>
                `;
                tbody.insertAdjacentHTML('beforeend', row);
            });
        })
        .catch(err => {
            console.error('Failed to fetch users:', err);
        });
}

document.addEventListener('DOMContentLoaded', fetchUsers);

function toggleUserStatus(e) {
    if (!e.target.classList.contains('toggle-status-btn')) return;

    const btn = e.target;
    const tr = btn.closest('tr');
    if (!tr) return;

    const userIdCell = tr.querySelector('.user-id');
    if (!userIdCell) return;

    const userId = userIdCell.textContent.trim();

    const currentStatus = btn.textContent.trim() === 'Active' ? 1 : 0;
    const newStatus = currentStatus === 1 ? 0 : 1;

    const formData = new FormData();
    formData.append('update_status', true);
    formData.append('user_id', userId);
    formData.append('status', newStatus);

    fetch('../server/api/user.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.text())
        .then(data => {
            if (data === '1') {
                if (newStatus === 1) {
                    btn.classList.remove('btn-secondary');
                    btn.classList.add('btn-success');
                    btn.textContent = 'Active';
                } else {
                    btn.classList.remove('btn-success');
                    btn.classList.add('btn-secondary');
                    btn.textContent = 'Inactive';
                }
                alert('success', 'Updated status successfully!');
            } else {
                alert('danger', 'Failed to update status! Try again');
            }
        })
        .catch(err => {
            console.error('Status update error:', err);
        });
}

document.addEventListener('click', toggleUserStatus);