<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Lingkungan form login agar dapat digunakan secara penuh di dalam container -->
<div class="col-12">
    <!-- Ini adalah desain kotak pada login form -->
    <div class="formlogres col-sm col-sm8- col-md-6 offset-md-3">

        <!-- Ini adalah tempat gambar logo aswassaw yang nyempil di tengah itu muncul -->
        <center>
            <p style="font-size:28px" class="fas fa-unlock mb-2" title="Masukkan Password Baru"> Change Password</p>
            <br>
            <div class="card card-body bg-light mt-2">
                Masukkan Kata Sandi Baru Untuk <b><?= session()->get('change_password') ?></b>
            </div>
        </center>
        <br>

        <center>
            <img src="<?= base_url('assets/img/logo/logo120px.webp') ?>" title="Logo AswassawExe" height="120px" width="120px">
        </center>
        <br>

        <?php if (session()->getFlashdata('danger')) : ?>
            <br>
            <div class="alert alert-danger" role="alert">
                <?= session()->getFlashdata('danger') ?>
            </div>
        <?php endif; ?>

        <hr>
        <!-- Sebuah form dengan metode post yang akan beraksi ke / -->
        <form class="" action="<?= base_url('changePassword') ?>" method="post">
            <!-- Proteksi CSRF -->
            <?= csrf_field(); ?>
            <!-- Form group tempat memasukkan password -->
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <!-- Icon user -->
                            <i class="fas fa-lock"></i>
                        </div>
                    </div>

                    <!-- Fungsi set_value digunakan agar form yang telah diisi tidak hilang ketika halaman direfresh -->
                    <input type="password" name="password" id="password" value="<?= set_value('password') ?>" placeholder="Masukkan Kata sandi" data-toggle="tooltip" title="Form Kata sandi" class="form-control
                        <?php if (isset($validation)) { ?>
                            <?php if ($validation->hasError('password')) { ?>
                                is-invalid
                            <?php } ?>
                        <?php } ?>">

                    <?php if (isset($validation)) { ?>
                        <?php if ($validation->hasError('password')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('password') ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>

            <!-- Form group tempat memasukkan password -->
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <!-- Icon user -->
                            <i class="fas fa-lock"></i>
                        </div>
                    </div>

                    <!-- Fungsi set_value digunakan agar form yang telah diisi tidak hilang ketika halaman direfresh -->
                    <input type="password" name="password_confirm" id="password_confirm" value="<?= set_value('password_confirm') ?>" placeholder="Masukkan Konfirmasi Kata sandi" data-toggle="tooltip" title="Form Konfirmasi Kata sandi" class="form-control
                        <?php if (isset($validation)) { ?>
                            <?php if ($validation->hasError('password_confirm')) { ?>
                                is-invalid
                            <?php } ?>
                        <?php } ?>">

                    <?php if (isset($validation)) { ?>
                        <?php if ($validation->hasError('password_confirm')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('password_confirm') ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>

            <hr>

            <button type="submit" class="btn btn-success" title="Klik Untuk Login">Change Password</button>
        </form>
    </div>
</div>

<?= $this->endSection('content'); ?>