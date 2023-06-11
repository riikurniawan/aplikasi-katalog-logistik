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

  <!-- typerjs cdn links -->
  <script async src="<?= base_url() ?>assets/js/typer.js"></script>

  <!-- custom scripts -->
  <script src="<?= base_url() ?>assets/js/scripts.js"></script>
</head>

<body>
  <div class="layout">

    <!-- navbar -->
    <?php include '../components/navbar-admin.php' ?>

    <main>
      <section class="main-content">
        <div class="bg-main"></div>
        <div class="position-absolute start-50 top-50 translate-middle text-white">
          <h3 class="fs-1 text-center mb-4">
            Your Shipment is Our
            <br /><span class="typer text-white" id="main" data-words="Priority!,Responsible!" data-delay="100" data-deleteDelay="1000"></span>
            <span class="cursor" data-owner="main"></span>
          </h3>
          <div class="d-flex justify-content-around flex-column d-sm-flex flex-md-row">
            <button class="btn btn-outline-warning mb-3 mb-md-0">
              Get Started
            </button>
            <button class="btn btn-warning">Discover More</button>
          </div>
        </div>
      </section>
    </main>
  </div>

  <!-- navbar -->
  <?php include '../components/footer.php' ?>

  <!-- bootstrap js minified -->
  <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
  <script>
    // trigger navbar changing background to dark when scrolling page
    window.onscroll = function() {
      scrollFunction();
    };

    function scrollFunction() {
      const navbar = document.getElementById("navbar");
      if (
        document.body.scrollTop > 20 ||
        document.documentElement.scrollTop > 20
      ) {
        navbar.classList.add("bg-dark");
      } else {
        navbar.classList.remove("bg-dark");
      }
    }
  </script>
</body>

</html>