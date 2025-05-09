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