<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="card bg-light">
    <div class="card-body">
        <center>
            <h1 title="Reset Password Anda" class="fas">Reset Password Anda!</h1>
            <hr>
            <!-- Tempat alert pesan kesalahan muncul -->
            <?php if (session()->getFlashdata('danger')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('danger') ?>
                </div>
                <hr>
            <?php endif; ?>
            <h5>Kami Telah Mengirimkan Link Reset Password Untuk <strong><?= session()->get('reset_email') ?></strong>, Tolong Reset Password Anda Sebelum 30 Menit Sejak Kami Mengirimkan Email Kepada Anda.</h5>

            <p>
                <button class="btn btn-primary mt-2" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Kirim Link Reset Password Baru
                </button>
            </p>
            <div class="collapse" id="collapseExample">
                <div class="card card-body">
                    <form class="mt-3" action="<?= base_url('reset') ?>" method="post">
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
                        <button type="submit" class="btn btn-primary">
                            Kirim
                        </button>
                    </form>
                </div>
            </div>
            <hr>
        </center>
    </div>
    <center>

        <div class="row">
            <div class="col-sm">
                <h5 class="fas">Login sekarang</h5>
                <br>
                <a href="<?= base_url('/') ?>" class="btn btn-outline-success fas fa-sign-in-alt">
                    Login
                </a>
                <br><br>
            </div>
            <div class="col-sm">
                <h5 class="fas">Register sekarang</h5>
                <br>
                <a href="<?= base_url('register') ?>" class="btn btn-outline-danger fas fa-user-plus">
                    Register
                </a>
                <br><br>
            </div>
        </div>
    </center>
</div>

<?= $this->endSection('content'); ?>