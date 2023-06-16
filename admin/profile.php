<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: ./index.php");
}

include '../components/baseurl.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>DiAnterin | My profile</title>

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

    <!-- axios cdn links -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <style>
        body {
            padding-top: 50px;
        }

        body>.layout {
            padding-bottom: 50px;
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
                    <div class="row">
                        <h3 class="card-title text-center section-title mb-3 fw-bold">
                            My Profile
                        </h3>
                    </div>
                    <div class="row justify-content-center align-items-center">
                        <div class="col-12 col-lg-4 d-flex justify-content-center">
                            <img src="<?= base_url() ?>assets/images/icons8-name-96.png" class="img-thumbnail" alt="avatar">
                        </div>
                        <?php
                        include '../Config/Functions.php';
                        $func = new Functions();
                        $fullName = $func->getAdminInfo($_SESSION['logged_in'])["nama"];
                        ?>
                        <div class="col-12 col-lg-5">
                            <form v-on:submit.prevent="updateProfileName" method="post">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" value="<?= $_SESSION['logged_in'] ?>" disabled>
                                </div>
                                <div class="mb-5">
                                    <label for="full_name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="full_name" value="<?= $fullName ?>" v-model="full_name" v-bind:class="{ error: full_nameError }">
                                    <span class="form-text text-danger" v-if="full_nameError">{{ full_nameError }}</span>
                                </div>
                                <div class="d-flex justify-content-between flex-column flex-lg-row">
                                    <button type="submit" class="btn btn-sm btn-success mb-3 mb-lg-0"><i class="fas fa-save"></i> Update Profile Name</button>
                                    <button type="button" class="btn btn-sm btn-primary mb-lg-0" data-bs-toggle="modal" data-bs-target="#changePasswordModal"><i class="fas fa-pencil-alt"></i> Change Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="old_password" class="col-sm-4 col-form-label">Old Password</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="old_password">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="new_password" class="col-sm-4 col-form-label">New Password</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="new_password">
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <label for="confirm_password" class="col-sm-4 col-form-label">Confirm Password</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="confirm_password">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"> </i> Save changes</button>
                    </div>
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
                full_name: "<?= $fullName ?>",
                full_nameError: "",
            },
            methods: {
                updateProfileName: function() {
                    if (this.validateForm()) {
                        axios.put('http://localhost/phprest/api/admin.php', {
                                fullname: this.full_name,
                            }, {
                                headers: {
                                    'Content-Type':'application/json'
                                }
                            })
                            .then(function(response) {
                                console.log(response.data);
                            })
                            .catch(function(error) {
                                console.log(error);
                            });
                    }
                },
                validateForm: function() {
                    this.full_nameError = "";
                    if (!this.full_name) {
                        this.full_nameError = "This field is required";
                    }
                    if (this.full_nameError) {
                        return false;
                    }
                    return true;
                }
            }
        })
    </script>
</body>

</html>