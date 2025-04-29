function getFeatures() {
    const nameInput = document.getElementById('feature_name_input');
    nameInput.value = '';

    const formData = new FormData();
    formData.append('get_features', true);

    fetch('api/feature.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            const tbody = document.querySelector('.tbody-feature');
            tbody.innerHTML = '';

            if (Array.isArray(data) && data.length > 0) {
                data.forEach((feature, index) => {
                    const row = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${feature.name}</td>
                        <td>
                            <button class="btn btn-sm btn-danger" onclick="deleteFeature(${feature.id})">Delete</button>
                        </td>
                    </tr>`;
                    tbody.insertAdjacentHTML('beforeend', row);
                });
            }
        })
        .catch(err => {
            console.error('Error fetching features:', err);
        });
}

function addFeature(e) {
    e.preventDefault();

    const nameInput = document.getElementById('feature_name_input');
    const name = nameInput.value.trim();

    const formData = new FormData();
    formData.append('add_feature', true);
    formData.append('name', name);

    fetch('api/feature.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.text())
        .then(data => {
            if (data === '1') {
                alert('success', 'Feature added successfully!');
                nameInput.value = '';
                bootstrap.Modal.getInstance(document.getElementById('feature-adding')).hide();
                getFeatures();
            } else {
                alert('danger', 'Failed to add feature! Please try again');
            }
        })
        .catch(err => {
            console.error('Error adding feature:', err);
        });
}

function deleteFeature(id) {
    const formData = new FormData();
    formData.append('delete_feature', true);
    formData.append('id', id);

    fetch('api/feature.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.text())
        .then(data => {
            if (data === '1') {
                alert('success', 'Feature deleted successfully!');
                getFeatures();
            } else {
                alert('danger', 'Failed to delete feature! Please try again');
            }
        })
        .catch(err => {
            console.error('Error deleting feature:', err);
        });
}

window.addEventListener('DOMContentLoaded', getFeatures);