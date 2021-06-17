<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- col dengan grid 12 -->
<div class="col-12">

    <!-- Sapaan kepada user -->
    <center>
        <?php $time = time();
        //Fungsi untuk waktu 24 jam
        $hour = date("G", $time);
        //Kondisional untuk menampilkan ucapan menurut waktu/jam
        if ($hour >= 0 && $hour <= 10) { ?>
            <!-- Saat pagi -->
            <h2 class="fas fa-cloud" title="Sapaan Pagi Untuk <?= $user['firstname'] ?> <?= $user['lastname'] ?>"> Selamat Pagi
            <?php } elseif ($hour >= 11 && $hour <= 14) { ?>
                <!-- Saat siang -->
                <h2 class="fas fa-sun" title="Sapaan Siang Untuk <?= $user['firstname'] ?> <?= $user['lastname'] ?>"> Selamat Siang
                <?php } elseif ($hour >= 15 && $hour <= 18) { ?>
                    <!-- Saat sore -->
                    <h2 class="fas fa-cloud-sun" title="Sapaan Sore Untuk <?= $user['firstname'] ?> <?= $user['lastname'] ?>"> Selamat Sore
                    <?php } elseif ($hour >= 19 && $hour <= 23) { ?>
                        <!-- Saat malam -->
                        <h2 class="fas fa-moon" title="Sapaan Malam Untuk <?= $user['firstname'] ?> <?= $user['lastname'] ?>"> Selamat Malam
                            <?php } ?><?= $user['firstname'] ?> <?= $user['lastname'] ?>
                        </h2>
    </center>

    <br><br>

</div>

