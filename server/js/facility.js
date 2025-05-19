function getFacilities() {
    document.getElementById('facility_name_input').value = '';
    document.getElementById('facility_description_input').value = '';
    document.getElementById('facility_icon_input').value = '';

    const formData = new FormData();
    formData.append('get_facilities', true);

    fetch('../server/api/facility.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            const tbody = document.querySelector('.tbody-facility');
            tbody.innerHTML = '';

            if (Array.isArray(data) && data.length > 0) {
                data.forEach((facility, index) => {
                    const row = `
                    <tr>
                        <td>${index + 1}</td>
                        <td><img src="../uploads/facilities/${facility.icon}" width="40" /></td>
                        <td>${facility.name}</td>
                        <td>${facility.description}</td>
                        <td>
                            <button class="btn btn-sm btn-danger" onclick="deleteFacility(${facility.id})">Delete</button>
                        </td>
                    </tr>`;
                    tbody.insertAdjacentHTML('beforeend', row);
                });
            }
        })
        .catch(err => {
            console.error('Error fetching facilities:', err);
        });
}

function addFacility(e) {
    e.preventDefault();

    const name = document.getElementById('facility_name_input').value.trim();
    const desc = document.getElementById('facility_description_input').value.trim();
    const icon = document.getElementById('facility_icon_input').files[0];

    if (name === '' || desc === '') {
        alert("danger", "All fields are required!", "#facility-adding");
        return;
    }

    if (!icon) {
        alert("danger", "Please upload an icon", "#facility-adding");
        return;
    }

    const formData = new FormData();
    formData.append('add_facility', true);
    formData.append('name', name);
    formData.append('description', desc);
    formData.append('icon', icon);

    fetch('../server/api/facility.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.text())
        .then(data => {
            if (data === '1') {
                alert('success', 'Facility added successfully!');
                bootstrap.Modal.getInstance(document.getElementById('facility-adding')).hide();
                getFacilities();
            } else if (data === 'invalid_image') {
                alert('danger', 'Invalid image format! Supported formats are: jpg, jpeg, png, webp, and svg', '#facility-adding');
            } else if (data === 'invalid_mime') {
                alert('danger', 'Invalid file type! Please upload a valid image file', '#facility-adding');
            } else if (data === 'large_image') {
                alert('danger', 'Image is too large! Max 2MB allowed', '#facility-adding');
            } else if (data === 'upload_failed') {
                alert('danger', 'Image upload failed', '#facility-adding');
            } else {
                alert('danger', 'Failed to add facility! Please try again', '#facility-adding');
            }
        })
        .catch(err => {
            console.error('Error adding facility:', err);
        });
}

function deleteFacility(id) {
    const formData = new FormData();
    formData.append('delete_facility', true);
    formData.append('id', id);

    fetch('../server/api/facility.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.text())
        .then(data => {
            if (data === '1') {
                alert('success', 'Facility deleted successfully!');
                getFacilities();
            } else {
                alert('danger', 'Failed to delete facility! Please try again');
            }
        })
        .catch(err => {
            console.error('Error deleting facility:', err);
        });
}

window.addEventListener('DOMContentLoaded', getFacilities);