<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Lingkungan form login agar dapat digunakan secara penuh di dalam container -->
<div class="col-12">
    <!-- Ini adalah desain kotak pada login form -->
    <div class="formlogres col-sm col-sm8- col-md-6 offset-md-3">

        <!-- Ini adalah tempat gambar logo aswassaw yang nyempil di tengah itu muncul -->
        <center>
            <p style="font-size:28px" class="fas fa-unlock mb-2" title="Forgot Password"> Forgot Password</p>
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
        <form class="" action="<?= base_url('forgotPassword') ?>" method="post">
            <!-- Proteksi CSRF -->
            <?= csrf_field(); ?>
            <!-- Form group tempat memasukkan email -->
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <!-- Icon user -->
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>

                    <!-- Fungsi set_value digunakan agar form yang telah diisi tidak hilang ketika halaman direfresh -->
                    <input type="email" name="email" id="email" value="<?= set_value('email') ?>" placeholder="Masukkan Email" data-toggle="tooltip" title="Form Email" class="form-control
                        <?php if (isset($validation)) { ?>
                            <?php if ($validation->hasError('email')) { ?>
                                is-invalid
                            <?php } ?>
                        <?php } elseif (session()->getFlashdata('belum-aktif')) { ?>
                            is-valid
                        <?php } ?>">

                    <?php if (isset($validation)) { ?>
                        <?php if ($validation->hasError('email')) { ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('email') ?>
                            </div>
                        <?php } ?>
                    <?php } elseif (session()->getFlashdata('belum-aktif')) { ?>
                        <div class="valid-feedback">
                            Email benar
                        </div>
                    <?php } ?>
                </div>
            </div>

            <button type="submit" class="btn btn-success" title="Klik Untuk Mengirim">Submit</button>

            <hr>

            <center>
                <div class="row">
                    <div class="col-sm">
                        <div class="mt-2" data-toggle="tooltip"><a class="btn btn-outline-warning fas" href="<?= base_url('/') ?>" data-toggle="tooltip" title="Kembali Ke Login">Kembali Ke Login</a></div>
                    </div>
                </div>
            </center>

        </form>
    </div>
</div>

<?= $this->endSection('content'); ?>