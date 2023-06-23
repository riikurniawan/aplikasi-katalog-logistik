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
                    <a class="nav-link" href="<?= BASEURL ?>">Home</a>
                </li>
                <li class="nav-item mx-lg-3">
                    <a class="nav-link" href="<?= BASEURL ?>products">Product</a>
                </li>
                <li class="nav-item mx-lg-3">
                    <a class="nav-link" href="<?= BASEURL ?>about">About Us</a>
                </li>
            </ul>

            <?php if (isset($_SESSION['logged_in'])) : ?>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?= BASEURL ?>assets/images/avatar/icons8-name-48.png" alt="admin avatar" />
                            <?= $_SESSION['logged_in'] ?> <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
                            <li>
                                <a class="dropdown-item" href="<?= BASEURL ?>admin/dashboard">Back to Dashboard</a>
                            </li>
                        </ul>
                    </li>
                </ul>

            <?php else : ?>
                <a class="btn btn-warning" href="<?= BASEURL ?>auth">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>