// Jika tombol like status di klik
$('.tombol-like').on('click', function (e) {
    // href default dari html dimatikan
    e.preventDefault();
    // Memasukkan href dari html ke dalam const href
    const href = $(this).attr('href');
    // Menuju ke href yang dimaksud
    document.location.href = href;
});


// Jika tombol notification status di klik
$('.notification').on('click', function (e) {
    // href default dari html dimatikan
    e.preventDefault();
    // Memasukkan href dari html ke dalam const href
    const href = $(this).attr('href');
    // Menuju ke href yang dimaksud
    document.location.href = href;
});


// Fungsi BackToTop
$(function () {
    // Secara default #Back-to-top akan terhide
    $('#Back-to-top').hide();
    // Jika ada scroll
    $(window).scroll(function () {
        // Jika jarak scroll dari atas lebih dari 300, maka jalankan fungsi ini
        if ($(this).scrollTop() > 500) {
            // Akan di show
            $('#Back-to-top').show();
        }
        // Lainnya
        else {
            // Akan dihide
            $('#Back-to-top').hide();
        }
    });

    // Jika #Back-to-top diklik, maka akan ke atas sesuai dengan animasi dari fungsi js ini
    $('#Back-to-top').click(function () {
        $('body,html')
            .animate({ scrollTop: 0 }, 300)
            .animate({ scrollTop: 40 }, 200)
            .animate({ scrollTop: 0 }, 130)
            .animate({ scrollTop: 15 }, 100)
            .animate({ scrollTop: 0 }, 70);
    });
});


//Dropify
$(document).ready(function () {
    $('.dropify').dropify({
        messages: {
            'default': 'Seret Gambar ke sini atau Klik',
            'replace': 'Seret Gambar ke sini atau Klik untuk mengganti',
            'remove': 'Buang',
            'error': 'Waduh, terjadi suatu kesalahan'
        }
    });
})


// Fungsi waktu
function showTime() {
    // Mengambil waktu sekarang
    let date = new Date();
    let h = date.getHours();
    let m = date.getMinutes();
    let s = date.getSeconds();
    let session = "AM";

    // Jika jam sama dengan 0
    if (h == 0) {
        // Jam diisi 12
        h = 12;
    }

    // Jika jam lebih besar dari 12
    if (h > 12) {
        // Jam dikurangi 12
        h = h - 12;
        session = "PM";
    }

    // Jika jam lebih kecil dari 10, maka depannya ditambah string "0"
    h = (h < 10) ? "0" + h : h;
    // Jika menit lebih kecil dari 10, maka depannya ditambah string "0"
    m = (m < 10) ? "0" + m : m;
    // Jika detik lebih kecil dari 10, maka depannya ditambah string "0"
    s = (s < 10) ? "0" + s : s;

    // Merangkai waktu
    let time = h + ":" + m + ":" + s + " " + session;
    document.getElementById('waktuSekarang').innerText = time;
    document.getElementById('waktuSekarang').textContent = time;

    // Gungsi refresh setiap 1 detik
    setTimeout(showTime, 1000);
}
// Memanggil fungsi showTime
showTime();