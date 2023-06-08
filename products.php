<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>DiAnterin | Product</title>

    <!-- bootstrap css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- custom css -->
    <link rel="stylesheet" href="/assets/css/style.css" />

    <!-- fontawesome icons -->
    <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css" />

    <!-- favicon -->
    <link rel="icon" href="/assets/images/logo.png" type="image/x-icon" id="light-scheme-icon">
    <link rel="icon" href="/assets/images/logo-dianterin.png" type="image/x-icon" id="dark-scheme-icon">

    <!-- custom scripts -->
    <script src="/assets/js/scripts.js"></script>

    <style>
        body {
            padding-top: 50px;
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
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="navbar">
            <div class="container-fluid">
                <a class="navbar-brand company-title" href="#">
                    <img src="assets/images/logo-dianterin.png" alt="Logo" width="50" height="34" class="d-inline-block align-text-top" />
                    diAnterin
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item mx-lg-3">
                            <a class="nav-link" href="/index.php">Home</a>
                        </li>
                        <li class="nav-item mx-lg-3">
                            <a class="nav-link" href="/products.php">Product</a>
                        </li>
                        <li class="nav-item mx-lg-3">
                            <a class="nav-link" href="/about.php">About Us</a>
                        </li>
                    </ul>
                    <li class="nav-item mb-2">
                        <a class="btn btn-warning" href="/admin/index.php">Login</a>
                    </li>
                </div>
            </div>
        </nav>

        <main>
            <section id="about">
                <div class="container mt-5">
                    <h3 class="card-title text-center section-title mb-3 fw-bold"> Product</h3>
                    <div class="row mb-4 mx-3">
                        <label class="col-2 col-sm-2 col-md-1 col-form-label fw-bold">Filter <i class="fas fa-filter text-warning"></i></label>
                        <div class="col-5 col-sm-5 col-lg-3">
                            <select name="delivery_area" id="delivery_area" class="form-select">
                                <option value="" selected disabled>Delivery Area</option>
                                <option value="">Batam</option>
                                <option value="">Tj. Pinang</option>
                            </select>
                        </div>
                        <div class="col-5 col-sm-5 col-lg-3">
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
                                <img src="/assets/images/CUBE.png" class="card-img-top mx-auto" style="width:200px" alt="..." />
                                <div class="card-body">
                                    <h5 class="card-title fw-bold text-center">CUBE</h5>
                                    <div class="text-truncate-container mb-3">
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima neque illo dolorum at illum, ullam non commodi explicabo dolores nam excepturi, labore quam nemo reiciendis. Debitis quibusdam quis at nesciunt ex sunt beatae aperiam, omnis quos fuga explicabo nostrum odit voluptate quod quasi vero est. Adipisci, fuga sunt! Delectus optio rerum, laborum esse odit, repellendus debitis aperiam accusantium cumque reiciendis explicabo perferendis! A, non. Nemo a adipisci, qui doloribus earum amet quia cum voluptatum soluta exercitationem. Deleniti atque debitis, beatae explicabo iusto odit quae dicta sapiente deserunt nostrum quos, magni repellendus exercitationem rem? Autem, cupiditate error hic ratione rerum excepturi.</p>
                                    </div>
                                    <div class="d-grid">
                                        <a href="#" class="btn btn-warning border">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-3 px-3">
                            <div class="card">
                                <img src="/assets/images/APEX.png" class="card-img-top mx-auto" style="width:200px">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold text-center">APEX</h5>
                                    <div class="text-truncate-container mb-3">
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima neque illo dolorum at illum, ullam non commodi explicabo dolores nam excepturi, labore quam nemo reiciendis. Debitis quibusdam quis at nesciunt ex sunt beatae aperiam, omnis quos fuga explicabo nostrum odit voluptate quod quasi vero est. Adipisci, fuga sunt! Delectus optio rerum, laborum esse odit, repellendus debitis aperiam accusantium cumque reiciendis explicabo perferendis! A, non. Nemo a adipisci, qui doloribus earum amet quia cum voluptatum soluta exercitationem. Deleniti atque debitis, beatae explicabo iusto odit quae dicta sapiente deserunt nostrum quos, magni repellendus exercitationem rem? Autem, cupiditate error hic ratione rerum excepturi.</p>
                                    </div>
                                    <div class="d-grid">
                                        <a href="#" class="btn btn-warning">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-3 px-3">
                            <div class="card">
                                <img src="/assets/images/CUBE.png" class="card-img-top mx-auto" style="width:200px" alt="..." />
                                <div class="card-body">
                                    <h5 class="card-title fw-bold text-center">CUBE</h5>
                                    <div class="text-truncate-container mb-3">
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima neque illo dolorum at illum, ullam non commodi explicabo dolores nam excepturi, labore quam nemo reiciendis. Debitis quibusdam quis at nesciunt ex sunt beatae aperiam, omnis quos fuga explicabo nostrum odit voluptate quod quasi vero est. Adipisci, fuga sunt! Delectus optio rerum, laborum esse odit, repellendus debitis aperiam accusantium cumque reiciendis explicabo perferendis! A, non. Nemo a adipisci, qui doloribus earum amet quia cum voluptatum soluta exercitationem. Deleniti atque debitis, beatae explicabo iusto odit quae dicta sapiente deserunt nostrum quos, magni repellendus exercitationem rem? Autem, cupiditate error hic ratione rerum excepturi.</p>
                                    </div>
                                    <div class="d-grid">
                                        <a href="#" class="btn btn-warning">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-3 px-3">
                            <div class="card">
                                <img src="/assets/images/APEX.png" class="card-img-top mx-auto" style="width:200px">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold text-center">APEX</h5>
                                    <div class="text-truncate-container mb-3">
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima neque illo dolorum at illum, ullam non commodi explicabo dolores nam excepturi, labore quam nemo reiciendis. Debitis quibusdam quis at nesciunt ex sunt beatae aperiam, omnis quos fuga explicabo nostrum odit voluptate quod quasi vero est. Adipisci, fuga sunt! Delectus optio rerum, laborum esse odit, repellendus debitis aperiam accusantium cumque reiciendis explicabo perferendis! A, non. Nemo a adipisci, qui doloribus earum amet quia cum voluptatum soluta exercitationem. Deleniti atque debitis, beatae explicabo iusto odit quae dicta sapiente deserunt nostrum quos, magni repellendus exercitationem rem? Autem, cupiditate error hic ratione rerum excepturi.</p>
                                    </div>
                                    <div class="d-grid">
                                        <a href="#" class="btn btn-warning">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-3 px-3">
                            <div class="card">
                                <img src="/assets/images/CUBE.png" class="card-img-top mx-auto" style="width:200px" alt="..." />
                                <div class="card-body">
                                    <h5 class="card-title fw-bold text-center">CUBE</h5>
                                    <div class="text-truncate-container mb-3">
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima neque illo dolorum at illum, ullam non commodi explicabo dolores nam excepturi, labore quam nemo reiciendis. Debitis quibusdam quis at nesciunt ex sunt beatae aperiam, omnis quos fuga explicabo nostrum odit voluptate quod quasi vero est. Adipisci, fuga sunt! Delectus optio rerum, laborum esse odit, repellendus debitis aperiam accusantium cumque reiciendis explicabo perferendis! A, non. Nemo a adipisci, qui doloribus earum amet quia cum voluptatum soluta exercitationem. Deleniti atque debitis, beatae explicabo iusto odit quae dicta sapiente deserunt nostrum quos, magni repellendus exercitationem rem? Autem, cupiditate error hic ratione rerum excepturi.</p>
                                    </div>
                                    <div class="d-grid">
                                        <a href="#" class="btn btn-warning">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-3 px-3">
                            <div class="card">
                                <img src="/assets/images/APEX.png" class="card-img-top mx-auto" style="width:200px">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold text-center">APEX</h5>
                                    <div class="text-truncate-container mb-3">
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima neque illo dolorum at illum, ullam non commodi explicabo dolores nam excepturi, labore quam nemo reiciendis. Debitis quibusdam quis at nesciunt ex sunt beatae aperiam, omnis quos fuga explicabo nostrum odit voluptate quod quasi vero est. Adipisci, fuga sunt! Delectus optio rerum, laborum esse odit, repellendus debitis aperiam accusantium cumque reiciendis explicabo perferendis! A, non. Nemo a adipisci, qui doloribus earum amet quia cum voluptatum soluta exercitationem. Deleniti atque debitis, beatae explicabo iusto odit quae dicta sapiente deserunt nostrum quos, magni repellendus exercitationem rem? Autem, cupiditate error hic ratione rerum excepturi.</p>
                                    </div>
                                    <div class="d-grid">
                                        <a href="#" class="btn btn-warning">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script>
        matcher = window.matchMedia('(prefers-color-scheme: dark)');
        matcher.addListener(onUpdate);
        onUpdate();


        function onUpdate() {
            lightSchemeIcon = document.querySelector('link#light-scheme-icon');
            darkSchemeIcon = document.querySelector('link#dark-scheme-icon');
            if (matcher.matches) {
                lightSchemeIcon.remove();
                document.head.append(darkSchemeIcon);
            } else {
                document.head.append(lightSchemeIcon);
                darkSchemeIcon.remove();
            }
        }
    </script>
</body>

</html>