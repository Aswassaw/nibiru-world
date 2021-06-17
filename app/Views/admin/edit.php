<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Kotak hitam tempat foto -->
<div class="card row bg-light">
    <!-- Kotak hitam tempat identitas -->
    <div class="col-md">

        <br>

        <!-- Tulisan Ubah Data User -->
        <center>
            <h3 class="fas" title="Ubah Data User @<?= $friend['username'] ?>">Ubah Data User: @<?= $friend['username'] ?></h3>
        </center>
        <hr>

        <!-- Semua data diri user -->
        <form class="" action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-12">
                    <!-- Proteksi CSRF -->
                    <?= csrf_field(); ?>
                    <!-- Form Nama Depan -->
                    <div class="form-group">
                        <label class="fas fa-user" for="username" title="Nama Depan"> Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                            </div>

                            <!-- Fungsi set_value digunakan agar form yang telah dikirim tidak hilang ketika halaman direfresh -->
                            <input type="text" maxlength="20" name="username" id="username" value="<?= set_value('username', $friend['username']) ?>" class="form-control
                        <?php if (isset($validation)) { ?>
                            <?php if ($validation->hasError('username')) { ?>
                                is-invalid
                            <?php } else { ?>
                                is-valid
                            <?php } ?>
                        <?php } ?>" autocomplete="off">

                            <?php if (isset($validation)) { ?>
                                <?php if ($validation->hasError('username')) { ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('username') ?>
                                    </div>
                                <?php } else { ?>
                                    <div class="valid-feedback">
                                        Username Benar
                                    </div>
                                <?php } ?>
                            <?php } ?>

                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <!-- Form Nama Depan -->
                    <div class="form-group">
                        <label class="fas fa-user" for="firstname" title="Nama Depan"> Nama Depan</label>
                        <div class="input-group">

                            <!-- Fungsi set_value digunakan agar form yang telah dikirim tidak hilang ketika halaman direfresh -->
                            <input type="text" maxlength="20" name="firstname" id="firstname" value="<?= set_value('firstname', $friend['firstname']) ?>" class="form-control
                        <?php if (isset($validation)) { ?>
                            <?php if ($validation->hasError('firstname')) { ?>
                                is-invalid
                            <?php } else { ?>
                                is-valid
                            <?php } ?>
                        <?php } ?>" autocomplete="off">

                            <?php if (isset($validation)) { ?>
                                <?php if ($validation->hasError('firstname')) { ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('firstname') ?>
                                    </div>
                                <?php } else { ?>
                                    <div class="valid-feedback">
                                        Firstname Benar
                                    </div>
                                <?php } ?>
                            <?php } ?>

                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <!-- Form Nama Belakang -->
                    <div class="form-group">
                        <label class="fas fa-user" for="lastname" title="Nama Belakang"> Nama Belakang</label>
                        <div class="input-group">

                            <!-- Fungsi set_value digunakan agar form yang telah dikirim tidak hilang ketika halaman direfresh -->
                            <input type="text" maxlength="20" name="lastname" id="lastname" value="<?= set_value('lastname', $friend['lastname']) ?>" class="form-control
                        <?php if (isset($validation)) { ?>
                            <?php if ($validation->hasError('lastname')) { ?>
                                is-invalid
                            <?php } else { ?>
                                is-valid
                            <?php } ?>
                        <?php } ?>" autocomplete="off">

                            <?php if (isset($validation)) { ?>
                                <?php if ($validation->hasError('lastname')) { ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('lastname') ?>
                                    </div>
                                <?php } else { ?>
                                    <div class="valid-feedback">
                                        Lastname Benar
                                    </div>
                                <?php } ?>
                            <?php } ?>

                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <!-- Form Foto Profil -->
                    <div class="form-group">
                        <label class="fas fa-file-image" for="foto" title="Foto Profil"> Foto Profil</label>
                        <div class="input-group">

                            <!-- Fungsi set_value digunakan agar form yang telah dikirim tidak hilang ketika halaman direfresh -->
                            <input class="dropify" type="file" maxlength="20" name="foto" id="foto" data-default-file="<?= base_url('gambar/foto/' . $friend['fotoprofil']) ?>" class="form-control
                        <?php if (isset($validation)) { ?>
                            <?php if ($validation->hasError('foto')) { ?>
                                is-invalid
                            <?php } else { ?>
                                is-valid
                            <?php } ?>
                        <?php } ?>" autocomplete="off">

                            <?php if (isset($validation)) { ?>
                                <?php if ($validation->hasError('foto')) { ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('foto') ?>
                                    </div>
                                <?php } else { ?>
                                    <div class="valid-feedback">
                                        Foto Benar
                                    </div>
                                <?php } ?>
                            <?php } ?>

                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <!-- Form Deskripsi -->
                    <div class="form-group">
                        <label class="fas fa-address-card" for="description" title="Deskripsi"> Deskripsi</label><br>
                        <div class="input-group">

                            <!-- Fungsi set_value digunakan agar form yang telah dikirim tidak hilang ketika halaman direfresh -->
                            <textarea maxlength="400" name="description" id="description" cols="70" rows="5" placeholder="Tulis deskripsi tentang dirimu" class="form-control
                        <?php if (isset($validation)) { ?>
                            <?php if ($validation->hasError('description')) { ?>
                                is-invalid
                            <?php } else { ?>
                                is-valid
                            <?php } ?>
                        <?php } ?>"><?= set_value('description', $friend['description']) ?></textarea>

                            <?php if (isset($validation)) { ?>
                                <?php if ($validation->hasError('description')) { ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('description') ?>
                                    </div>
                                <?php } else { ?>
                                    <div class="valid-feedback">
                                        Description Benar
                                    </div>
                                <?php } ?>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Button Update Data -->
            <button type="submit" class="btn btn-success mb-3 fas fa-user-edit" title="Perbarui Data"> Update Data</button>

        </form>
    </div>
</div>

<?= $this->endSection('content'); ?>