<?php if (!isset($_SESSION['logged_in'])) header('Location: ' . BASEURL); ?>

<main class="layout" id="app">
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
        <div class="row" v-if="Object.keys(products).length">
            <div class="col-md-6 col-lg-4 mb-3 px-3" v-for="(product,idx) in products" :key="idx">
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
                    <img :src="'<?= BASEURL ?>assets/images/products/' + product.gambar" class="card-img-top mx-auto" style="width:200px" alt="..." />

                    <div class="card-body">
                        <h5 class="card-title fw-bold text-center">{{ product.nama }}</h5>

                        <span class="badge text-bg-secondary mb-3" v-if="product.status_publikasi != 1">Not published</span>
                        <span class="badge text-bg-success mb-3" v-else>Published</span>

                        <div class="text-truncate-container mb-3">
                            <p>{{ product.deskripsi }}</p>
                        </div>
                        <div class="d-grid">
                            <a :href="'<?= BASEURL ?>admin/manage_products/detail/'+product.id_produk" class="btn btn-warning border">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" v-else>
        </div>
    </div>
    <!-- modal add product -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" v-on:submit.prevent="submitForm">
                    <div class="modal-body">
                        <div class="alert alert-danger" v-if="errorMessage">
                            {{ errorMessage }}
                        </div>
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Product name <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" id="product_name" v-on:keyup="keymonitor" v-model="product_name">
                        </div>
                        <div class=" mb-3">
                            <label for="product_desc" class="form-label">Product description <span class="text-danger">*</span> </label>
                            <textarea v-on:keyup="keymonitor" v-model="product_desc" id="product_desc" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="product_price" class="form-label">Price <span class="text-danger">*</span> </label>
                            <input type="number" v-on:keyup="keymonitor" v-model="product_price" id="product_price" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="weight" class="form-label">Weight <span class="text-danger">*</span> </label>
                            <input type="text" v-on:keyup="keymonitor" v-model="product_weight" id="product_weight" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="delivery_area" class="form-label">Delivery area <span class="text-danger">*</span> </label>
                            <input type="text" v-on:keyup="keymonitor" v-model="delivery_area" id="delivery_area" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="delivery_estimate" class="form-label">Delivery estimate <span class="text-danger">*</span> </label>
                            <input type="text" v-on:keyup="keymonitor" v-model="delivery_estimate" id="delivery_estimate" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="product_img" class="form-label">Product image <span class="text-danger">*</span> </label>
                            <input type="file" accept="image/jpeg, image/png" id="product_img" v-on:change="fileChange" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Publish?</label>
                            <div class="form-check">
                                <input class="form-check-input border border-success" type="checkbox" id="product_publish" v-model="product_publish">
                                <label class="form-check-label" for="product_publish">
                                    {{ product_publish }}
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
</main>


<style>
    body {
        padding-top: 50px;
    }

    body>.layout {
        padding-bottom: 50px;
        min-height: 500px;
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

<!-- vuejs cdn links -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<!-- axios cdn links -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    const app = new Vue({
        el: "#app",
        data: {
            products: '',
            product_name: '',
            product_desc: '',
            product_price: '',
            product_weight: '',
            delivery_area: '',
            delivery_estimate: '',
            product_img: null,
            product_publish: false,
            errorMessage: ''
        },
        methods: {
            getProducts() {
                axios.get("<?= BASEURL ?>products/getAllProducts")
                    .then(function(response) {
                        app.products = response.data.data
                    })
            },
            keymonitor: function(event) {
                if (event.key == 'Enter') {
                    this.submitForm()
                }
            },
            fileChange(event) {
                this.product_img = event.target.files[0]
                app.errorMessage = ''
            },
            submitForm() {
                if (this.product_name == "") {
                    this.errorMessage = 'Product name field is required'
                } else if (this.product_desc == "") {
                    this.errorMessage = 'Product description field is required'
                } else if (this.product_price == "") {
                    this.errorMessage = 'Product price field is required'
                } else if (this.product_weight == "") {
                    this.errorMessage = 'Product weight field is required'
                } else if (this.delivery_area == "") {
                    this.errorMessage = 'Delivery area field is required'
                } else if (this.delivery_estimate == "") {
                    this.errorMessage = 'Product price field is required'
                } else if (this.product_img == null) {
                    this.errorMessage = 'Product image field is required'
                } else {
                    this.errorMessage = ''
                    let addProductForm = new FormData()

                    addProductForm.append("product_name", this.product_name)
                    addProductForm.append("product_desc", this.product_desc)
                    addProductForm.append("product_price", this.product_price)
                    addProductForm.append("product_weight", this.product_weight)
                    addProductForm.append("delivery_area", this.delivery_area)
                    addProductForm.append("delivery_estimate", this.delivery_estimate)
                    addProductForm.append("product_img", this.product_img)
                    addProductForm.append("product_publish", this.product_publish)

                    axios.post('<?= BASEURL ?>admin/manage_products/create', addProductForm, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        })
                        .then(function(response) {
                            console.log(response.data);
                            if (response.data.error) {
                                app.errorMessage = response.data.message
                            } else {
                                app.errorMessage = ''
                                app.product_name = ''
                                app.product_desc = ''
                                app.product_price = ''
                                app.product_weight = ''
                                app.delivery_area = ''
                                app.delivery_estimate = ''
                                app.product_img = null
                                app.product_publish = false
                                $(function() {
                                    $('#addProductModal').modal('toggle');
                                });
                                Swal.fire({
                                    icon: 'success',
                                    title: response.data.message,
                                })
                                this.getProducts()
                            }
                        })
                        .catch(function(error) {
                            console.log(error)
                            if (error.response.status === 422) {
                                app.errorMessage = error.response.data.message
                            } else {
                                console.log(error);
                            }
                        });
                }
            }
        },
        mounted: function() {
            this.getProducts()
        }
    })

    // prevent user input string
    const product_price = document.getElementById('product_price');
    product_price.addEventListener('input', function(event) {
        const inputValue = event.target.value;
        const numericValue = inputValue.replace(/\D/g, '');
        event.target.value = numericValue;
    });
</script>