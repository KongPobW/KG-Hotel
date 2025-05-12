function submitUserMessage(e) {
    e.preventDefault();

    const form = document.getElementById('send-message-form');
    const name = form.elements['name'].value.trim();
    const email = form.elements['email'].value.trim();
    const subject = form.elements['subject'].value.trim();
    const message = form.elements['message'].value.trim();

    if (name === '' || email === '' || subject === '' || message === '') {
        alert("danger", "All fields are required!");
        return;
    }

    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/i;
    if (!emailPattern.test(email)) {
        alert("danger", "Invalid email format!");
        return;
    }

    const formData = new FormData(form);
    formData.append('send_message', true);

    fetch('server/api/send_message.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.text())
        .then(data => {
            if (data === '1') {
                alert("success", "Message sent successfully!");
                form.reset();
            } else {
                alert("danger", "Failed to send message! Try again");
            }
        })
        .catch(err => {
            console.error('Message sending error:', err);
        });
}