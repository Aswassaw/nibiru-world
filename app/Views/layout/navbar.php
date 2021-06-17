<!-- Mengisi variabel $uri dengan service('uri')/ url saat ini -->
<?php $uri = service('uri'); ?>

<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-info">

    <div class="container">
        <a href="<?= base_url('/') ?>">
            <img src="<?= base_url('assets/img/logo/logo50px.webp') ?>" title="Logo AswassawExe" height="50px" width="50px">
            <span class="fas navbar-brand ml-1" title="AswassawExe">NibiruWorld</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Jika terdapat sebuah sesi dengan nama isLoggedIn, maka jalankan perintah ini -->
            <?php if (session()->get('isLoggedIn')) : ?>

                <ul class="navbar-nav mr-auto">
                    <li class="nav-item <?= ($uri->getSegment(1)) == 'home' ? 'active' : null ?>">
                        <a class="nav-link" href="<?= base_url('home') ?>" data-toggle="tooltip" title="Home"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="nav-item dropdown <?= ($uri->getSegment(1)) == 'friend' ? 'active' : null ?> <?= ($uri->getSegment(1)) == 'friendRequest' ? 'active' : null ?>">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Friend"><i class="fas fa-users"></i>
                            Friend
                            <?php if ($notification_friend) { ?>
                                <span class="badge badge-light">
                                    <?= $notification_friend ?>
                                </span>
                            <?php } ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" title="Permintaan Pertemanan" href="<?= base_url('friendRequest') ?>"><i class="fas fa-user-plus"></i> Permintaan
                                <?php if ($notification_friend) { ?>
                                    <span class="badge badge-dark">
                                        <?= $notification_friend ?>
                                    </span>
                                <?php } ?>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" title="Cari Seseorang" href="<?= base_url('friend') ?>"><i class="fas fa-search"></i> Cari</a>
                        </div>
                    </li>
                    <li class="nav-item <?= ($uri->getSegment(1)) == 'chatList' ? 'active' : null ?>">
                        <a class="nav-link" href="<?= base_url('chatList') ?>" data-toggle="tooltip" title="Chat"><i class="fas fa-comments"></i> Chat
                            <?php if ($notification_chat) { ?>
                                <span class="badge badge-light">
                                    <?= $notification_chat ?>
                                </span>
                            <?php } ?>
                        </a>
                    </li>
                    <?php if ($user['level'] != 3) { ?>
                        <li class="nav-item <?= ($uri->getSegment(1)) == 'admins' ? 'active' : null ?>">
                            <a class="nav-link" href="<?= base_url('admins') ?>" data-toggle="tooltip" title="Admin"><i class="fas fa-crown"></i> Admin</a>
                        </li>
                    <?php } ?>
                    <li class="nav-item <?= ($uri->getSegment(1)) == 'notifications' ? 'active' : null ?>">
                        <a class="nav-link" href="<?= base_url('notifications') ?>" data-toggle="tooltip" title="Notifikasi"><i class="fas fa-bell"></i> Notification
                            <?php if ($notification_all) { ?>
                                <span class="badge badge-light">
                                    <?= $notification_all ?>
                                </span>
                            <?php } ?>
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav my-2 my-lg-0">
                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle dropdown-kanan" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-toggle="tooltip" title="Profile dan Konfigurasi Lainnya">
                            <img src="<?= base_url('gambar/foto/' . $user['fotoprofil']); ?>" alt="image" class="rounded-circle" height="50px" width="50px"> <b>@<?= $user['username'] ?></b></a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?= base_url('profile') ?>" data-toggle="tooltip" title="Lihat Profil"><i class="fas fa-user"></i> Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= base_url('abouts') ?>" data-toggle="tooltip" title="Tentang Situs Ini"><i class="fas fa-exclamation-circle"></i> About</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= base_url('deleteAccountPage') ?>" data-toggle="tooltip" title="Hapus Akun"><i class="fas fa-user-minus"></i> Delete Account</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= base_url('logout') ?>" data-toggle="tooltip" title="Keluar Sekarang"><i class="fas fa-sign-out-alt"></i> Log-Out</a>
                        </div>
                    </li>
                </ul>

                <!-- Jika tidak terdapat sebuah sesi dengan nama isLoggedIn, maka jalankan perintah ini -->
            <?php else : ?>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item <?= ($uri->getSegment(1) == '' ? 'active' : null) ?>">
                        <a class="nav-link" href="<?= base_url('/') ?>" data-toggle="tooltip" title="Log-In"><i class="fas fa-sign-in-alt"></i> Log-In</a>
                    </li>
                    <li class="nav-item <?= ($uri->getSegment(1) == 'register' ? 'active' : null) ?>">
                        <a class="nav-link" href="<?= base_url('register') ?>" data-toggle="tooltip" title="Register"><i class="fas fa-user-plus"></i> Register</a>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</nav>