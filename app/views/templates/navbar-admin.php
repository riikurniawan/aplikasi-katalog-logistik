<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark" id="navbar">
    <div class="container-fluid">
        <a class="navbar-brand company-title" href="<?= BASEURL ?>">
            <img src="<?= BASEURL ?>assets/images/logo/logo-dianterin.png" alt="Logo" width="50" height="34" class="d-inline-block align-text-top" />
            diAnterin
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item mx-lg-3">
                    <a class="nav-link" href="<?= BASEURL ?>admin/dashboard">Dashboard</a>
                </li>
                <li class="nav-item mx-lg-3">
                    <a class="nav-link" href="<?= BASEURL ?>admin/manage_products">Manage Products</a>
                </li>
                <li class="nav-item mx-lg-3">
                    <a class="nav-link" href="<?= BASEURL ?>about">About Us</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?= BASEURL ?>assets/images/avatar/icons8-name-48.png" alt="admin avatar" />
                        <?= $_SESSION['logged_in'] ?> <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
                        <li>
                            <a class="dropdown-item" href="<?= BASEURL ?>admin/profile">My profile</a>
                            <a class="dropdown-item" href="<?= BASEURL ?>auth/logout">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>