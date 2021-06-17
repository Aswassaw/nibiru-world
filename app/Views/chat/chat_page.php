<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Mengisi variabel $uri dengan service('uri')/ url saat ini -->
<?php $uri = service('uri'); ?>

<!-- Desain awal container agar agak ke samping -->
<div class="container">

    <center>
        <h3 class="fas mb-2" title="Terhubung di AswassawChat!">Anda dan @<?= $friend['username'] ?> Terhubung di AswassawChat</h3><br>
    </center>

    <!-- menghitung jumlah $chat -->
    <?php $jumlah = count($chat);
    // jika segment 1 adalah chatPageAll, jalankan perintah if ini
    if ($uri->getSegment(1) == 'chatPageAll') { ?>

        <!-- Jika $jumlah isinya kurang dari 5, munculkan button ini -->
    <?php } elseif ($jumlah < 5) { ?>
        <center>
            <a class="btn btn-success btn-sm fas fa-redo" title="Muat Semua Pesan" href="<?= base_url('chatPageAll/' . $friend['slug_users']) ?>"> Muat Semua Pesan</a>
        </center>
    <?php } ?>

    <br>

    <!-- Jika tidak data chat smaa sekali -->
    <?php if ($chat == null) { ?>
        <div class="card bg-light">
            <div class="card-body">
                <h3 title="Tidak ada pesan">
                    Anda Belum Berbagi Pesan Dengan @<?= $friend['username'] ?>
                </h3>
            </div>
        </div>
    <?php } ?>
</div>

<!-- Fungsi sort untuk membalik -->
<?php sort($chat);
foreach ($chat as $ch) : ?>
    <!-- Jika id_users-chat pada data chat nilainya sama dengan session(id) maka print ke paling kanan -->
    <?php if ($ch['id_users-chat'] == session()->get('id_users')) { ?>
        <div align="right" class="container mb-3" data-toggle="tooltip" data-placement="top" title="<?= $ch['chat-created_at'] ?>">
            <div class="col-10">
                <img src="<?= base_url('gambar/foto/' . $user['fotoprofil']) ?>" alt="image" title="Foto Profil User" class="rounded-circle mb-2" height="50px" width="50px">
                <b title="Pembuat Pesan"><?= $user['firstname'] . ' ' . $user['lastname'] ?></b>
                <div align="left" class="card border-success">
                    <div class="card-body text-success">
                        <?= $ch['chat'] ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jika id_users-chat pada data chat nilainya sama dengan session(id) maka print ke paling kanan -->
    <?php } else { ?>
        <div class="container mb-3" data-toggle="tooltip" data-placement="top" title="<?= $ch['chat-created_at'] ?>">
            <div class="col-10">
                <img src="<?= base_url('gambar/foto/' . $friend['fotoprofil']) ?>" alt="image" title="Foto Profil User" class="rounded-circle mb-2" height="50px" width="50px">
                <b title="Pembuat Pesan">
                    <a href=<?= base_url('friendPage/' . $friend['slug_users']) ?>>
                        <?= $friend['firstname'] . ' ' . $friend['lastname'] ?>
                    </a>
                </b>
                <div class="card border-danger">
                    <div class="card-body text-danger">
                        <?= $ch['chat'] ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
<?php endforeach; ?>

<br>

<!-- Form untuk mengirim pesan -->
<form class="" action="<?= base_url('chatPage/' . $friend['slug_users']) ?>" method="post">
    <div class="input-group fixed-bottom">
        <!-- Form pencarian -->
        <textarea class="form-control" name="chat" id="chat" rows="1" placeholder="Tulis Pesan" data-toggle="tooltip" title="Tulis Pesan" maxlength="2500" required autofocus></textarea>
        <div class="input-group-append">
            <!-- Tombol search -->
            <input class="btn btn-success fas" title="Klik Untuk Mengirim" type="submit" name="submit" value="Kirim">
        </div>
    </div>
</form>

<?= $this->endSection('content'); ?>