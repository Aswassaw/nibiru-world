<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?php if ($friend_add) { ?>
    <!-- Row tempat tulisan permintaan pertemanan muncul -->
    <div class="row">
        <!-- Dibuat di dalam row yang sama agar kedua object tersebut bersandingan -->
        <div class="col-md">
            <h3 class="fas fa-user-plus" title="Permintaan Pertemanan"> Permintaan Pertemanan (<?= count($friend_add) ?>)</h3>
        </div>
    </div>

    <!-- Semua permintaan pertemanan akan diprint oleh fungsi ini -->
    <?php foreach ($friend_add as $frd_a) : ?>

        <br>

        <div class="card bg-light">
            <div class="card-header">
                <!-- Tulisan Meminta Pertemanan pada -->
                <p class="card-text" title="Tanggal Meminta Pertemanan">Meminta Pertemanan Pada <?= $frd_a['friendreq-created_at']; ?></p>
            </div>

            <div class="row no-gutters">

                <!-- Kotak tempat Foto profil -->
                <div class="col-md-4 fotofriend">
                    <center>
                        <img src="<?= base_url('gambar/foto/' . $frd_a['fotoprofil']) ?>" alt="image" title="Foto Profil User" class="img-fluid rounded-circle">
                    </center>
                </div>

                <!-- Kotak tempat nama dan lainnya -->
                <div class="col-md-8 bg-light">
                    <div class="card-body">
                        <!-- Nama setiap user, serta link menuju ke sana -->
                        <a href=<?= base_url('friendPage/' . $frd_a['slug_users']) ?>>
                            <!-- Jika user tersebut adalah owner atau admin, maka fungsi ini akan dijalankan -->
                            <h5 class="card-title fas" title="Nama User">
                                @<?= $frd_a['username']; ?>
                            </h5>
                        </a>

                        <!-- Deskripsi tentang user -->
                        <p class="card-text" title="Deskripsi"><?= $frd_a['description']; ?></p>
                        <hr>
                        <!-- Button untuk menerima teman -->
                        <button href="<?= base_url('acceptFriend/' . $frd_a['id_users']) ?>" class="btn btn-primary fas fa-user-check friend" name="accept" title="Terima Pertemanan"> Terima</button>
                        <button href="<?= base_url('deleteFriend/' . $frd_a['id_users']) ?>" class="btn btn-danger fas fa-user-times friend" name="reject" title="Hapus"> Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php } else { ?>
    <!-- Row tempat tulisan permintaan pertemanan muncul -->
    <div class="row">
        <!-- Dibuat di dalam row yang sama agar kedua object tersebut bersandingan -->
        <div class="col-md">
            <h3 class="fas fa-user-plus" title="Tidak Ada Permintaan Pertemanan"> Tidak Ada Permintaan Pertemanan</h3>
        </div>
    </div>

    <div class="card bg-light mt-4">
        <div class="card-body">
            <h3 title="Mulailah Cari Teman!">
                Tidak ada permintaan Pertemanan.
                <hr>
                <a class="btn btn-success fas fa-search" href="<?= base_url('friend') ?>"> Mulailah Cari Teman!</a>
            </h3>
        </div>
    </div>
<?php } ?>

<?= $this->endSection('content'); ?>