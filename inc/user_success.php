<?php if (isset($_GET['register_success']) && $_GET['register_success'] == '1'): ?>
<script>
window.addEventListener('DOMContentLoaded', () => {
    alert("success", "Registration successful!");
    history.replaceState(null, '', window.location.pathname);
});
</script>
<?php endif; ?>

<?php if (isset($_GET['reset_success']) && $_GET['reset_success'] == '1'): ?>
<script>
window.addEventListener('DOMContentLoaded', () => {
    alert("success", "Password reset successful!");
    history.replaceState(null, '', window.location.pathname);
});
</script>
<?php endif; ?>

<?php if (isset($_GET['login_success']) && $_GET['login_success'] == '1'): ?>
<script>
window.addEventListener('DOMContentLoaded', () => {
    alert("success", "Login successful!");
    if (!window.location.pathname.includes('room_detail.php')) {
        history.replaceState(null, '', window.location.pathname);
    } else {
        const url = new URL(window.location.href);
        url.searchParams.delete('login_success');
        window.history.replaceState(null, '', url.pathname + '?' + url.searchParams.toString());
    }
});
</script>
<?php endif; ?>