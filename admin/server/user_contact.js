function getAllMessages() {
    const formData = new FormData();
    formData.append('get_messages', true);

    fetch('api/user_contact.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.error) {
                console.error(data.error);
                return;
            }

            const messageTableBody = document.querySelector('tbody');
            messageTableBody.innerHTML = '';

            data.forEach(message => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                <td>${message.sr_no}</td>
                <td>${message.name}</td>
                <td>${message.email}</td>
                <td>${message.subject}</td>
                <td>${message.message}</td>
                <td>${message.date}</td>
                <td>
                    ${message.seen == 0
                        ? `<button class="btn btn-sm btn-success mark-read" data-id="${message.sr_no}">Mark as Read</button>`
                        : `<button class="btn btn-sm btn-secondary" disabled>Read</button>`
                    }
                </td>
            `;
                messageTableBody.appendChild(tr);
            });

            const buttons = document.querySelectorAll('.mark-read');
            buttons.forEach(button => {
                button.addEventListener('click', function () {
                    const messageId = this.getAttribute('data-id');
                    updateMessageStatus(messageId);
                });
            });
        })
        .catch(err => {
            console.error('Error fetching messages:', err);
        });
}

function updateMessageStatus(messageId) {
    const formData = new FormData();
    formData.append('update_message_status', true);
    formData.append('message_id', messageId);

    fetch('api/user_contact.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.text())
        .then(data => {
            if (data === '1') {
                alert('success', 'Message marked as read!');
                getAllMessages();
            } else {
                alert('danger', 'Failed to update message status!');
            }
        })
        .catch(err => {
            console.error('Error updating message status:', err);
        });
}

window.addEventListener('DOMContentLoaded', getAllMessages);