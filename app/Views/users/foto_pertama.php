<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<h1>Ubah Foto Anda Agar Teman Anda Dapat Mengenali Anda</h1>

<!-- Form mengganti foto -->
<form action="<?= base_url('gantiFoto') ?>" method="post" enctype="multipart/form-data">
    <div class="card card-body">
        <!-- Form upload foto -->
        <div class="form-group">
            <input type="file" class="custom-file-input fas dropify" data-height="240" name="foto" id="foto" required>
        </div>
    </div>

    <div class="row">
        <div class="col-sm mt-3">
            <!-- Button untuk submit -->
            <button type="submit" class="btn btn-success fas fa-edit" data-toggle="tooltip" title="Ubah Foto"> Ubah Foto</button>
            <!-- Button untuk lewati -->
            <a href="<?= base_url('home') ?>" type="submit" class="btn btn-danger fas fa-forward float-right" data-toggle="tooltip" title="Lewati"> Lewati</a>
        </div>
    </div>
</form>

<?= $this->endSection('content'); ?>