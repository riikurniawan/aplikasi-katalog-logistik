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
                <button class="btn btn-outline-success btn-sm" v-on:click="addModal"><i class="fas fa-plus-circle"></i> Add Product</button>
            </div>
        </div>
        <div class="row mb-3 px-3">
            <label class="col col-sm-2 col-md-2 col-lg-1 col-form-label fw-bold">Filter <i class="fas fa-filter text-warning"></i></label>
            <div class="col-5 col-sm-5 col-lg-3">
                <select v-model="filter_delivery_area" id="filter_delivery_area" class="form-select" v-if="Object.keys(delivery_areas).length" v-on:change=filterProducts>
                    <option value="" selected>Delivery Area</option>
                    <option :value="delivery_area.jangkauan_pengiriman" v-for="(delivery_area,idx) in delivery_areas" :key="idx">{{ delivery_area.jangkauan_pengiriman }}</option>
                </select>
                <select v-model="filter_delivery_area" id="filter_delivery_area" class="form-select" v-else>
                    <option value="" selected disabled>Delivery Area</option>
                </select>
            </div>
            <div class="col-4 col-sm-5 col-lg-3">
                <select v-model="filter_weight" id="filter_weight" class="form-select" v-if="Object.keys(weights).length" v-on:change=filterProducts>
                    <option value="" selected>Weight</option>
                    <option :value="weight.bobot_pengiriman" v-for="(weight,idx) in weights" :key="idx">{{ weight.bobot_pengiriman }}</option>
                </select>
                <select v-model="filter_weight" id="filter_weight" v-else>
                    <option value="" selected disabled>Weight</option>
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
                            <li><a class="dropdown-item" href="#" v-on:click="editModal(idx)"><i class="fas fa-pencil-alt"></i> Edit</a></li>
                            <li>
                                <a class="dropdown-item" href="#" v-on:click="updatePublishStatus(product.id_produk, product.status_publikasi)" v-if="product.status_publikasi == 0">
                                    <i class="fas fa-check-circle"></i> Published
                                </a>
                                <a class="dropdown-item" href="#" v-on:click="updatePublishStatus(product.id_produk, product.status_publikasi)" v-else>
                                    <i class="fas fa-archive"></i> Unlisted
                                </a>
                            </li>
                            <li><a class="dropdown-item bg-danger" href="#" v-on:click="deleteProduct(product.id_produk, product.nama)"><i class="fas fa-trash"></i> Delete</a></li>
                        </ul>
                    </div>
                    <img :src="'<?= BASEURL ?>assets/images/products/' + product.gambar" class="card-img-top mx-auto" style="width:200px" :alt="product.gambar" />

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
            <p class="text-center">No products found</p>
        </div>
    </div>
    </div>

    <!-- modal product -->
    <div class="modal fade" id="productsModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModaltitle">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
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
                        <label for="product_img" class="form-label">Product Logo<span class="text-danger">*</span></label>
                        <input type="file" accept="image/jpeg, image/png" id="product_img" v-on:change="fileChange" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="product_detail_img" class="form-label">Product image<span class="text-danger">*</span></label>
                        <div class="box-upload">
                            <div class="drag-area" ref="drag_area" v-on:dragover="dragover_area" v-on:dragleave="dragleave_area" v-on:drop="dragdrop_area">
                                <span class="drag-drop-inner" ref="drag_drop_inner">Drag & Drop image here or
                                    <span class="file-select" v-on:click="browseFiles">Browse</span>
                                </span>
                                <input type="file" id="product_detail_img" v-on:change="fileInputChange" ref="product_detail_img" accept="image/jpeg, image/png" name="product_detail_img" class="file-upload" multiple>
                            </div>
                            <div class="box-preview" ref="box_preview">
                            </div>
                        </div>

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
                    <button type="submit" v-on:click="submitForm(action, productID)" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>
    </div>
</main>


