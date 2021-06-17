<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="col-12">
    <!-- Kotak register -->
    <div class="formlogres col-sm col-sm8- col-md-6 offset-md-3">

        <center>
            <p style="font-size:28px" class="fas fa-user-plus mb-2" title="Register Now"> Register Now</p>
        </center>
        <br>

        <center>
            <img src="<?= base_url('assets/img/logo/logo120px.webp') ?>" title="Logo AswassawExe" height="120px" width="120px">
        </center>
        <br>

        <!-- Tempat alert pesan kesalahan muncul -->
        <?php if (session()->getFlashdata('danger')) : ?>
            <br>
            <div class="alert alert-danger" role="alert">
                <?= session()->getFlashdata('danger') ?>
            </div>
        <?php endif; ?>

        <hr>
        <!-- Sebuah form dengan metode post dengan action: routes register -->
        <form class="" action="<?= base_url('register') ?>" method="post">
            <!-- Proteksi CSRF -->
            <?= csrf_field(); ?>
            <!-- Form Username -->
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <!-- Icon user -->
                            <i class="fas fa-user"></i>
                        </div>
                    </div>

                    <input type="text" maxlength="20" name="username" id="username" value="<?= set_value('username') ?>" placeholder="Masukkan Username" data-toggle="tooltip" title="Form Username" class="form-control
                        <?php if (isset($validation)) { ?>
                            <?php if ($validation->hasError('username')) { ?>
                                is-invalid
                            <?php } else { ?>
                                is-valid
                            <?php } ?>
                        <?php } ?>">

                    <!-- Jika terdapat validation -->
                    <?php if (isset($validation)) { ?>
                        <!-- Jika terdapat validation dengan nama username -->
                        <?php if ($validation->hasError('username')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('username') ?>
                            </div>

                            <!-- Jika tidak terdapat validation dengan nama username -->
                        <?php } else { ?>
                            <div class="valid-feedback">
                                Username Benar
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>

            <!-- Form Email -->
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <!-- Icon email -->
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>

                    <input type="email" maxlength="100" name="email" id="email" value="<?= set_value('email') ?>" placeholder="Masukkan Email" data-toggle="tooltip" title="Form Email" class="form-control
                        <?php if (isset($validation)) { ?>
                            <?php if ($validation->hasError('email')) { ?>
                                is-invalid
                            <?php } else { ?>
                                is-valid
                            <?php } ?>
                        <?php } ?>">

                    <?php if (isset($validation)) { ?>
                        <?php if ($validation->hasError('email')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('email') ?>
                            </div>
                        <?php } else { ?>
                            <div class="valid-feedback">
                                Email benar
                            </div>
                        <?php } ?>
                    <?php } ?>

                </div>
            </div>

            <!-- Form Password -->
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <!-- Icon password -->
                            <i class="fas fa-lock"></i>
                        </div>
                    </div>

                    <input type="password" maxlength="100" name="password" id="password" value="<?= set_value('password') ?>" placeholder="Masukkan Kata sandi" data-toggle="tooltip" title="Form Kata sandi" class="form-control
                        <?php if (isset($validation)) { ?>
                            <?php if ($validation->hasError('password')) { ?>
                                is-invalid
                            <?php } else { ?>
                                is-valid
                            <?php } ?>
                        <?php } ?>">

                    <?php if (isset($validation)) { ?>
                        <?php if ($validation->hasError('password')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('password') ?>
                            </div>
                        <?php } else { ?>
                            <div class="valid-feedback">
                                Kata sandi benar
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>

            <!-- Form Konfirmasi Password -->
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <!-- Icon password -->
                            <i class="fas fa-lock"></i>
                        </div>
                    </div>

                    <input type="password" maxlength="100" name="password_confirm" id="password_confirm" value="<?= set_value('password_confirm') ?>" placeholder="Masukkan Konfirmasi Kata sandi" data-toggle="tooltip" title="Form Konfirmasi Kata sandi" class="form-control
                        <?php if (isset($validation)) { ?>
                            <?php if ($validation->hasError('password_confirm') or set_value('password_confirm') == null) { ?>
                                is-invalid
                            <?php } else { ?>
                                is-valid
                            <?php } ?>
                        <?php } ?>">

                    <?php if (isset($validation)) { ?>
                        <?php if ($validation->hasError('password_confirm') or set_value('password_confirm') == null) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('password_confirm') ?>
                            </div>
                        <?php } else { ?>
                            <div class="valid-feedback">
                                Konfirmasi Kata sandi benar
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>

            <button type="submit" class="btn btn-success" data-toggle="tooltip" title="Klik Untuk Register">Register</button>

            <hr>

            <center>
                <div class="row">
                    <div class="col-sm">
                        <div class="mt-2" data-toggle="tooltip"><a class="btn btn-outline-primary fas" href="<?= base_url('/') ?>" data-toggle="tooltip" title="Sudah Memiliki Akun?">Sudah Memiliki Akun?</a></div>
                    </div>
                </div>
            </center>

        </form>
    </div>
</div>

<?= $this->endSection('content'); ?>