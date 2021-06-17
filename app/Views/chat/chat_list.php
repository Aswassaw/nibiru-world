<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Row tempat tulisan bagikan pesan dengan temanmu -->
<div class="row">
    <div class="col-md">
        <h3 class="fas fa-comments" title="Bagikan Pesan Dengan Temanmu!"> Bagikan Pesan Dengan Temanmu!</h3>
    </div>
    <div class="col-md">
        <div class="input-group">
            <div class="input-group-append">
                <button class="btn btn-outline-primary dropdown-toggle asw" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih Teman Untuk Chat</button>
                <div class="dropdown-menu">
                    <?php if ($friend_list) { ?>
                        <?php foreach ($friend_list as $frd_ls) : ?>
                            <a class="dropdown-item" href="<?= base_url('chatPage/' . $frd_ls['slug_users']) ?>"><img class="mr-2 rounded-circle" alt="image" height="50px" width="50px" src="<?= base_url('gambar/foto/' . $frd_ls['fotoprofil']) ?>">@<?= $frd_ls['username'] ?></a>
                            <div class="dropdown-divider"></div>
                        <?php endforeach; ?>
                    <?php } else { ?>
                        <a class="dropdown-item">Tidak Ada Teman</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Jika tidak ada user yang telah diajak chat -->
<?php if ($friend == null) { ?>
    <div class="card bg-light mt-4">
        <div class="card-body">
            <h3 title="User tidak ditemukan">
                Anda belum berbagi pesan dengan siapapun.
            </h3>
        </div>
    </div>

    <!-- Jika ada users yang pernah dichat -->
<?php } else { ?>
    <?php foreach ($friend as $frd) : ?>

        <br>

        <!-- Card -->
        <div class="card bg-light">
            <div class="card-body">
                <!-- Foto profil -->
                <img src="<?= base_url('gambar/foto/' . $frd['fotoprofil']) ?>" alt="image" title="Foto Profil User" class="rounded-circle mb-2" height="70px" width="70px">

                <!-- Chat with nama user -->
                <h5 class="card-title mb-2 fas" title="Identitas User">Chat with
                    <a href="<?= base_url('friendPage/' . $frd['slug_users']) ?>">
                        @<?= $frd['username'] ?>
                    </a>
                </h5>
                <hr>
                <!-- Pesan terakhir -->
                <p class="card-text" title="Pesan Terakhir">
                    <?php if ($frd['status_chattrue'] == 1) { ?>
                        <i class="fas fa-check-circle"> </i>
                    <?php } else { ?>
                        <i class="fas fa-times-circle"> </i>
                    <?php } ?>
                    Last Message: <?= $frd['minichat']; ?></p>
                <hr>
                <a href=<?= base_url('chatPage/' . $frd['slug_users']) ?> class="btn btn-primary fas fa-comments" title="Chat Now"> Chat Now</a>
            </div>
        </div>
    <?php endforeach; ?>
<?php } ?>

<?= $this->endSection('content'); ?>