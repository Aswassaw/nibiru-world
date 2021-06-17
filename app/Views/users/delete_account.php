<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col-12">

        <center>
            <h2 class="fas">Apakah Anda benar-benar yakin ingin menghapus Akun Anda?</h2>
        </center>
        <hr>

        <marquee class="my-1" behavior="alternate">
            <h3 style="color: white" class="card card-body bg-danger fas fa-smile"> Harap Pikirkan Dengan Baik Keputusan Anda</h3>
        </marquee>
        <hr>

        <center>
            <h4>Berikut ini adalah konsekuensi dari penghapusan akun.</h4>
        </center>

        <div style="color:black" class="row">
            <div class="col">
                <div class="card card-body mt-2">
                    <h4 class="fas">Konsekuensi Terhadap Akun</h4>
                    Akun anda akan hilang pada situs ini, anda tidak akan dapat berinteraksi dengan semua user pada situs ini lagi. Anda akan lenyap tanpa jejak, hingga hanya kenangan user yang pernah berinteraksi dengan anda saja yang tersisa.
                </div>
            </div>
            <div class="col">
                <div class="card card-body mt-2">
                    <h4 class="fas">Konsekuensi Status dan Komentar</h4>
                    Seluruh Status serta Komentar yang telah anda posting akan ikut terhapus dari situs ini. Anda tidak akan dapat melihat Status atau Komentar yang pernah anda posting setelah proses penghapusan akun terjadi.
                </div>
            </div>
        </div>
        <hr>

        <h5>Jika Anda telah siap menerima semua konsekuensi yang ada, silahkan klik tombol "Hapus Akun Sekarang" di bawah untuk menghapus Akun</h5>
        <button name="tombol-hapus-akun" href="<?= base_url('deleteAccount/' . $user['id_users'])?>" class="btn btn-danger mt-2 fas fa-user-minus hapus"> Hapus Akun Sekarang</button>
    </div>
</div>

<?= $this->endSection('content'); ?>