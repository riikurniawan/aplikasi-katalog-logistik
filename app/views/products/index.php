<main class="layout" id="app">
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
        <div class="row px-3" v-if="Object.keys(products).length">
            <div class="col-md-6 col-lg-4 mb-3 px-3" v-for="(product,idx) in products" :key="idx">
                <div class="card">
                    <img :src="'<?= BASEURL ?>assets/images/products/' + product.gambar" class="card-img-top mx-auto" style="width:200px" alt="..." />
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-center"> {{ product.nama }} </h5>
                        <div class="text-truncate-container mb-3">
                            <p> {{ product.deskripsi }} </p>
                        </div>
                        <div class="d-grid">
                            <a :href="'<?= BASEURL ?>products/detail/'+product.id_produk" class="btn btn-warning border">Detail</a>
                        </div>
                    </div>
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
        },
        methods: {
            getProducts() {
                axios.get("<?= BASEURL ?>products/getAllProducts")
                    .then(function(response) {
                        app.products = response.data.data
                    })
            },
        },
        mounted: function() {
            this.getProducts()
        }
    })
</script>