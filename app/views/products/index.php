<main class="layout" id="app">
    <div class="container mt-5">
        <h3 class="card-title text-center section-title mb-3 fw-bold"> Product</h3>
        <div class="row mb-4 mx-3">
            <label class="col-4 col-sm-2 col-md-4  col-form-label fw-bold">Filter <i class="fas fa-filter text-warning"></i></label>
            <div class="col-8 col-sm-4 col-md-4 col-lg-3 mb-3">
                <select v-model="filter_delivery_area" id="filter_delivery_area" class="form-select" v-if="Object.keys(delivery_areas).length" v-on:change=filterProducts>
                    <option value="" selected>Delivery Area</option>
                    <option :value="delivery_area.jangkauan_pengiriman" v-for="(delivery_area,idx) in delivery_areas" :key="idx">{{ delivery_area.jangkauan_pengiriman }}</option>
                </select>
                <select v-model="filter_delivery_area" id="filter_delivery_area" class="form-select" v-else>
                    <option value="" selected disabled>Delivery Area</option>
                </select>
            </div>
            <div class="col col-sm-5 col-md-4 col-lg-3">
                <select v-model="filter_weight" id="filter_weight" class="form-select" v-if="Object.keys(weights).length" v-on:change=filterProducts>
                    <option value="" selected>Weight</option>
                    <option :value="weight.bobot_pengiriman" v-for="(weight,idx) in weights" :key="idx">{{ weight.bobot_pengiriman }}</option>
                </select>
                <select v-model="filter_weight" id="filter_weight" class="form-select" v-else>
                    <option value="" selected disabled>Weight</option>
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
        <div class="row px-3" v-else>
            <p class="text-center">No Product found</p>
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
            weights: '',
            delivery_areas: '',
            filter_delivery_area: '',
            filter_weight: '',
        },
        methods: {
            getProducts() {
                axios.get("<?= BASEURL ?>products/getAllProducts")
                    .then(function(response) {
                        app.products = response.data.data
                    })
            },
            getWeights() {
                axios.get("<?= BASEURL ?>products/getWeights")
                    .then(function(response) {
                        app.weights = response.data.data
                    })
            },
            getDeliveryAreas() {
                axios.get("<?= BASEURL ?>products/getDeliveryAreas")
                    .then(function(response) {
                        app.delivery_areas = response.data.data
                    })
            },
            filterProducts: function(event) {
                if (event.target.id === 'filter_delivery_area') {
                    this.filter_delivery_area = event.target.value
                } else if (event.target.id === 'filter_weight') {
                    this.filter_weight = event.target.value
                }

                if (this.filter_delivery_area != "" || this.filter_weight != "") {
                    let data = {
                        delivery_area: this.filter_delivery_area,
                        weight: this.filter_weight
                    }
                    axios.post('<?= BASEURL ?>products/filterProductsBy', data)
                        .then(function(response) {
                            if (response.data.data.length != 0) {
                                app.products = response.data.data
                            } else {
                                app.products = ''
                            }
                        }).catch(function(error) {
                            if (error.response) {
                                // The request was made and the server responded with a status code
                                // that falls out of the range of 2xx
                                console.log(error.response.data);
                                console.log(error.response.status);
                                console.log(error.response.headers);
                            }
                        })
                } else {
                    this.getProducts()
                }
            },
        },
        mounted: function() {
            this.getProducts(), this.getDeliveryAreas(), this.getWeights()
        }
    })
</script>