<div class="modal fade my-3" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form onsubmit="loginUser(event)">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-circle me-2"></i>
                        User
                        Login
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"
                        data-reload="true"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control shadow-none">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control shadow-none">
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <button type="submit" class="btn btn-dark shadow-none">LOGIN</button>
                        <a href="#" class="text-secondary text-decoration-none" data-bs-toggle="modal"
                            data-bs-target="#forgotPasswordModal" data-bs-dismiss="modal">
                            Forgot Password?
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade my-3" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="registerModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="register-form">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-lines-fill me-2"></i>
                        User
                        Registration
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span class="badge rounded-pill text-bg-light mb-3 text-wrap lh-base">
                        Note: Your details must
                        match with your ID (
                        ID card, passport, driving license, etc) that will be required during check-in.
                    </span>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" id="name-input-register" class="form-control shadow-none"
                                    required>
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" id="email-input-register"
                                    class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="text" name="pnumber" id="phone-input-register"
                                    class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label class="form-label">Picture</label>
                                <input type="file" name="profile" id="profile-input-register"
                                    class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-12 p-0 mb-3">
                                <label class="form-label">Address</label>
                                <textarea name="address" id="address-input-register" class="form-control shadow-none"
                                    rows="1" required></textarea>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Pin Code</label>
                                <input type="text" name="pincode" id="pincode-input-register"
                                    class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" name="dob" id="dob-input-register" class="form-control shadow-none"
                                    required>
                            </div>
                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" id="pass-input-register"
                                    class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" id="cpass-input-register" class="form-control shadow-none"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="text-center my-1">
                        <button type="button" class="btn btn-dark shadow-none"
                            onclick="registerUser(event)">REGISTER</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade my-3" id="forgotPasswordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="forgotPasswordForm">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-envelope-fill me-2"></i>
                        Reset Password
                    </h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" id="email-input-reset" class="form-control shadow-none"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">PIN Code</label>
                        <input type="text" name="pinCode" id="pin-code-input-reset" class="form-control shadow-none"
                            maxlength="6" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" name="newPassword" id="new-pass-input-reset"
                            class="form-control shadow-none" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="confirmPassword" id="cf-pass-input-reset"
                            class="form-control shadow-none" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-secondary shadow-none"
                            onclick="goBackToLogin()">Back</button>
                        <button type="button" class="btn btn-dark shadow-none" onclick="resetPassword(event)">Reset
                            Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="promptpayModal" aria-labelledby="promptpayModalLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="promptpayModalLabel">Scan QR to Pay</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="payment-proof-form">
                <div class="modal-body">
                    <img id="promptpay-qr" src="" style="width:250px;" alt="PromptPay QR Code">
                    <div class="mt-3">
                        <label for="slip-upload" class="form-label small">Upload Payment Slip</label>
                        <input class="form-control" type="file" id="slip-upload" name="slip" accept="image/*" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary w-100" onclick="saveBooking()">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
function goBackToLogin() {
    const forgotModal = bootstrap.Modal.getInstance(document.getElementById('forgotPasswordModal'));
    forgotModal.hide();

    document.getElementById('forgotPasswordModal').addEventListener('hidden.bs.modal', function() {
        const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
        loginModal.show();
    }, {
        once: true
    });
}
</script>
<script>
document.querySelectorAll('.btn-close[data-reload="true"]').forEach(button => {
    button.addEventListener('click', () => {
        const parentModal = button.closest('.modal');
        parentModal.addEventListener('hidden.bs.modal', function() {
            location.reload();
        }, {
            once: true
        });
    });
});
</script>