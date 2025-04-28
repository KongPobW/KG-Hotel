<?php
function alert($type, $msg) {
    echo "
    <div class='alert alert-$type alert-dismissible fade show custom-alert' role='alert'>
        <strong>$msg</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>
    <script>
    setTimeout(function() {
        var alert = document.querySelector('.custom-alert');
        if(alert) {
            alert.classList.remove('show');
            alert.classList.add('hide');
            setTimeout(function() {
                alert.remove();
            }, 500);
        }
    }, 3000);
    </script>
    ";
}

function redirect($url) {
    echo "<script>window.location.href='$url'</script>";
}
?>