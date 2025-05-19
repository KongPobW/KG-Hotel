<?php
function redirect($url) {
    echo "<script>window.location.href='$url'</script>";
}

function alert($type, $msg, $modalSelector = null) {
    $targetSelector = $modalSelector ? $modalSelector . ' .modal-body' : 'body';

    $alertHtml = "
        <script>
            (function() {
                let targetElement = document.querySelector('$targetSelector');
                if (!targetElement) {
                    targetElement = document.body;
                }

                const element = document.createElement('div');
                element.innerHTML = `
                    <div class='alert alert-$type alert-dismissible fade show custom-alert' role='alert'>
                        <strong>$msg</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>`;
                
                targetElement.appendChild(element);

                setTimeout(() => {
                    if (element) {
                        element.classList.remove('show');
                        element.classList.add('hide');
                        setTimeout(() => {
                            element.remove();
                        }, 500);
                    }
                }, 3000);
            })();
        </script>
    ";

    echo $alertHtml;
}
?>