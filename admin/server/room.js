function addRoom(e) {
    e.preventDefault();

    const name = document.getElementById('room_name_input_add').value.trim();
    const area = document.getElementById('area_input_add').value.trim();
    const price = document.getElementById('price_input_add').value.trim();
    const quantity = document.getElementById('quantity_input_add').value.trim();
    const adult = document.getElementById('adult_max_input_add').value.trim();
    const children = document.getElementById('children_max_input').value.trim();
    const desc = document.querySelector('#room-adding textarea[name="desc"]').value.trim();

    const formData = new FormData();
    formData.append('add_room', true);
    formData.append('name', name);
    formData.append('area', area);
    formData.append('price', price);
    formData.append('quantity', quantity);
    formData.append('adult', adult);
    formData.append('children', children);
    formData.append('desc', desc);

    document.querySelectorAll('#room-adding input[name="features[]_add"]:checked').forEach(input => {
        formData.append('features[]', input.value);
    });

    document.querySelectorAll('#room-adding input[name="facilities[]_add"]:checked').forEach(input => {
        formData.append('facilities[]', input.value);
    });

    fetch('api/room.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.text())
        .then(data => {
            console.log(data);
            if (data === '1') {
                alert('success', 'Room added successfully!');
                bootstrap.Modal.getInstance(document.getElementById('room-adding')).hide();

                document.querySelector('#room-adding form').reset();
                getRooms();
            } else {
                alert('danger', 'Failed to add room! Please try again');
            }
        })
        .catch(err => {
            console.error('Error adding room:', err);
        });
}

function getRooms() {
    document.getElementById('room_cover_input').value = '';
    document.getElementById('room_image_input').value = '';
    document.getElementById('imagePreviewTable').innerHTML = '';

    const formData = new FormData();
    formData.append('get_rooms', true);

    fetch('api/room.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            const tbody = document.querySelector('.tbody-room');
            tbody.innerHTML = '';

            if (Array.isArray(data)) {
                data.forEach((room, index) => {
                    const row = `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${room.name}</td>
                            <td>${room.area} sqft</td>
                            <td>${room.adult} Adult(s), ${room.children} Child(ren)</td>
                            <td>${room.price}</td>
                            <td>${room.quant}</td>
                            <td>${room.features.join(', ')}</td>
                            <td>${room.facilities.join(', ')}</td>
                            <td>
                                <button class="btn btn-sm ${room.status == '1' ? 'btn-success' : 'btn-secondary'}" 
                                        onclick="toggleStatus(${room.id}, ${room.status})">
                                    ${room.status == '1' ? 'Active' : 'Inactive'}
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary me-1" onclick="editRoom(${room.id})">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-sm btn-info me-1" onclick="addImageAndCover(${room.id})">
                                    <i class="bi bi-images"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" onclick="deleteRoom(${room.id})">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `;

                    tbody.insertAdjacentHTML('beforeend', row);
                });
            }
        })
        .catch(err => {
            console.error('Error fetching rooms:', err);
        });
}

