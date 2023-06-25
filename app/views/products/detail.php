<main class="layout" id="app">
    <div class="container mt-5">
        <div class="row">
            <h3 class="card-title text-center section-title fw-bold">
                Product Detail
            </h3>
        </div>
        <div class="row px-3">
            <div class="col-2">
                <a href="<?= BASEURL ?>products" class="btn btn-outline-warning">Back</a>
            </div>
        </div>
        <div class="row p-3" v-if="Object.keys(product).length">
            <div class="col-lg-6 mb-3" v-if="Object.keys(productImages).length">
                <swiper-container class="mySwiper rounded" pagination="true" pagination-clickable="true" navigation="true" space-between="30" centered-slides="true" autoplay-delay="2500" autoplay-disable-on-interaction="false" effect="fade" loop="true">
                    <swiper-slide v-for="(productImg,idx) in productImages" :key="idx">
                        <img :src="'<?= BASEURL ?>assets/images/products/' + productImg.file_foto" class="d-block w-100" :alt="product.gambar">
                    </swiper-slide>
                </swiper-container>
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

    swiper-container {
        max-height: 400px;
        width: 100%;
    }

    swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>

<!-- vuejs cdn links -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<!-- axios cdn links -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<!-- swiperjs cdn links -->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-element-bundle.min.js"></script>
<script>
    const app = new Vue({
        el: "#app",
        data: {
            product: '',
            productImages: ''
        },
        methods: {
            getProduct() {
                axios.get('<?= BASEURL ?>products/getProduct/<?= $data['id'] ?>')
                    .then(function(response) {
                        app.product = response.data.data
                    })
            },
            getProductImage() {
                axios.get('<?= BASEURL ?>products/getProductImages/<?= $data['id'] ?>')
                    .then(function(response) {
                        app.productImages = response.data.data
                    })
            }
        },
        mounted: function() {
            this.getProduct(), this.getProductImage()
        }
    })
</script>