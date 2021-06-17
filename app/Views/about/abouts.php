<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col-12">

        <br>

        <h2 class="fas">
            About This Site
        </h2>

        <br><br>

        <div class="card card-body">
            <h4 class="mx-auto fas">Apa Itu NibiruWorld/AswassawExe2?</h4>
            <div class="gambar mb-3 mt-2">
                <center><img src="<?= base_url('assets/img/logo/logo120px.webp') ?>" data-toggle="tooltip" title="Logo AswassawExe" height="120px" width="120px"></center>
            </div>
            <p>NibiruWorld/AswassawExe2 adalah sebuah situs Sosial Media yang dikembangkan oleh siswa SMK bernama Andry Pebrianto sebagai tugas laporan akhir PKL-nya. AswassawExe dikembangkan menggunakan sebuah Framework PHP yang bernama CodeiIgniter 4 dan sebuah Framework CSS yang bernama Bootstrap. Project situs ini bersifat Open Source, jika kalian ingin Source Code dari situs ini silahkan kunjungi Github atau Gitlab milik Andry pada link berikut:<br><br>
                Github: <a href="https://github.com/Aswassaw/AswassawExe" target="_blank">NibiruWorld/AswassawExe2 Source Code</a><br>
                Gitlab: <a href="https://gitlab.com/aswassaw227/aswassawexe-sosmed" target="_blank">NibiruWorld/AswassawExe2 Source Code</a>
            </p>
        </div>

        <br><br>

        <p>
            <button class="btn btn-success" data-toggle="collapse" href="#codeigniter" role="button" aria-expanded="false" aria-controls="codeigniter"><i class="fas fa-fire"></i> CodeIgniter 4.3</button>
            <button class="btn btn-success float-right" data-toggle="collapse" href="#bootstrap" role="button" aria-expanded="false" aria-controls="bootstrap"><i class='fab fa-bootstrap'></i> Bootstrap 4.5</button>
        </p>

        <div class="row">
            <div class="col">
                <div class="collapse multi-collapse" id="codeigniter">
                    <div class="card card-body">
                        <h4 class="mx-auto">Apa Itu CodeIgniter?</h4>
                        <div class="gambar mb-3 mt-2">
                            <center><img src="<?= base_url('assets/img/lainnya/logocodeigniter.png') ?>" data-toggle="tooltip" title="Logo CodeIgniter" height="120px" width="100px"></center>
                        </div>
                        CodeIgniter merupakan aplikasi sumber terbuka yang berupa kerangka kerja PHP dengan model MVC untuk membangun situs web dinamis dengan menggunakan PHP. CodeIgniter memudahkan pengembang web untuk membuat aplikasi web dengan cepat dan mudah dibandingkan dengan membuatnya dari awal.
                        <a href="https://codeigniter.com/" target="_blank">CodeIgniter Official Site</a>
                    </div>
                    <br>
                </div>
            </div>

            <div class="col">
                <div class="collapse multi-collapse" id="bootstrap">
                    <div class="card card-body">
                        <h4 class="mx-auto">Apa Itu Bootstrap?</h4>
                        <div class="gambar mb-3 mt-2">
                            <center><img src="<?= base_url('assets/img/lainnya/logobootstrap.png') ?>" data-toggle="tooltip" title="Logo Bootstrap" height="120px" width="120px"></center>
                        </div>
                        Bootstrap adalah kerangka kerja CSS yang sumber terbuka dan bebas untuk merancang situs web dan aplikasi web. Kerangka kerja ini berisi templat desain berbasis HTML dan CSS untuk tipografi, formulir, tombol, navigasi, dan komponen antarmuka lainnya, serta juga ekstensi opsional JavaScript.
                        <a href="https://getbootstrap.com/" target="_blank">Bootstrap Official Site</a>
                    </div>
                    <br>
                </div>
            </div>
        </div>

        <p>
            <button class="btn btn-success" data-toggle="collapse" href="#fontawesome" role="button" aria-expanded="false" aria-controls="fontawesome"><i class="fab fa-font-awesome"></i> FontAwesome 5.1</button>
            <button class="btn btn-success float-right" data-toggle="collapse" href="#sweetalert" role="button" aria-expanded="false" aria-controls="sweetalert"><i class="fab fa-js"></i> SweetAlert 2</button>
        </p>

        <div class="row">
            <div class="col">
                <div class="collapse multi-collapse" id="fontawesome">
                    <div class="card card-body">
                        <h4 class="mx-auto">Apa Itu FontAwesome?</h4>
                        <div class="gambar mb-3 mt-2">
                            <center><img src="<?= base_url('assets/img/lainnya/logofontawesome.png') ?>" data-toggle="tooltip" title="Logo FontAwesome" height="120px" width="120px"></center>
                        </div>
                        FontAwesome adalah font dan ikon toolkit berdasarkan CSS dan biasanya digunakan pada web untuk mempercantik web dengan ikon-ikon yang disediakan oleh FontAwesome. FontAwesome sendiri tersedia dengan 2 versi, yaitu versi gratis yang terbatas dan versi berbayar yang full.
                        <a href="https://fontawesome.com/" target="_blank">FontAwesome Official Site</a>
                    </div>
                    <br>
                </div>
            </div>

            <div class="col">
                <div class="collapse multi-collapse" id="sweetalert">
                    <div class="card card-body">
                        <h4 class="mx-auto">Apa Itu SweetAlert?</h4>
                        <div class="gambar mb-3 mt-2">
                            <center><img src="<?= base_url('assets/img/lainnya/logosweetalert2.png') ?>" data-toggle="tooltip" title="Logo SweetAlert2" height="120px" width="120px"></center>
                        </div>
                        SweetAlert adalah sebuah library Javascript yang dibuat untuk mempercantik tampilan sebuah alert pada halaman web. Dikarenakan tampilan alert default pada javascript sangatlah biasa dan membosankan, maka dari itulah library ini dibuat demi mempercantik tampilan alert agar lebih terlihat elegan.
                        <a href="https://sweetalert2.github.io/" target="_blank">SweetAlert Official Site</a>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>