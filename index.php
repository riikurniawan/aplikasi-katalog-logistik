<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>DiAnterin | Your shipment is our priority</title>

  <!-- bootstrap css -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

  <!-- custom css -->
  <link rel="stylesheet" href="/assets/css/style.css" />

  <!-- fontawesome icons -->
  <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css" />

  <!-- favicon -->
  <link rel="icon" href="/assets/images/logo.png" type="image/x-icon" id="light-scheme-icon">
  <link rel="icon" href="/assets/images/logo-dianterin.png" type="image/x-icon" id="dark-scheme-icon">

  <!-- typerjs cdn links -->
  <script async src="/assets/js/typer.js"></script>

  <!-- custom scripts -->
  <script src="/assets/js/scripts.js"></script>
</head>

<body>
  <div class="layout">

    <!-- navbar -->
    <?php include './components/navbar.php' ?>

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
      <section id="about">
        <div class="container mt-3 mb-5">
          <div class="row">
            <h3 class="card-title text-center section-title mb-3">
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

  <script src="assets/js/bootstrap.bundle.min.js"></script>
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