function getGeneralSetting() {
    const formData = new FormData();
    formData.append('get_general', true);

    fetch('api/setting.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            document.getElementById('general_site_title').innerText = data.site_title || 'Not set';
            document.getElementById('general_site_about').innerText = data.site_about || 'Not set';

            document.getElementById('site_title_input').value = data.site_title || '';
            document.getElementById('site_about_input').value = data.site_about || '';
        })
        .catch(err => {
            console.error("Error fetching general setting:", err);
        });
}

window.addEventListener('DOMContentLoaded', getGeneralSetting);

function updateGeneralSetting(e) {
    e.preventDefault();

    const siteTitle = document.getElementById('site_title_input').value.trim();
    const siteAbout = document.getElementById('site_about_input').value.trim();

    const formData = new FormData();
    formData.append('update_general', true);
    formData.append('site_title', siteTitle);
    formData.append('site_about', siteAbout);

    fetch('api/setting.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.text())
        .then(data => {
            if (data === '1') {
                alert('success', 'General setting updated successfully!');
                getGeneralSetting();
                const modal = bootstrap.Modal.getInstance(document.getElementById('general-setting'));
                modal.hide();
            } else {
                alert('danger', 'Update failed! Please try again');
            }
        })
        .catch(err => {
            console.error('Error updating general setting:', err);
        });
}

function getShutdownSetting() {
    fetch('api/setting.php?get_shutdown=1')
        .then(res => res.text())
        .then(data => {
            const shutdownToggle = document.getElementById('shutdown-toggle');
            shutdownToggle.checked = data === '1';
        })
        .catch(err => {
            console.error('Error fetching shutdown setting:', err);
        });
}

window.addEventListener('DOMContentLoaded', getShutdownSetting);

function updateShutdownSetting(shutdownStatus, e) {
    e.preventDefault();

    const formData = new FormData();
    formData.append('update_shutdown', true);
    formData.append('shutdown_mode', shutdownStatus);

    fetch('api/setting.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.text())
        .then(data => {
            if (data === '1') {
                alert('success', 'Shutdown setting updated successfully!');
            } else {
                alert('danger', 'Update failed! Please try again');
            }
        })
        .catch(err => {
            console.error('Error updating shutdown setting:', err);
        });
}

document.getElementById('shutdown-toggle').addEventListener('change', function (e) {
    updateShutdownSetting(this.checked ? '1' : '0', e);
});

function getContactSetting() {
    const formData = new FormData();
    formData.append('get_contact', true);

    fetch('api/setting.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.error) {
                console.error(data.error);
                return;
            }

            document.getElementById('iframe').src = data.gmap || '';
            document.getElementById('address').innerText = data.address || 'Not set';
            document.getElementById('pn1').innerText = data.pn1 || 'N/A';
            document.getElementById('pn2').innerText = data.pn2 || 'N/A';
            document.getElementById('email').innerText = data.email || 'Not set';

            document.getElementById('google_map_input').value = data.gmap || '';
            document.getElementById('address_input').value = data.address || '';
            document.getElementById('pn1_input').value = data.pn1 || '';
            document.getElementById('pn2_input').value = data.pn2 || '';
            document.getElementById('email_input').value = data.email || '';
        })
        .catch(err => {
            console.error("Error fetching contact setting:", err);
        });
}

window.addEventListener('DOMContentLoaded', getContactSetting);

function updateContactSetting(e) {
    e.preventDefault();

    const gmap = document.getElementById('google_map_input').value.trim();
    const address = document.getElementById('address_input').value.trim();
    const pn1 = document.getElementById('pn1_input').value.trim();
    const pn2 = document.getElementById('pn2_input').value.trim();
    const email = document.getElementById('email_input').value.trim();

    const formData = new FormData();
    formData.append('update_contact', true);
    formData.append('gmap', gmap);
    formData.append('address', address);
    formData.append('pn1', pn1);
    formData.append('pn2', pn2);
    formData.append('email', email);

    fetch('api/setting.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.text())
        .then(data => {
            if (data === '1') {
                alert('success', 'Contact setting updated successfully!');
                getContactSetting();
                const modal = bootstrap.Modal.getInstance(document.getElementById('contact-setting'));
                modal.hide();
            } else {
                alert('danger', 'Failed to update contact setting!');
            }
        })
        .catch(err => {
            console.error('Error updating contact setting:', err);
        });
}