<?php include './components/baseurl.php' ?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>DiAnterin | Product</title>

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

<body>
    <div class="layout">
        <!-- navbar -->
        <?php include './components/navbar.php' ?>

        <main>
            <section id="about">
                <div class="container mt-5">
                    <h3 class="card-title text-center section-title mb-3 fw-bold"> Product</h3>
                    <div class="row mb-4 mx-3">
                        <label class="col col-sm-2 col-md-1 col-form-label fw-bold">Filter <i class="fas fa-filter text-warning"></i></label>
                        <div class="col-5 col-sm-5 col-lg-3">
                            <select name="delivery_area" id="delivery_area" class="form-select">
                                <option value="" selected disabled>Delivery Area</option>
                                <option value="">Batam</option>
                                <option value="">Tj. Pinang</option>
                            </select>
                        </div>
                        <div class="col-4 col-sm-5 col-lg-3">
                            <select name="weight" id="weight" class="form-select">
                                <option value="" selected disabled>Weight</option>
                                <option value="">
                                    < 5Kg</option>
                                <option value="">> 10Kg</option>
                            </select>
                        </div>
                    </div>
                    <div class="row px-3">
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
                                <img src="<?= base_url() ?>assets/images/CUBE.png" class="card-img-top mx-auto" style="width:200px" alt="..." />
                                <div class="card-body">
                                    <h5 class="card-title fw-bold text-center">CUBE</h5>
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
                        <div class="col-md-6 col-lg-4 mb-3 px-3">
                            <div class="card">
                                <img src="<?= base_url() ?>assets/images/CUBE.png" class="card-img-top mx-auto" style="width:200px" alt="..." />
                                <div class="card-body">
                                    <h5 class="card-title fw-bold text-center">CUBE</h5>
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

    <!-- footer -->
    <?php include './components/footer.php' ?>

    <!-- bootstrap js minified -->
    <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>