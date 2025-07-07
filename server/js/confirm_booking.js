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
    const phone = '0982592063';

    const formData = new FormData();
    formData.append('create_promptpay', true);
    formData.append('phone', phone);

    fetch('server/api/promptpay_qr.php', {
        method: 'POST',
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.qr_url) {
                document.getElementById('promptpay-qr').src = data.qr_url;

                const promptpayModal = new bootstrap.Modal(document.getElementById('promptpayModal'));
                promptpayModal.show();
            } else {
                alert('danger', data.error || 'Unable to generate QR code!');
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
}

function saveBooking() {
    let phone = bookFormElement.elements['phone'].value;
    let name = bookFormElement.elements['name'].value;
    let address = bookFormElement.elements['address'].value;
    let checkOut = bookFormElement.elements['check-out'].value;
    let checkIn = bookFormElement.elements['check-in'].value;

    const slipInput = document.getElementById('slip-upload');
    const file = slipInput.files[0];

    const formData = new FormData();
    formData.append('save_booking', true);
    formData.append('phone', phone);
    formData.append('name', name);
    formData.append('address', address);
    formData.append('check_out_date', checkOut);
    formData.append('check_in_date', checkIn);
    formData.append('slip', file);

    fetch('server/api/confirm_booking.php', {
        method: 'POST',
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.status === 'success') {
                window.location.href = `thankyou.php?booking_id=${data.booking_id}`;
            } else {
                alert('danger', data.message);
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
}