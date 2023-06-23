<?php if (!isset($_SESSION['logged_in'])) header('Location: ' . BASEURL); ?>

<main id="app">
    <div class="container mt-5">
        <div class="row">
            <h3 class="card-title text-center section-title fw-bold">
                Product Detail
            </h3>
        </div>
        <div class="row px-3">
            <div class="col-2">
                <a href="<?= BASEURL ?>admin/manage_products" class="btn btn-outline-warning">Back</a>
            </div>
        </div>
        <div class="row p-3" v-if="Object.keys(product).length">
            <div class="col-lg-6 mb-3">
                <div id="carouselProductControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner rounded">
                        <div class="carousel-item active">
                            <img :src="'<?= BASEURL ?>assets/images/products/' + product.gambar" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img :src="'<?= BASEURL ?>assets/images/products/' + product.gambar" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img :src="'<?= BASEURL ?>assets/images/products/' + product.gambar" class="d-block w-100" alt="...">
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
                    {{ product.nama }}
                </h3>
                <div>
                    <p class="text-center">
                        {{ product.deskripsi }}
                    </p>
                </div>
                <div>
                    <div class="d-flex flex-column text-center">
                        <i class="far fa-clock text-warning fw-bold fs-4 my-3"></i>
                        <span> {{ product.lama_pengiriman }} </span>
                    </div>
                    <div class="d-flex flex-column text-center">
                        <i class="fas fa-map-marker-alt text-warning fw-bold fs-4 my-3"></i>
                        <span> {{ product.jangkauan_pengiriman }} </span>
                    </div>
                    <div class="d-flex flex-column text-center">
                        <i class="fas fa-tag text-warning fw-bold fs-4 my-3"></i>
                        <span> {{ product.harga }} </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row p-3" v-else>
            <p class="text-center">No product found</p>
        </div>
    </div>
</main>
</div>
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
</style>

<!-- vuejs cdn links -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<!-- axios cdn links -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    const app = new Vue({
        el: "#app",
        data: {
            product: ''
        },
        methods: {
            getProduct() {
                axios.get('<?= BASEURL ?>products/getProduct/<?= $data['id'] ?>')
                    .then(function(response) {
                        app.product = response.data.data
                    })
            }
        },
        mounted: function() {
            this.getProduct()
        }
    })
</script>