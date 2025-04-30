<div class="container-fluid bg-dark text-light p-3 d-flex align-items-center justify-content-between sticky-top">
    <h3 class="mb-0 h-font">KG HOTEL</h3>
    <a href="logout.php" class="btn btn-light btn-sm">LOG OUT</a>
</div>

<div class="col-lg-2 bg-dark border border-top border-3 border-secondary" id="admin-menu">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid flex-lg-column align-items-stretch">
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#admin-dropdown" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="admin-dropdown">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-light" href="dashboard.php" id="dashboard-link">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="room.php" id="rooms-link">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="feature_facility.php"
                            id="features-facilities-link">Features & Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="user_contact.php" id="user-contacts-link">User Contacts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="setting.php" id="setting-link">Setting</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<script>
window.onload = function() {
    let currentPath = window.location.pathname;

    let menuItems = [{
            id: 'dashboard-link',
            path: '/dashboard.php'
        },
        {
            id: 'rooms-link',
            path: '/room.php'
        },
        {
            id: 'features-facilities-link',
            path: '/feature_facility.php'
        },
        {
            id: 'user-contacts-link',
            path: '/user_contact.php'
        },
        {
            id: 'setting-link',
            path: '/setting.php'
        }
    ];

    menuItems.forEach(item => {
        let menuLink = document.getElementById(item.id);

        if (currentPath.includes(item.path)) {
            menuLink.classList.add('active');
        } else {
            menuLink.classList.remove('active');
        }
    });
};
</script>