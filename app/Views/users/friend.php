<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Row tempat tulisan carilah temanmu dan pencarian berada -->
<div class="row">
    <!-- Dibuat di dalam row yang sama agar kedua object tersebut bersandingan -->
    <div class="col-md">
        <h3 class="fas fa-search" title="Cari Seseorang!"> Cari Seseorang!</h3>
    </div>
    <!-- Dibuat di dalam row yang sama agar kedua object tersebut bersandingan -->
    <div class="col-md">
        <form class="" action="<?= base_url('friend') ?>" method="post">
            <div class="input-group mb-4">
                <!-- Form pencarian -->
                <input type="text" title="Masukkan Kata Kunci Pencarian" class="form-control" value="<?= set_value('keyword') ?>" name="keyword" id="keyword" placeholder="Masukkan Kata Kunci Pencarian" maxlength="100" autocomplete="off" autofocus>
                <div class="input-group-append">
                    <!-- Tombol search -->
                    <input class="btn btn-success fas" title="Klik Untuk Mencari" type="submit" name="submit" value="Search">
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Jika tidak ada user sama sekali -->
<?php if ($friend == null) { ?>
    <div class="card bg-light mt-4">
        <div class="card-body">
            <h3 title="User tidak ditemukan">
                Tidak ada user.
            </h3>
        </div>
    </div>
<?php } else if ($friend[0] == 'kosong') { ?>
    <div class="card bg-light mt-4">
        <div class="card-body">
            <h3 title="User tidak ditemukan">
                User dengan kata kunci "<?= set_value('keyword') ?>" tidak ditemukan, mohon cari lagi dengan kata kunci yang berbeda.
            </h3>
        </div>
    </div>

    <!-- Jika ada user -->
<?php } else { ?>
    <!-- Semua user yang ada akan diprint oleh fungsi ini -->
    <?php foreach ($friend as $frd) : ?>

        <br>

        <div class="card bg-light">
            <div class="card-header">
                <!-- Tulisan bergabung pada -->
                <p class="card-text" title="Tanggal Bergabung">Bergabung Pada <?= $frd['users-created_at']; ?></p>
            </div>

            <div class="row no-gutters">

                <!-- Kotak tempat Foto profil -->
                <div class="col-md-4 fotofriend">
                    <center>
                        <img src="<?= base_url('gambar/foto/' . $frd['fotoprofil']) ?>" alt="image" title="Foto Profil User" class="img-fluid rounded-circle">
                    </center>
                </div>

                <!-- Kotak tempat nama dan lainnya -->
                <div class="col-md-8 bg-light">
                    <div class="card-body">
                        <!-- Nama setiap user, serta link menuju ke sana -->
                        <a href=<?= base_url('friendPage/' . $frd['slug_users']) ?>>
                            <!-- Jika user tersebut adalah owner atau admin, maka fungsi ini akan dijalankan -->
                            <h5 class="card-title fas" title="Nama User">
                                @<?= $frd['username']; ?>
                            </h5>
                        </a>

                        <!-- Deskripsi tentang user -->
                        <p class="card-text" title="Deskripsi"><?= $frd['description']; ?></p>
                        <hr>
                        <!-- Button untuk melihat profil -->
                        <a href=<?= base_url('friendPage/' . $frd['slug_users']) ?> class="btn btn-primary fas fa-arrow-right" title="Lihat Profil"> Lihat Profil</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php } ?>

<?= $this->endSection('content'); ?>