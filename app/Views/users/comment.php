<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?php foreach ($status as $sts) : ?>

    <!-- Foto profil -->
    <img src="<?= base_url('gambar/foto/' . $sts['fotoprofil']) ?>" alt="image" title="Foto Profil User" class="rounded-circle" height="60px" width="60px">
    <b title="Pembuat Komentar">
        <a href=<?= base_url('friendPage/' . $sts['slug_users']) ?>>
            @<?= $sts['username'] ?>
        </a>
    </b>

    <!-- Kotak hitam tempat status -->
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

            <div style="font-family: calibri;"><button style="font-weight: bold;" type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalLike<?= $sts['id_status'] ?>"><?= $sts['like'] ?> Suka</button></div>

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
                                <?php foreach ($status_like as $sts_lk) : ?>
                                    <?php if ($sts_lk['id_status-likestatus'] == $sts['id_status']) { ?>
                                        <div class="card my-3">
                                            <a class="teman" href="<?= base_url('friendPage/' . $sts_lk['slug_users']) ?>">
                                                <div class="card-body"> <img class="mr-2 rounded-circle" alt="image" height="50px" width="50px" src="<?= base_url('gambar/foto/' . $sts_lk['fotoprofil']) ?>"> @<?= $sts_lk['username'] ?>
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

            <!-- Jika status ini dibuat oleh user di komputer ini, maka tombol hapus akan muncul -->
            <?php if ($sts['id_users'] == session()->get('id_users')) { ?>
                <button name="tombol-hapus-status" href="<?= base_url('deleteStatus/' . $sts['id_status']) ?>" class="btn btn-danger ml-1 fas fa-trash-alt hapus" title="Hapus"> </button>
            <?php } ?>

            <!-- Share fb -->
            <a class="btn btn-primary ml-1 fab fa-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?= base_url('comment/' . $sts['id_status']) ?>" target="_blank" data-toggle="tooltip" title="Bagikan Ke Facebook"> </a>

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

<br>

<!-- Pesan ketika terjadi kesalahan akan muncul di sini -->
<?php if (isset($validation)) : ?>
    <div class="alert alert-danger" role="alert">
        <?= $validation->listErrors() ?>
    </div>
<?php endif; ?>

<!-- Form membuat komentar -->
<form action="<?= base_url('createComment/' . $sts['id_status']) ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field(); ?>
    <!-- Fungsi set_value digunakan agar form yang telah diisi tidak hilang ketika halaman direfresh -->
    <div class="form-group">
        <textarea class="form-control" maxlength="1000" name="comment" id="comment" cols="70" rows="3" placeholder="Komentari Status ini" data-toggle="tooltip" title="Tulis Komentar" required autofocus></textarea>
    </div>

    <p>
        <button class="btn btn-primary fas fa-upload" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Upload Gambar
        </button>
    </p>
    <div class="collapse" id="collapseExample">
        <div class="card card-body mb-3">
            <!-- Form upload gambar -->
            <div class="form-group">
                <input type="file" class="custom-file-input fas dropify" data-height="120" name="gambar" id="gambar">
            </div>
        </div>
    </div>

    <!-- Button buat komentar -->
    <button type="submit" class="btn btn-success mb-3 fas fa-pen" data-toggle="tooltip" title="Posting Komentar"> Posting Komentar</button>
</form>

<!-- Jika tidak ada komentar -->
<?php if ($comment == null) { ?>
    <div class="card bg-light">
        <div class="card-body">
            <h1 title="Tidak Ada Komentar">
                Tidak Ada Komentar
            </h1>
        </div>
    </div>

    <!-- Jika terdapat komentar -->
<?php } else { ?>
    <!-- sort untuk membalik urutan -->
    <?php sort($comment); ?>

    <!-- Jumlah status -->
    <h4 data-toggle="tooltip" title="Jumlah Komentar">
        <center>
            Status ini memiliki <?= $status[0]['comment'] ?> Komentar
        </center>
    </h4>

    <!-- Semua komentar yang ada akan diprint di sini -->
    <?php foreach ($comment as $cmt) { ?>

        <br>

        <!-- Foto profil -->
        <img src="<?= base_url('gambar/foto/' . $cmt['fotoprofil']) ?>" alt="image" title="Foto Profil User" class="rounded-circle" height="50px" width="50px">
        <b title="Pembuat Komentar">
            <a href=<?= base_url('friendPage/' . $cmt['slug_users']) ?>>
                @<?= $cmt['username'] ?>
            </a> berkomentar
        </b>

        <div class="card bg-light mt-2">
            <div class="card-header">
                <!-- Diposting pada -->
                <p class="card-subtitle mb-2 mt-1" title="Tanggal Diposting">Pada <?= $cmt['comment-created_at'] ?></p>
            </div>
            <div class="card-body">
                <!-- Isi status -->
                <p class="card-text"><?= $cmt['comment'] ?></p>

                <?php if ($cmt['gambar_comment'] != null) { ?>
                    <div class="card card-body bg-light">
                        <center>
                            <img class="img-fluid" src="<?= base_url('gambar/gambar_comment/' . $cmt['gambar_comment']) ?>" title="Gambar Status">
                        </center>
                    </div>
                <?php } ?>
                <hr>

                <div style="font-family: calibri;"><button style="font-weight: bold;" type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalLike<?= $cmt['id_comment'] ?>"><?= $cmt['like'] ?> Suka</button> dan <a href="" style="font-weight: bold;" class="btn btn-outline-success" data-toggle="collapse" data-target="#collapseReply<?= $cmt['id_comment'] ?>"><?= $cmt['reply'] ?> Balasan</a></div>

                <!-- Modal penampilan orang yang like -->
                <div class="modal fade" id="modalLike<?= $cmt['id_comment'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">User Yang Menyukai</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php if ($cmt['like'] != 0) { ?>
                                    <?php foreach ($comment_like as $cmt_lk) : ?>
                                        <?php if ($cmt_lk['id_comment-likecomment'] == $cmt['id_comment']) { ?>
                                            <div class="card my-3">
                                                <a class="teman" href="<?= base_url('friendPage/' . $cmt_lk['slug_users']) ?>">
                                                    <div class="card-body"> <img class="mr-2 rounded-circle" alt="image" height="50px" width="50px" src="<?= base_url('gambar/foto/' . $cmt_lk['fotoprofil']) ?>"> @<?= $cmt_lk['username'] ?>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                <?php } else { ?>
                                    <div class="card bg-light mt-4">
                                        <div class="card-body">
                                            <h4 title="Tidak ada yang menyukai">
                                                Tidak ada yang menyukai komentar ini.
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

                <!-- Tombol like -->
                <?php if ($cmt['sudah_like'] == true) { ?>
                    <button href="<?= base_url('likeComment/' . $status[0]['id_status'] . '/' . $cmt['id_comment']) ?>" class="btn btn-primary fas fa-thumbs-up tombol-like" title="Like"> </button>
                <?php } else { ?>
                    <button href="<?= base_url('likeComment/' . $status[0]['id_status'] . '/' . $cmt['id_comment']) ?>" class="btn btn-secondary fas fa-thumbs-up tombol-like" title="Like"> </button>
                <?php } ?>

                <!-- Reply -->
                <button class="btn btn-success fas fa-reply ml-1" type="button" data-toggle="collapse" data-target="#collapseReply<?= $cmt['id_comment'] ?>" aria-expanded="false" aria-controls="collapseReply<?= $cmt['id_comment'] ?>" title="Reply"> </button>

                <!-- Tombol hapus -->
                <?php if ($cmt['id_users'] == session()->get('id_users')) { ?>
                    <button name="tombol-hapus-comment" href="<?= base_url('deleteComment/' . $cmt['id_comment']) ?>" class="btn btn-danger ml-1 fas fa-trash-alt hapus" title="Hapus"> </button>
                <?php } ?>

                <!-- Jika user komputer ini memiliki level yang bukan 3, maka tombol hak akses admin akan muncul -->
                <?php if ($user['level'] != 3) { ?>
                    <div class="btn-group dropup float-right">
                        <button type="button" class="btn btn-primary dropdown-toggle fas fa-crown" data-toggle="dropdown" title="Fitur Admin" aria-haspopup="true" aria-expanded="false"> </button>
                        <div class="dropdown-menu">
                            <!-- Jika level dari status ini adalah 1 -->
                            <?php if ($cmt['level'] == 1) { ?>
                                <!-- Jika user di komputer ini memiliki level 1, maka tombol hapus akan muncul -->
                                <?php if ($user['level'] == 1) { ?>
                                    <button name="tombol-hapus-comment" href="<?= base_url('deleteComment/' . $cmt['id_comment']) ?>" class="dropdown-item btn btn-danger ml-1 fas fas fa-crown hapus" title="Hapus Sebagai Admin"> Hapus</button>
                                <?php } ?>
                                <!-- Jika user di komputer ini memiliki level 2, maka tombol hapus akan muncul, tapi tidak akan bisa digunakan -->
                                <?php if ($user['level'] == 2) { ?>
                                    <button class="dropdown-item btn btn-danger ml-1 fas fas fa-crown tidak-berhak" title="Anda Tidak Punya Hak"> Anda Tidak Berhak</button>
                                <?php } ?>
                                <!-- Jika level dari status ini adalah 2 -->
                            <?php } elseif ($cmt['level'] == 2) { ?>
                                <!-- Jika user di komputer ini memiliki level 1, maka tombol hapus akan muncul -->
                                <?php if ($user['level'] == 1) { ?>
                                    <button name="tombol-hapus-comment" href="<?= base_url('deleteComment/' . $cmt['id_comment']) ?>" class="dropdown-item btn btn-danger ml-1 fas fas fa-crown hapus" title="Hapus Sebagai Admin"> Hapus</button>
                                <?php } ?>
                                <!-- Jika user di komputer ini memiliki level 2, maka tombol hapus akan muncul, tapi... -->
                                <?php if ($user['level'] == 2) { ?>
                                    <!-- Jika id pada session tidak sama dengan id user di komputer ini, maka user tidak akan berhak -->
                                    <?php if ($cmt['id_users'] != $user['id_users']) { ?>
                                        <button class="dropdown-item btn btn-danger ml-1 fas fas fa-crown tidak-berhak" title="Anda Tidak Punya Hak"> Anda Tidak Berhak</button>
                                    <?php } ?>
                                    <!-- Jika id pada session sama dengan id user di komputer ini, maka tombol hapus akan berfungsi -->
                                    <?php if ($cmt['id_users'] == $user['id_users']) { ?>
                                        <button name="tombol-hapus-comment" href="<?= base_url('deleteComment/' . $cmt['id_comment']) ?>" class="dropdown-item btn btn-danger ml-1 hapusbol-hapus-comment" title="Hapus Sebagai Admin"> Hapus</button>
                                    <?php } ?>
                                <?php } ?>
                                <!-- Jika level dari status ini adalah 3 -->
                            <?php } elseif ($cmt['level'] == 3) { ?>
                                <!-- Jika user di komputer ini memiliki level selain 3, maka tombol hapus akan muncul -->
                                <?php if ($user['level'] != 3) { ?>
                                    <button name="tombol-hapus-comment" href="<?= base_url('deleteComment/' . $cmt['id_comment']) ?>" class="dropdown-item btn btn-danger ml-1 fas fas fa-crown hapus" title="Hapus Sebagai Admin"> Hapus</button>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <div class="collapse" id="collapseReply<?= $cmt['id_comment'] ?>">
                    <hr>
                    <div class="card-body mt-3">
                        <!-- Form membuat reply -->
                        <form action="<?= base_url('createReply/' . $status[0]['id_status'] . '/' . $cmt['id_comment']) ?>" method="post" enctype="multipart/form-data">
                            <!-- Fungsi set_value digunakan agar form yang telah diisi tidak hilang ketika halaman direfresh -->
                            <?= csrf_field(); ?>
                            <div class="form-group">
                                <textarea class="form-control" maxlength="1000" name="reply" id="reply" cols="70" rows="3" placeholder="Balas Komentar ini" data-toggle="tooltip" title="Tulis Reply" required autofocus></textarea>
                            </div>

                            <p>
                                <button class="btn btn-primary fas fa-upload" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    Upload Gambar
                                </button>
                            </p>
                            <div class="collapse" id="collapseExample">
                                <div class="card card-body mb-3">
                                    <!-- Form upload gambar -->
                                    <div class="form-group">
                                        <input type="file" class="custom-file-input fas dropify" data-height="120" name="gambar" id="gambar">
                                    </div>
                                </div>
                            </div>

                            <!-- Button buat Balasan -->
                            <button type="submit" class="btn btn-success mb-3 fas fa-pen" data-toggle="tooltip" title="Posting Balasan"> Posting Balasan</button>
                        </form>

                        <!-- Jika tidak ada balasan -->
                        <?php if ($cmt['reply'] == 0) { ?>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h1 title="Tidak Ada Balasan">
                                        Tidak Ada Balasan
                                    </h1>
                                </div>
                            </div>

                            <!-- Jika terdapat komentar -->
                        <?php } else { ?>
                            <!-- Semua komentar yang ada akan diprint di sini -->
                            <?php foreach ($reply as $rpy) { ?>
                                <?php if ($rpy['id_comment-reply'] == $cmt['id_comment']) { ?>

                                    <br>

                                    <!-- Foto profil -->
                                    <img src="<?= base_url('gambar/foto/' . $rpy['fotoprofil']) ?>" alt="image" title="Foto Profil User" class="rounded-circle" height="50px" width="50px">
                                    <b title="Pembuat Komentar">
                                        <a href=<?= base_url('friendPage/' . $rpy['slug_users']) ?>>
                                            @<?= $rpy['username'] ?>
                                        </a> membalas
                                    </b>

                                    <div class="card bg-light mt-2">
                                        <div class="card-header">
                                            <!-- Diposting pada -->
                                            <p class="card-subtitle mb-2 mt-1" title="Tanggal Diposting">Pada <?= $rpy['reply-created_at'] ?></p>
                                        </div>
                                        <div class="card-body">
                                            <!-- Isi status -->
                                            <p class="card-text"><?= $rpy['reply'] ?></p>

                                            <?php if ($rpy['gambar_reply'] != null) { ?>
                                                <div class="card card-body bg-light">
                                                    <center>
                                                        <img class="img-fluid" src="<?= base_url('gambar/gambar_reply/' . $rpy['gambar_reply']) ?>" title="Gambar Status">
                                                    </center>
                                                </div>
                                            <?php } ?>
                                            <hr>

                                            <div style="font-family: calibri;"><button style="font-weight: bold;" type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalLike<?= $rpy['id_reply'] ?>"><?= $rpy['like'] ?> Suka</button></div>

                                            <!-- Modal penampilan orang yang like -->
                                            <div class="modal fade" id="modalLike<?= $rpy['id_reply'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">User Yang Menyukai</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php if ($rpy['like'] != 0) { ?>
                                                                <?php foreach ($reply_like as $rpy_lk) : ?>
                                                                    <?php if ($rpy_lk['id_reply-likereply'] == $rpy['id_reply']) { ?>
                                                                        <div class="card my-3">
                                                                            <a class="teman" href="<?= base_url('friendPage/' . $rpy_lk['slug_users']) ?>">
                                                                                <div class="card-body"> <img class="mr-2 rounded-circle" alt="image" height="50px" width="50px" src="<?= base_url('gambar/foto/' . $rpy_lk['fotoprofil']) ?>"> @<?= $rpy_lk['username'] ?>
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    <?php } ?>
                                                                <?php endforeach; ?>
                                                            <?php } else { ?>
                                                                <div class="card bg-light mt-4">
                                                                    <div class="card-body">
                                                                        <h4 title="Tidak ada yang menyukai">
                                                                            Tidak ada yang menyukai komentar ini.
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
                                            <?php if ($rpy['sudah_like'] == true) { ?>
                                                <button href="<?= base_url('likeReply/' . $status[0]['id_status'] . '/' . $cmt['id_comment'] . '/' . $rpy['id_reply']) ?>" class="btn btn-primary fas fa-thumbs-up tombol-like" title="Like"> </button>
                                            <?php } else { ?>
                                                <button href="<?= base_url('likeReply/' . $status[0]['id_status'] . '/' . $cmt['id_comment'] . '/' . $rpy['id_reply']) ?>" class="btn btn-secondary fas fa-thumbs-up tombol-like" title="Like"> </button>
                                            <?php } ?>

                                            <!-- Jika reply ini dibuat oleh user di komputer ini, maka tombol hapus akan muncul -->
                                            <?php if ($rpy['id_users'] == session()->get('id_users')) { ?>
                                                <button name="tombol-hapus-reply" href="<?= base_url('deleteReply/' . $rpy['id_reply']) ?>" class="btn btn-danger ml-1 fas fa-trash-alt hapus" title="Hapus"> </button>
                                            <?php } ?>

                                            <!-- Jika user komputer ini memiliki level yang bukan 3, maka tombol hak akses admin akan muncul -->
                                            <?php if ($user['level'] != 3) { ?>
                                                <div class="btn-group dropup float-right">
                                                    <button type="button" class="btn btn-primary dropdown-toggle fas fa-crown" data-toggle="dropdown" title="Fitur Admin" aria-haspopup="true" aria-expanded="false"> </button>
                                                    <div class="dropdown-menu">
                                                        <!-- Jika level dari status ini adalah 1 -->
                                                        <?php if ($rpy['level'] == 1) { ?>
                                                            <!-- Jika user di komputer ini memiliki level 1, maka tombol hapus akan muncul -->
                                                            <?php if ($user['level'] == 1) { ?>
                                                                <button name="tombol-hapus-reply" href="<?= base_url('deleteReply/' . $rpy['id_reply']) ?>" class="dropdown-item btn btn-danger ml-1 fas fas fa-crown hapus" title="Hapus Sebagai Admin"> Hapus</button>
                                                            <?php } ?>
                                                            <!-- Jika user di komputer ini memiliki level 2, maka tombol hapus akan muncul, tapi tidak akan bisa digunakan -->
                                                            <?php if ($user['level'] == 2) { ?>
                                                                <button class="dropdown-item btn btn-danger ml-1 fas fas fa-crown tidak-berhak" title="Anda Tidak Punya Hak"> Anda Tidak Berhak</button>
                                                            <?php } ?>
                                                            <!-- Jika level dari status ini adalah 2 -->
                                                        <?php } elseif ($rpy['level'] == 2) { ?>
                                                            <!-- Jika user di komputer ini memiliki level 1, maka tombol hapus akan muncul -->
                                                            <?php if ($user['level'] == 1) { ?>
                                                                <button name="tombol-hapus-reply" href="<?= base_url('deleteReply/' . $rpy['id_reply']) ?>" class="dropdown-item btn btn-danger ml-1 fas fas fa-crown hapus" title="Hapus Sebagai Admin"> Hapus</button>
                                                            <?php } ?>
                                                            <!-- Jika user di komputer ini memiliki level 2, maka tombol hapus akan muncul, tapi... -->
                                                            <?php if ($user['level'] == 2) { ?>
                                                                <!-- Jika id pada session tidak sama dengan id user di komputer ini, maka user tidak akan berhak -->
                                                                <?php if ($rpy['id_users'] != $user['id_users']) { ?>
                                                                    <button class="dropdown-item btn btn-danger ml-1 fas fas fa-crown tidak-berhak" title="Anda Tidak Punya Hak"> Anda Tidak Berhak</button>
                                                                <?php } ?>
                                                                <!-- Jika id pada session sama dengan id user di komputer ini, maka tombol hapus akan berfungsi -->
                                                                <?php if ($rpy['id_users'] == $user['id_users']) { ?>
                                                                    <button name="tombol-hapus-reply" href="<?= base_url('deleteReply/' . $rpy['id_reply']) ?>" class="dropdown-item btn btn-danger ml-1 hapusbol-hapus-comment" title="Hapus Sebagai Admin"> Hapus</button>
                                                                <?php } ?>
                                                            <?php } ?>
                                                            <!-- Jika level dari status ini adalah 3 -->
                                                        <?php } elseif ($rpy['level'] == 3) { ?>
                                                            <!-- Jika user di komputer ini memiliki level selain 3, maka tombol hapus akan muncul -->
                                                            <?php if ($user['level'] != 3) { ?>
                                                                <button name="tombol-hapus-reply" href="<?= base_url('deleteReply/' . $rpy['id_reply']) ?>" class="dropdown-item btn btn-danger ml-1 fas fas fa-crown hapus" title="Hapus Sebagai Admin"> Hapus</button>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>

<?= $this->endSection('content'); ?>