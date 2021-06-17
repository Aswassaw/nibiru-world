<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Kotak hitam tempat foto -->
<div class="row bg-light">
    <div class="col-md">

        <br>

        <!-- Nama -->
        <center>
            <h3 class="fas" title="Nama User">
                @<?= $friend['username'] ?>
            </h3>
        </center>
        <hr>

        <!-- Foto profil -->
        <div class="fotoprofile">
            <center>
                <img src="<?= base_url('gambar/foto/' . $friend['fotoprofil']) ?>" alt="image" class="img-fluid rounded-circle shadow" title="Foto Profil">
            </center>
        </div>

        <br>

    </div>

    <!-- Kotak hitam tempat identitas -->
    <div class="col-md">

        <br>

        <!-- Data diri user -->
        <center>
            <h3 class="fas" title="Data Diri User">Data Diri
                @<?= $friend['username'] ?>
            </h3>
        </center>
        <hr>

        <!-- Semua data diri user -->
        <form class="" action="<?= base_url('profile') ?>" method="post">
            <div class="row">
                <div class="col-12">
                    <!-- Form Username -->
                    <div class="form-group">
                        <label class="fas fa-user" for="username" title="Nama Depan"> Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <!-- Fungsi set_value digunakan agar form yang telah dikirim tidak hilang ketika halaman direfresh -->
                            <input type="text" class="form-control" readonly name="username" id="username" value="<?= $friend['username'] ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <!-- Form Nama Depan -->
                    <div class="form-group">
                        <label class="fas fa-user" for="firstname" title="Nama Depan"> Depan</label>
                        <!-- Fungsi set_value digunakan agar form yang telah diisi tidak hilang ketika halaman direfresh -->
                        <input type="text" class="form-control" readonly name="firstname" id="firstname" value="<?= $friend['firstname'] ?>">
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <!-- Form Nama Belakang -->
                    <div class="form-group">
                        <label class="fas fa-user" for="lastname" title="Nama Belakang"> Belakang</label>
                        <!-- Fungsi set_value digunakan agar form yang telah diisi tidak hilang ketika halaman direfresh -->
                        <input type="text" class="form-control" readonly name="lastname" id="lastname" value="<?= $friend['lastname'] ?>">
                    </div>
                </div>
                <div class="col-12">
                    <!-- Form Nama Email -->
                    <div class="form-group">
                        <label class="fas fa-envelope" for="email" title="Email"> Email</label>
                        <!-- Fungsi set_value digunakan agar form yang telah diisi tidak hilang ketika halaman direfresh -->
                        <input class="form-control" readonly name="email" id="email" value="<?= $friend['email'] ?>">
                    </div>
                </div>
                <div class="col-12">
                    <!-- Form Nama Description -->
                    <div class="form-group">
                        <label class="fas fa-address-card" for="description" title="Deskripsi"> Deskripsi</label><br>
                        <!-- Fungsi set_value digunakan agar form yang telah diisi tidak hilang ketika halaman direfresh -->
                        <textarea class="form-control" name="description" id="description" cols="70" rows="5" placeholder="Tidak Ada Deskripsi Apapun" readonly><?= $friend['description'] ?></textarea>
                    </div>
                </div>
            </div>
        </form>

        <!-- Jika array friend_add tidak kosong -->
        <?php if ($friend_add) { ?>
            <!-- Jika status pertemanan sudah diterima -->
            <?php if ($friend_add[0]['status'] == 1) { ?>
                <!-- Munculkan button hapus pertemanan -->
                <button href="<?= base_url('deleteFriend/' . $friend['id_users']) ?>" class="btn btn-danger mb-4 fas fa-user-check friend" name="delete" title="Delete Friend"> Hapus</button>
                <!-- Jika status pertemanan belum diterima -->
            <?php } elseif ($friend_add[0]['status'] == 0) { ?>
                <!-- Jika user adalah yang mengirimi permintaan -->
                <?php if ($friend_add[0]['id_users-friendreq'] == session()->get('id_users')) { ?>
                    <!-- Munculkan button cancel -->
                    <button href="<?= base_url('deleteFriend/' . $friend['id_users']) ?>" class="btn btn-danger mb-4 fas fa-user-check friend" name="cancel" title="Cancel Friend"> Batalkan</button>
                    <!-- Jika user adalah yang dikirimi permintaan -->
                <?php } elseif ($friend_add[0]['id_users-friendreq'] != session()->get('id_users')) { ?>
                    <!-- Munculkan button tanggapi -->
                    <div class="btn-group dropup mb-4">
                        <button type="button" class="btn btn-success dropdown-toggle fas fa-check-circle" data-toggle="dropdown" title="Tanggapi" aria-haspopup="true" aria-expanded="false"> Tanggapi</button>
                        <div class="dropdown-menu">
                            <button href="<?= base_url('acceptFriend/' . $friend['id_users']) ?>" class="dropdown-item btn btn-primary ml-1 fas fas fa-user-check friend" name="accept" title="Terima Pertemanan"> Terima</button>
                            <div class="dropdown-divider"></div>
                            <button href="<?= base_url('deleteFriend/' . $friend['id_users']) ?>" class="dropdown-item btn btn-danger ml-1 fas fas fa-user-times friend" name="reject" title="Hapus"> Hapus</button>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
            <!-- Jika array friend_add tidak ada -->
        <?php } else { ?>
            <!-- Munculkan button tambah teman -->
            <button href="<?= base_url('addFriend/' . $friend['id_users']) ?>" class="btn btn-success mb-4 fas fa-user-plus friend" name="add" title="Add Friend"> Tambah</button>
        <?php } ?>
        <!-- Tombol chat -->
        <a href=<?= base_url('chatPage/' . $friend['slug_users']) ?> class="btn btn-primary mb-4 fas fa-comments" title="Chat Now"> Chat Now</a>
    </div>
</div>

<br>

<?php if ($friend_demo) { ?>
    <div class="card card-body">
        <div class="row">
            <div class="col-sm">
                <div style="font-size: 18px;">Daftar Teman (<?= $friend_count ?>)
                    <a href="<?= base_url('friendList/' . $friend['slug_users']) ?>" type="submit" class="float-right" data-toggle="tooltip" title="Lihat Semua Teman"> Lihat Semua Teman</a></div>
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
                <div style="font-size: 18px;">Daftar Teman</div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h3 title="Tidak Ada Status">
                @<?= $friend['username'] ?> Belum Memiliki Teman
            </h3>
        </div>
    </div>
<?php } ?>

<br><br>

<!-- Jika user belum membuat status apapun -->
<?php if ($status == null) { ?>
    <div class="card bg-light">
        <div class="card-body">
            <h1 title="Tidak Ada Status">
                @<?= $friend['username'] ?> Belum Membuat Status Apapun
            </h1>
        </div>
    </div>

    <!-- Jika user sudah membuat status -->
<?php } else { ?>
    <div class="col-sm mt-3">
        <!-- Mengurutkan status secara terbalik -->
        <?php rsort($status);
        // Menghitung semua status yang ada
        $jumlah = count($status); ?>

        <!-- Jumlah status yang ada -->
        <h4 title="Jumlah Status Yang Ada">
            <center>
                @<?= $friend['username'] ?> memiliki <?= $jumlah ?> Status
            </center>
        </h4>

        <!-- Semua post yang dibuat user akan diprint di sini -->
        <?php foreach ($status as $sts) : ?>

            <br>

            <!-- Foto profil -->
            <img src="<?= base_url('gambar/foto/' . $friend['fotoprofil']) ?>" alt="image" title="Foto Profil Friend" class="rounded-circle" height="60px" width="60px">
            <b title="Pembuat Komentar">
                @<?= $friend['username'] ?>
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

                    <!-- Share -->
                    <a class="btn btn-primary ml-1 fab fa-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?= base_url('comment/' . $sts['id_status']) ?>" target="_blank" title="Bagikan Ke Facebook"> </a>

                    <!-- Jika user komputer ini memiliki level yang bukan 3, maka tombol hak akses admin akan muncul -->
                    <?php if ($user['level'] != 3) { ?>
                        <div class="btn-group dropup float-right">
                            <button type="button" class="btn btn-primary dropdown-toggle fas fa-crown" data-toggle="dropdown" title="Fitur Admin" aria-haspopup="true" aria-expanded="false"> </button>
                            <div class="dropdown-menu">
                                <!-- Jika level dari friend adalah 1 -->
                                <?php if ($friend['level'] == 1) { ?>
                                    <?php if ($user['level'] == 1) { ?>
                                        <button name="tombol-hapus-status" href="<?= base_url('deleteStatus/' . $sts['id_status']) ?>" class="dropdown-item btn btn-danger ml-1 fas fas fa-crown hapus" title="Hapus Sebagai Admin"> Hapus</button>
                                    <?php } ?>
                                    <?php if ($user['level'] == 2) { ?>
                                        <button class="dropdown-item btn btn-danger ml-1 fas fas fa-crown tidak-berhak" title="Anda Tidak Punya Hak"> Anda Tidak Berhak</button>
                                    <?php } ?>
                                    <!-- Jika level dari friend adalah 2 -->
                                <?php } elseif ($friend['level'] == 2) { ?>
                                    <?php if ($user['level'] == 1) { ?>
                                        <button name="tombol-hapus-status" href="<?= base_url('deleteStatus/' . $sts['id_status']) ?>" class="dropdown-item btn btn-danger ml-1 fas fas fa-crown hapus" title="Hapus Sebagai Admin"> Hapus</button>
                                    <?php } ?>
                                    <?php if ($user['level'] == 2) { ?>
                                        <?php if ($friend['id_users'] != $user['id_users']) { ?>
                                            <button class="dropdown-item btn btn-danger ml-1 fas fas fa-crown tidak-berhak" title="Anda Tidak Punya Hak"> Anda Tidak Berhak</button>
                                        <?php } ?>
                                        <?php if ($friend['id_users'] == $user['id_users']) { ?>
                                            <button name="tombol-hapus-status" href="<?= base_url('deleteStatus/' . $sts['id_status']) ?>" class="dropdown-item btn btn-danger ml-1 fas fas fa-crown hapus" title="Hapus Sebagai Admin"> Hapus</button>
                                        <?php } ?>
                                    <?php } ?>
                                    <!-- Jika level dari friend adalah 3 -->
                                <?php } elseif ($friend['level'] == 3) { ?>
                                    <?php if ($user['level'] != 3) { ?>
                                        <button name="tombol-hapus-status" href="<?= base_url('deleteStatus/' . $sts['id_status']) ?>" class="dropdown-item btn btn-danger ml-1 fas fas fa-crown hapus" title="Hapus Sebagai Admin"> Hapus</button>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php endforeach ?>
    </div>
<?php } ?>

<?= $this->endSection('content'); ?>