<style>
    .box-upload {
        width: 100%;
        height: auto;
        padding: 15px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
        border-radius: 5px;
        overflow: hidden;
        background: #fafbff;
    }

    .drag-area {
        width: 100%;
        height: 160px;
        border-radius: 5px;
        border: 2px dashed #d5d5e1;
        color: #c8c9dd;
        font-size: 1.2em;
        position: relative;
        background: #dfe3f259;
        display: flex;
        justify-content: center;
        align-items: center;
        user-select: none;
        margin-top: 20px;
    }

    .drag-area .file-select {
        color: #5256ad;
        margin-left: 7px;
        cursor: pointer;
    }

    .drag-area .file-upload {
        display: none;
    }

    .drag-area.dragover {
        border-style: solid;
        font-size: 2rem;
        color: #c8ccdd;
        background: rgba(0, 0, 0, 0.34);
        text-align: center;
    }

    .box-preview {
        width: 100%;
        display: flex;
        justify-content: flex-start;
        align-items: flex-start;
        flex-wrap: wrap;
        position: relative;
        height: auto;
        margin-top: 20px;
        max-height: 300px;
        overflow-y: auto;
    }

    .box-preview .preview-img {
        width: 85px;
        height: 85px;
        border-radius: 5px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        position: relative;
        margin-bottom: 7px;
        margin-right: 7px;
    }

    .box-preview .preview-img:nth-child(4n) {
        margin-right: 0;
    }

    .box-preview .preview-img img {
        height: 100%;
        width: 100%;
    }

    .box-preview .preview-img span {
        background: #5256ad;
        width: 20px;
        height: 30px;
        position: absolute;
        top: -3px;
        right: 0;
        cursor: pointer;
        font-size: 22px;
        color: #fff;
        text-align: center;
        user-select: none;
    }

    .box-preview .preview-img span:hover {
        opacity: 0.8;
    }

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
<!-- sweetalert2 cdn links -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- jquery -->
<script src="<?= BASEURL ?>assets/js/jquery.min.js"></script>
<script>
    const app = new Vue({
        el: "#app",
        data: {
            products: '',
            weights: '',
            delivery_areas: '',
            filter_delivery_area: '',
            filter_weight: '',
            productID: '',
            product_name: '',
            product_desc: '',
            product_price: '',
            product_weight: '',
            delivery_area: '',
            delivery_estimate: '',
            product_img: null,
            product_publish: false,
            errorMessage: '',
            action: 'add',
            files: [],
        },
        methods: {
            browseFiles() {
                this.$refs.product_detail_img.click();
            },
            fileInputChange(event) {
                let file = this.$refs.product_detail_img.files

                for (let i = 0; i < file.length; i++) {
                    if (this.files.every(function(e) {
                            return (e.name != file[i].name);
                        })) {
                        this.files.push(file[i]);
                    }
                }

                this.showImages();
            },
            showImages() {
                let images = ''
                this.files.forEach((e, i) => {
                    images += `<div class="preview-img">
                            <img src="${URL.createObjectURL(e)}">
                            <span onclick="app.delImage(${i})">&times;</span>
                        </div>`
                })

                this.$refs.box_preview.innerHTML = images;
            },
            delImage(index) {
                this.files.splice(index, 1)
                this.showImages()
            },
            dragover_area(event) {
                event.preventDefault()
                this.$refs.drag_area.classList.add('dragover')
                this.$refs.drag_drop_inner.innerHTML = 'Drop image here'
            },
            dragleave_area(event) {
                event.preventDefault()

                this.$refs.drag_area.classList.remove('dragover')
                this.$refs.drag_drop_inner.innerHTML = '<span class="drag-drop-inner" ref="drag_drop_inner">Drag & Drop image here or <span class="file-select" onclick="app.browseFiles()">Browse</span>'
            },
            dragdrop_area(event) {
                event.preventDefault()

                this.$refs.drag_area.classList.remove('dragover')
                this.$refs.drag_drop_inner.innerHTML = '<span class="drag-drop-inner" ref="drag_drop_inner">Drag & Drop image here or <span class="file-select" onclick="app.browseFiles()">Browse</span>'

                let file = event.dataTransfer.files
                for (let i = 0; i < file.length; i++) {
                    if (this.files.every(function(e) {
                            return (e.name !== file[i].name);
                        })) {
                        this.files.push(file[i]);
                    }
                }

                this.showImages();
            },
            addModal() {
                // buka modal
                $('#productsModal').modal('toggle');

                // ubah isi modal
                $('#productsModal').find('h5#productModaltitle').text('Add Product');
                $('#productsModal').find('.modal-footer button[type="submit"]').text("Submit")
                $('#productsModal').find('label[for="product_img"]').html('Product image <span class="text-danger">*</span>')

                app.errorMessage = ''
                app.product_name = ''
                app.product_desc = ''
                app.product_price = ''
                app.product_weight = ''
                app.delivery_area = ''
                app.delivery_estimate = ''
                app.product_img = null
                app.product_publish = false
                document.getElementById('product_img').value = ""
                app.action = 'add'
            },
            editModal(idx) {
                // buka modal
                $('#productsModal').modal('toggle');

                // ubah isi modal
                $('#productsModal').find('h5#productModaltitle').text('Edit Product');
                $('#productsModal').find('.modal-footer button[type="submit"]').text("Update")
                $('#productsModal').find('label[for="product_img"]').html("Product image")

                // hapus semua isi form
                app.errorMessage = ''
                app.product_name = ''
                app.product_desc = ''
                app.product_price = ''
                app.product_weight = ''
                app.delivery_area = ''
                app.delivery_estimate = ''
                app.product_img = null
                app.product_publish = false
                document.getElementById('product_img').value = ""

                // ambil data product di index
                let product = this.products[idx]

                // set nilai data product ke form
                this.product_name = product['nama']
                this.product_desc = product['deskripsi']
                this.product_price = product['harga']
                this.product_weight = product['bobot_pengiriman']
                this.delivery_area = product['jangkauan_pengiriman']
                this.delivery_estimate = product['lama_pengiriman']
                this.product_publish = product['status_publikasi'] == 0 ? false : true
                this.productID = product['id_produk']
                this.action = 'edit'
            },
            getProducts() {
                axios.get("<?= BASEURL ?>admin/manage_products/getAllProducts")
                    .then(function(response) {
                        app.products = response.data.data
                    })
            },
            getWeights() {
                axios.get("<?= BASEURL ?>admin/manage_products/getWeights")
                    .then(function(response) {
                        app.weights = response.data.data
                    })
            },
            getDeliveryAreas() {
                axios.get("<?= BASEURL ?>admin/manage_products/getDeliveryAreas")
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
                    axios.post('<?= BASEURL ?>admin/manage_products/filterProductsBy', data)
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
            keymonitor: function(event) {
                if (event.key == 'Enter') {
                    this.submitForm(app.action)
                }
            },
            fileChange(event) {
                this.product_img = event.target.files[0]
                app.errorMessage = ''
            },
            updatePublishStatus(id, status) {
                axios.post('<?= BASEURL ?>admin/manage_products/updatePublishStatus', {
                        id_produk: id,
                        status_publikasi: status == 0 ? 1 : 0
                    })
                    .then(function(response) {
                        app.getProducts()
                        Swal.fire({
                            title: response.data.message,
                            icon: 'success'
                        })
                    })
                    .catch(function(error) {
                        if (error.response) {
                            // The request was made and the server responded with a status code
                            // that falls out of the range of 2xx
                            Swal.fire({
                                title: error.response.data.message,
                                icon: 'warning'
                            })
                        } else if (error.request) {
                            // The request was made but no response was received
                            // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                            // http.ClientRequest in node.js
                            console.log(error.request);
                        } else {
                            // Something happened in setting up the request that triggered an Error
                            console.log('Error', error.message);
                        }
                    });
            },
            deleteProduct(id, product_name) {
                let productId = id
                Swal.fire({
                    title: 'Are u sure wanna delete this product?',
                    text: `${product_name}`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yeah, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        axios.delete('<?= BASEURL ?>admin/manage_products/delete', {
                                data: {
                                    id: productId
                                },
                            })
                            .then(function(response) {
                                Swal.fire({
                                    title: response.data.message,
                                    icon: 'success'
                                })
                                app.getProducts()
                            })
                            .catch(function(error) {
                                if (error.response) {
                                    // The request was made and the server responded with a status code
                                    // that falls out of the range of 2xx
                                    Swal.fire({
                                        title: error.response.data.message,
                                        icon: 'warning'
                                    })
                                } else if (error.request) {
                                    // The request was made but no response was received
                                    // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                                    // http.ClientRequest in node.js
                                    console.log(error.request);
                                } else {
                                    // Something happened in setting up the request that triggered an Error
                                    console.log('Error', error.message);
                                }
                            });
                    } else if (
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        Swal.fire({
                            title: 'Cancelled',
                            icon: 'error'
                        })
                    }
                })
            },
            submitForm(action, id) {
                if (action == 'add') {
                    let addProductForm = new FormData()
                    this.files.forEach((val, idx) => {
                        addProductForm.append(`product_detail_image[]`, val)
                    })

                    axios.post('<?= BASEURL ?>admin/manage_products/create', addProductForm, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        })
                        .then(function(response) {
                            console.log(response.data)
                            // if (response.data.error) {
                            //     app.errorMessage = response.data.message
                            // } else {
                            //     app.errorMessage = ''
                            //     app.product_name = ''
                            //     app.product_desc = ''
                            //     app.product_price = ''
                            //     app.product_weight = ''
                            //     app.delivery_area = ''
                            //     app.delivery_estimate = ''
                            //     app.product_img = null
                            //     app.product_publish = false
                            //     document.getElementById('product_img').value = "";
                            //     $('#productsModal').modal('toggle');
                            //     Swal.fire({
                            //         icon: 'success',
                            //         title: response.data.message,
                            //     })
                            //     app.getProducts()
                            // }
                        })
                        .catch(function(error) {
                            if (error.response) {
                                // The request was made and the server responded with a status code
                                // that falls out of the range of 2xx
                                Swal.fire({
                                    title: error.response.data.message,
                                    icon: 'warning'
                                })
                            } else if (error.request) {
                                // The request was made but no response was received
                                // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                                // http.ClientRequest in node.js
                                console.log(error.request);
                            } else {
                                // Something happened in setting up the request that triggered an Error
                                console.log('Error', error.message);
                            }
                        });
                    // this.addForm()
                } else if (action == 'edit') {
                    this.editForm(id)
                }
            },
            addForm() {
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
                    this.errorMessage = 'Delivery estimate field is required'
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
                                document.getElementById('product_img').value = "";
                                $('#productsModal').modal('toggle');
                                Swal.fire({
                                    icon: 'success',
                                    title: response.data.message,
                                })
                                app.getProducts()
                            }
                        })
                        .catch(function(error) {
                            if (error.response) {
                                // The request was made and the server responded with a status code
                                // that falls out of the range of 2xx
                                Swal.fire({
                                    title: error.response.data.message,
                                    icon: 'warning'
                                })
                            } else if (error.request) {
                                // The request was made but no response was received
                                // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                                // http.ClientRequest in node.js
                                console.log(error.request);
                            } else {
                                // Something happened in setting up the request that triggered an Error
                                console.log('Error', error.message);
                            }
                        });
                }
            },
            editForm(id) {
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
                    this.errorMessage = 'Delivery estimate field is required'
                } else {
                    this.errorMessage = ''
                    let updateProductForm = new FormData()

                    updateProductForm.append("product_name", this.product_name)
                    updateProductForm.append("product_desc", this.product_desc)
                    updateProductForm.append("product_price", this.product_price)
                    updateProductForm.append("product_weight", this.product_weight)
                    updateProductForm.append("delivery_area", this.delivery_area)
                    updateProductForm.append("delivery_estimate", this.delivery_estimate)
                    updateProductForm.append("product_img", this.product_img)
                    updateProductForm.append("product_publish", this.product_publish)

                    axios.post(`<?= BASEURL ?>admin/manage_products/update/${this.productID}`, updateProductForm, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        })
                        .then(function(response) {
                            console.log(response.data)
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
                                app.productID = ''
                                document.getElementById('product_img').value = "";
                                app.getProducts()
                                $('#productsModal').modal('toggle');
                                Swal.fire({
                                    icon: 'success',
                                    title: response.data.message,
                                })
                            }
                        })
                        .catch(function(error) {
                            if (error.response) {
                                // The request was made and the server responded with a status code
                                // that falls out of the range of 2xx
                                Swal.fire({
                                    title: error.response.data.message,
                                    icon: 'warning'
                                })
                            } else if (error.request) {
                                // The request was made but no response was received
                                // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                                // http.ClientRequest in node.js
                                console.log(error.request);
                            } else {
                                // Something happened in setting up the request that triggered an Error
                                console.log('Error', error.message);
                            }
                        });
                }
            }
        },
        mounted: function() {
            this.getProducts(), this.getDeliveryAreas(), this.getWeights()
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