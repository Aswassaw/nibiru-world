<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Kotak hitam tempat foto -->
<div class="row bg-light">
    <div class="col-md">

        <br>

        <center>
            <!-- Nama -->
            <h3 class="fas" title="Username">
                @<?= $user['username'] ?>
            </h3>
        </center>
        <hr>

        <!-- Foto profil -->
        <div class="fotoprofile">
            <center>
                <img src="<?= base_url('gambar/foto/' . $user['fotoprofil']) ?>" alt="image" class="img-fluid rounded-circle shadow" title="Foto Profil">

                <br><br>

                <!-- Button Ubah foto profil -->
                <button type="button" class="btn btn-success mb-5 fas fa-edit" data-toggle="modal" data-target="#modalFoto" title="Ubah Foto">
                    Ubah
                </button>
            </center>
        </div>
    </div>

    <!-- Kotak hitam tempat identitas -->
    <div class="col-md">

        <br>

        <!-- Tulisan Data Diri Anda -->
        <center>
            <h3 class="fas" title="Data Diri Anda">Data Diri Anda</h3>
        </center>
        <hr>

        <!-- Semua data diri user -->
        <form class="" action="<?= base_url('profile') ?>" method="post">
            <div class="row">
                <div class="col-12">
                    <!-- Proteksi CSRF -->
                    <?= csrf_field(); ?>
                    <!-- Form Username -->
                    <div class="form-group">
                        <label class="fas fa-user" for="username" title="Username"> Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                            </div>

                            <!-- Fungsi set_value digunakan agar form yang telah dikirim tidak hilang ketika halaman direfresh -->
                            <input type="text" maxlength="20" name="username" id="username" value="<?= set_value('username', $user['username']) ?>" class="form-control
                        <?php if (isset($validation)) { ?>
                            <?php if ($validation->hasError('username')) { ?>
                                is-invalid
                            <?php } else { ?>
                                is-valid
                            <?php } ?>
                        <?php } ?>" autocomplete="off" required>

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
                            <input type="text" maxlength="20" name="firstname" id="firstname" value="<?= set_value('firstname', $user['firstname']) ?>" class="form-control
                        <?php if (isset($validation)) { ?>
                            <?php if ($validation->hasError('firstname')) { ?>
                                is-invalid
                            <?php } else { ?>
                                is-valid
                            <?php } ?>
                        <?php } ?>" autocomplete="off" required>

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
                            <input type="text" maxlength="20" name="lastname" id="lastname" value="<?= set_value('lastname', $user['lastname']) ?>" class="form-control
                        <?php if (isset($validation)) { ?>
                            <?php if ($validation->hasError('lastname')) { ?>
                                is-invalid
                            <?php } else { ?>
                                is-valid
                            <?php } ?>
                        <?php } ?>" autocomplete="off" required>

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
                    <!-- Form Email -->
                    <div class="form-group">
                        <label class="fas fa-envelope" for="email" title="Email"> Email</label>
                        <div class="input-group">

                            <!-- Fungsi set_value digunakan agar form yang telah dikirim tidak hilang ketika halaman direfresh -->
                            <input readonly name="email" id="email" value="<?= $user['email'] ?>" class="form-control
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
                                        Email Benar
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
                        <?php } ?>"><?= set_value('description', $user['description']) ?></textarea>

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
                <div class="col-12 col-sm-6">
                    <!-- Form Kata Sandi -->
                    <div class="form-group">
                        <label class="fas fa-lock" for="password" title="Kata Sandi"> Kata Sandi</label>
                        <div class="input-group">

                            <input type="password" maxlength="100" name="password" id="password" class="form-control
                        <?php if (isset($validation)) { ?>
                            <?php if ($validation->hasError('password')) { ?>
                                is-invalid
                            <?php } else { ?>
                                is-valid
                            <?php } ?>
                        <?php } ?>" autocomplete="off">

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
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label class="fas fa-lock" for="password_confirm" title="Konfirmasi Kata Sandi"> Konfirmasi</label>
                        <div class="input-group">

                            <input type="password" name="password_confirm" id="password_confirm" class="form-control
                        <?php if (isset($validation)) { ?>
                            <?php if ($validation->hasError('password_confirm')) { ?>
                                is-invalid
                            <?php } else { ?>
                                is-valid
                            <?php } ?>
                        <?php } ?>" autocomplete="off">

                            <?php if (isset($validation)) { ?>
                                <?php if ($validation->hasError('password_confirm')) { ?>
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
                </div>
                <div class="col-12 mb-3">
                    *Note: Jika anda mengosongkan form Kata Sandi, maka Kata Sandi anda tidak akan berubah.
                </div>
            </div>

            <!-- Button Update Data -->
            <button type="submit" class="btn btn-success mb-3 fas fa-user-edit" title="Perbarui Data"> Update Data</button>

        </form>
    </div>
</div>

<br>

<?php if ($friend_demo) { ?>
    <div class="card card-body">
        <div class="row">
            <div class="col-sm">
                <div style="font-size: 18px;">Daftar Teman (<?= $friend_count ?>)
                    <a href="<?= base_url('friendList/' . $user['slug_users']) ?>" type="submit" class="float-right" data-toggle="tooltip" title="Lihat Semua Teman"> Lihat Semua Teman</a></div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <?php foreach ($friend_demo as $frd_dm) : ?>
                    <div class="col-sm-3">
                        <div class="card">
                            <a class="teman" href="<?= base_url('friendPage/' . $frd_dm['slug_users']) ?>">
                                <div class="card-body"> <img class="mr-2 rounded-circle" alt="image" height="50px" width="50px" src="<?= base_url('gambar/foto/' . $frd_dm['fotoprofil']) ?>"> @<?= substr($frd_dm['username'], 0, 7) ?><?php if (strlen($frd_dm['username']) > 7) { ?>...<?php } ?>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="card card-body">
        <div class="row">
            <div class="col-sm">
                <div style="font-size: 18px;" title="Daftar Teman">Daftar Teman</div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h3 title="Tidak Ada Status">
                Anda Belum Memiliki Teman
                <hr>
                <a class="btn btn-success fas fa-search" href="<?= base_url('friend') ?>"> Mulailah Cari Teman!</a>
            </h3>
        </div>
    </div>
<?php } ?>

<br><br>

<!-- Jika user belum membuat status apapun -->
<?php if ($status == null) { ?>
    <div class="card bg-light">
        <div class="card-body">
            <h1 title="Tidak Ada Status">Anda Belum Membuat Status Apapun</h1>
            <hr>
            <button type="button" class="btn btn-success fas fa-pen" data-toggle="modal" data-target="#modalStatus" title="Buat Status">
                Buat Status
            </button>
        </div>
    </div>

    <!-- Jika user sudah membuat status -->
<?php } else { ?>
    <div class="col-sm mt-3">
        <!-- Mengurutkan status secara terbalik -->
        <?php rsort($status);
        // Menghitung semua status yang ada
        $jumlah = count($status); ?>

        <!-- Button buat status -->
        <button type="button" class="btn btn-success mb-3 fas fa-pen" data-toggle="modal" data-target="#modalStatus" title="Buat Status">
            Buat Status
        </button>

        <!-- Jumlah status yang ada -->
        <h4 title="Jumlah Status Yang Ada">
            <center>
                Anda memiliki <?= $jumlah ?> Status
            </center>
        </h4>

        <!-- Semua post yang dibuat user akan diprint di sini -->
        <?php foreach ($status as $sts) : ?>

            <br>

            <!-- Foto profil -->
            <img src="<?= base_url('gambar/foto/' . $user['fotoprofil']) ?>" alt="image" title="Foto Profil User" class="rounded-circle" height="60px" width="60px">
            <b title="Pembuat Komentar">
                @<?= $user['username'] ?>
            </b>

            <div class="card bg-light mt-2">
                <div class="card-header">
                    <!-- Diposting pada -->
                    <p class="card-subtitle mb-2 mt-1" title="Tanggal Diposting">Pada <?= $sts['status-created_at'] ?></p>
                </div>

                <div class="card-body">
                    <?php if ($sts['type'] == 'biasa') { ?>
                        <!-- Isi status -->
                        <p class="card-text" title="Isi Status"><?= $sts['status'] ?></p>
                        <?php if ($sts['gambar_status'] != null) { ?>
                            <hr>
                            <center>
                                <img class="img-fluid" src="<?= base_url('gambar/gambar_status/' . $sts['gambar_status']) ?>" title="Gambar Status">
                            </center>
                        <?php } ?>
                    <?php } else { ?>
                        <!-- Menentukan ukuran font -->
                        <?php if (strlen($sts['status']) <= 100) {
                            $ukuran_font = 25;
                        } elseif (strlen($sts['status']) <= 250) {
                            $ukuran_font = 21;
                        } elseif (strlen($sts['status']) <= 500) {
                            $ukuran_font = 17;
                        } ?>

                        <div style=" background-image: url('../../../gambar/gambar_status/<?= $sts['gambar_status'] ?>'); font-size: <?= $ukuran_font ?>px;" class="card card-body bg-light">
                            <center>
                                <div class="text-status-background">
                                    <?= $sts['status'] ?>
                                </div>
                            </center>
                        </div>
                    <?php } ?>
                    <hr>
                    <div style="font-family: calibri;"><button style="font-weight: bold;" type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalLike<?= $sts['id_status'] ?>"><?= $sts['like'] ?> Suka</button> dan <a href="<?= base_url('comment/' . $sts['slug_status']) ?>" style="font-weight: bold;" class="btn btn-outline-success"><?= $sts['comment'] ?> Komentar</a></div>

                    <!-- Modal penampilan orang yang like -->
                    <div class="modal fade" id="modalLike<?= $sts['id_status'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">User Yang Menyukai</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php if ($sts['like'] != 0) { ?>
                                        <?php foreach ($like as $lk) : ?>
                                            <?php if ($lk['id_status-likestatus'] == $sts['id_status']) { ?>
                                                <div class="card my-3">
                                                    <a class="teman" href="<?= base_url('friendPage/' . $lk['slug_users']) ?>">
                                                        <div class="card-body"> <img class="mr-2 rounded-circle" alt="image" height="50px" width="50px" src="<?= base_url('gambar/foto/' . $lk['fotoprofil']) ?>"> @<?= $lk['username'] ?>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        <?php endforeach; ?>
                                    <?php } else { ?>
                                        <div class="card bg-light mt-4">
                                            <div class="card-body">
                                                <h4 title="Tidak ada yang menyukai">
                                                    Tidak ada yang menyukai status ini.
                                                </h4>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Tombol Like -->
                    <?php if ($sts['sudah_like'] == true) { ?>
                        <button href="<?= base_url('likeStatus/' . $sts['id_status']) ?>" class="btn btn-primary fas fa-thumbs-up tombol-like" title="Like"> </button>
                    <?php } else { ?>
                        <button href="<?= base_url('likeStatus/' . $sts['id_status']) ?>" class="btn btn-secondary fas fa-thumbs-up tombol-like" title="Like"> </button>
                    <?php } ?>

                    <!-- Comment -->
                    <a href="<?= base_url('comment/' . $sts['slug_status']) ?>" class="btn btn-success fas fa-comment ml-1 tombol-comment" title="Komentar"> </a>

                    <!-- Tombol hapus -->
                    <button name="tombol-hapus-status" href="<?= base_url('deleteStatus/' . $sts['id_status']) ?>" class="btn btn-danger ml-1 fas fa-trash-alt hapus" title="Hapus"> </button>

                    <!-- Share ke fb -->
                    <a class="btn btn-primary ml-1 fab fa-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?= base_url('comment/' . $sts['id_status']) ?>" target="_blank" title="Bagikan Ke Facebook"> </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php } ?>

<?= $this->endSection('content'); ?>