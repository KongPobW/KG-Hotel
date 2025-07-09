function requestRefund(bookingId) {
    const formData = new FormData();
    formData.append('request_refund', true);
    formData.append('booking_id', bookingId);

    fetch('server/api/booking_history.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('success', data.success);
                setTimeout(() => {
                    location.reload();
                }, 1000);
            } else {
                alert('danger', data.error);
            }
        })
        .catch(err => {
            console.error(err);
        });
}