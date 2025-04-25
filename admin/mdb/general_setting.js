function getGeneralSetting() {
    const formData = new FormData();
    formData.append('get_general', true);

    fetch('ajax/setting_crud.php', {
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

function updateGeneralSetting() {
    const siteTitle = document.getElementById('site_title_input').value.trim();
    const siteAbout = document.getElementById('site_about_input').value.trim();

    const formData = new FormData();
    formData.append('update_general', true);
    formData.append('site_title', siteTitle);
    formData.append('site_about', siteAbout);

    fetch('ajax/setting_crud.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.text())
        .then(data => {
            if (data === '1') {
                alert('success', 'Updated successfully!');
                getGeneralSetting();
                const modal = bootstrap.Modal.getInstance(document.getElementById('general-setting'));
                modal.hide();
            } else {
                alert('danger', 'Update failed! Please try again');
            }
        })
        .catch(err => {
            console.error('Error updating setting:', err);
        });
}

function updateShutdownSetting(shutdownStatus) {
    const formData = new FormData();
    formData.append('update_shutdown', true);
    formData.append('shutdown_mode', shutdownStatus);

    fetch('ajax/setting_crud.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.text())
        .then(data => {
            if (data === '1') {
                alert('success', 'Shutdown updated successfully!');
            } else {
                alert('danger', 'Update failed! Please try again');
            }
        })
        .catch(err => {
            console.error('Error updating shutdown setting:', err);
        });
}

document.getElementById('shutdown-toggle').addEventListener('change', function () {
    updateShutdownSetting(this.checked ? '1' : '0');  // Pass '1' if checked, '0' if unchecked
});