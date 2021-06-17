<?php

namespace App\Controllers;

// Memanggil model yang diperlukan
use App\Models\UserModel;
use App\Models\TokenModel;

//Membuat class bernama Users yang extends dengan BaseController
class Login extends BaseController
{
    // Membuat property yang diperlukan
    protected $UserModel;
    protected $TokenModel;
    protected $Waktu;


    // Fungsi construct
    public function __construct()
    {
        //Mendefinisikan property UserModel sebagai UserModel
        $this->UserModel = new UserModel;
        //Mendefinisikan property TokenModel sebagai TokenModel
        $this->TokenModel = new TokenModel;
        // l = nama hari, d-m-yy = hari, bulan, dan tahun, H:i:s = jam, menit, dan detik.
        $this->Waktu = date('l, d-m-yy, H:i:s');
        // Helper form untuk fungsi set_value()
        helper(['form']);
    }



    // Method index atau halaman login
    public function index()
    {
        // Jika terdapat sebuah request dengan metode post
        if ($this->request->getMethod() == 'post') {
            // Membuat rules validasi
            $rules = [
                // Validasi untuk form username
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required|validateUser[username,password]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'validateUser' => '{field} atau Kata sandi yang anda masukkan salah',
                    ]
                ],
                // Validasi untuk form password
                'password' => [
                    'label' => 'Kata sandi',
                    'rules' => 'required|validateUser[username,password]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'validateUser' => 'Username atau {field} yang anda masukkan salah',
                    ]
                ],
            ];

            // Jika terdapat kesalahan saat validasi
            if (!$this->validate($rules)) {
                // Mengembalikan flash data dengan pesan kesalahan
                session()->setFlashdata('danger', 'Gagal Login, Data Anda Salah.');
                // Membuat variabel untuk menampung semua pesan kesalahan dari validasi
                $data['validation'] = $this->validator;
            }

            // Jika tidak terdapat kesalahan saat validasi
            else {
                // Membuat variabel untuk menampung data milik user
                $user = $this->UserModel->where('username', $this->request->getVar('username'))->first();

                // Jika user belum aktif
                if ($user['is_active'] != 1) {
                    // Mengembalikan flash data dengan pesan kesalahan
                    session()->setFlashdata('danger', 'Gagal Login, User Tersebut Belum Diaktifkan.');
                    // Mengembalikan flash data sebagai syarat agar kedua form menjadi hijau (valid)
                    session()->setFlashdata('belum-aktif', '');
                }

                // Jika user sudah aktif
                else {
                    // Menghapus sesi2 tidak penting jika ada
                    session()->remove('verify_email');
                    session()->remove('reset_email');
                    session()->remove('change_password');

                    // Memanggil method untuk membuat sesi2 yang diperlukan
                    $this->_setUserSession($user);
                    // Akan diarahkan ke routes fotoPertama
                    return redirect()->to(base_url('fotoPertama'));
                }
            }
        }

        // Membuat title
        $data['title'] = 'Login';

        //Menampilkan view dengan membawa $data
        return view('login/login', $data);
    }



    // Method untuk membuat session ketika login
    private function _setUserSession($user)
    {
        //Membuat sebuah variabel untuk menampung informasi session
        $data = [
            // Sesi bernama id_users berisi $user['id_users]
            'id_users' => $user['id_users'],
            // Sesi bernama isLoggedIn berisi true
            'isLoggedIn' => true,
        ];

        // Membuat sesi
        session()->set($data);
        // Kembali dengan nilai true
        return true;
    }



    // Method register atau halaman register
    public function register()
    {
        // Jika terdapat sebuah request dengan metode post
        if ($this->request->getMethod() == 'post') {
            // Membuat rules validasi
            $rules = [
                // Validasi untuk username
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required|max_length[20]|is_unique[users.username]|alpha_numeric',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'max_length' => '{field} terlalu panjang, batas karakter hanya 20',
                        'is_unique' => '{field} tersebut sudah digunakan',
                        'alpha_numeric' => '{field} hanya boleh mengandung huruf dan angka',
                    ]
                ],
                // Validasi untuk email
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email|is_unique[users.email]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'valid_email' => '{field} yang anda masukkan tidak valid',
                        'is_unique' => '{field} tersebut sudah terdaftar',
                    ]
                ],
                // Validasi untuk password
                'password' => [
                    'label' => 'Kata sandi',
                    'rules' => 'required|min_length[8]|max_length[100]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'min_length' => '{field} terlalu pendek, minimal karakter adalah 8',
                        'max_length' => '{field} terlalu pendek, batas karakter hanya 100',
                    ]
                ],
                // Validasi untuk password confirm
                'password_confirm' => [
                    'label' => 'Konfirmasi Kata sandi',
                    'rules' => 'required|matches[password]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'matches' => 'Kata sandi dan {field} tidak sama',
                    ]
                ],
            ];

            // Jika terdapat kesalahan saat validasi
            if (!$this->validate($rules)) {
                // Mengembalikan flash data dengan pesan kesalahan
                session()->setFlashdata('danger', 'Gagal Register, Data Anda Salah.');
                // Membuat variabel untuk menampung semua pesan kesalahan dari validasi
                $data['validation'] = $this->validator;
            }

            // Jika tidak terdapat kesalahan saat validasi
            else {
                // Mengisi variabel $email dengan request email
                $email = htmlspecialchars(strtolower($this->request->getVar('email')));
                // Membuat variabel yang menampung semua data user yang akan dimasukkan ke database
                $data = [
                    'username' => htmlspecialchars($this->request->getVar('username')),
                    'slug_users' => htmlspecialchars(url_title($this->request->getVar('username'), '-', true)),
                    'email' => $email,
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'users-created_at' => $this->Waktu,
                ];

                // Mengisi variabel $token dengan data random
                $token = base64_encode(random_bytes(32));
                // Membuat variabel yang menampung semua data token yang akan dimasukkan ke database
                $data_token = [
                    'email' => $email,
                    'token' => $token,
                    'token-created_at' => time(),
                ];

                // Menjalankan method _sendEmail untuk mengirim link aktivasi ke user
                $this->_sendEmail($token, 'verify');
                // Menyimpan data user ke database
                $this->UserModel->save($data);
                // Menyimpan data token ke database
                $this->TokenModel->save($data_token);
                // Membuat sebuah flash data dengan pesan berhasil
                session()->setFlashdata('success', 'Anda Telah Terdaftar, Silahkan Aktifkan Akun Anda Melalui Link Aktivasi Yang Telah Kami Kirimkan Ke Email Anda.');
                // Membuat sesi email dengan isi email
                session()->set('verify_email', $email);
                // Arahkan ke route /
                return redirect()->to(base_url('activation'));
            }
        }

        // Membuat title
        $data['title'] = 'Register';

        // Menampilkan view dengan membawa $data
        return view('login/register', $data);
    }



    // Method untuk halaman activation
    public function activation()
    {
        // Jika tidak terdapat sesi bernama verify_email
        if (!session()->get('verify_email')) {
            // Jika akun tidak ada maka akan muncul halaman 404
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Jika terdapat sebuah request dengan metode post
        if ($this->request->getMethod() == 'post') {
            // Membuat rules validasi
            $rules = [
                // Validasi untuk email
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email|is_not_unique[users.email]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'valid_email' => '{field} yang anda masukkan tidak valid',
                        'is_not_unique' => '{field} tersebut belum terdaftar',
                    ]
                ],
            ];

            // Jika terdapat kesalahan saat validasi
            if (!$this->validate($rules)) {
                // Mengembalikan flash data dengan pesan kesalahan
                session()->setFlashdata('danger', 'Gagal Mengirim Link Baru, Data Anda Salah.');
                // Membuat variabel untuk menampung semua pesan kesalahan dari validasi
                $data['validation'] = $this->validator;
            }

            // Jika tidak terdapat kesalahan
            else {
                // Mengisi variabel email
                $email = strtolower($this->request->getVar('email'));
                // Mengisi variabel dengan data user
                $data_user = $this->UserModel->where('email', $email)->first();

                // Jika user tersebut sudah aktif
                if ($data_user['is_active'] == 1) {
                    // Mengembalikan flash data dengan pesan kesalahan
                    session()->setFlashdata('danger', 'Gagal Mengirim Link Baru, Akun Tersebut Sudah Aktif.');
                }

                // Jika user tersebut belum aktif
                else {
                    // Jika ada token dengan email yang sama, maka hapus yang lama
                    $this->TokenModel->where('email', $email)->delete();

                    // Mengisi variabel $token dengan data random
                    $token = base64_encode(random_bytes(32));
                    // Membuat variabel yang menampung semua data token yang akan dimasukkan ke database
                    $data_token = [
                        'email' => $email,
                        'token' => $token,
                        'token-created_at' => time(),
                    ];

                    // Menjalankan method _sendEmail untuk mengirim link aktivasi ke user
                    $this->_sendEmail($token, 'verify');
                    // Menyimpan data token ke database
                    $this->TokenModel->save($data_token);
                    // Membuat sesi email dengan isi email
                    session()->set('verify_email',  $email);
                    // Membuat sebuah flash data dengan pesan berhasil
                    session()->setFlashdata('success', 'Kami Telah Mengirimkan Link Baru Ke Email Anda.');
                    // Arahkan ke route activation
                    return redirect()->to(base_url('activation'));
                }
            }
        }

        // Membuat title
        $data['title'] = 'Activate Your Account';

        // Menampilkan view dengan membawa $data
        return view('login/activation', $data);
    }



    // Method untuk verifikasi akun
    public function verify()
    {
        // Mengambil email dan token dari url
        $email = strtolower($this->request->getGet('email'));
        $token = $this->request->getGet('token');

        // Jika email atau token kosong
        if ($email == null or $token == null) {
            // Menampilkan 404
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Membuat variabel $user untuk menampung data milik user
        $user = $this->UserModel->where('email', $email)->first();

        // Jika $user memiliki isi
        if ($user) {
            // Mencocokkan data token milik user dengan data token di database
            $user_token = $this->TokenModel->where('token', $token)->first();

            // Jika token benar
            if ($user_token) {
                // Jika umur token belum lebih dari 30 Menit
                if (time() - $user_token['token-created_at'] < 1800) {
                    // Membuat variabel untuk menampung semua data yang diperlukan
                    $data = [
                        'id_users' => $user['id_users'],
                        'is_active' => 1.
                    ];

                    // Mengupdate data untuk merubah is_active
                    $this->UserModel->save($data);
                    // Menghapus token karena sudah tidak diperlukan lagi
                    $this->TokenModel->where('email', $email)->delete();
                    // Membuat sebuah flash data dengan pesan berhasil
                    session()->setFlashdata('success', 'Akun Anda Telah Diaktifkan, Silahkan Login.');
                    // Menghapus session dengan nama verify_email
                    session()->remove('verify_email');
                    // Arahkan ke routes /
                    return redirect()->to(base_url('/'));
                }

                // Jika token sudah kadaluarsa
                else {
                    // Mengembalikan flash data dengan pesan kesalahan
                    session()->setFlashdata('danger', 'Aktivasi Akun Gagal, Link Tersebut Telah Kadaluarsa.');
                    // Membuat sesi email dengan isi email
                    session()->set('verify_email', $email);
                    // Arahkan ke routes activation
                    return redirect()->to(base_url('activation'));
                }
            }

            // Jika token tidak ada di database
            else {
                // Mengembalikan flash data dengan pesan kesalahan
                session()->setFlashdata('danger', 'Aktivasi Akun Gagal, Link Tersebut Tidak Benar.');
                // Membuat sesi email dengan isi email
                session()->set('verify_email', $email);
                // Arahkan ke routes activation
                return redirect()->to(base_url('activation'));
            }
        }

        // Jika user tidak ada di dalam database
        else {
            // Mengembalikan flash data dengan pesan kesalahan
            session()->setFlashdata('danger', 'Aktivasi Akun Gagal, Email Tersebut Tidak Terdaftar.');
            // Membuat sesi email dengan isi email
            session()->set('verify_email', $email);
            // Arahkan ke routes activation
            return redirect()->to(base_url('activation'));
        }
    }



    // Method untuk forgot password atau halaman forgot password
    public function forgotPassword()
    {
        // Jika terdapat sebuah request dengan metode post
        if ($this->request->getMethod() == 'post') {
            // Membuat variabel $rules untuk menampung semua rules validasi
            $rules = [
                // Validasi untuk email
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'valid_email' => '{field} yang anda masukkan tidak valid',
                    ]
                ],
            ];

            // Jika terdapat kesalahan saat validasi
            if (!$this->validate($rules)) {
                // Mengembalikan flash data dengan pesan kesalahan
                session()->setFlashdata('danger', 'Data Anda Salah.');
                // Mengisi variabel $data dengan semua pesan kesalahan validasi
                $data['validation'] = $this->validator;
            }

            // Jika tidak terdapat kesalahan saat validasi
            else {
                // Mengisi variabel $email dengan request email
                $email = strtolower($this->request->getPost('email'));
                // Mengisi $user dengan data user berdasarkan $email
                $user = $this->UserModel->where('email', $email)->first();

                // Jika data user ditemukan
                if ($user != null) {
                    // Jika akun user sudah aktif
                    if ($user['is_active'] == 1) {
                        // Membuat token random
                        $token = base64_encode(random_bytes(32));
                        // Mengisi variabel $data dengan data yang dibutuhkan
                        $user_token = [
                            'email' => $email,
                            'token' => $token,
                            'token-created_at' => time(),
                        ];

                        // Jika ada token dengan email yang sama, maka hapus yang lama
                        $this->TokenModel->where('email', $email)->delete();
                        // Menyimpan data token
                        $this->TokenModel->save($user_token);
                        // Menjalankan method untuk mengirim email
                        $this->_sendEmail($token, 'forgot');
                        // Mengembalikan flash data dengan pesan kebenaran
                        session()->setFlashdata('success', 'Silahkan Cek Emailmu Untuk Mereset Password');
                        // Membuat sesi email dengan isi email
                        session()->set('reset_email', $email);
                        // Arahkan ke route /
                        return redirect()->to(base_url('reset'));
                    }

                    // Jika akun user belum aktif
                    else {
                        // Mengembalikan flash data dengan pesan kesalahan
                        session()->setFlashdata('danger', 'Email Yang Anda Masukkan Belum Diaktifkan!');
                    }
                }

                // Jika data user tidak ditemukan
                else {
                    // Mengembalikan flash data dengan pesan kesalahan
                    session()->setFlashdata('danger', 'Email Yang Anda Masukkan Belum Terdaftar!');
                }
            }
        }

        //Membuat sebuah array dengan nama $title, ini akan dikembalikan ke view sebagai pengisi setiap title
        $data['title'] = 'Forgot Password';

        //Menampilkan view dengan membawa $data
        return view('login/forgot_password', $data);
    }



    // Method reset atau halaman reset
    public function reset()
    {
        // Jika tidak terdapat sesi bernama reset_email
        if (!session()->get('reset_email')) {
            // Jika akun tidak ada maka akan muncul halaman 404
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Jika terdapat sebuah request dengan metode post
        if ($this->request->getMethod() == 'post') {
            // Membuat rules validasi
            $rules = [
                // Validasi untuk email
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email|is_not_unique[users.email]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'valid_email' => '{field} yang anda masukkan tidak valid',
                        'is_not_unique' => '{field} tersebut belum terdaftar',
                    ]
                ],
            ];

            // Jika terdapat kesalahan saat validasi
            if (!$this->validate($rules)) {
                // Mengembalikan flash data dengan pesan kesalahan
                session()->setFlashdata('danger', 'Gagal Mengirim Link Baru, Data Anda Salah.');
                // Membuat variabel untuk menampung semua pesan kesalahan dari validasi
                $data['validation'] = $this->validator;
            }

            // Jika tidak terdapat kesalahan
            else {
                // Mengisi variabel email
                $email = strtolower($this->request->getVar('email'));
                // Mengisi variabel dengan data user
                $data_user = $this->UserModel->where('email', $email)->first();

                // Jika user tersebut belum aktif
                if ($data_user['is_active'] == 0) {
                    // Mengembalikan flash data dengan pesan kesalahan
                    session()->setFlashdata('danger', 'Gagal Mengirim Link Baru, Akun Tersebut Belum Aktif.');
                }

                // Jika user tersebut sudah aktif
                else {
                    // Jika ada token dengan email yang sama, maka hapus yang lama
                    $this->TokenModel->where('email', $email)->delete();

                    // Mengisi variabel $token dengan data random
                    $token = base64_encode(random_bytes(32));
                    // Membuat variabel yang menampung semua data token yang akan dimasukkan ke database
                    $data_token = [
                        'email' => $email,
                        'token' => $token,
                        'token-created_at' => time(),
                    ];

                    // Menjalankan method _sendEmail untuk mengirim link aktivasi ke user
                    $this->_sendEmail($token, 'forgot');
                    // Menyimpan data token ke database
                    $this->TokenModel->save($data_token);
                    // Membuat sesi email dengan isi email
                    session()->set('reset_email',  $email);
                    // Membuat sebuah flash data dengan pesan berhasil
                    session()->setFlashdata('success', 'Kami Telah Mengirimkan Link Baru Ke Email Anda.');
                    // Arahkan ke route reset
                    return redirect()->to(base_url('reset'));
                }
            }
        }

        // Membuat title
        $data['title'] = 'Reset Your Password';

        // Menampilkan view dengan membawa $data
        return view('login/reset', $data);
    }



    // Method untuk memverifikasi link reset password
    public function resetPassword()
    {
        // Mengambil email dan token dari url
        $email = strtolower($this->request->getGet('email'));
        $token = $this->request->getGet('token');

        // Jika email atau token kosong
        if ($email == null or $token == null) {
            // Menampilkan 404
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Mengisi variabel $user dengan data user berdasarkan $email
        $user = $this->UserModel->where('email', $email)->first();

        // Jika user tersebut ada
        if ($user) {
            // Mengisi $user_token dengan data token berdasarkan $token
            $user_token = $this->TokenModel->where('token', $token)->first();

            // Jika token tersebut ada
            if ($user_token) {
                // Jika umur token belum 30 menit
                if (time() - $user_token['token-created_at'] < 1600) {
                    // Membuat sebuah flash data dengan pesan berhasil
                    session()->setFlashdata('success', 'Link Tersebut Valid, Silahkan Ganti Password Anda.');
                    // Membuat sesi bernama reset_email yang berisi $email
                    session()->remove('reset_email');
                    // Membuat sesi bernama change_password yang berisi $email
                    session()->set('change_password', $email);
                    // Arahkan ke routes changePassword
                    return redirect()->to(base_url('changePassword'));
                }

                // Jika token sudah kadaluarsa
                else {
                    // Mengembalikan flash data dengan pesan kesalahan
                    session()->setFlashdata('danger', 'Reset Password Gagal, Link Tersebut Telah Kadaluarsa.');
                    // Membuat sesi email dengan isi email
                    session()->set('reset_email', $email);
                    // Arahkan ke routes reset
                    return redirect()->to(base_url('reset'));
                }
            }

            // Jika token tersebut tidak ada
            else {
                // Mengembalikan flash data dengan pesan kesalahan
                session()->setFlashdata('danger', 'Reset Password Gagal, Link Tersebut Tidak Valid.');
                // Membuat sesi email dengan isi email
                session()->set('reset_email', $email);
                // Arahkan ke routes reset
                return redirect()->to(base_url('reset'));
            }
        }

        // Jika user tidak ada
        else {
            // Mengembalikan sesi dengan pesan kesalahan
            session()->setFlashdata('danger', 'Reset Password Gagal, Email Tersebut Tidak Terdaftar.');
            // Membuat sesi email dengan isi email
            session()->set('reset_email', $email);
            // Arahkan ke routes reset
            return redirect()->to(base_url('reset'));
        }
    }



    // Method changePassword atau halaman untuk memasukkan password baru
    public function changePassword()
    {
        // Jika tidak terdapat sesi dengan nama change_password
        if (!session()->get('change_password')) {
            // Menampilkan 404
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Jika terdapat sebuah request dengan metode post
        if ($this->request->getMethod() == 'post') {
            // Membuat rules
            $rules = [
                // Validasi untuk password
                'password' => [
                    'label' => 'Kata sandi',
                    'rules' => 'required|min_length[8]|max_length[100]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'min_length' => '{field} terlalu pendek, minimal karakter adalah 8',
                        'max_length' => '{field} terlalu pendek, batas karakter hanya 100',
                    ]
                ],
                // Validasi untuk password confirm
                'password_confirm' => [
                    'label' => 'Konfirmasi Kata sandi',
                    'rules' => 'required|matches[password]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'matches' => 'Kata sandi dan {field} tidak sama',
                    ]
                ],
            ];

            // Jika terdapat error pada validasi
            if (!$this->validate($rules)) {
                // Mengembalikan flash data dengan pesan kesalahan
                session()->setFlashdata('danger', 'Gagal Merubah, Password Anda Salah.');
                // Mengisi variabel $data dengan semua kesalahan yang ada
                $data['validation'] = $this->validator;
            }

            // Jika tidak terdapat error pada validasi
            else {
                // Membuat variabel $data_user untuk menampung data user
                $data_user = $this->UserModel->where('email', session()->get('change_password'))->first();
                // Mengisi data-data yang diperlukan
                $data = [
                    'id_users' => $data_user['id_users'],
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                ];

                // Memperbarui data
                $this->UserModel->save($data);
                // Menghapus token karena sudah tidak diperlukan lagi
                $this->TokenModel->where('email', session()->get('change_password'))->delete();
                // Menghapus sesi change_password
                session()->remove('change_password');
                // Mengembalikan flash data dengan pesan berhasil
                session()->setFlashdata('success', 'Password Berhasil Diubah, Silahkan Login');
                // Redirect to halaman login
                return redirect()->to(base_url('/'));
            }
        }

        // Membuat title
        $data['title'] = 'Change Password';

        // Menampilkan view dengan membawa $data
        return view('login/change_password', $data);
    }



    // Method untuk mengirim email
    private function _sendEmail($token, $type) 
    {
        // Mengisi variabel $email dengan class email milik ci4
        $email = \Config\Services::email();
        // Memberitahu email yang akan mengirim
        $email->setFrom('aswassawexe2@gmail.com', 'Nibiru World');
        // Memberitahu email yang akan menerima
        $email->setTo(strtolower($this->request->getVar('email')));

        // Jika $type berisi 'verify'
        if ($type == 'verify') {
            // Membuat subject
            $email->setSubject('Verifikasi Akun');
            // Membuat pesan
            $email->setMessage('Klik link ini untuk memverifikasi Akun: <a href="' . base_url() . '/verify?email=' . strtolower($this->request->getVar('email')) . '&token=' . urlencode($token) . '">Aktifkan!</a>');
        }

        // Jika $type berisi 'forgot'
        else if ($type == 'forgot') {
            // Membuat subject
            $email->setSubject('Reset Password');
            // Membuat pesan
            $email->setMessage('Klik link ini untuk mereset password: <a href="' . base_url() . '/resetPassword?email=' . strtolower($this->request->getVar('email')) . '&token=' . urlencode($token) . '">Reset Password!</a>');
        }

        // Jika berhasil mengirim
        if ($email->send()) {
            return true;
        } else {
            echo $email->printDebugger();
            die;
        }
    }
}
