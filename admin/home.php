<?php 
session_start();
if (!isset($_SESSION['logged_in'])) {
  header("Location: ./index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>DiAnterin | Kiriman Anda Prioritas Kami</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css" />
    <script async src="https://unpkg.com/typer-dot-js@0.1.0/typer.js"></script>
  </head>

  <body>
    <div class="layout">
      <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="navbar">
        <div class="container-fluid">
          <a class="navbar-brand company-title" href="#">
            <img
              src="../assets/images/logo-dianterin.png"
              alt="Logo"
              width="50"
              height="34"
              class="d-inline-block align-text-top"
            />
            diAnterin
          </a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto">
              <li class="nav-item mx-3">
                <a class="nav-link" href="#">Home</a>
              </li>
              <li class="nav-item mx-3">
                <a class="nav-link" href="#">Our Services</a>
              </li>
              <li class="nav-item mx-3">
                <a class="nav-link" href="#about">About Us</a>
              </li>
            </ul>
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0 avatar">
              <span
                class="text-white"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                ><img
                  src="../assets/images/icons8-name-48.png"
                  alt="admin avatar" />
                <?= $_SESSION['logged_in'] ?> <i class="fas fa-chevron-down"></i
              ></span>

              <ul class="dropdown-menu avatar-dropdown">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="./logout.php">Logout</a></li>
              </ul>
            </ul>
          </div>
        </div>
      </nav>

      <main>
        <section class="main-content">
          <div class="bg-main"></div>
          <div
            class="position-absolute start-50 top-50 translate-middle text-white"
          >
            <h3 class="fs-1 text-center mb-4">
              Your Shipment is Our
              <br /><span
                class="typer text-white"
                id="main"
                data-words="Priority!,Responsible!"
                data-delay="100"
                data-deleteDelay="1000"
              ></span>
              <span class="cursor" data-owner="main"></span>
            </h3>
            <div
              class="d-flex justify-content-around flex-column d-sm-flex flex-md-row"
            >
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
                <img
                  src="../assets/images/company.jpg"
                  alt="company images"
                  class="img-fluid rounded"
                />
              </div>
              <div
                class="col-md-6 col-lg-7 d-flex align-items-center flex-column my-3"
              >
                <div class="d-flex align-items-center">
                  <img
                    src="../assets/images/logo.png"
                    alt="company logo"
                    height="80"
                  />
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

        <section class="bg-dark text-white" id="contact">
          <div class="container">
            <div class="row">
              <h3 class="card-title text-center my-3">Contact Us</h3>
              <div class="col-md-6 mb-sm-5">
                <form>
                  <div class="mb-3">
                    <input
                      type="text"
                      class="form-control"
                      id="name"
                      placeholder="Name.."
                    />
                  </div>
                  <div class="mb-3">
                    <input
                      type="email"
                      class="form-control"
                      id="email"
                      placeholder="Email.."
                    />
                  </div>
                  <div class="mb-3">
                    <input
                      type="tel"
                      class="form-control"
                      id="phone_number"
                      placeholder="Phone"
                    />
                  </div>
                  <div class="mb-4">
                    <textarea
                      name=""
                      id="message"
                      rows="10"
                      class="form-control"
                      placeholder="Message.."
                    ></textarea>
                  </div>
                  <div class="d-grid gap-2">
                    <button
                      type="submit"
                      class="btn btn-outline-warning btn-sm font-weight-bold"
                    >
                      <span class="far fa-paper-plane"></span> Submit
                    </button>
                  </div>
                </form>
              </div>
              <div class="col-md-6">
                <div class="d-block mb-3">
                  <div class="row">
                    <div
                      class="col-2 d-flex justify-content-center align-items-center"
                    >
                      <div
                        class="rounded bg-light d-flex justify-content-center align-items-center"
                        style="width: 30px; height: 30px"
                      >
                        <i class="fas fa-location-arrow text-warning"></i>
                      </div>
                    </div>
                    <div class="col">
                      <span>
                        Batam Centre, Jl. Ahmad Yani, Tlk. Tering, Kec. Batam
                        Kota, Kota Batam, Kepulauan Riau 29461
                      </span>
                    </div>
                  </div>
                </div>
                <div class="d-block mb-3">
                  <div class="row">
                    <div
                      class="col-2 d-flex justify-content-center align-items-center"
                    >
                      <div
                        class="rounded bg-light d-flex justify-content-center align-items-center"
                        style="width: 30px; height: 30px"
                      >
                        <i class="fas fa-phone text-warning"></i>
                      </div>
                    </div>
                    <div class="col">
                      <span> 0895621546938 </span>
                    </div>
                  </div>
                </div>
                <div class="d-block mb-3">
                  <div class="row">
                    <div
                      class="col-2 d-flex justify-content-center align-items-center"
                    >
                      <div
                        class="rounded bg-light d-flex justify-content-center align-items-center"
                        style="width: 30px; height: 30px"
                      >
                        <i class="fas fa-at text-warning"></i>
                      </div>
                    </div>
                    <div class="col">
                      <span> dianterinaja@gmail.com </span>
                    </div>
                  </div>
                </div>
                <div class="d-block mb-3">
                  <div class="row">
                    <div
                      class="col-2 d-flex justify-content-center align-items-center"
                    >
                      <div
                        class="rounded bg-light d-flex justify-content-center align-items-center"
                        style="width: 30px; height: 30px"
                      >
                        <i class="fab fa-instagram text-warning"></i>
                      </div>
                    </div>
                    <div class="col d-flex flex-column">
                      <span> @ydnic_jly</span>
                      <span> @putri_nrah</span>
                      <span> @arikurniawan.dev</span>
                      <span> @adithya_rhmdita</span>
                      <span> @ahannpjr1402_</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </main>
    </div>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script>
      window.onscroll = function () {
        scrollFunction();
      };

      let navbar = document.getElementById("navbar");

      function scrollFunction() {
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
