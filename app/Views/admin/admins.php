<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<center>
    <h2 class="fas fa-crown"> Selamat datang di halaman Admin,
        <?php print '@' . $user['username'];
        if ($user['level'] == 1) { ?>
            (Owner)
        <?php } elseif ($user['level'] == 2) { ?>
            (Admin)
        <?php } ?>
    </h2>
</center>

<br><br>

<div class="card card-body bg-light">
    <div class="row">
        <div class="col-12 col-sm-6 float-right">
            <h3>
                <?php if ($status['type'] == 'biasa') { ?>
                    Jumlah User Total:
                <?php } elseif ($status['type'] == 'cari') { ?>
                    User Ditemukan:
                <?php } ?>
                <?php print($status['jumlah_users']); ?>
            </h3>
        </div>
        <div class="col-12 col-sm-6 float-right">
            <form class="" action="<?= base_url('admins') ?>" method="post">
                <div class="input-group">
                    <input type="text" class="form-control" value="<?= set_value('keyword') ?>" name="keyword" id="keyword" placeholder="Masukkan Kata Kunci Pencarian (Username atau Nama)" maxlength="100" autocomplete="off" autofocus>
                    <div class="input-group-append">
                        <input class="btn btn-success fas" type="submit" name="submit" value="Search">
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

        <!-- Jika tidak ada user yang ditemukan saat pencarian -->
    <?php } else if ($friend[0] == 'kosong') { ?>
        <div class="card bg-light mt-4">
            <div class="card-body">
                <h3 title="User tidak ditemukan">
                    Tidak ada User yang memiliki kemiripan dengan kata kunci "<?= set_value('keyword') ?>" di dalam Database, mohon cari lagi dengan kata kunci yang berbeda.
                </h3>
            </div>
        </div>

        <!-- Jika ada user -->
    <?php } else { ?>
        <!-- Semua data diri user -->
        <div class="table-responsive">
            <table class="table table-secondary table-bordered mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">
                            <center>No</center>
                        </th>
                        <th scope="col-sm">
                            <center>Username</center>
                        </th>
                        <th scope="col-sm">
                            <center>Nama</center>
                        </th>
                        <th scope="col-sm">
                            <center>Email</center>
                        </th>
                        <th scope="col-sm">
                            <center>Tanggal_Bergabung</center>
                        </th>
                        <th scope="col-sm">
                            <center>Foto_Profil_User</center>
                        </th>
                        <th scope="col-sm">
                            <center>Status</center>
                        </th>
                        <th scope="col-sm">
                            <center>Aksi</center>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <!-- Semua user yang ada akan diprint oleh fungsi ini -->
                    <?php $no = 1 + (5 * ($current_page - 1));
                    foreach ($friend as $frd) : ?>
                        <tr>
                            <th>
                                <p><?= $no++; ?></p>
                            </th>
                            <td>
                                <a title="Nama Username" href=<?= base_url('friendPage/' . $frd['slug_users']) ?>>
                                    <!-- Jika user tersebut adalah owner atau admin, maka fungsi ini akan dijalankan -->
                                    <p>
                                        @<?= $frd['username'] ?>
                                        <?php if ($frd['level'] == 1) { ?>
                                            (Owner)
                                        <?php } elseif ($frd['level'] == 2) { ?>
                                            (Admin)
                                        <?php } elseif ($frd['level'] == 3) { ?>
                                            (User)
                                        <?php } ?>
                                    </p>
                                </a>
                            </td>
                            <td>
                                <!-- Jika user tersebut adalah owner atau admin, maka fungsi ini akan dijalankan -->
                                <p>
                                    <?= $frd['firstname'] . ' ' . $frd['lastname'] ?>
                                </p>
                            </td>
                            <td>
                                <p title="Email"><?= $frd['email'] ?></p>
                            </td>
                            <td>
                                <p title="Tanggal Bergabung"><?= $frd['users-created_at'] ?></p>
                            </td>
                            <td class="fotoadmin">
                                <center>
                                    <img src="<?= base_url('gambar/foto/' . $frd['fotoprofil']); ?>" alt="image" title="Foto Profil User" class="rounded-circle">
                                </center>
                            </td>
                            <td>
                                <p title="Status Akun">
                                    <?php if ($frd['is_active'] == 1) { ?>
                                        Aktif
                                    <?php } else { ?>
                                        Belum Aktif
                                    <?php } ?>
                                </p>
                            </td>
                            <td>

                                <div class="btn-group dropup float-right mt-2">
                                    <a class="btn btn-success fas fa-edit mr-2" href="<?= base_url('edit/' . $frd['slug_users']) ?>" title="Ubah data User"> </a>
                                    <button type="button" class="btn btn-primary dropdown-toggle fas fa-crown" data-toggle="dropdown" title="Fitur Admin" aria-haspopup="true" aria-expanded="false"> </button>
                                    <div class="dropdown-menu">
                                        <?php if ($frd['level'] == 1) { ?>
                                            <?php if ($user['level'] == 1) { ?>
                                                <button name="tombol-hapus-akun" href="<?= base_url('deleteAccountAdmin/' . $frd['id_users']) ?>" class="dropdown-item btn btn-danger ml-1 fas fas fa-crown hapus" title="Hapus Sebagai Admin"> Hapus</button>
                                            <?php } ?>
                                            <?php if ($user['level'] == 2) { ?>
                                                <button class="dropdown-item btn btn-danger ml-1 fas fas fa-crown tidak-berhak" title="Anda Tidak Punya Hak"> Anda Tidak Berhak</button>
                                            <?php } ?>
                                        <?php } elseif ($frd['level'] == 2) { ?>
                                            <?php if ($user['level'] == 1) { ?>
                                                <button name="tombol-hapus-akun" href="<?= base_url('deleteAccountAdmin/' . $frd['id_users']) ?>" class="dropdown-item btn btn-danger ml-1 fas fas fa-crown hapus" title="Hapus Sebagai Admin"> Hapus</button>
                                                <div class="dropdown-divider"></div>
                                                <button name="tombol-ubah-user" href="<?= base_url('changeLevelDown/' . $frd['id_users']) ?>" class="dropdown-item btn btn-danger ml-1 fas fas fa-crown ubah" title="Ubah Menjadi User"> Jadikan User</button>
                                            <?php } ?>
                                            <?php if ($user['level'] == 2) { ?>
                                                <?php if ($frd['id_users'] != $user['id_users']) { ?>
                                                    <button class="dropdown-item btn btn-danger ml-1 fas fas fa-crown tidak-berhak" title="Anda Tidak Punya Hak"> Anda Tidak Berhak</button>
                                                <?php } ?>
                                                <?php if ($frd['id_users'] == $user['id_users']) { ?>
                                                    <button name="tombol-hapus-akun" href="<?= base_url('deleteAccountAdmin/' . $frd['id_users']) ?>" class="dropdown-item btn btn-danger ml-1 fas fas fa-crown hapus" title="Hapus Sebagai Admin"> Hapus</button>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } elseif ($frd['level'] == 3) { ?>
                                            <?php if ($user['level'] != 3) { ?>
                                                <button name="tombol-hapus-akun" href="<?= base_url('deleteAccountAdmin/' . $frd['id_users']) ?>" class="dropdown-item btn btn-danger ml-1 fas fas fa-crown hapus" title="Hapus Sebagai Admin"> Hapus</button>
                                                <div class="dropdown-divider"></div>
                                                <button name="tombol-ubah-admin" href="<?= base_url('changeLevelUp/' . $frd['id_users']) ?>" class="dropdown-item btn btn-danger ml-1 fas fas fa-crown ubah" title="Ubah Menjadi Admin"> Jadikan Admin</button>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('users', 'users_pagination') ?>
        </div>
</div>
<?php } ?>

<?= $this->endSection('content'); ?>