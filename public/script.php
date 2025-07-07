<script>
function alert(type, msg, modalSelector = null) {
    let targetElement;

    if (modalSelector) {
        targetElement = document.querySelector(modalSelector + ' .modal-body');
    }

    if (!targetElement) {
        targetElement = document.body;
    }

    const element = document.createElement('div');
    element.innerHTML = `
        <div class='alert alert-${type} alert-dismissible fade show custom-alert' role='alert'>
            <strong>${msg}</strong>
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
}
</script>