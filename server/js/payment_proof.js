function getAllPaymentProofs() {
    const formData = new FormData();
    formData.append('get_payment_proof', true);

    fetch('../server/api/payment_proof.php', {
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

            data.forEach((row, index) => {
                const arrivalSlip = row.proof_file_arrival
                    ? 
                    `<a href="../uploads/payment_proofs/arrival/${row.proof_file_arrival}" target="_blank" class="btn btn-sm">
                        <i class="bi bi-eye"></i>
                    </a>`
                    : 
                    'N/A';

                const refundSlip = row.proof_file_refund
                    ? 
                    `<a href="../uploads/payment_proofs/refund/${row.proof_file_refund}" target="_blank" class="btn btn-sm">
                        <i class="bi bi-eye"></i>
                    </a>`
                    : (row.status === 'refunding'
                        ? 
                        `
                        <input type="file" id="refund-input-${row.payment_id}" style="display: none;">
                        <button id="refund-upload-btn-${row.payment_id}" class="btn btn-sm">
                            <i class="bi bi-upload"></i>
                        </button>
                        `
                        : 'N/A'
                    );

                const actionElement = row.verified == 0
                    ? `<button id="verify-btn-${row.payment_id}" class="btn btn-sm btn-success">Verify</button>`
                    : `<span class="badge bg-secondary">Verified</span>`;

                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td style="display: none;">${row.payment_id}</td>
                    <td>${index + 1}</td>
                    <td>${row.booker_name}</td>
                    <td>${row.pnumber}</td>
                    <td>${row.booking_date}</td>
                    <td>${row.subtotal}</td>
                    <td>${arrivalSlip}</td>
                    <td>${refundSlip}</td>
                    <td>${actionElement}</td>
                `;
                tbody.appendChild(tr);

                if (row.verified == 0) {
                    const verifyBtn = document.getElementById(`verify-btn-${row.payment_id}`);
                    if (verifyBtn) {
                        verifyBtn.addEventListener('click', () => {
                            verifyPayment(row.payment_id);
                        });
                    }
                }

                if (row.status === 'refunding' && !row.refund_file) {
                    const uploadBtn = document.getElementById(`refund-upload-btn-${row.payment_id}`);
                    const fileInput = document.getElementById(`refund-input-${row.payment_id}`);

                    if (uploadBtn && fileInput) {
                        uploadBtn.addEventListener('click', () => {
                            fileInput.click();
                        });

                        fileInput.addEventListener('change', () => {
                            const file = fileInput.files[0];
                            if (!file) {
                                alert('danger', 'No file selected!');
                                return;
                            }

                            uploadRefundSlip(row.payment_id, file);
                        });
                    }
                }
            });
        })
        .catch((err) => console.error('Error:', err));
}

function verifyPayment(paymentId) {
    const formData = new FormData();
    formData.append('verify_payment', true);
    formData.append('payment_id', paymentId);

    fetch('../server/api/payment_proof.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert("success", "Payment verified!");
                getAllPaymentProofs();
            } else {
                alert("danger", "Failed to verify payment!");
            }
        })
        .catch((err) => console.error('Error:', err));
}

function uploadRefundSlip(paymentId, file) {
    const formData = new FormData();
    formData.append('upload_refund_slip', true);
    formData.append('payment_id', paymentId);
    formData.append('refund_slip_file', file);

    fetch('../server/api/payment_proof.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert('success', 'Refund slip uploaded!');
                getAllPaymentProofs();
            } else {
                alert('danger', 'Failed to upload refund slip!');
            }
        })
        .catch((err) => console.error('Error:', err));
}

window.addEventListener('DOMContentLoaded', getAllPaymentProofs);