# NibiruWorld 

## Apa itu NibiruWorld?
NibiruWorld adalah sebuah aplikasi sosial media sederhana yang dibuat menggunakan CodeIgniter 4 dan Bootstrap 4. Aplikasi ini merupakan Project PKL saya pada tahun 2020.

## Cara Instalasi NibiruWorld
- Pastikan composer terinstall.
- Pastikan versi PHP yang terinstall adalah versi `7.3` ke atas.
- Jalankan `composer install`.
- Ubah file `env` menjadi `.env`, atau gunakan konfigurasi milik Anda sendiri.
- Konfigurasikan email Anda di `App\Config\Email.php`, ubah isi property `SMTPHost` dengan host email Anda, `$SMTPUser` dengan email Anda dan `$SMTPPass` dengan password email Anda.
- Buat database bernama `nibiruworld`.
- Import database dari file sql yang sudah disertakan dalam repository.
- Jalankan `php spark serve`.
- Akun default yang tersedia untuk login:

  ### SuperAdmin:
  - Username: superadmin
  - Password: superadmin123
  
  ### Admin:
  - Username: admin
  - Password: admin123

  ### User:
  - Username: user
  - Password: user1234

## Demo
https://nibiru-world.000webhostapp.com/

## Bantuan
Jika Anda membutuhkan bantuan, hubungi saya di email: andrypeb27@protonmail.com atau andrypeb227@gmail.com.
