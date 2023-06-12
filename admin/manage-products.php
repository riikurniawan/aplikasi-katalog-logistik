<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: ./index.php");
}

include '../components/baseurl.php'
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>DiAnterin | Your shipment is our priority</title>

    <!-- bootstrap css -->
    <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- custom css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css" />

    <!-- fontawesome icons -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/fontawesome/css/all.min.css" />

    <!-- favicon -->
    <link rel="icon" href="<?= base_url() ?>assets/images/logo.png" type="image/x-icon" id="light-scheme-icon">
    <link rel="icon" href="<?= base_url() ?>assets/images/logo-dianterin.png" type="image/x-icon" id="dark-scheme-icon">

    <!-- custom scripts -->
    <script src="<?= base_url() ?>assets/js/scripts.js"></script>

    <style>
        body {
            padding-top: 50px;
        }

        body>.layout {
            padding-bottom: 50px;
        }

        .card-img-top {
            width: 100%;
            height: 15vw;
            object-fit: contain;
        }

        .text-truncate-container p {
            -webkit-line-clamp: 2;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="layout">

        <!-- navbar -->
        <?php include '../components/navbar-admin.php' ?>

        <main>
            <section id="about">
                <div class="container mt-5">
                    <div class="row mb-3">
                        <div class="col-lg-6 offset-lg-3 mb-3 mb-lg-0">
                            <h3 class="card-title text-center section-title fw-bold">
                                Manage Products
                            </h3>
                        </div>
                        <div class="col-lg-3 d-flex justify-content-lg-end px-3 mb-3 mb-lg-0">
                            <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-plus-circle"></i> Add Product</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-4 mb-3 px-3">
                            <div class="card">
                                <img src="<?= base_url() ?>assets/images/CUBE.png" class="card-img-top mx-auto" style="width:200px" alt="..." />
                                <div class="card-body">
                                    <h5 class="card-title fw-bold text-center">CUBE</h5>
                                    <div class="text-truncate-container mb-3">
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima neque illo dolorum at illum, ullam non commodi explicabo dolores nam excepturi, labore quam nemo reiciendis. Debitis quibusdam quis at nesciunt ex sunt beatae aperiam, omnis quos fuga explicabo nostrum odit voluptate quod quasi vero est. Adipisci, fuga sunt! Delectus optio rerum, laborum esse odit, repellendus debitis aperiam accusantium cumque reiciendis explicabo perferendis! A, non. Nemo a adipisci, qui doloribus earum amet quia cum voluptatum soluta exercitationem. Deleniti atque debitis, beatae explicabo iusto odit quae dicta sapiente deserunt nostrum quos, magni repellendus exercitationem rem? Autem, cupiditate error hic ratione rerum excepturi.</p>
                                    </div>
                                    <div class="d-grid">
                                        <a href="./product-detail.php" class="btn btn-warning border">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-3 px-3">
                            <div class="card">
                                <img src="<?= base_url() ?>assets/images/APEX.png" class="card-img-top mx-auto" style="width:200px">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold text-center">APEX</h5>
                                    <div class="text-truncate-container mb-3">
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima neque illo dolorum at illum, ullam non commodi explicabo dolores nam excepturi, labore quam nemo reiciendis. Debitis quibusdam quis at nesciunt ex sunt beatae aperiam, omnis quos fuga explicabo nostrum odit voluptate quod quasi vero est. Adipisci, fuga sunt! Delectus optio rerum, laborum esse odit, repellendus debitis aperiam accusantium cumque reiciendis explicabo perferendis! A, non. Nemo a adipisci, qui doloribus earum amet quia cum voluptatum soluta exercitationem. Deleniti atque debitis, beatae explicabo iusto odit quae dicta sapiente deserunt nostrum quos, magni repellendus exercitationem rem? Autem, cupiditate error hic ratione rerum excepturi.</p>
                                    </div>
                                    <div class="d-grid">
                                        <a href="./product-detail.php" class="btn btn-warning">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-3 px-3">
                            <div class="card">
                                <img src="<?= base_url() ?>assets/images/APEX.png" class="card-img-top mx-auto" style="width:200px">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold text-center">APEX</h5>
                                    <div class="text-truncate-container mb-3">
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima neque illo dolorum at illum, ullam non commodi explicabo dolores nam excepturi, labore quam nemo reiciendis. Debitis quibusdam quis at nesciunt ex sunt beatae aperiam, omnis quos fuga explicabo nostrum odit voluptate quod quasi vero est. Adipisci, fuga sunt! Delectus optio rerum, laborum esse odit, repellendus debitis aperiam accusantium cumque reiciendis explicabo perferendis! A, non. Nemo a adipisci, qui doloribus earum amet quia cum voluptatum soluta exercitationem. Deleniti atque debitis, beatae explicabo iusto odit quae dicta sapiente deserunt nostrum quos, magni repellendus exercitationem rem? Autem, cupiditate error hic ratione rerum excepturi.</p>
                                    </div>
                                    <div class="d-grid">
                                        <a href="./product-detail.php" class="btn btn-warning">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <!-- navbar -->
    <?php include '../components/footer.php' ?>

    <!-- modal add product -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- bootstrap js minified -->
    <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>