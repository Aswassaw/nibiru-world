<!-- Modal untuk membuat status -->
<div class="modal fade" id="modalStatus" tabindex="-1" role="dialog" aria-labelledby="judulModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fas" id="judulModal" title="Buat Status Baru">Buat Status Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="status-biasa-tab" data-toggle="tab" href="#status-biasa" role="tab" aria-controls="status-biasa" aria-selected="true">Status Biasa</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="status-bg-tab" data-toggle="tab" href="#status-bg" role="tab" aria-controls="status-bg" aria-selected="false">Status Background</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade show active" id="status-biasa" role="tabpanel" aria-labelledby="status-biasa-tab">
                        <form action="<?= base_url("createStatus") ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="type" value="biasa">
                            <?= csrf_field(); ?>
                            <div class="form-group">
                                <!-- Form untuk membuat status baru -->
                                <textarea class="form-control" maxlength="2000" name="status" id="status" cols="45" rows="5" placeholder="Tulis Sesuatu Di Sini" required title="Tulis Sesuatu"></textarea>
                            </div>

                            <p>
                                <button class="btn btn-primary fas fa-upload" type="button" data-toggle="collapse" data-target="#collapseUploadGambar" aria-expanded="false" aria-controls="collapseUploadGambar">
                                    Upload Gambar
                                </button>
                            </p>
                            <div class="collapse" id="collapseUploadGambar">
                                <!-- Form upload gambar -->
                                <div class="form-group">
                                    <input type="file" class="custom-file-input fas dropify" data-height="120" name="gambar" id="gambar">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary fas fa-times" data-dismiss="modal" title="Batalkan"> Batalkan</button>
                                <button type="submit" class="btn btn-success fas fa-pen" title="Posting Status"> Posting Status</button>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="status-bg" role="tabpanel" aria-labelledby="status-bg-tab">
                        <form action="<?= base_url("createStatus") ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="type" value="background">
                            <?= csrf_field(); ?>
                            <div class="form-group">
                                <!-- Form untuk membuat status baru -->
                                <textarea class="form-control" maxlength="500" name="status" id="status" cols="45" rows="5" placeholder="Tulis Sesuatu Di Sini" required title="Tulis Sesuatu"></textarea>
                            </div>

                            <p class="fas fa-image"> Pilih Background Yang Akan Digunakan:</p>

                            <br>

                            <!-- Radio Button -->
                            <div class="form-check form-check-inline my-1">
                                <input class="form-check-input" type="radio" name="pilihan_gambar" id="pilihan_gambar1" value="bg-blue.webp" checked required>
                                <label class="form-check-label" for="pilihan_gambar1">
                                    <img src="<?= base_url('gambar/gambar_status/bg-blue.webp') ?>" height="55" width="110" alt="">
                                </label>
                            </div>
                            <div class="form-check form-check-inline my-1">
                                <input class="form-check-input" type="radio" name="pilihan_gambar" id="pilihan_gambar2" value="bg-green.webp" required>
                                <label class="form-check-label" for="pilihan_gambar2">
                                    <img src="<?= base_url('gambar/gambar_status/bg-green.webp') ?>" height="55" width="110" alt="">
                                </label>
                            </div>
                            <div class="form-check form-check-inline my-1">
                                <input class="form-check-input" type="radio" name="pilihan_gambar" id="pilihan_gambar3" value="bg-red.webp" required>
                                <label class="form-check-label" for="pilihan_gambar3">
                                    <img src="<?= base_url('gambar/gambar_status/bg-red.webp') ?>" height="55" width="110" alt="">
                                </label>
                            </div>
                            <div class="form-check form-check-inline my-1">
                                <input class="form-check-input" type="radio" name="pilihan_gambar" id="pilihan_gambar4" value="bg-purple.webp" required>
                                <label class="form-check-label" for="pilihan_gambar4">
                                    <img src="<?= base_url('gambar/gambar_status/bg-purple.webp') ?>" height="55" width="110" alt="">
                                </label>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary fas fa-times" data-dismiss="modal" title="Batalkan"> Batalkan</button>
                                <button type="submit" class="btn btn-success fas fa-pen" title="Posting Status"> Posting Status</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk mengganti foto profil -->
<div class="modal fade" id="modalFoto" tabindex="-1" role="dialog" aria-labelledby="judulModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fas" id="judulModal" title="Ganti Foto Profil">Ganti Foto Profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url("gantiFoto") ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <input style="font-size: 1px;" type="file" class="custom-file-input fas dropify" data-height="230" name="foto" id="foto" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary fas fa-times" data-dismiss="modal" title="Batalkan"> Batalkan</button>
                <button type="submit" class="btn btn-success fas fa-edit" title="Ubah Foto"> Ubah Foto</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Jika ada sebuah sesi bernama success, jalankan perintah di dalam if ini -->
<?php if (session()->get('success')) : ?>
    <div class="berhasil-data" data-berhasildata="<?= session()->get('success') ?>"></div>
<?php endif; ?>

<!-- Jika ada sebuah sesi bernama danger, jalankan perintah di dalam if ini -->
<?php if (session()->get('danger')) : ?>
    <div class="gagal-data" data-gagaldata="<?= session()->get('danger') ?>"></div>
<?php endif; ?>