<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Row tempat tulisan carilah temanmu dan pencarian berada -->
<div class="row">
    <!-- Dibuat di dalam row yang sama agar kedua object tersebut bersandingan -->
    <div class="col-md">
        <h3 class="fas fa-search" title="Cari Teman @<?= $friend_pemilik['username'] ?>"> Cari Teman
            <?php if ($friend_pemilik['id_users'] == session()->get('id_users')) { ?>
                Anda!
            <?php } else { ?>
                @<?= $friend_pemilik['username'] ?>!
            <?php } ?>
        </h3>
    </div>
    <!-- Dibuat di dalam row yang sama agar kedua object tersebut bersandingan -->
    <div class="col-md">
        <form class="" action="<?= base_url('friendList/' . $friend_pemilik['slug_users']) ?>" method="post">
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
<?php if ($friend_list == null) { ?>
    <div class="card bg-light mt-4">
        <div class="card-body">
            <h3 title="User tidak ditemukan">
                @<?= $friend_pemilik['username'] ?> Belum Memiliki Teman.
            </h3>
        </div>
    </div>
<?php } else if ($friend_list[0] == 'kosong') { ?>
    <div class="card bg-light mt-4">
        <div class="card-body">
            <h3 title="User tidak ditemukan">
                User dengan kata kunci "<?= set_value('keyword') ?>" tidak ditemukan, mohon cari lagi dengan kata kunci yang berbeda.
            </h3>
        </div>
    </div>

    <!-- Jika ada user -->
<?php } else { ?>
    <?php foreach ($friend_list as $frd_ls) : ?>

        <br>

        <div class="card">
            <div class="card-header">
                <!-- Tulisan berteman pada -->
                <p class="card-text" title="Tanggal Berteman">Berteman Pada <?= $frd_ls['friend-created_at']; ?></p>
            </div>
            <a class="teman" href="<?= base_url('friendPage/' . $frd_ls['slug_users']) ?>">
                <div class="card-body"> <img class="mr-2 rounded-circle" alt="image" height="50px" width="50px" src="<?= base_url('gambar/foto/' . $frd_ls['fotoprofil']) ?>"> @<?= $frd_ls['username'] ?>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
<?php } ?>

<?= $this->endSection('content'); ?>