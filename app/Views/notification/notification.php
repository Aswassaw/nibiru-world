<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<!-- Row tempat tulisan carilah temanmu dan pencarian berada -->
<div class="row">
    <!-- Dibuat di dalam row yang sama agar kedua object tersebut bersandingan -->
    <div class="col-md">
        <h3 class="fas fa-bell" title="Daftar Notifikasi"> Daftar Notifikasi</h3>
    </div>
</div>

<!-- Jika tidak ada notifikasi sama sekali -->
<?php if ($notification == null) { ?>
    <div class="card mt-4">
        <div class="card-body">
            <h3 title="Tidak ada Notifikasi">
                Tidak ada Notifikasi.
            </h3>
        </div>
    </div>

    <!-- Jika ada notifikasi -->
<?php } else { ?>
    <?php foreach ($notification as $ntf) : ?>
        <div class="card mt-3">
            <div class="card-body">
                <button class="btn notification" href="<?= base_url('toNotification/' . $ntf['id_notification']) ?>">
                    <?php if ($ntf['status_notification'] == 0) { ?>
                        <i class="fas fa-bell"></i>
                    <?php } else { ?>
                        <i class="fas fa-bell-slash"></i>
                    <?php } ?>
                    <?= $ntf['notification'] ?> pada <?= $ntf['notification-created_at'] ?>
                </button>
            </div>
        </div>
    <?php endforeach; ?>
<?php } ?>

<?= $this->endSection('content'); ?>