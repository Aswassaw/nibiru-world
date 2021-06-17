<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="col-12">
    <!-- Kotak login -->
    <div class="formlogres col-sm col-sm8- col-md-6 offset-md-3">

        <center>
            <p style="font-size:28px" class="fas fa-sign-in-alt mb-2" title="Log-In Now"> Log-In Now</p>
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
        <!-- Sebuah form dengan metode post dengan action: routes / -->
        <form action="<?= base_url('/') ?>" method="post">
            <!-- Proteksi CSRF -->
            <?= csrf_field(); ?>
            <!-- Form username -->
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <!-- Icon username -->
                            <i class="fas fa-user"></i>
                        </div>
                    </div>

                    <input type="text" maxlength="20" name="username" id="username" value="<?= set_value('username') ?>" placeholder="Masukkan Username" data-toggle="tooltip" title="Form Username" class="form-control
                        <?php if (isset($validation)) { ?>
                            <?php if ($validation->hasError('username')) { ?>
                                is-invalid
                            <?php } ?>
                        <?php } elseif (session()->getFlashdata('belum-aktif')) { ?>
                            is-valid
                        <?php } ?>">

                    <!-- Jika terdapat validasi -->
                    <?php if (isset($validation)) { ?>
                        <!-- Jika terdapat validasi dengan nama username -->
                        <?php if ($validation->hasError('username')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('username') ?>
                            </div>
                        <?php } ?>

                        <!-- Jika terdapat flash data dengan nama belum-aktif -->
                    <?php } elseif (session()->getFlashdata('belum-aktif')) { ?>
                        <div class="valid-feedback">
                            Username benar
                        </div>
                    <?php } ?>
                </div>
            </div>

            <!-- Form Kata sandi -->
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <!-- Icon password -->
                            <i class="fas fa-unlock-alt"></i>
                        </div>
                    </div>

                    <input type="password" maxlength="100" name="password" id="password" value="<?= set_value('password') ?>" placeholder="Masukkan Kata sandi" data-toggle="tooltip" title="Form Kata sandi" class="form-control
                    <?php if (isset($validation)) { ?>
                            <?php if ($validation->hasError('password')) { ?>
                                is-invalid
                            <?php } ?>
                        <?php } elseif (session()->getFlashdata('belum-aktif')) { ?>
                            is-valid
                        <?php } ?>">

                    <!-- Jikaterdapat validasi -->
                    <?php if (isset($validation)) { ?>
                        <!-- Jika terdapat validasi dengan nama password -->
                        <?php if ($validation->hasError('password')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('password') ?>
                            </div>
                        <?php } ?>

                        <!-- Jika terdapat flash data dengan nama belum-aktif -->
                    <?php } elseif (session()->getFlashdata('belum-aktif')) { ?>
                        <div class="valid-feedback">
                            Kata sandi benar
                        </div>
                    <?php } ?>
                </div>
            </div>

            <button type="submit" class="btn btn-success" title="Klik Untuk Login">Login</button>

            <hr>

            <center>
                <div class="row">
                    <div class="col-sm">
                        <div class="mt-3" title="Buat Akun Baru?"><a class="btn btn-outline-primary fas" href="<?=base_url('register')?>" title="Register">Buat Akun Baru?</a></div>
                    </div>
                    <div class="col-sm">
                        <div class="mt-3" data-toggle="tooltip" title="Lupa Kata sandi?"><a class="btn btn-outline-danger fas" href="<?= base_url('forgotPassword') ?>" data-toggle="tooltip" title="Forgot Password">Lupa Kata Sandi?</a></div>
                    </div>
                </div>
            </center>
        </form>
    </div>
</div>

<?= $this->endSection('content'); ?>