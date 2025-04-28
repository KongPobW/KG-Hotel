<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
</script>

<script>
function alert(type, msg) {
    let element = document.createElement('div');
    element.innerHTML = `
             <div class='alert alert-${type} alert-dismissible fade show custom-alert' role='alert'>
                 <strong>${msg}</strong>
                 <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
             </div>`;
    document.body.append(element);

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