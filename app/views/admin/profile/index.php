<?php
if (!isset($_SESSION['logged_in'])) header('Location: ' . BASEURL)
?>
<main class="layout" id="profile">
    <div class="container mt-5">
        <div class="row">
            <h3 class="card-title text-center section-title mb-3 fw-bold">
                My Profile
            </h3>
        </div>
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-lg-4 d-flex justify-content-center">
                <img src="<?= BASEURL ?>assets/images/avatar/icons8-name-96.png" class="img-thumbnail" alt="avatar">
            </div>
            <div class="col-12 col-lg-5">
                <div class="alert alert-danger" v-if="errorUpdateProfileMsg">
                    {{ errorUpdateProfileMsg }}
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" v-model="username" disabled>
                </div>
                <div class="mb-5">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="fullname" v-model="fullname" v-on:keyup.enter="keymonitor">
                </div>
                <div class=" d-flex justify-content-between flex-column flex-lg-row">
                    <button type="submit" class="btn btn-sm btn-success mb-3 mb-lg-0" v-on:click="updateProfile()"><i class="fas fa-save"></i> Update Profile</button>
                    <button type="button" class="btn btn-sm btn-primary mb-lg-0" data-bs-toggle="modal" data-bs-target="#changePasswordModal"><i class="fas fa-pencil-alt"></i> Change Password</button>
                </div>
            </div>
        </div>
    </div>
    <!-- change password modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" v-if="errorChangePasswordMsg">
                        {{ errorChangePasswordMsg }}
                    </div>
                    <div class="row mb-3">
                        <label for="old_password" class="col-sm-4 col-form-label">Old Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="old_password" v-model="old_password" v-on:keyup.enter="keymonitor">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="new_password" class="col-sm-4 col-form-label">New Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="new_password" v-model="new_password" v-on:keyup.enter="keymonitor">
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <label for="confirm_password" class="col-sm-4 col-form-label">Confirm Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="confirm_password" v-model="confirm_password" v-on:keyup.enter="keymonitor">
                        </div>
                        <div class="ml-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" v-on:click="showPassword" id="show_password">
                                <label class="form-check-label" for="show_password">Show Password</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" v-on:click="changePassword"><i class="fas fa-save"> </i> Save changes</button>
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
        el: "#profile",
        data: {
            errorUpdateProfileMsg: '',
            errorChangePasswordMsg: '',
            username: '',
            fullname: '',
            old_password: '',
            new_password: '',
            confirm_password: ''
        },
        mounted: function() {
            this.getProfile()
        },
        methods: {
            keymonitor: function(event) {
                if (event.target.name == 'fullname') {
                    this.updateProfile()
                } else if (event.target.name == 'old_password' || event.target.name == 'new_password' || event.target.name == 'confirm_password') {
                    this.changePassword()
                }
            },
            getProfile: function() {
                axios.get('<?= BASEURL ?>admin/profile/info')
                    .then(function(response) {
                        const profile = response.data.data
                        app.username = profile.username
                        app.fullname = profile.fullname
                    })
            },
            updateProfile: function() {
                axios.put('<?= BASEURL ?>admin/profile/update', {
                        fullname: app.fullname,
                    })
                    .then(function(response) {
                        if (response.data.error) {
                            app.errorUpdateProfileMsg = response.data.message
                        } else {
                            app.errorUpdateProfileMsg = ''
                            app.getProfile()
                            Swal.fire({
                                icon: 'success',
                                title: response.data.message,
                            })
                        }
                    })
            },
            showPassword: function() {
                const password_input = document.querySelectorAll('input[name$="_password"]')
                password_input.forEach(function(pw_input) {
                    if (pw_input.type === 'password') {
                        pw_input.type = "text"
                    } else {
                        pw_input.type = "password"
                    }
                })
            },
            changePassword: function() {
                axios.put('<?= BASEURL ?>admin/profile/changePassword', {
                        old_password: app.old_password,
                        new_password: app.new_password,
                        confirm_password: app.confirm_password,
                    })
                    .then(function(response) {
                        if (response.data.error) {
                            app.errorChangePasswordMsg = response.data.message
                        } else {
                            app.errorChangePasswordMsg = ''
                            app.old_password = ''
                            app.new_password = ''
                            app.confirm_password = ''

                            $(function() {
                                $('#changePasswordModal').modal('toggle');
                            });
                            Swal.fire({
                                icon: 'success',
                                title: response.data.message,
                            })
                        }
                    })
            }
        }
    })
</script>