// Jika tombol seri friend di klik
$('.friend').on('click', function (e) {
    // href default dari html dimatikan
    e.preventDefault();
    // Memasukkan href dari html ke dalam const href
    const href = $(this).attr('href');
    // Mencari nama tombol
    const name = $(this).attr('name');

    let texts;
    let img;

    if (name === 'add') {
        texts = "Anda akan mengirimkan permintaan pertemanan kepada User ini.";
        img = "http://localhost:8080/assets/img/sweetalert/tambah-teman.jpg";
    } else if (name === 'cancel') {
        texts = "Anda akan membatalkan permintaan pertemanan kepada User ini.";
        img = "http://localhost:8080/assets/img/sweetalert/hapus-teman.jpg";
    } else if (name === 'delete') {
        texts = "Anda akan menghapus User ini dari teman anda.";
        img = "http://localhost:8080/assets/img/sweetalert/hapus-teman.jpg";
    } else if (name === 'accept') {
        texts = "Anda akan menerima permintaan pertemanan dari User ini."
        img = "http://localhost:8080/assets/img/sweetalert/terima-teman.jpg";
    } else if (name === 'reject') {
        texts = "Anda akan menolak permintaan pertemanan dari User ini.";
        img = "http://localhost:8080/assets/img/sweetalert/hapus-teman.jpg";
    }

    // Fungsi sweetalert2
    Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: texts,
        imageUrl: img,
        imageWidth: 400,
        imageHeight: 200,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Kirim!'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    })
});


// Jika tombol hapus apapun di klik
$('.hapus').on('click', function (e) {
    // href default dari html dimatikan
    e.preventDefault();
    // Memasukkan href dari html ke dalam const href
    const href = $(this).attr('href');
    // Mencari nama tombol
    const name = $(this).attr('name');

    let texts;
    let img;

    if (name === 'tombol-hapus-status') {
        texts = "Sekali anda menghapus Status ini, anda tidak akan dapat mengembalikannya.";
        img = "http://localhost:8080/assets/img/sweetalert/hapus-status.jpg";
    } else if (name === 'tombol-hapus-comment') {
        texts = "Sekali anda menghapus Komentar ini, anda tidak akan dapat mengembalikannya.";
        img = "http://localhost:8080/assets/img/sweetalert/hapus-komentar.jpg";
    } else if (name === 'tombol-hapus-reply') {
        texts = "Sekali anda menghapus Balasan ini, anda tidak akan dapat mengembalikannya.";
        img = "http://localhost:8080/assets/img/sweetalert/hapus-reply.jpg";
    } else if (name === 'tombol-hapus-akun') {
        texts = "Sekali anda menghapus Akun ini, anda tidak akan dapat mengembalikannya."
        img = "http://localhost:8080/assets/img/sweetalert/hapus-akun.jpg";
    }

    // Fungsi sweetalert2
    Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: texts,
        imageUrl: img,
        imageWidth: 400,
        imageHeight: 200,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus!'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    })
});


// Jadikan admin
$('.ubah').on('click', function (e) {
    e.preventDefault();
    const href = $(this).attr('href');
    const name = $(this).attr('name');

    if (name === 'tombol-ubah-admin') {
        texts = "Anda akan merubah User ini menjadi Admin.";
        img = "http://localhost:8080/assets/img/sweetalert/jadikan-admin.jpg";
    } else if (name === 'tombol-ubah-user') {
        texts = "Anda akan merubah Admin ini menjadi User.";
        img = "http://localhost:8080/assets/img/sweetalert/jadikan-user.jpg";
    }

    Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: texts,
        imageUrl: img,
        imageWidth: 400,
        imageHeight: 200,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Lakukan!'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    })
});


// Tidak berhak
$('.tidak-berhak').on('click', function () {
    Swal.fire({
        title: 'Anda Tidak Berhak!',
        text: 'Anda tidak berhak untuk melakukan tindakan tersebut.',
        imageUrl: 'http://localhost:8080/assets/img/sweetalert/tidak-berhak.jpg',
        imageWidth: 400,
        imageHeight: 200,
    })
});


// Jika ada sesi berhasil
const berhasilData = $('.berhasil-data').data('berhasildata');
if (berhasilData) {

    Swal.fire({
        imageUrl: 'http://localhost:8080/assets/img/sweetalert/berhasil.jpg',
        imageWidth: 400,
        imageHeight: 200,
        title: 'Berhasil',
        text: berhasilData,
    });
}


// Jika ada sesi gagal
const gagalData = $('.gagal-data').data('gagaldata');
if (gagalData) {

    Swal.fire({
        imageUrl: 'http://localhost:8080/assets/img/sweetalert/gagal.jpg',
        imageWidth: 400,
        imageHeight: 200,
        title: 'Gagal',
        text: gagalData,
    })
}