<!-- Row tempat tombol buat status dan kotak pencarian berada -->
<div class="row">
    <!-- Dibuat di dalam row yang sama agar kedua object tersebut bersandingan -->
    <div class="col-md">
        <!-- Button yang akan mengarah ke modal buat status -->
        <button type="button" class="btn btn-success fas fa-pen mb-2" data-toggle="modal" data-target="#modalStatus" title="Buat Status">
            Buat Status
        </button>
    </div>
    <div class="col-md">
        <!-- Dibuat di dalam row yang sama agar kedua object tersebut bersandingan -->
        <form class="" action="<?= base_url('home') ?>" method="post">
            <div class="input-group">
                <!-- Form pencarian -->
                <input type="text" class="form-control" title="Masukkan Kata Kunci Pencarian" value="<?= set_value('keyword') ?>" name="keyword" id="keyword" placeholder="Masukkan Kata Kunci Pencarian" maxlength="100" autocomplete="off" autofocus>
                <div class="input-group-append">
                    <!-- Tombol search -->
                    <input class="btn btn-success fas" title="Klik Untuk Mencari" type="submit" name="submit" value="Search">
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Jika tidak ada status sama sekali -->
<?php if ($status == null) { ?>
    <div class="card bg-light mt-4">
        <div class="card-body">
            <h3 title="User tidak ditemukan">
                Tidak ada status.
            </h3>
        </div>
    </div>

    <!-- Jika tidak ada status yang ditemukan saat pencarian -->
<?php } elseif ($status[0] == 'kosong') { ?>
    <div class="card bg-light mt-3">
        <div class="card-body">
            <h3 title="Status tidak ditemukan">
                Status dengan kata kunci "<?= set_value('keyword') ?>" tidak ditemukan, mohon cari lagi dengan kata kunci yang berbeda.
            </h3>
        </div>
    </div>

    <!-- Jika ada user -->
<?php } else { ?>
    <!-- Semua post yang dibuat user akan diprint di sini dengan kondisi tershuffle -->
    <?php shuffle($status);
    // Array $status dijadikan serpihan per bagian dengan foreach
    foreach ($status as $sts) : ?>

        <br>

        <!-- Foto profil -->
        <img src="<?= base_url('gambar/foto/' . $sts['fotoprofil']) ?>" alt="image" title="Foto Profil User" class="rounded-circle" height="60px" width="60px">
        <b title="Pembuat Status">
            <a href=<?= base_url('friendPage/' . $sts['slug_users']) ?>>
                @<?= $sts['username'] ?>
            </a>
        </b>

        <!-- Kotak status dengan bg dark -->
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

                <!-- Jika status tersebut dibuat oleh user di komputer ini, maka tombol hapus akan muncul -->
                <?php if ($sts['id_users'] == session()->get('id_users')) { ?>
                    <button name="tombol-hapus-status" href="<?= base_url('deleteStatus/' . $sts['id_status']) ?>" class="btn btn-danger ml-1 fas fa-trash-alt hapus" title="Hapus"> </button>
                <?php } ?>

                <!-- Tombol share ke Facebook -->
                <a class="btn btn-primary ml-1 fab fa-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?= base_url('comment/' . $sts['id_status']) ?>" target="_blank" title="Bagikan Ke Facebook"> </a>

                <!-- Jika user komputer ini memiliki level yang bukan 3, maka tombol hak akses admin akan muncul -->
                <?php if ($user['level'] != 3) { ?>
                    <div class="btn-group dropup float-right">
                        <button type="button" class="btn btn-primary dropdown-toggle fas fa-crown" data-toggle="dropdown" title="Fitur Admin" aria-haspopup="true" aria-expanded="false"> </button>
                        <div class="dropdown-menu">
                            <!-- Jika level dari status ini adalah 1 -->
                            <?php if ($sts['level'] == 1) { ?>
                                <!-- Jika user di komputer ini memiliki level 1, maka tombol hapus akan muncul -->
                                <?php if ($user['level'] == 1) { ?>
                                    <button name="tombol-hapus-status" href="<?= base_url('deleteStatus/' . $sts['id_status']) ?>" class="dropdown-item btn btn-danger ml-1 fas fas fa-crown hapus" title="Hapus Sebagai Admin"> Hapus</button>
                                <?php } ?>
                                <!-- Jika user di komputer ini memiliki level 2, maka tombol hapus akan muncul, tapi tidak akan bisa digunakan -->
                                <?php if ($user['level'] == 2) { ?>
                                    <button class="dropdown-item btn btn-danger ml-1 fas fas fa-crown tidak-berhak" title="Anda Tidak Punya Hak"> Anda Tidak Berhak</button>
                                <?php } ?>
                                <!-- Jika level dari status ini adalah 2 -->
                            <?php } elseif ($sts['level'] == 2) { ?>
                                <!-- Jika user di komputer ini memiliki level 1, maka tombol hapus akan muncul -->
                                <?php if ($user['level'] == 1) { ?>
                                    <button name="tombol-hapus-status" href="<?= base_url('deleteStatus/' . $sts['id_status']) ?>" class="dropdown-item btn btn-danger ml-1 fas fas fa-crown hapus" title="Hapus Sebagai Admin"> Hapus</button>
                                <?php } ?>
                                <!-- Jika user di komputer ini memiliki level 2, maka tombol hapus akan muncul, tapi... -->
                                <?php if ($user['level'] == 2) { ?>
                                    <!-- Jika id pada session tidak sama dengan id user di komputer ini, maka user tidak akan berhak -->
                                    <?php if ($sts['id_users'] != $user['id_users']) { ?>
                                        <button class="dropdown-item btn btn-danger ml-1 fas fas fa-crown tidak-berhak" title="Anda Tidak Punya Hak"> Anda Tidak Berhak</button>
                                    <?php } ?>
                                    <!-- Jika id pada session sama dengan id user di komputer ini, maka tombol hapus akan berfungsi -->
                                    <?php if ($sts['id_users'] == $user['id_users']) { ?>
                                        <button name="tombol-hapus-status" href="<?= base_url('deleteStatus/' . $sts['id_status']) ?>" class="dropdown-item btn btn-danger ml-1 fas fas fa-crown hapus" title="Hapus Sebagai Admin"> Hapus</button>
                                    <?php } ?>
                                <?php } ?>
                                <!-- Jika level dari status ini adalah 3 -->
                            <?php } elseif ($sts['level'] == 3) { ?>
                                <!-- Jika user di komputer ini memiliki level selain 3, maka tombol hapus akan muncul -->
                                <?php if ($user['level'] != 3) { ?>
                                    <button name="tombol-hapus-status" href="<?= base_url('deleteStatus/' . $sts['id_status']) ?>" class="dropdown-item btn btn-danger ml-1 fas fas fa-crown hapus" title="Hapus Sebagai Admin"> Hapus</button>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php endforeach; ?>
<?php } ?>

<?= $this->endSection('content'); ?>