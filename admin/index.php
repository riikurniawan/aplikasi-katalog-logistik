<?php
session_start();

if (isset($_SESSION['logged_in'])) {
    header("Location: /admin/home.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DiAnterin Admin - Login</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

    <style>
        .bg-image::before {
            content: '';
            position: absolute;
            background-image: url(../assets/images/jumbo.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            height: 100svh;
            width: 100svw;
            filter: brightness(0.6);

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
    <div class="bg-image" id="app">
        <div class="container d-flex align-items-center">
            <div class="card mx-auto flex-grow-1 shadow">
                <h3 class="card-title text-center my-3 company-title">
                    <img src="../assets/images/logo.png" width="80" alt=""> diAnterin
                </h3>
                <div class="card-body">
                    <form method="post" v-on:submit.prevent="submitForm" class="mb-4">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" v-model="username" placeholder="Enter your username..."
                                v-bind:class="{ error: usernameError }">
                            <span class="form-text text-danger" v-if="usernameError">{{ usernameError }}</span>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" v-model="password" placeholder="Enter your password..."
                                v-bind:class="{ error: passwordError }">
                            <span class="form-text text-danger" v-if="passwordError">{{ passwordError }}</span>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" name="submit" class=" btn btn-outline-warning">Sign in <i
                                    class="fas fa-arrow-circle-right"></i> </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        const app = new Vue({
            el: "#app",
            data: {
                username: "",
                password: "",
                usernameError: "",
                passwordError: "",
                errors: null
            },
            methods: {
                submitForm: function () {
                    if (this.validateForm()) {
                        $.ajax({
                            method: 'POST',
                            url: 'login.php',
                            dataType: "json",
                            data: {
                                username: this.username,
                                password: this.password,
                            },
                            success: (response) => {
                                if (response.success) {
                                    // redirect ke halaman selanjutnya jika berhasil login
                                    let timerInterval
                                    Swal.fire({
                                        title: 'Login Success!',
                                        html: "You'll be redirect in <b></b> milliseconds.",
                                        timer: 3000,
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
                                        /* Read more about handling dismissals below */
                                        if (result.dismiss === Swal.DismissReason
                                            .timer) {
                                            window.location.href = 'home.php';
                                        }
                                    })
                                } else {
                                    // tampilkan pesan error jika login gagal
                                    this.errors = response.errors;
                                    Swal.fire(
                                        'Login Failed!',
                                        this.errors,
                                        'error'
                                    )
                                }
                            },
                            error: (xhr, status, error) => {
                                console.log(error, xhr.responseText);
                            }
                        });
                    }
                },
                validateForm: function () {
                    this.usernameError = "";
                    this.passwordError = "";
                    if (!this.username) {
                        this.usernameError = "Username is required";
                    }
                    if (!this.password) {
                        this.passwordError = "Password is required";
                    }
                    if (this.usernameError || this.passwordError) {
                        return false;
                    }
                    return true;
                }
            }
        })
    </script>
</body>

</html>