<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>DiAnterin | Your shipment is our priority</title>

    <!-- bootstrap css -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />

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

        body>.layout {
            padding-bottom: 50px;
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
                    <div class="row">
                        <h3 class="card-title text-center section-title mb-3 fw-bold">
                            About Us
                        </h3>
                        <div class="col-md-6 col-lg-5 d-flex justify-content-center">
                            <img src="assets/images/company.jpg" alt="company images" class="img-fluid rounded" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center flex-column my-3">
                            <div class="d-flex align-items-center">
                                <img src="assets/images/logo.png" alt="company logo" height="80" />
                                <h4 class="card-title ms-2 company-title">diAnterin</h4>
                            </div>
                            <div class="my-3">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Distinctio, explicabo adipisci magnam quibusdam atque,
                                    libero facere perspiciatis iste expedita iure asperiores!
                                    Quia sint culpa possimus inventore quaerat eos at aliquam
                                    vero repudiandae sit, laboriosam iusto harum, temporibus
                                    sequi fugit autem tempora laborum veniam illum corrupti,
                                    earum eius fugiat ipsa. At qui adipisci ratione, reiciendis
                                    nam quia obcaecati explicabo quos atque pariatur, a
                                    distinctio. Officia, rem amet. Amet beatae maxime minima
                                    laboriosam fuga obcaecati fugit cupiditate repudiandae,
                                    doloribus ad animi hic?
                                </p>
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
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>