function deleteRoom(id) {
    const formData = new FormData();
    formData.append('delete_room', true);
    formData.append('id', id);

    fetch('api/room.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.text())
        .then(data => {
            if (data === '1') {
                alert('success', 'Room deleted successfully!');
                getRooms();
            } else {
                alert('danger', 'Failed to delete room! Please try again');
            }
        })
        .catch(err => {
            console.error('Error deleting room:', err);
        });
}

window.addEventListener('DOMContentLoaded', getRooms);

function toggleStatus(id, currentStatus) {
    const formData = new FormData();
    const newStatus = currentStatus === 1 ? 0 : 1;

    formData.append('toggle_status', true);
    formData.append('id', id);
    formData.append('status', newStatus);

    fetch('api/room.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.text())
        .then(data => {
            if (data === '1') {
                alert('success', 'Status updated successfully!');

                const button = document.querySelector(`button[onclick="toggleStatus(${id}, ${currentStatus})"]`);
                if (button) {
                    button.classList.remove(currentStatus === 1 ? 'btn-success' : 'btn-secondary');
                    button.classList.add(newStatus === 1 ? 'btn-success' : 'btn-secondary');
                    button.textContent = newStatus === 1 ? 'Active' : 'Inactive';

                    button.setAttribute('onclick', `toggleStatus(${id}, ${newStatus})`);
                }
            } else {
                alert('danger', 'Failed to update status! Please try again');
            }
        })
        .catch(err => {
            console.error('Error updating status:', err);
        });
}

function editRoom(id) {
    const formData = new FormData();
    formData.append('get_room_by_id', true);
    formData.append('id', id);

    fetch('api/room.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            document.getElementById('room_id_input').value = data.room.id;
            document.getElementById('room_name_input_edit').value = data.room.name;
            document.getElementById('area_input_edit').value = data.room.area;
            document.getElementById('price_input_edit').value = data.room.price;
            document.getElementById('quantity_input_edit').value = data.room.quant;
            document.getElementById('adult_max_input_edit').value = data.room.adult;
            document.getElementById('children_max_input_edit').value = data.room.children;
            document.querySelector('#room-editing textarea[name="desc"]').value = data.room.description;

            document.querySelectorAll('#room-editing input[name="features[]_edit"]').forEach(cb => cb.checked = false);
            document.querySelectorAll('#room-editing input[name="facilities[]_edit"]').forEach(cb => cb.checked = false);

            data.features.forEach(id => {
                const checkbox = document.getElementById(`feature_edit${id}`);
                if (checkbox) checkbox.checked = true;
            });

            data.facilities.forEach(id => {
                const checkbox = document.getElementById(`facility_edit${id}`);
                if (checkbox) checkbox.checked = true;
            });

            const modal = new bootstrap.Modal(document.getElementById('room-editing'));
            modal.show();
        });
}

function updateRoom(e) {
    e.preventDefault();

    const id = document.getElementById('room_id_input').value;
    const name = document.getElementById('room_name_input_edit').value.trim();
    const area = document.getElementById('area_input_edit').value.trim();
    const price = document.getElementById('price_input_edit').value.trim();
    const quantity = document.getElementById('quantity_input_edit').value.trim();
    const adult = document.getElementById('adult_max_input_edit').value.trim();
    const children = document.getElementById('children_max_input_edit').value.trim();
    const desc = document.querySelector('#room-editing textarea[name="desc"]').value.trim();

    const formData = new FormData();
    formData.append('update_room', true);
    formData.append('id', id);
    formData.append('name', name);
    formData.append('area', area);
    formData.append('price', price);
    formData.append('quantity', quantity);
    formData.append('adult', adult);
    formData.append('children', children);
    formData.append('desc', desc);

    document.querySelectorAll('#room-editing input[name="features[]_edit"]:checked').forEach(input => {
        formData.append('features[]', input.value);
    });

    document.querySelectorAll('#room-editing input[name="facilities[]_edit"]:checked').forEach(input => {
        formData.append('facilities[]', input.value);
    });

    fetch('api/room.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.text())
        .then(data => {
            if (data === '1') {
                alert('success', 'Room updated successfully!');
                bootstrap.Modal.getInstance(document.getElementById('room-editing')).hide();
                getRooms();
            } else {
                alert('danger', 'Failed to update room! Please try again');
            }
        })
        .catch(err => {
            console.error('Error updating room:', err);
        });
}

CURRENT_ROOM_ID_FOR_IMAGE_UPLOAD = '';

function addImageAndCover(id) {
    CURRENT_ROOM_ID_FOR_IMAGE_UPLOAD = id;

    const modal = new bootstrap.Modal(document.getElementById('room-image'));
    modal.show();

    const formData = new FormData();
    formData.append('get_room_image_cover', true);
    formData.append('room_id', id);

    fetch('api/room.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            const imagePreviewTable = document.getElementById('imagePreviewTable');
            imagePreviewTable.innerHTML = '';

            if (data.cover) {
                const coverRow = `
                <tr>
                    <td><img src="uploads/rooms/covers/${data.cover}" alt="Room Cover" style="width: 100px;"></td>
                    <td></td>
                    <td>
                        <button class="btn btn-danger btn-sm" onclick="deleteRoomImageAndCover('${data.cover}', true)">Delete</button>
                    </td>
                </tr>
            `;
                imagePreviewTable.insertAdjacentHTML('beforeend', coverRow);
            }

            data.images.forEach(image => {
                const imageRow = `
                <tr>
                    <td></td>
                    <td><img src="uploads/rooms/images/${image}" alt="Room Image" style="width: 100px;"></td>
                    <td>
                        <button class="btn btn-danger btn-sm" onclick="deleteRoomImageAndCover('${image}', false)">Delete</button>
                    </td>
                </tr>
            `;
                imagePreviewTable.insertAdjacentHTML('beforeend', imageRow);
            });
        })
        .catch(err => {
            console.error('Error fetching room image and cover:', err);
        });
}

function uploadImageAndCover(e) {
    e.preventDefault();

    const coverInput = document.getElementById('room_cover_input');
    const imagesInput = document.getElementById('room_image_input');
    const roomId = CURRENT_ROOM_ID_FOR_IMAGE_UPLOAD;

    const coverSelected = coverInput.files.length > 0;
    const imagesSelected = imagesInput.files.length > 0;

    if (!coverSelected && !imagesSelected) {
        alert('danger', 'Please select a cover or room image to upload');
        return;
    }

    const formData = new FormData();
    formData.append('upload_room_image_cover', true);
    formData.append('room_id', roomId);

    if (coverSelected) {
        formData.append('room_cover', coverInput.files[0]);
    }

    if (imagesSelected) {
        for (let img of imagesInput.files) {
            formData.append('room_images[]', img);
        }
    }

    fetch('api/room.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.text())
        .then(data => {
            if (data === '1') {
                alert('success', 'Uploaded successfully!');
                bootstrap.Modal.getInstance(document.getElementById('room-image')).hide();
                getRooms();

                coverInput.value = '';
                imagesInput.value = '';
            } else {
                alert('danger', 'Failed to upload! Please try again');
            }
        })
        .catch(err => {
            console.error('Error during upload:', err);
        });
}

function deleteRoomImageAndCover(filename, isCover) {
    const formData = new FormData();
    formData.append('delete_room_image_cover', true);
    formData.append('room_id', CURRENT_ROOM_ID_FOR_IMAGE_UPLOAD);
    formData.append('filename', filename);
    formData.append('is_cover', isCover);

    fetch('api/room.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert('success', 'Deleted successfully!');
                addImageAndCover(CURRENT_ROOM_ID_FOR_IMAGE_UPLOAD);
            } else {
                alert('danger', 'Failed to delete! Please try again');
            }
        })
        .catch(err => {
            console.error('Error during delete:', err);
        });
}