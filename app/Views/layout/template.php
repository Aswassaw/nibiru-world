<!-- <html oncontextmenu="return false" lang="en"> -->
<html>

<!-- Mengisi variabel $uri dengan service('uri')/ url saat ini -->
<?php $uri = service('uri'); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>

        <?php if ($uri->getSegment(1) == 'profile') { ?>
            @<?= $user['username'] ?> <?= $title; ?>
        <?php } elseif ($uri->getSegment(1) == 'friendPage') { ?>
            <?php if ($friend == null) { ?>
                User Tidak Tersedia
            <?php } else { ?>
                @<?= $friend['username'] ?> <?= $title; ?>
            <?php } ?>
        <?php } elseif ($uri->getSegment(1) == 'comment') { ?>
            <?php if ($status == null) { ?>
                Status Tidak Tersedia
            <?php } else { ?>
                <?php foreach ($status as $sts) : ?>
                    <?= $title; ?> For Status Made By @<?= $sts['username'] ?>
                <?php endforeach; ?>
            <?php } ?>
        <?php } elseif ($uri->getSegment(1) == 'friendList') { ?>
            @<?= $friend_pemilik['username'] ?> <?= $title; ?>
        <?php } elseif ($uri->getSegment(1) == 'chatPage') { ?>
            <?php if ($friend == null) { ?>
                User Tidak Tersedia
            <?php } else { ?>
                <?= $title; ?> With @<?= $friend['username'] ?>
            <?php } ?>
        <?php } elseif ($uri->getSegment(1) == 'chatPageAll') { ?>
            <?php if ($friend == null) { ?>
                User Tidak Tersedia
            <?php } else { ?>
                <?= $title; ?> With @<?= $friend['username'] ?> Full
            <?php } ?>
        <?php } else { ?>
            <?= $title; ?>
        <?php } ?>

    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/pribadi/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.0/css/all.min.css" integrity="sha512-gRH0EcIcYBFkQTnbpO8k0WlsD20x5VzjhOA1Og8+ZUAhcMUCvd+APD35FJw3GzHAP3e+mP28YcDJxVr745loHw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <!-- Memanggil Navbar -->
    <?= $this->include('layout/navbar'); ?>

    <div class="render-page" title="Jumlah Waktu Proses Render Halaman">
        <center>
            <b style="color: white;" class="fas" id="waktuSekarang"></b>
        </center>
    </div>

    <br>

    <!-- Memanggil tampilan alert success dan danger -->
    <?= $this->include('layout/lainnya'); ?>

    <!-- Memanggil content -->
    <div class="container mt-2 mb-2">
        <br>
        <!-- <br> aktifkan ini jika yang atas aktif -->
        <?= $this->renderSection('content'); ?>
        <br>
    </div>

    <?php if ($uri->getSegment(1) == 'chatPage' or $uri->getSegment(1) == 'chatPageAll') { ?>
        <!-- Tidak ada backtotop -->
    <?php } else { ?>
        <div class="img-thumbnail" title="Kembali ke atas" id='Back-to-top'></div>
    <?php } ?>

    <?php session()->remove('danger'); ?>
    <?php session()->remove('belum-aktif'); ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="/assets/pribadi/js/script.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/assets/sweetalert/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js" integrity="sha512-hJsxoiLoVRkwHNvA5alz/GVA+eWtVxdQ48iy4sFRQLpDrBPn6BFZeUcW4R4kU+Rj2ljM9wHwekwVtsb0RY/46Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>