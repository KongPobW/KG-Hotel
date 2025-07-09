function getAllBookings() {
    const formData = new FormData();
    formData.append('get_booking', true);

    fetch('../server/api/booking.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.error) {
                console.error(data.error);
                return;
            }

            const tbody = document.querySelector('tbody');
            tbody.innerHTML = '';

            data.forEach((row) => {
                const actionElement = generateActionElement(row.status, row.booking_id);

                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${row.booking_id}</td>
                    <td>${row.room_name}</td>
                    <td>${row.check_in_date}</td>
                    <td>${row.check_out_date}</td>
                    <td>${row.num_nights}</td>
                    <td>${row.total_amount}</td>
                    <td>${row.booker_name}</td>
                    <td>${row.pnumber}</td>
                    <td>${row.booking_date}</td>
                    <td>${actionElement}</td>
                `;
                tbody.appendChild(tr);
            });
        })
        .catch((err) => console.error('Error:', err));
}

function generateActionElement(status, bookingId) {
    if (status === 'pending') {
        return `
            <div class="dropdown">
                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    ⏳ Pending
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <button class="dropdown-item text-success" onclick="completeBooking(${bookingId})">
                            ✔ Completed
                        </button>
                    </li>
                    <li>
                        <button class="dropdown-item text-danger" onclick="cancelBooking(${bookingId})">
                            ✘ Cancelled
                        </button>
                    </li>
                </ul>
            </div>
        `;
    } else if (status === 'completed') {
        return `<span class="badge bg-success">✔ Completed</span>`;
    } else if (status === 'cancelled') {
        return `<span class="badge bg-danger">✘ Cancelled</span>`;
    } else if (status === 'refunding') {
        return `<span class="badge bg-warning text-dark">↺ Refunding</span>`;
    }
    return '';
}

function completeBooking(bookingId) {
    const formData = new FormData();
    formData.append('complete_booking', true);
    formData.append('booking_id', bookingId);

    fetch('../server/api/booking.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert('success', data.success);
                getAllBookings();
            } else {
                alert('danger', data.error);
            }
        })
        .catch((err) => {
            console.error('Error:', err);
        });
}

function cancelBooking(bookingId) {
    const formData = new FormData();
    formData.append('cancel_booking', true);
    formData.append('booking_id', bookingId);

    fetch('../server/api/booking.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert('success', data.success);
                getAllBookings();
            } else {
                alert('danger', data.error);
            }
        })
        .catch((err) => {
            console.error('Error:', err);
        });
}

window.addEventListener('DOMContentLoaded', getAllBookings);