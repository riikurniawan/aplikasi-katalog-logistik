<?php
if (isset($_SESSION['logged_in'])) header('Location: ' . BASEURL . 'admin/dashboard')
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DiAnterin | Login</title>

    <!-- bootstrap css -->
    <link href="<?= BASEURL ?>assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- custom css -->
    <link rel="stylesheet" href="<?= BASEURL ?>assets/css/style.css" />

    <!-- fontawesome icons -->
    <link rel="stylesheet" href="<?= BASEURL ?>assets/fontawesome/css/all.min.css" />

    <!-- favicon -->
    <link rel="icon" href="<?= BASEURL ?>assets/images/logo/logo.png" type="image/x-icon" id="light-scheme-icon">
    <link rel="icon" href="<?= BASEURL ?>assets/images/logo/logo-dianterin.png" type="image/x-icon" id="dark-scheme-icon">

    <!-- custom scripts -->
    <script src="<?= BASEURL ?>assets/js/scripts.js"></script>

    <!-- vuejs cdn links -->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

    <style>
        .bg-image::before {
            content: '';
            position: absolute;
            background-image: url(assets/images/jumbo.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            height: 100svh;
            width: 100svw;
            filter: brightness(0.4);

        }

        .container {
            min-height: 100svh;
        }

        .card {
            max-width: 500px;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #ced4da;
        }
    </style>

</head>

<body>
    <div class="bg-image">
        <div class="container d-flex align-items-center">
            <div class="card mx-auto flex-grow-1 shadow">
                <h3 class="card-title text-center my-3 company-title">
                    <img src="<?= BASEURL ?>assets/images/logo/logo.png" width="80" alt=""> diAnterin
                </h3>
                <div class="card-body mb-4" id="formLogin">
                    <div class="alert alert-danger" v-if="errorMessage">
                        {{ errorMessage }}
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" v-model="loginForm.username" v-on:keyup="keymonitor" placeholder="Enter your username..." autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" v-model="loginForm.password" v-on:keyup="keymonitor" placeholder="Enter your password...">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="showPassword">
                        <label class="form-check-label" for="showPassword">Show password</label>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" name="submit" v-on:click="checkLogin()" class="px-4 py-2 rounded-5 btn btn-warning btn-login">Login <i class="fas fa-arrow-circle-right"></i> </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- bootstrap js minified -->
    <script src="<?= BASEURL ?>assets/js/bootstrap.bundle.min.js"></script>

    <!-- axios cdn links -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- sweetalert2 cdn links -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        const app = new Vue({
            el: "#formLogin",
            data: {
                errorMessage: "",
                loginForm: {
                    username: "",
                    password: "",
                }
            },
            methods: {
                keymonitor: function(event) {
                    if (event.key == 'Enter') {
                        this.checkLogin()
                    }
                },

                checkLogin: function() {
                    let login_form = this.toFormData(this.loginForm)
                    axios.post('<?= BASEURL ?>auth/login', login_form)
                        .then(function(response) {
                            if (response.data.error) {
                                app.errorMessage = response.data.message
                            } else {
                                app.errorMessage = ''
                                Swal.fire({
                                    title: response.data.message,
                                    html: "You'll be redirect in <b></b> milliseconds.",
                                    timer: 2000,
                                    timerProgressBar: true,
                                    didOpen: () => {
                                        Swal.showLoading()
                                        const b = Swal.getHtmlContainer()
                                            .querySelector('b')
                                        timerInterval = setInterval(() => {
                                            b.textContent = Swal
                                                .getTimerLeft()
                                        }, 100)
                                    },
                                    willClose: () => {
                                        clearInterval(timerInterval)
                                    }
                                }).then((result) => {
                                    if (result.dismiss === Swal.DismissReason
                                        .timer) {
                                        window.location.href = '<?= BASEURL ?>admin/dashboard';
                                    }
                                })
                                app.loginForm = {
                                    username: '',
                                    password: ''
                                }
                            }
                        })
                },
                toFormData: function(obj) {
                    let formData = new FormData()
                    for (let key in obj) {
                        formData.append(key, obj[key])
                    }
                    return formData
                },
            }
        })

        // show password
        const password_toggle = document.getElementById("showPassword")
        const password_input = document.querySelector("input[name=password]")
        password_toggle.addEventListener("click", () => {
            if (password_input.type === 'password') {
                password_input.type = "text"
            } else {
                password_input.type = "password"
            }
        })
    </script>
</body>

</html>