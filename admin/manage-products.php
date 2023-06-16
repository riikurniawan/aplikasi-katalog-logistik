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

    <!-- vuejs cdn links -->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

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

        .action-button {
            position: absolute;
            right: 10px;
            top: 10px;
            z-index: 1;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="layout" id="app">

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
                            <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#addProductModal"><i class="fas fa-plus-circle"></i> Add Product</button>
                        </div>
                    </div>
                    <div class="row mb-3 px-3">
                        <label class="col col-sm-2 col-md-2 col-lg-1 col-form-label fw-bold">Filter <i class="fas fa-filter text-warning"></i></label>
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
                    <div class="row">
                        <div class="col-md-6 col-lg-4 mb-3 px-3">
                            <div class="card position-relative">
                                <div class="dropdown dropend">
                                    <button class="btn btn-sm action-button border border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark">
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-pencil-alt"></i> Edit</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-check-circle"></i> Published</a></li>
                                        <li><a class="dropdown-item bg-danger" href="#"><i class="fas fa-trash"></i> Delete</a></li>
                                    </ul>
                                </div>
                                <img src="<?= base_url() ?>assets/images/CUBE.png" class="card-img-top mx-auto" style="width:200px" alt="..." />

                                <div class="card-body">
                                    <h5 class="card-title fw-bold text-center">CUBE</h5>
                                    <span class="badge text-bg-secondary mb-3">Not published</span>

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
                            <div class="card position-relative">
                                <div class="dropdown dropend">
                                    <button class="btn btn-sm action-button border border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark">
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-pencil-alt"></i> Edit</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-check-circle"></i> Published</a></li>
                                        <li><a class="dropdown-item bg-danger" href="#"><i class="fas fa-trash"></i> Delete</a></li>
                                    </ul>
                                </div>
                                <img src="<?= base_url() ?>assets/images/APEX.png" class="card-img-top mx-auto" style="width:200px">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold text-center">APEX</h5>
                                    <span class="badge text-bg-secondary mb-3">Not published</span>

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
                            <div class="card position-relative">
                                <div class="dropdown dropend">
                                    <button class="btn btn-sm action-button border border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark">
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-pencil-alt"></i> Edit</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-minus-circle"></i> Unpublished</a></li>
                                        <li><a class="dropdown-item bg-danger" href="#"><i class="fas fa-trash"></i> Delete</a></li>
                                    </ul>
                                </div><img src="<?= base_url() ?>assets/images/APEX.png" class="card-img-top mx-auto" style="width:200px">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold text-center">APEX</h5>
                                    <span class="badge text-bg-success mb-3">Published</span>

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
        <!-- modal add product -->
        <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" v-on:submit.prevent="submitForm">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Product name</label>
                                <input type="text" class="form-control" id="product_name" name="product_name" v-model="productName">
                                <div class="invalid-feedback d-block" v-if="product_name_error">
                                    {{ product_name_error }}
                                </div>
                            </div>
                            <div class=" mb-3">
                                <label for="product_desc" class="form-label">Product Description</label>
                                <textarea name="product_desc" id="product_desc" class="form-control" v-model="product_desc" v-bind:class="{ error: product_desc_error }"></textarea>
                                <div class="invalid-feedback d-block" v-if="product_desc_error">
                                    {{ product_desc_error }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="product_price" class="form-label">Price</label>
                                <input type="text" name="product_price" id="product_price" class="form-control" v-model="product_price" v-bind:class="{ error: product_price_error }">
                                <div class="invalid-feedback d-block" v-if="product_price_error">
                                    {{ product_price_error }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="product_weight" class="form-label">Weight</label>
                                <input type="text" name="product_weight" id="product_weight" class="form-control" v-model="product_weight" v-bind:class="{ error: product_weight_error }">
                                <div class="invalid-feedback d-block" v-if="product_weight_error">
                                    {{ product_weight_error }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="product_delivery_area" class="form-label">Delivery Area</label>
                                <input type="text" name="product_delivery_area" id="product_delivery_area" class="form-control" v-model="product_delivery_area" v-bind:class="{ error: product_delivery_area_error }">
                                <div class="invalid-feedback d-block" v-if="product_delivery_area_error">
                                    {{ product_delivery_area_error }}
                                </div>
                            </div>
                            <!-- <div class="mb-3">
                                <label for="product_img" class="form-label">Product Image</label>
                                <input type="file" name="product_img" id="product_img" class="form-control" v-model="product_img" v-bind:class="{ error: product_img_error }">
                                <div class="invalid-feedback d-block" v-if="product_img_error">
                                    {{ product_img_error }}
                                </div>
                            </div> -->
                            <div class="mb-3">
                                <label class="form-label">Publish?</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="product_publish" v-model="product_publish">
                                    <label class="form-check-label" for="product_publish">
                                        {{product_publish}}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- footer -->
    <?php include '../components/footer.php' ?>

    <!-- bootstrap js minified -->
    <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>

    <script>
        const app = new Vue({
            el: "#app",
            data: {
                productName: "asd",
                product_name_error: "",
                product_desc: "",
                product_desc_error: "",
                product_price: "",
                product_price_error: "",
                product_weight: "",
                product_weight_error: "",
                product_delivery_area: "",
                product_delivery_area_error: "",
                product_img: "",
                product_img_error: "",
                product_publish: false
            },
            methods: {
                submitForm: function() {
                    if (this.validateForm()) {

                    }
                },
                validateForm: function() {
                    this.product_name_error = "";
                    this.product_desc_error = "";
                    this.product_price_error = "";
                    this.product_weight_error = "";
                    this.product_delivery_area_error = "";
                    if (!this.product_name) {
                        this.product_name_error = "This field is required";
                    }
                    if (!this.product_desc) {
                        this.product_desc_error = "This field is required";
                    }
                    if (!this.product_price) {
                        this.product_price_error = "This field is required";
                    }
                    if (!this.product_weight) {
                        this.product_weight_error = "This field is required";
                    }
                    if (!this.product_delivery_area) {
                        this.product_delivery_area_error = "This field is required";
                    }
                    if (this.product_name_error || this.product_desc_error || this.product_price_error || this.product_weight_error || this.product_delivery_area_error) {
                        return false;
                    }
                    return true;
                }
            }
        })
    </script>
</body>

</html>