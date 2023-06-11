<?php include './components/baseurl.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>DiAnterin | Product Detail</title>

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
        <?php include './components/navbar.php' ?>

        <main>
            <section>
                <div class="container mt-5">
                    <div class="row">
                        <h3 class="card-title text-center section-title fw-bold">
                            Product Detail
                        </h3>
                    </div>
                    <div class="row p-3">
                        <div class="col-lg-6 mb-3">
                            <div id="carouselProductControls" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner rounded">
                                    <div class="carousel-item active">
                                        <img src="<?= base_url() ?>assets/images/jumbo.jpg" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="<?= base_url() ?>assets/images/jumbo.jpg" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="<?= base_url() ?>assets/images/jumbo.jpg" class="d-block w-100" alt="...">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselProductControls" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselProductControls" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h3 class="card-title text-center section-title mb-3 fw-bold">
                                APEX
                            </h3>
                            <div>
                                <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam eaque corporis, impedit ullam sed reprehenderit libero sit hic eius recusandae.</p>
                            </div>
                            <div>
                                <div class="d-flex flex-column text-center">
                                    <i class="far fa-clock text-warning fw-bold fs-4 my-3"></i>
                                    <span>5-7 Hari</span>
                                </div>
                                <div class="d-flex flex-column text-center">
                                    <i class="fas fa-map-marker-alt text-warning fw-bold fs-4 my-3"></i>
                                    <span>Batam dan sekitarnya.</span>
                                </div>
                                <div class="d-flex flex-column text-center">
                                    <i class="fas fa-tag text-warning fw-bold fs-4 my-3"></i>
                                    <span>Mulai dari Rp. 50.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <!-- footer -->
    <?php include './components/footer.php' ?>

    <!-- bootstrap js minified -->
    <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>