<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark" id="navbar">
    <div class="container-fluid">
        <a class="navbar-brand company-title" href="#">
            <img src="<?= base_url() ?>assets/images/logo-dianterin.png" alt="Logo" width="50" height="34" class="d-inline-block align-text-top" />
            diAnterin
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item mx-lg-3">
                    <a class="nav-link" href="<?= base_url() ?>index.php">Home</a>
                </li>
                <li class="nav-item mx-lg-3">
                    <a class="nav-link" href="<?= base_url() ?>admin/manage-products.php">Manage Products</a>
                </li>
                <li class="nav-item mx-lg-3">
                    <a class="nav-link" href="<?= base_url() ?>about.php">About Us</a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <span class="text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?= base_url() ?>assets/images/icons8-name-48.png" alt="admin avatar" />
                        <?= $_SESSION['logged_in'] ?> <i class="fas fa-chevron-down"></i></span>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
                        <li>
                            <a class="dropdown-item" href="<?= base_url() ?>admin/profile.php">Profile</a>
                            <a class="dropdown-item" href="<?= base_url() ?>admin/logout.php">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>