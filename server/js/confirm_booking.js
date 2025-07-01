let bookFormElement = document.getElementById('booking-form');
let payInfoElement = document.getElementById('pay-info');

function checkAvailability() {
    let checkInVal = bookFormElement.elements['check-in'].value;
    let checkOutVal = bookFormElement.elements['check-out'].value;

    bookFormElement.elements['pay-now'].setAttribute('disabled', true);

    if (checkInVal !== '' && checkOutVal !== '') {
        payInfoElement.classList.add('d-none');

        let formData = new FormData();
        formData.append('check_availability', true);
        formData.append('check_in', checkInVal);
        formData.append('check_out', checkOutVal);

        fetch('server/api/confirm_booking.php', {
            method: 'POST',
            body: formData
        })
            .then(res => res.json())
            .then(data => {
                payInfoElement.classList.remove('d-none');

                if (data.status === 'check_in_out_equal') {
                    payInfoElement.innerText = 'You cannot check-out on the same day!';
                } else if (data.status === 'check_out_earlier') {
                    payInfoElement.innerText = 'Check-out date is earlier than Check-in date!';
                } else if (data.status === 'check_in_earlier') {
                    payInfoElement.innerText = 'Check-in date is earlier than today!';
                } else if (data.status === 'unavailable') {
                    payInfoElement.innerText = 'Room not available for this check-in date!';
                } else if (data.status === 'available') {
                    payInfoElement.classList.replace('text-danger', 'text-success');
                    payInfoElement.innerText = `Room available for ${data.days} day(s), Total payment: $${data.payment}`;
                    bookFormElement.elements['pay-now'].removeAttribute('disabled');
                }
            })
    }
}

function createPromptPay() {
    let formData = new FormData();
    formData.append('generate_promptpay', true);

    fetch('server/api/create_promptpay.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                const qrImg = document.getElementById('promptpay-qr');
                qrImg.src = data.qr_url;

                const modalEl = document.getElementById('promptpayModal');
                const promptpayModal = new bootstrap.Modal(modalEl);
                promptpayModal.show();
            } else {
                alert('danger', 'Failed to generate QR code!');
            }
        });
}