<?php

// Direktori tempat file ini berada
namespace App\Controllers;

// Memanggil semua model yang diperlukan
use App\Models\UserModel;
use App\Models\FriendreqModel;
use App\Models\FriendModel;
use App\Models\StatusModel;
use App\Models\LikestatusModel;
use App\Models\CommentModel;
use App\Models\LikecommentModel;
use App\Models\ReplyModel;
use App\Models\LikereplyModel;
use App\Models\ChattrueModel;
use App\Models\NotificationModel;

// Membuat class bernama Users yang extends dengan BaseController
class Users extends BaseController
{
    //Membuat property yang diperlukan
    protected $UserModel;
    protected $FriendreqModel;
    protected $FriendModel;
    protected $StatusModel;
    protected $LikestatusModel;
    protected $CommentModel;
    protected $LikecommentModel;
    protected $ReplyModel;
    protected $LikereplyModel;
    protected $ChattrueModel;
    protected $NotificationModel;
    protected $Waktu;


    // Fungsi construct
    public function __construct()
    {
        // Mendefinisikan setiap property sebagai fungsi yang sesuai
        $this->UserModel = new UserModel;
        $this->FriendreqModel = new FriendreqModel;
        $this->FriendModel = new FriendModel;
        $this->StatusModel = new StatusModel;
        $this->LikestatusModel = new LikestatusModel();
        $this->CommentModel = new CommentModel;
        $this->LikecommentModel = new LikecommentModel();
        $this->ReplyModel = new ReplyModel;
        $this->LikereplyModel = new LikereplyModel();
        $this->ChattrueModel = new ChattrueModel();
        $this->NotificationModel = new NotificationModel();
        $this->Waktu = date('l, d-m-yy, H:i:s');
        // helper form untuk fungsi set_value
        helper(['form']);
    }



    // Method index atau halaman home
    public function index()
    {
        // Jika terdapat sebuah request dengan metode post
        if ($this->request->getMethod() == 'post') {
            // Mengisi variabel $keyword dengan keyword
            $keyword = $this->request->getVar('keyword');
            // Memanggil method searchStatus pada StatusModel untuk memulai pencarian
            $status = $this->StatusModel->searchStatus($keyword);

            // Jika hasil pencarian kosong, maka $status akan diisi sebuah string [kosong]
            if ($status == null) {
                $status = ['kosong'];
            }
        }

        // Jika tidak terdapat request pencarian
        else {
            // $status diisi dengan StatusModel->getDataStatus
            $status = $this->StatusModel->getDataStatus();
        }

        // Mengisi array $data dengan data yang dibutuhkan
        $data['title'] = 'Home';
        $data['user'] = $this->UserModel->find(session()->get('id_users'));
        // Mencari jumlah notifikasi jika ada
        $data['notification_all'] = count($this->NotificationModel->where(['id_users-notification' => session()->get('id_users'), 'status_notification' => 0])->get()->getResultArray());
        // Mencari jumlah permintaan teman jika ada
        $data['notification_friend'] = count($this->FriendreqModel->requestFriend(session()->get('id_users')));
        // Mencari jumlah chat yang belum dibaca jika ada
        $data['notification_chat'] = count($this->ChattrueModel->getChattrueNotification(session()->get('id_users')));

        // Mengisi $data_status dengan $status
        $data_status = $status;

        // Jika $data_status tidak kosong
        if ($data_status) {
            // Jika isi dari $data_status bukanlah string 'kosong'
            if ($data_status[0] != 'kosong') {
                // Membuat No
                $no = 0;
                // Untuk setiap jumlah array $data_status, ulangi
                foreach ($data_status as $dt_sts) {
                    // $status diisi dengan $data_status[$no], $status ini berbeda dengan $status di atas
                    $status = $data_status[$no];
                    // Mencari jumlah comment yang ada berdasarkan status yang dimaksud
                    $comment['comment'] = count($this->CommentModel->where(['id_status-comment' => $dt_sts['id_status']])->get()->getResultArray());
                    // Mencari jumlah like yang ada berdasarkan like yang dimaksud
                    $like['like'] = count($this->LikestatusModel->where(['id_status-likestatus' => $dt_sts['id_status']])->get()->getResultArray());

                    // Jika user sudah memberi like pada status itu
                    if ($this->LikestatusModel->where(['id_users-likestatus' => session()->get('id_users'), 'id_status-likestatus' => $dt_sts['id_status']])->get()->getResultArray()) {
                        // $like diisi true
                        $like['sudah_like'] = true;
                    }

                    // Jika belum
                    else {
                        // $like diisi false
                        $like['sudah_like'] = false;
                    }

                    // $status_final diisi dengan penggabungan dari 3 array di atas
                    $status_final = array_merge($status, $comment, $like);
                    // $status_final diisikan ke $data[status][sesuai no]
                    $data['status'][$no] = $status_final;
                    // Nilai dari no ditambahkan++
                    $no++;
                }
            } else {
                $data['status'] = $data_status;
            }
        } else {
            $data['status'] = $data_status;
        }
        // Mengisi data like
        $data['like'] = $this->LikestatusModel->join('users', 'likestatus.id_users-likestatus = users.id_users')->get()->getResultArray();

        // Jika user tidak ada maka akan terlogout
        if ($data['user'] == null) {
            return redirect()->to(base_url('logout'));
        }

        //Menampilkan view dengan membawa $data
        return view('users/home', $data);
    }



    // Method fotoPertama atau halaman foto_pertama
    public function fotoPertama()
    {
        // Membuat variabel untuk menampung data milik user
        $user = $this->UserModel->find(session()->get('id_users'));

        // Jika foto user masih default
        if ($user['fotoprofil'] != 'default.png') {
            // Arahkan ke route home
            return redirect()->to(base_url('home'));
        }

        // Mengisi array $data dengan data yang dibutuhkan
        $data['title'] = 'Ubah Foto Anda';
        $data['user'] = $user;
        // Mencari jumlah notifikasi jika ada
        $data['notification_all'] = count($this->NotificationModel->where(['id_users-notification' => session()->get('id_users'), 'status_notification' => 0])->get()->getResultArray());
        // Mencari jumlah permintaan teman jika ada
        $data['notification_friend'] = count($this->FriendreqModel->requestFriend(session()->get('id_users')));
        // Mencari jumlah chat yang belum dibaca jika ada
        $data['notification_chat'] = count($this->ChattrueModel->getChattrueNotification(session()->get('id_users')));

        // Jika user tidak ada maka akan terlogout
        if ($data['user'] == null) {
            return redirect()->to(base_url('logout'));
        }

        //Menampilkan view dengan membawa $data
        return view('users/foto_pertama', $data);
    }



    // Method friend atau halaman friend
    public function friend()
    {
        // Jika terdapat sebuah request dengan metode post
        if ($this->request->getMethod() == 'post') {
            // Dapatkan keyword
            $keyword = $this->request->getVar('keyword');
            ///Memanggil method searchUser pada UserModel untuk memulai pencarian
            $friend = $this->UserModel->searchUser($keyword);

            // Jika hasil pencarian kosong, maka $friend akan diisi sebuah string [kosong]
            if ($friend == null) {
                $friend = ['kosong'];
            }
        }

        // Jika tidak terdapat request pencarian
        else {
            // $friend diisi dengan UserModel->findAll
            $friend = $this->UserModel->findAll();
        }

        // Mengisi array $data dengan data yang dibutuhkan
        $data['title'] = 'All User';
        $data['user'] = $this->UserModel->find(session()->get('id_users'));
        $data['friend'] = $friend;
        // Mencari jumlah notifikasi jika ada
        $data['notification_all'] = count($this->NotificationModel->where(['id_users-notification' => session()->get('id_users'), 'status_notification' => 0])->get()->getResultArray());
        // Mencari jumlah permintaan teman jika ada
        $data['notification_friend'] = count($this->FriendreqModel->requestFriend(session()->get('id_users')));
        // Mencari jumlah chat yang belum dibaca jika ada
        $data['notification_chat'] = count($this->ChattrueModel->getChattrueNotification(session()->get('id_users')));

        // Jika user tidak ada maka akan terlogout
        if ($data['user'] == null) {
            return redirect()->to(base_url('logout'));
        }

        //Menampilkan view dengan membawa $data
        return view('users/friend', $data);
    }



    // Method friend atau halaman friend
    public function friendRequest()
    {
        // Mengisi array $data dengan data yang dibutuhkan
        $data['title'] = 'Friend Request';
        $data['user'] = $this->UserModel->find(session()->get('id_users'));
        $data['friend_add'] = $this->FriendreqModel->requestFriend(session()->get('id_users'));
        // Mencari jumlah notifikasi jika ada
        $data['notification_all'] = count($this->NotificationModel->where(['id_users-notification' => session()->get('id_users'), 'status_notification' => 0])->get()->getResultArray());
        // Mencari jumlah permintaan teman jika ada
        $data['notification_friend'] = count($this->FriendreqModel->requestFriend(session()->get('id_users')));
        // Mencari jumlah chat yang belum dibaca jika ada
        $data['notification_chat'] = count($this->ChattrueModel->getChattrueNotification(session()->get('id_users')));

        // Jika user tidak ada maka akan terlogout
        if ($data['user'] == null) {
            return redirect()->to(base_url('logout'));
        }

        //Menampilkan view dengan membawa $data
        return view('users/friend_request', $data);
    }



    // Method profile atau halaman profile
    public function profile()
    {
        // Jika terdapat request method post
        if ($this->request->getMethod() == 'post') {
            // Mengambil data username_lama
            $username_lama = $this->UserModel->find(session()->get('id_users'));

            // Jika username adalah username lama maka tidak ada is_unique
            if ($username_lama['username'] == $this->request->getVar('username')) {
                $username_rules = 'required|max_length[20]|alpha_numeric';
            }

            // Jika username adalah baru maka ada is_unique
            else {
                $username_rules = 'required|max_length[20]|is_unique[users.username]|alpha_numeric';
            }

            // Membuat rules validasi
            $rules = [
                // Validasi untuk username
                'username' => [
                    'label' => 'Username',
                    'rules' => $username_rules,
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'max_length' => '{field} terlalu panjang, batas karakter hanya 20',
                        'is_unique' => '{field} tersebut sudah terdaftar',
                        'alpha_numeric' => '{field} hanya boleh mengandung huruf dan angka'
                    ]
                ],
                // Validasi untuk firstname
                'firstname' => [
                    'label' => 'Nama depan',
                    'rules' => 'required|max_length[20]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'max_length' => '{field} terlalu panjang, batas karakter hanya 20'
                    ]
                ],
                // Validasi untuk lastname
                'lastname' => [
                    'label' => 'Nama depan',
                    'rules' => 'required|max_length[20]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'max_length' => '{field} terlalu panjang, batas karakter hanya 20'
                    ]
                ],
                // Validasi untuk description
                'description' => [
                    'label' => 'Deskripsi',
                    'rules' => 'max_length[400]',
                    'errors' => [
                        'max_length' => '{field} terlalu panjang, batas karakter hanya 400'
                    ]
                ],
            ];

            // Jika ada request bernama password
            if ($this->request->getVar('password') != '') {
                // Validasi untuk password
                $rules['password'] = [
                    'label' => 'Kata sandi',
                    'rules' => 'min_length[8]|max_length[100]',
                    'errors' => [
                        'min_length' => '{field} terlalu pendek, minimal karakter adalah 8',
                        'max_length' => '{field} terlalu panjang, batas karakter hanya 100',
                    ]
                ];
                // Validasi untuk password_confirm
                $rules['password_confirm'] = [
                    'label' => 'Konfirmasi Kata sandi',
                    'rules' => 'matches[password]',
                    'errors' => [
                        'matches' => 'Kata sandi dan {field} tidak sama',
                    ]
                ];
            }

            // Jika terdapat kesalahan pada validasi
            if (!$this->validate($rules)) {
                // Mengembalikan flash data berisi kesalahan
                session()->setFlashdata('danger', 'Data gagal diperbarui, pastikan data yang anda masukkan benar.');
                // Mengisi $data dengan semua kesalahan
                $data['validation'] = $this->validator;
            }

            //Jika tidak terdapat kesalahan saat validasi
            else {
                // Mengisi deskripsi agar tidak kosong
                if ($this->request->getVar('description') == '') {
                    $description = 'Tidak ada deskripsi';
                } else {
                    $description = $this->request->getVar('description');
                }

                // Membuat variabel data untuk menampung data baru
                $data = [
                    'id_users' => session()->get('id_users'),
                    'username' => htmlspecialchars($this->request->getVar('username')),
                    'slug_users' => htmlspecialchars(url_title($this->request->getVar('username'), '-', true)),
                    'firstname' => htmlspecialchars($this->request->getVar('firstname')),
                    'lastname' => htmlspecialchars($this->request->getVar('lastname')),
                    'description' => htmlspecialchars($description),
                    'users-updated_at' => $this->Waktu,
                ];

                // Jika password ikut dirubah maka jalankan perintah ini
                if ($this->request->getVar('password') != '') {
                    $data['password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
                }

                // Menyimpan data baru
                $this->UserModel->save($data);
                // Membuat sebuah flash data pesan berhasil
                session()->setFlashdata('success', 'Data berhasil diperbarui.');
                // Arahkan ke profile
                return redirect()->to(base_url('profile'));
            }
        }

        // Membuat beberapa array yang akan dikembalikan ke view
        $data['title'] = 'Profile';
        $data['user'] = $this->UserModel->find(session()->get('id_users'));
        $data['status'] = [];
        $data['friend_demo'] = $this->FriendModel->demoFriend(session()->get('id_users'));
        $data['friend_count'] = count($this->FriendModel->where(['id_users-friend' => session()->get('id_users')])->get()->getResultArray());
        $data['like'] = $this->LikestatusModel->join('users', 'likestatus.id_users-likestatus = users.id_users')->get()->getResultArray();
        // Mencari jumlah notifikasi jika ada
        $data['notification_all'] = count($this->NotificationModel->where(['id_users-notification' => session()->get('id_users'), 'status_notification' => 0])->get()->getResultArray());
        // Mencari jumlah permintaan teman jika ada
        $data['notification_friend'] = count($this->FriendreqModel->requestFriend(session()->get('id_users')));
        // Mencari jumlah chat yang belum dibaca jika ada
        $data['notification_chat'] = count($this->ChattrueModel->getChattrueNotification(session()->get('id_users')));

        // Mengisi $data_status dengan status yang dimiliki user
        $data_status = $this->StatusModel->statusUser();

        // Membuat No
        $no = 0;
        // Untuk setiap jumlah array $data_status, ulangi
        foreach ($data_status as $dt_sts) {
            // $status diisi dengan $data_status[$no], $status ini berbeda dengan $status di atas
            $status = $data_status[$no];
            // Mencari jumlah comment yang ada berdasarkan status yang dimaksud
            $comment['comment'] = count($this->CommentModel->where(['id_status-comment' => $dt_sts['id_status']])->get()->getResultArray());
            // Mencari jumlah like yang ada berdasarkan like yang dimaksud
            $like['like'] = count($this->LikestatusModel->where(['id_status-likestatus' => $dt_sts['id_status']])->get()->getResultArray());

            // Jika user sudah memberi like pada status itu
            if ($this->LikestatusModel->where(['id_users-likestatus' => session()->get('id_users'), 'id_status-likestatus' => $dt_sts['id_status']])->get()->getResultArray()) {
                // $like diisi true
                $like['sudah_like'] = true;
            }

            // Jika belum
            else {
                // $like diisi false
                $like['sudah_like'] = false;
            }

            // $status_final diisi dengan penggabungan dari 3 array di atas
            $status_final = array_merge($status, $comment, $like);
            // $status_final diisikan ke $data[status][sesuai no]
            $data['status'][$no] = $status_final;
            // Nilai dari no ditambahkan++
            $no++;
        }

        // Jika user tidak ada maka akan terlogout
        if ($data['user'] == null) {
            return redirect()->to(base_url('logout'));
        }

        // Menampilkan view dengan membawa $data
        return view('users/user_profile', $data);
    }



    // Method friendList untuk menampilkan semua daftar teman
    public function friendList($slug_users)
    {
        // Mengambil data friend
        $data_friend = $this->UserModel->where(['slug_users' => $slug_users])->first();

        // Jika friend tidak ada
        if ($data_friend == null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Jika terdapat sebuah request dengan metode post
        if ($this->request->getMethod() == 'post') {
            // Dapatkan keyword
            $keyword = $this->request->getVar('keyword');
            ///Memanggil method searchFriend pada FriendModel untuk memulai pencarian
            $friend_list = $this->FriendModel->searchFriend($keyword, $data_friend['id_users']);

            // Jika hasil pencarian kosong, maka $friend akan diisi sebuah string [kosong]
            if ($friend_list == null) {
                $friend_list = ['kosong'];
            }
        }

        // Jika tidak terdapat request pencarian
        else {
            // $friend diisi dengan FriendModel->findAll
            $friend_list = $this->FriendModel->getAllFriend($data_friend['id_users']);
        }

        // Mengisi array $data dengan data yang dibutuhkan
        $data['title'] = 'Friend List';
        $data['user'] = $this->UserModel->find(session()->get('id_users'));
        $data['friend_pemilik'] = $this->UserModel->find($data_friend['id_users']);
        $data['friend_list'] = $friend_list;
        // Mencari jumlah notifikasi jika ada
        $data['notification_all'] = count($this->NotificationModel->where(['id_users-notification' => session()->get('id_users'), 'status_notification' => 0])->get()->getResultArray());
        // Mencari jumlah permintaan teman jika ada
        $data['notification_friend'] = count($this->FriendreqModel->requestFriend(session()->get('id_users')));
        // Mencari jumlah chat yang belum dibaca jika ada
        $data['notification_chat'] = count($this->ChattrueModel->getChattrueNotification(session()->get('id_users')));

        // Jika user tidak ada maka akan terlogout
        if ($data['user'] == null) {
            return redirect()->to(base_url('logout'));
        }

        //Menampilkan view dengan membawa $data
        return view('users/friend_list', $data);
    }



    // Method gantiFoto untuk merubah foto profile
    public function gantiFoto()
    {
        // Jika terdapat sebuah method post, maka jalankan fungsi ini
        if ($this->request->getMethod() == 'post') {
            // Membuat rules
            $rules = [
                // Validasi untuk gambar
                'foto' => [
                    'label' => 'Gambar',
                    'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Ukuran {field} terlalu besar (max: 1024 kb)',
                        'is_image' => '{field} yang anda pilih bukanlah gambar',
                        'mime_in' => '{field} yang anda pilih bukanlah gambar',
                    ]
                ]
            ];

            // Jika terdapat kesalahan pada validasi
            if (!$this->validate($rules)) {
                // Mengembalikan sesi dengan fungsi kesalahannya
                session()->setFlashdata('danger', 'Foto gagal diperbarui, pastikan tipe, ukuran (max: 1024kb) dan file yang anda masukkan benar');
                // Redirect ke halaman sebelumnya
                return redirect()->back();
            }

            // Jika tidak terdapat kesalahan saat validasi
            else {
                // Membuat variabel $image yang menampung file gambar yang dimasukkan oleh user
                $image = $this->request->getFile('foto');
                // Jika ada gambar
                if ($image->getError() != 4) {
                    //Membuat nama random untuk foto
                    $name = $image->getRandomName();
                    // Mencari nama foto lama untuk dihapus nanti
                    $foto_lama = $this->UserModel->find(session()->get('id_users'));

                    // Cek apakah foto lama berupa gambar default, ini agar gambar default tidak ikut terhapus
                    if ($foto_lama['fotoprofil'] != 'default.png') {
                        // Menghapus foto yang lama
                        unlink('gambar/foto/' . $foto_lama['fotoprofil']);
                    }

                    // Memindahkan file gambar yang diupload user ke dalam folder foto
                    $image->move('gambar/foto', $name);

                    // Mengisi $data dengan data untuk update
                    $data = [
                        'id_users' => session()->get('id_users'),
                        'fotoprofil' => $name,
                    ];

                    // Update fotoprofil
                    $this->UserModel->save($data);
                    // Membuat flash data berhasil
                    session()->setFlashdata('success', 'Foto Berhasil Diperbarui');
                }

                // Arahkan ke halaman profile
                return redirect()->to(base_url('profile'));
            }
        }
        // Jika users secara gabut menulis di url, maka akan muncul halaman 404
        throw new \CodeIgniter\Exceptions\PageNotFoundException();
    }



    // Method createStatus untuk membuat status
    public function createStatus()
    {
        // Jika terdapat sebuah request bermethod post
        if ($this->request->getMethod() == 'post') {
            // Jika status yang dibuat bertipe biasa
            if ($this->request->getVar('type') == 'biasa') {
                // Membuat rules untuk validasi
                $rules = [
                    // Validasi untuk status
                    'status' => [
                        'label' => 'Status',
                        'rules' => 'required|max_length[2000]',
                        'errors' => [
                            'required' => '{field} harus diisi',
                            'max_length' => '{field} terlalu panjang, batas karakter hanya 2000',
                        ]
                    ],
                    // Validasi untuk gambar
                    'gambar' => [
                        'label' => 'Gambar',
                        'rules' => 'max_size[gambar,1024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                        'errors' => [
                            'max_size' => 'Ukuran {field} terlalu besar (max: 1024 kb)',
                            'is_image' => '{field} yang anda pilih bukanlah gambar',
                            'mime_in' => '{field} yang anda pilih bukanlah gambar',
                        ]
                    ]
                ];

                // Jika terdapat kesalahan saat validasi
                if (!$this->validate($rules)) {
                    // Membuat flash data tanda gagal
                    session()->setFlashdata('danger', 'Gagal membuat status, pastikan status anda tidak lebih dari 2000 huruf, dan jika anda mengupload gambar, pastikan tipe, ukuran (max: 1024kb) dan file yang anda masukkan benar');
                    // Arahkan ke halaman sebelumnya
                    return redirect()->back();
                }

                // Jika tidak terdapat kesalahan saat validasi
                else {
                    // Ambil gambar
                    $gambar = $this->request->getFile('gambar');

                    // Jika tidak ada gambar
                    if ($gambar->getError() == 4) {
                        $name = null;
                    }

                    // Jika gambar ada
                    else {
                        //Membuat nama random untuk gambar
                        $name = $this->request->getFile('gambar')->getRandomName();
                        //Memindahkan file gambar yang diupload user ke dalam folder gambar
                        $gambar->move('gambar/gambar_status', $name);
                    }

                    // Membuat Array baru yang akan dimasukkan ke database sebagai status baru
                    $data = [
                        'id_users-status' => session()->get('id_users'),
                        'slug_status' => 'status' . '-' . rand() . '-' . rand() . '-' . rand() . '-' . rand(),
                        'status' => nl2br(htmlspecialchars($this->request->getVar('status'))),
                        'gambar_status' => $name,
                        'type' => $this->request->getVar('type'),
                        'status-created_at' => $this->Waktu,
                    ];
                }
            }

            // Jika status yang dibuat bertipe background
            else {
                // Mengambil background yang dipilih
                $background = $this->request->getVar('pilihan_gambar');

                // Jika background yang dipilih tidak ada
                if ($background != 'bg-blue.webp' and $background != 'bg-green.webp' and $background != 'bg-red.webp' and $background != 'bg-purple.webp') {
                    // Membuat flash data tanda gagal
                    session()->setFlashdata('danger', 'Gagal membuat status, pastikan status anda tidak lebih dari 500 huruf, dan pastikan anda memilih gambar yang benar');
                    // Arahkan ke halaman sebelumnya
                    return redirect()->back();
                }

                // Membuat rules untuk validasi
                $rules = [
                    // Validasi untuk status
                    'status' => [
                        'label' => 'Status',
                        'rules' => 'required|max_length[500]',
                        'errors' => [
                            'required' => '{field} harus diisi',
                            'max_length' => '{field} terlalu panjang, batas karakter hanya 500',
                        ]
                    ],
                ];

                // Jika terdapat kesalahan saat validasi
                if (!$this->validate($rules)) {
                    // Membuat flash data tanda gagal
                    session()->setFlashdata('danger', 'Gagal membuat status, pastikan status anda tidak lebih dari 500 huruf, dan pastikan anda memilih gambar yang benar');
                    // Arahkan ke halaman sebelumnya
                    return redirect()->back();
                }

                // Jika tidak terdapat kesalahan saat validasi
                else {
                    // Membuat Array baru yang akan dimasukkan ke database sebagai status baru
                    $data = [
                        'id_users-status' => session()->get('id_users'),
                        'slug_status' => 'status' . '-' . rand() . '-' . rand() . '-' . rand() . '-' . rand(),
                        'status' => nl2br(htmlspecialchars($this->request->getVar('status'))),
                        'gambar_status' => $background,
                        'type' => $this->request->getVar('type'),
                        'status-created_at' => $this->Waktu,
                    ];
                }
            }

            // Menyimpan status
            $this->StatusModel->save($data);
            // Mengambil id yang baru saja dimasukkan dari fungsi save di atas
            $id_status = $this->StatusModel->insertID();

            // Mengambil data milik user
            $data_user = $this->UserModel->find(session()->get('id_users'));
            // Mengambil semua data teman yang dimiliki user
            $teman = $this->FriendModel->getAllFriend(session()->get('id_users'));

            // Membuat perulangan untuk notifikasi
            foreach ($teman as $tmn) {
                // Membuat notifikasi
                $notification = [
                    'id_users-notification' => $tmn['id_users'],
                    'notification' => '@' . $data_user['username'] . ' telah mengirim status baru',
                    'routes_notification' => 'new-status',
                    'key_notification' => $id_status,
                    'notification-created_at' => $this->Waktu,
                ];

                // Menyimpan notifikasi
                $this->NotificationModel->save($notification);
            }

            // Membuat sebuah flash data berhasil
            session()->setFlashdata('success', 'Status Berhasil Ditambahkan');
            // Arahkan ke url sebelumnya
            return redirect()->back();
        }
        // Jika users secara gabut menulis di url, maka akan mncul halaman 404
        throw new \CodeIgniter\Exceptions\PageNotFoundException();
    }



    // likeStatus untuk memberi like pada sebuah status
    public function likeStatus($id_status)
    {
        // Mengambil data milik friend
        $data_status = $this->StatusModel->find($id_status);
        // Jika status yang dimaksud tidak ada di dalam database
        if ($data_status == null) {
            // muncul halaman 404
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Mengambil data apakah user pernah like
        $status_like = $this->LikestatusModel->where(['id_users-likestatus' => session()->get('id_users'), 'id_status-likestatus' => $id_status])->get()->getResultarray();
        // Jika ternyata like dari user tersebut sudah pernah ada
        if ($status_like) {
            // Menghapus like
            $this->LikestatusModel->where(['id_users-likestatus' => session()->get('id_users'), 'id_status-likestatus' => $id_status])->delete();

            // Arahkan ke url sebelumnya
            return redirect()->back();
        } else {
            // Membuat Array baru yang akan dimasukkan ke database sebagai like baru
            $data = [
                'id_users-likestatus' => session()->get('id_users'), // Yang memberi like
                'id_status-likestatus' => $id_status, // Status yang diberi like
                'likestatus-created_at' => $this->Waktu,
            ];

            // Jika pemilik status bukanlah aku sendiri
            if ($data_status['id_users-status'] != session()->get('id_users')) {
                // Mengambil data milik user
                $data_user = $this->UserModel->find(session()->get('id_users'));

                // Membuat notifikasi
                $notification = [
                    'id_users-notification' => $data_status['id_users-status'],
                    'notification' => '@' . $data_user['username'] . ' menyukai status anda',
                    'routes_notification' => 'like-status',
                    'key_notification' => $id_status,
                    'notification-created_at' => $this->Waktu,
                ];

                // Menyimpan notifikasi
                $this->NotificationModel->save($notification);
            }

            // Menyimpan data like
            $this->LikestatusModel->save($data);

            // Arahkan ke url sebelumnya
            return redirect()->back();
        }
    }



    // deleteStatus untuk menghapus status
    public function deleteStatus($id_status)
    {
        // Mengambil data milik user
        $data_user = $this->UserModel->find(session()->get('id_users'));
        // Mengambil data status yang akan dihapus
        $data_status = $this->StatusModel->find($id_status);

        // Jika status yang dimaksud tidak ada di dalam database
        if ($data_status == null) {
            // muncul halaman 404
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Mengmbil data dari pemilik status
        $data_user_pemilik_status = $this->UserModel->find($data_status['id_users-status']);

        // Jika level pemilik status adalah 1
        if ($data_user_pemilik_status['level'] == 1) {
            // Jika level user adalah 1 maka true
            if ($data_user['level'] == 1) {
                $hak = true;
            }
            // Lainnya maka false
            else {
                $hak = false;
            }
        }
        // Jika level pemilik status adalah 2
        elseif ($data_user_pemilik_status['level'] == 2) {
            // Jika level user adalah 1 maka true
            if ($data_user['level'] == 1) {
                $hak = true;
            }
            // Jika id user sama dengan pemilik status maka true
            elseif ($data_user_pemilik_status['id_users'] == session()->get('id_users')) {
                $hak = true;
            }
            // Lainnya maka false
            else {
                $hak = false;
            }
        }
        // Jika level pemilik status adalah 3
        elseif ($data_user_pemilik_status['level'] == 3) {
            // Jika level user adalah 1 maka true
            if ($data_user['level'] == 1) {
                $hak = true;
            }
            // Jika level user adalah 2 maka true
            elseif ($data_user['level'] == 2) {
                $hak = true;
            }
            // Jika id user sama dengan pemilik status maka true
            elseif ($data_user_pemilik_status['id_users'] == session()->get('id_users')) {
                $hak = true;
            }
            // Lainnya maka false
            else {
                $hak = false;
            }
        }

        // Jika hak = true
        if ($hak == true) {
            // Jika tipe status biasa
            if ($data_status['type'] == 'biasa') {
                //cari nama gambar berdasarkan id
                $gambar = $this->StatusModel->find($id_status);

                // Jika gambar ada
                if ($gambar['gambar_status'] != null) {
                    unlink('gambar/gambar_status/' . $gambar['gambar_status']);
                }
            }

            //Memanggil model deleteStatus
            $this->StatusModel->deleteStatus($id_status);
            //Membuat sebuah flash data baru tenda status berhasil dibuat
            session()->setFlashdata('success', 'Status Berhasil Dihapus');
            // Redirect ke halaman sebelumnya
            return redirect()->back();
        }
        // Jika user secara gabut menulis di url atau hak = false, maka akan muncul halaman 404
        throw new \CodeIgniter\Exceptions\PageNotFoundException();
    }



    // Method friendPage atau halaman friend
    public function friendPage($slug_users)
    {
        // Mengambil data friend
        $data_friend = $this->UserModel->where(['slug_users' => $slug_users])->first();

        // Jika friend tidak ada
        if ($data_friend == null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Jika id friend sama dengan id user
        if ($data_friend['id_users'] == session()->get('id_users')) {
            // Arahkan ke halaman profile
            return redirect()->to(base_url('profile'));
        }

        // Mengisi variabel data yang diperlukan
        $data['title'] = 'Profile';
        $data['user'] = $this->UserModel->find(session()->get('id_users'));
        $data['status'] = [];
        $data['friend'] = $data_friend;
        $data['friend_add'] = $this->FriendreqModel->requestFriend(session()->get('id_users'), $data_friend['id_users']);
        $data['friend_demo'] = $this->FriendModel->demoFriend($data_friend['id_users']);
        $data['friend_count'] = count($this->FriendModel->where(['id_users-friend' => session()->get('id_users')])->get()->getResultArray());
        $data['like'] = $this->LikestatusModel->join('users', 'likestatus.id_users-likestatus = users.id_users')->get()->getResultArray();
        // Mencari jumlah notifikasi jika ada
        $data['notification_all'] = count($this->NotificationModel->where(['id_users-notification' => session()->get('id_users'), 'status_notification' => 0])->get()->getResultArray());
        // Mencari jumlah permintaan teman jika ada
        $data['notification_friend'] = count($this->FriendreqModel->requestFriend(session()->get('id_users')));
        // Mencari jumlah chat yang belum dibaca jika ada
        $data['notification_chat'] = count($this->ChattrueModel->getChattrueNotification(session()->get('id_users')));

        // Mengisi $data_status dengan status yang dimiliki user
        $data_status = $this->StatusModel->statusFriend($data_friend['id_users']);

        // Membuat No
        $no = 0;
        // Untuk setiap jumlah array $data_status, ulangi
        foreach ($data_status as $dt_sts) {
            // $status diisi dengan $data_status[$no], $status ini berbeda dengan $status di atas
            $status = $data_status[$no];
            // Mencari jumlah comment yang ada berdasarkan status yang dimaksud
            $comment['comment'] = count($this->CommentModel->where(['id_status-comment' => $dt_sts['id_status']])->get()->getResultArray());
            // Mencari jumlah like yang ada berdasarkan like yang dimaksud
            $like['like'] = count($this->LikestatusModel->where(['id_status-likestatus' => $dt_sts['id_status']])->get()->getResultArray());

            // Jika user sudah memberi like pada status itu
            if ($this->LikestatusModel->where(['id_users-likestatus' => session()->get('id_users'), 'id_status-likestatus' => $dt_sts['id_status']])->get()->getResultArray()) {
                // $like diisi true
                $like['sudah_like'] = true;
            }

            // Jika belum
            else {
                // $like diisi false
                $like['sudah_like'] = false;
            }

            // $status_final diisi dengan penggabungan dari 3 array di atas
            $status_final = array_merge($status, $comment, $like);
            // $status_final diisikan ke $data[status][sesuai no]
            $data['status'][$no] = $status_final;
            // Nilai dari no ditambahkan++
            $no++;
        }

        // Jika user tidak ada maka akan terlogout
        if ($data['user'] == null) {
            return redirect()->to(base_url('logout'));
        }

        // Menampilkan view dengan membawa $data
        return view('users/friend_profile', $data);
    }



    // Method addFriend untuk menambahkan teman
    public function addFriend($id_friend)
    {
        // Mengambil data milik friend
        $data_friend = $this->UserModel->find($id_friend);
        // Mengambil data milik user
        $data_user = $this->UserModel->find(session()->get('id_users'));
        // Jika user yang dimaksud tidak ada di dalam database
        if ($data_friend == null or $id_friend == session()->get('id_users')) {
            // muncul halaman 404
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Mengambil data tentang status dari permintaan tersebut
        $status_permintaan = $this->FriendreqModel->requestFriend(session()->get('id_users'), $id_friend);
        // Jika ternyata permintaan tersebut sudah pernah ada
        if ($status_permintaan) {
            // muncul halaman 404
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Membuat Array baru yang akan dimasukkan ke database sebagai permintaan pertemanan baru
        $data = [
            'id_users-friendreq' => session()->get('id_users'), // Yang mengirim permintaan
            'id_friend-friendreq' => $id_friend, // Yang dikirimi permintaan
            'friendreq-created_at' => $this->Waktu,
        ];

        // Membuat notifikasi
        $notification = [
            'id_users-notification' => $id_friend,
            'notification' => '@' . $data_user['username'] . ' mengirimi anda permintaan pertemanan',
            'routes_notification' => 'request-friend',
            'key_notification' => $data_user['id_users'],
            'notification-created_at' => $this->Waktu,
        ];

        // Menyimpan data permintaan
        $this->FriendreqModel->save($data);
        // Menyimpan notifikasi
        $this->NotificationModel->save($notification);
        // Membuat sebuah flash data berhasil
        session()->setFlashdata('success', 'Permintaan Pertemanan Berhasil Dikirim');

        // Arahkan ke url sebelumnya
        return redirect()->back();
    }



    // Method acceptFriend untuk menerima teman
    public function acceptFriend($id_friend)
    {
        // Mengambil data milik friend
        $data_friend = $this->UserModel->find($id_friend);
        // Mengambil data milik user
        $data_user = $this->UserModel->find(session()->get('id_users'));
        // Jika user yang dimaksud tidak ada di dalam database
        if ($data_friend == null or $id_friend == session()->get('id_users')) {
            // muncul halaman 404
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Mengambil data tentang status dari permintaan tersebut
        $status_permintaan = $this->FriendreqModel->requestFriend(session()->get('id_users'), $id_friend);
        // Jika ternyata permintaan tersebut belum pernah ada
        if (!$status_permintaan) {
            // muncul halaman 404
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Jika yang menerima permintaan bukanlah user yang dikirimi permintaan
        if ($status_permintaan[0]['id_friend-friendreq'] != session()->get('id_users')) {
            // muncul halaman 404
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Mencari id_users
        $id_users = session()->get('id_users');
        // Menentukan where
        $where = "id_users-friendreq = $id_users AND id_friend-friendreq = $id_friend OR id_users-friendreq = $id_friend AND id_friend-friendreq = $id_users";
        $id_friendreq = $this->FriendreqModel->where($where)->get()->getResultArray();

        // Membuat data untuk mengupdate status pertemanan
        $data = [
            'id_friendreq' => $id_friendreq[0]['id_friendreq'],
            'status' => 1,
        ];
        // Menyimpan perubahan
        $this->FriendreqModel->save($data);

        // Membuat 2 buah data pertemanan
        $friend = [
            [
                'id_users-friend' => $id_users,
                'id_friend-friend' => $id_friend,
                'friend-created_at' => $this->Waktu,
            ],
            [
                'id_users-friend' => $id_friend,
                'id_friend-friend' => $id_users,
                'friend-created_at' => $this->Waktu,
            ]
        ];

        // Membuat notifikasi
        $notification = [
            'id_users-notification' => $id_friend,
            'notification' => '@' . $data_user['username'] . ' menerima permintaan pertemanan anda',
            'routes_notification' => 'accept-friend',
            'key_notification' => $data_user['id_users'],
            'notification-created_at' => $this->Waktu,
        ];

        // Menyimpan data pertemanan
        $this->FriendModel->insertBatch($friend);
        // Menyimpan notifikasi
        $this->NotificationModel->save($notification);

        // Membuat sebuah flash data berhasil
        session()->setFlashdata('success', 'Anda Telah Berhasil Berteman');
        // Arahkan ke url sebelumnya
        return redirect()->back();
    }



    // Method deleteFriend untuk menghapus teman
    public function deleteFriend($id_friend)
    {
        // Mengambil data milik friend
        $data_user = $this->UserModel->find($id_friend);
        // Jika user yang dimaksud tidak ada di dalam database
        if ($data_user == null or $id_friend == session()->get('id_users')) {
            // muncul halaman 404
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Mengambil data tentang status dari permintaan tersebut
        $status_permintaan = $this->FriendreqModel->requestFriend(session()->get('id_users'), $id_friend);
        // Jika ternyata permintaan tersebut belum pernah ada
        if (!$status_permintaan) {
            // muncul halaman 404
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Membuat id_users
        $id_users = session()->get('id_users');

        // Mencari status permintaan pertemanan
        $status_friend = $this->FriendreqModel->requestFriend(session()->get('id_users'), $id_friend);
        // Jika permntaan sudah diterima, hapus juga data pada tabel friend
        if ($status_friend[0]['status'] == 1) {
            // Menentukan where pada tabel friend
            $hapus_friend = "id_users-friend = $id_users AND id_friend-friend = $id_friend OR id_users-friend = $id_friend AND id_friend-friend = $id_users";
            // Menghapus pertemanan di tabel friend
            $this->FriendModel->where($hapus_friend)->delete();
        }

        // Menentukan where pada tabel friendreq
        $hapus_friendreq = "id_users-friendreq = $id_users AND id_friend-friendreq = $id_friend OR id_users-friendreq = $id_friend AND id_friend-friendreq = $id_users";
        // Menghapus pertemanan di tabel friendreq
        $this->FriendreqModel->where($hapus_friendreq)->delete();

        // Menentukan flash data yang akan muncul
        if ($status_friend[0]['status'] == 1) {
            // Membuat sebuah flash data berhasil
            session()->setFlashdata('success', 'Pertemanan Berhasil Dihapus');
        } else {
            // Membuat sebuah flash data berhasil
            session()->setFlashdata('success', 'Permintaan Pertemanan Berhasil Dihapus');
        }

        // Arahkan ke url sebelumnya
        return redirect()->back();
    }



    // Method comment atau halaman comment
    public function comment($slug_status)
    {
        // Mengambil data user
        $data_status = $this->StatusModel->where(['slug_status' => $slug_status])->first();

        // Jika data user tidak ada
        if ($data_status == null) {
            // 404
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Mengisi dta yang diperlukan untuk ke view
        $data['title'] = 'Comment';
        $data['user'] = $this->UserModel->find(session()->get('id_users'));
        // Mencari jumlah notifikasi jika ada
        $data['notification_all'] = count($this->NotificationModel->where(['id_users-notification' => session()->get('id_users'), 'status_notification' => 0])->get()->getResultArray());
        // Mencari jumlah permintaan teman jika ada
        $data['notification_friend'] = count($this->FriendreqModel->requestFriend(session()->get('id_users')));
        // Mencari jumlah chat yang belum dibaca jika ada
        $data['notification_chat'] = count($this->ChattrueModel->getChattrueNotification(session()->get('id_users')));

        // Mengisi $data_status dengan status yang dimiliki user
        $data_status2 = $this->StatusModel->getStatusComment($data_status['id_status']);
        // $status diisi dengan $data_status2[0]
        $status = $data_status2[0];
        // Mencari jumlah comment yang ada berdasarkan status yang dimaksud
        $comment['comment'] = count($this->CommentModel->where(['id_status-comment' => $data_status2[0]['id_status']])->get()->getResultArray());
        // Mencari jumlah like yang ada berdasarkan like yang dimaksud
        $status_like['like'] = count($this->LikestatusModel->where(['id_status-likestatus' => $data_status2[0]['id_status']])->get()->getResultArray());

        // Jika user sudah memberi like pada status itu
        if ($this->LikestatusModel->where(['id_users-likestatus' => session()->get('id_users'), 'id_status-likestatus' => $data_status2[0]['id_status']])->get()->getResultArray()) {
            // $status_like diisi true
            $status_like['sudah_like'] = true;
        }
        // Jika belum
        else {
            // $status_like diisi false
            $status_like['sudah_like'] = false;
        }

        // $status_final diisi dengan penggabungan dari 3 array di atas
        $status_final = array_merge($status, $comment, $status_like);
        // $status_final diisikan ke $data[status][sesuai no]
        $data['status'][0] = $status_final;
        // Data like dari status
        $data['status_like'] = $this->LikestatusModel->join('users', 'likestatus.id_users-likestatus = users.id_users')->get()->getResultArray();


        // Mengisi $data_comment dengan status yang dimiliki user
        $data_comment = $this->CommentModel->getComment($data_status2[0]['id_status']);
        // Jika ada comment
        if ($data_comment) {
            // Membuat No
            $no = 0;
            // Untuk setiap jumlah array $data_comment, ulangi
            foreach ($data_comment as $dt_cmt) {
                // $comment diisi dengan $data_comment[$no], $comment ini berbeda dengan $comment di atas
                $comment = $data_comment[$no];
                // Mencari jumlah reply yang ada berdasarkan comment yang dimaksud
                $reply['reply'] = count($this->ReplyModel->where(['id_comment-reply' => $data_comment[$no]['id_comment']])->get()->getResultArray());
                // Mencari jumlah like yang ada berdasarkan like yang dimaksud
                $comment_like['like'] = count($this->LikecommentModel->where(['id_comment-likecomment' => $dt_cmt['id_comment']])->get()->getResultArray());

                // Jika user sudah memberi like pada comment itu
                if ($this->LikecommentModel->where(['id_users-likecomment' => session()->get('id_users'), 'id_comment-likecomment' => $dt_cmt['id_comment']])->get()->getResultArray()) {
                    // $comment_like diisi true
                    $comment_like['sudah_like'] = true;
                }

                // Jika belum
                else {
                    // $comment_like diisi false
                    $comment_like['sudah_like'] = false;
                }

                // $comment_final diisi dengan penggabungan dari 3 array di atas
                $comment_final = array_merge($comment, $reply, $comment_like);
                // $data[comment] diisi $comment_final
                $data['comment'][$no] = $comment_final;
                // Nilai dari no ditambahkan++
                $no++;
            }
        } else {
            // $data_comment diisi null
            $data['comment'] = null;
        }
        // Data like dari komentar
        $data['comment_like'] = $this->LikecommentModel->join('users', 'likecomment.id_users-likecomment = users.id_users')->having('id_status-likecomment', $data_status['id_status'])->get()->getResultArray();


        // Mengisi $data_reply dengan status yang dimiliki user
        $data_reply = $this->ReplyModel->getReply($data_status2[0]['id_status']);
        // Jika ada comment
        if ($data_reply) {
            // Membuat No
            $no = 0;
            // Untuk setiap jumlah array $data_reply, ulangi
            foreach ($data_reply as $dt_rpy) {
                // $reply diisi dengan $data_reply[$no], $reply ini berbeda dengan $reply di atas
                $reply = $data_reply[$no];
                // Mencari jumlah like yang ada berdasarkan like yang dimaksud
                $reply_like['like'] = count($this->LikereplyModel->where(['id_reply-likereply' => $dt_rpy['id_reply']])->get()->getResultArray());

                // Jika user sudah memberi like pada comment itu
                if ($this->LikereplyModel->where(['id_users-likereply' => session()->get('id_users'), 'id_reply-likereply' => $dt_rpy['id_reply']])->get()->getResultArray()) {
                    // $reply_like diisi true
                    $reply_like['sudah_like'] = true;
                }

                // Jika belum
                else {
                    // $reply_like diisi false
                    $reply_like['sudah_like'] = false;
                }

                // $reply_final diisi dengan penggabungan dari 3 array di atas
                $reply_final = array_merge($reply, $reply_like);
                // $reply_final diisikan ke $data[comment][sesuai no]
                $data['reply'][$no] = $reply_final;
                // Nilai dari no ditambahkan++
                $no++;
            }
        } else {
            // $data_reply diisi null
            $data['reply'] = null;
        }
        // Data like dari reply
        $data['reply_like'] = $this->LikereplyModel->join('users', 'likereply.id_users-likereply = users.id_users')->having('id_status-likereply', $data_status['id_status'])->get()->getResultArray();


        // Jika user tidak ada maka akan terlogout
        if ($data['user'] == null) {
            return redirect()->to(base_url('logout'));
        }

        //Menampilkan view dengan membawa $data
        return view('users/comment', $data);
    }



    // Method createComment untuk membuat komentar
    public function createComment($id_status)
    {
        // Jika terdapat request dengan metode post
        if ($this->request->getMethod() == 'post') {
            // Membuat rules untuk validasi
            $rules = [
                // Validasi untuk comment
                'comment' => [
                    'label' => 'Komentar',
                    'rules' => 'required|max_length[1000]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'max_length' => '{field} terlalu panjang, batas karakter hanya 1000',
                    ]
                ],
                // Validasi untuk gambar
                'gambar' => [
                    'label' => 'Gambar',
                    'rules' => 'max_size[gambar,1024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Ukuran {field} terlalu besar (max: 1024 kb)',
                        'is_image' => '{field} yang anda pilih bukanlah gambar',
                        'mime_in' => '{field} yang anda pilih bukanlah gambar',
                    ]
                ]
            ];

            // Jika terdapat kesalahan saat validasi
            if (!$this->validate($rules)) {
                // Membuat flash data tanda gagal
                session()->setFlashdata('danger', 'Gagal mengirim komentar, pastikan komentar anda tidak lebih dari 1000 huruf, dan jika anda mengupload gambar, pastikan tipe dan ukuran (max: 1024kb) File yang anda masukkan benar');
                // Redirect ke halaman sebelumnya
                return redirect()->back();
            }

            // Jika tidak ada kesalahan saat validasi
            else {
                // Ambil gambar
                $gambar = $this->request->getFile('gambar');

                // Jika tidak ada gambar
                if ($gambar->getError() == 4) {
                    $name = null;
                } else {
                    // Membuat nama random untuk gambar
                    $name = $this->request->getFile('gambar')->getRandomName();
                    // Memindahkan file gambar yang diupload user ke dalam folder gambar
                    $gambar->move('gambar/gambar_comment', $name);
                }

                // Membuat Array baru yang akan dimasukkan ke database sebagai komentar baru
                $data = [
                    'id_users-comment' => session()->get('id_users'),
                    'id_status-comment' => $id_status,
                    'comment' => nl2br(htmlspecialchars($this->request->getVar('comment'))),
                    'gambar_comment' => $name,
                    'comment-created_at' => $this->Waktu,
                ];

                // Menyimpan komentar
                $this->CommentModel->save($data);

                // Mengambil data status
                $data_status = $this->StatusModel->find($id_status);

                // Jika pemilik status bukanlah aku sendiri
                if ($data_status['id_users-status'] != session()->get('id_users')) {
                    // Mengambil data milik user
                    $data_user = $this->UserModel->find(session()->get('id_users'));
                    // Mengambil data pemilik status
                    $pemilik_status = $this->UserModel->find($data_status['id_users-status']);

                    // Membuat notifikasi
                    $notification = [
                        'id_users-notification' => $pemilik_status['id_users'],
                        'notification' => '@' . $data_user['username'] . ' mengomentari status anda',
                        'routes_notification' => 'new-comment',
                        'key_notification' => $id_status,
                        'notification-created_at' => $this->Waktu,
                    ];

                    // Menyimpan notifikasi
                    $this->NotificationModel->save($notification);
                }

                // Membuat sebuah flash data baru tenda status berhasil dibuat
                session()->setFlashdata('success', 'Komentar Berhasil Ditambahkan');
                // Dipaksa redirect ke halaman sebelumnya
                return redirect()->back();
            }
        }
        // Jika users secara gabut menulis di url, maka akan mncul halaman 404
        throw new \CodeIgniter\Exceptions\PageNotFoundException();
    }



    // likeComment untuk memberi like pada sebuah status
    public function likeComment($id_status, $id_comment)
    {
        // Mengambil data milik friend
        $data_comment = $this->CommentModel->find($id_comment);
        // Jika status yang dimaksud tidak ada di dalam database
        if ($data_comment == null) {
            // muncul halaman 404
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Mengambil data apakah user pernah like
        $comment_like = $this->LikecommentModel->where(['id_users-likecomment' => session()->get('id_users'), 'id_comment-likecomment' => $id_comment])->get()->getResultArray();
        // Jika ternyata like dari user tersebut sudah pernah ada
        if ($comment_like) {
            // Menghapus like
            $this->LikecommentModel->where(['id_users-likecomment' => session()->get('id_users'), 'id_comment-likecomment' => $id_comment])->delete();

            // Arahkan ke url sebelumnya
            return redirect()->back();
        } else {
            // Membuat Array baru yang akan dimasukkan ke database sebagai like baru
            $data = [
                'id_users-likecomment' => session()->get('id_users'), // Yang memberi like
                'id_status-likecomment' => $id_status, // Status tempat komentar berasal yang diberi like
                'id_comment-likecomment' => $id_comment, // Komentar yang diberi like
                'likecomment-created_at' => $this->Waktu,
            ];

            // Jika pemilik komentar bukanlah aku sendiri
            if ($data_comment['id_users-comment'] != session()->get('id_users')) {
                // Mengambil data milik user
                $data_user = $this->UserModel->find(session()->get('id_users'));

                // Membuat notifikasi
                $notification = [
                    'id_users-notification' => $data_comment['id_users-comment'],
                    'notification' => '@' . $data_user['username'] . ' menyukai komentar anda',
                    'routes_notification' => 'like-comment',
                    'key_notification' => $id_status,
                    'notification-created_at' => $this->Waktu,
                ];

                // Menyimpan notifikasi
                $this->NotificationModel->save($notification);
            }

            // Menyimpan data like
            $this->LikecommentModel->save($data);

            // Arahkan ke url sebelumnya
            return redirect()->back();
        }
    }



    // Method delete comment untuk menghapus komentar
    public function deleteComment($id_comment)
    {
        // Mengambil data milik user
        $data_user = $this->UserModel->find(session()->get('id_users'));
        // Mengambil data comment yang akan dihapus
        $data_comment = $this->CommentModel->find($id_comment);

        // Jika sttaus yang dimaksud tidak ada di dalam database
        if ($data_comment == null) {
            // 404
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Mengambil data user pemilik comment jika comment ada
        $data_user_pemilik_comment = $this->UserModel->find($data_comment['id_users-comment']);

        // Mendapatkan hak untuk menghapus
        if ($data_user_pemilik_comment['level'] == 1) {
            if ($data_user['level'] == 1) {
                $hak = true;
            } else {
                $hak = false;
            }
        } elseif ($data_user_pemilik_comment['level'] == 2) {
            if ($data_user['level'] == 1) {
                $hak = true;
            } elseif ($data_user_pemilik_comment['id_users'] == session()->get('id_users')) {
                $hak = true;
            } else {
                $hak = false;
            }
        } elseif ($data_user_pemilik_comment['level'] == 3) {
            if ($data_user['level'] == 1) {
                $hak = true;
            } elseif ($data_user['level'] == 2) {
                $hak = true;
            } elseif ($data_user_pemilik_comment['id_users'] == session()->get('id_users')) {
                $hak = true;
            } else {
                $hak = false;
            }
        }

        // Jika hak = true, maka hapus, jika tidak maka lewati
        if ($hak == true) {
            // Cari nama gambar berdasarkan id
            $gambar = $this->CommentModel->find($id_comment);

            if ($gambar['gambar_comment'] != null) {
                unlink('gambar/gambar_comment/' . $gambar['gambar_comment']);
            }

            // Menghapus komentar
            $this->CommentModel->deleteComment($id_comment);
            //Membuat sebuah sesi baru tenda comment berhasil dibuat
            session()->setFlashdata('success', 'Komentar Berhasil Dihapus');
            // Redirect ke halaman sebelumnya
            return redirect()->back();
        }
        // Jika users secara gabut menulis di url, maka akan mncul halaman 404
        throw new \CodeIgniter\Exceptions\PageNotFoundException();
    }



    // Method createReply untuk membuat balasan pada Balasan
    public function createReply($id_status, $id_comment)
    {
        // Jika terdapat request dengan metode post
        if ($this->request->getMethod() == 'post') {
            // Membuat rules untuk validasi
            $rules = [
                // Validasi untuk reply
                'reply' => [
                    'label' => 'Balasan',
                    'rules' => 'required|max_length[1000]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'max_length' => '{field} terlalu panjang, batas karakter hanya 1000',
                    ]
                ],
                // Validasi untuk gambar
                'gambar' => [
                    'label' => 'Gambar',
                    'rules' => 'max_size[gambar,1024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Ukuran {field} terlalu besar (max: 1024 kb)',
                        'is_image' => '{field} yang anda pilih bukanlah gambar',
                        'mime_in' => '{field} yang anda pilih bukanlah gambar',
                    ]
                ]
            ];

            // Jika terdapat kesalahan saat validasi
            if (!$this->validate($rules)) {
                // Membuat flash data tanda gagal
                session()->setFlashdata('danger', 'Gagal mengirim balasan, pastikan balasan anda tidak lebih dari 1000 huruf, dan jika anda mengupload gambar, pastikan tipe dan ukuran (max: 1024kb) File yang anda masukkan benar');
                // Redirect ke halaman sebelumnya
                return redirect()->back();
            }

            // Jika tidak ada kesalahan saat validasi
            else {
                // Ambil gambar
                $gambar = $this->request->getFile('gambar');

                // Jika tidak ada gambar
                if ($gambar->getError() == 4) {
                    $name = null;
                } else {
                    // Membuat nama random untuk gambar
                    $name = $this->request->getFile('gambar')->getRandomName();
                    // Memindahkan file gambar yang diupload user ke dalam folder gambar
                    $gambar->move('gambar/gambar_reply', $name);
                }

                // Membuat Array baru yang akan dimasukkan ke database sebagai Balasan baru
                $data = [
                    'id_users-reply' => session()->get('id_users'),
                    'id_status-reply' => $id_status,
                    'id_comment-reply' => $id_comment,
                    'reply' => nl2br(htmlspecialchars($this->request->getVar('reply'))),
                    'gambar_reply' => $name,
                    'reply-created_at' => $this->Waktu,
                ];

                // Menyimpan Balasan
                $this->ReplyModel->save($data);

                // Mengambil data comment
                $data_comment = $this->CommentModel->find($id_comment);

                // Jika pemilik komentar bukanlah aku sendiri
                if ($data_comment['id_users-comment'] != session()->get('id_users')) {
                    // Mengambil data milik user
                    $data_user = $this->UserModel->find(session()->get('id_users'));
                    // Mengambil data pemilik comment
                    $pemilik_comment = $this->UserModel->find($data_comment['id_users-comment']);

                    // Membuat notifikasi
                    $notification = [
                        'id_users-notification' => $pemilik_comment['id_users'],
                        'notification' => '@' . $data_user['username'] . ' membalas komentar anda',
                        'routes_notification' => 'new-reply',
                        'key_notification' => $id_status,
                        'notification-created_at' => $this->Waktu,
                    ];

                    // Menyimpan notifikasi
                    $this->NotificationModel->save($notification);
                }

                // Membuat sebuah flash data baru tenda status berhasil dibuat
                session()->setFlashdata('success', 'Balasan Berhasil Ditambahkan');
                // Dipaksa redirect ke halaman sebelumnya
                return redirect()->back();
            }
        }
        // Jika users secara gabut menulis di url, maka akan mncul halaman 404
        throw new \CodeIgniter\Exceptions\PageNotFoundException();
    }



    // likeReply untuk memberi like pada sebuah reply
    public function likeReply($id_status, $id_comment, $id_reply)
    {
        // Mengambil data milik friend
        $data_reply = $this->ReplyModel->find($id_reply);
        // Jika reply yang dimaksud tidak ada di dalam database
        if ($data_reply == null) {
            // muncul halaman 404
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Mengambil data apakah user pernah like
        $reply_like = $this->LikereplyModel->where(['id_users-likereply' => session()->get('id_users'), 'id_reply-likereply' => $id_reply])->get()->getResultArray();
        // Jika ternyata like dari user tersebut sudah pernah ada
        if ($reply_like) {
            // Menghapus like
            $this->LikereplyModel->where(['id_users-likereply' => session()->get('id_users'), 'id_reply-likereply' => $id_reply])->delete();

            // Arahkan ke url sebelumnya
            return redirect()->back();
        } else {
            // Membuat Array baru yang akan dimasukkan ke database sebagai like baru
            $data = [
                'id_users-likereply' => session()->get('id_users'), // Yang memberi like
                'id_status-likereply' => $id_status, // Status tempat komentar berasal yang diberi like
                'id_comment-likereply' => $id_comment, // Komentar tempat reply berasal yang diberi like
                'id_reply-likereply' => $id_reply, // Reply yang diberi like
                'likereply-created_at' => $this->Waktu,
            ];

            // Jika pemilik reply bukanlah aku sendiri
            if ($data_reply['id_users-reply'] != session()->get('id_users')) {
                // Mengambil data milik user
                $data_user = $this->UserModel->find(session()->get('id_users'));

                // Membuat notifikasi
                $notification = [
                    'id_users-notification' => $data_reply['id_users-reply'],
                    'notification' => '@' . $data_user['username'] . ' menyukai balasan anda',
                    'routes_notification' => 'like-reply',
                    'key_notification' => $id_status,
                    'notification-created_at' => $this->Waktu,
                ];

                // Menyimpan notifikasi
                $this->NotificationModel->save($notification);
            }

            // Menyimpan data like
            $this->LikereplyModel->save($data);

            // Arahkan ke url sebelumnya
            return redirect()->back();
        }
    }



    // Method deleteReply untuk menghapus reply
    public function deleteReply($id_reply)
    {
        // Mengambil data milik user
        $data_user = $this->UserModel->find(session()->get('id_users'));
        // Mengambil data reply yang akan dihapus
        $data_reply = $this->ReplyModel->find($id_reply);

        // Jika balasan yang dimaksud tidak ada di dalam database
        if ($data_reply == null) {
            // 404
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Mengambil data user pemilik reply jika reply ada
        $data_user_pemilik_reply = $this->UserModel->find($data_reply['id_users-reply']);

        // Mendapatkan hak untuk menghapus
        if ($data_user_pemilik_reply['level'] == 1) {
            if ($data_user['level'] == 1) {
                $hak = true;
            } else {
                $hak = false;
            }
        } elseif ($data_user_pemilik_reply['level'] == 2) {
            if ($data_user['level'] == 1) {
                $hak = true;
            } elseif ($data_user_pemilik_reply['id_users'] == session()->get('id_users')) {
                $hak = true;
            } else {
                $hak = false;
            }
        } elseif ($data_user_pemilik_reply['level'] == 3) {
            if ($data_user['level'] == 1) {
                $hak = true;
            } elseif ($data_user['level'] == 2) {
                $hak = true;
            } elseif ($data_user_pemilik_reply['id_users'] == session()->get('id_users')) {
                $hak = true;
            } else {
                $hak = false;
            }
        }

        // Jika hak = true, maka hapus, jika tidak maka lewati
        if ($hak == true) {
            // Cari nama gambar berdasarkan id
            $gambar = $this->ReplyModel->find($id_reply);

            if ($gambar['gambar_reply'] != null) {
                unlink('gambar/gambar_reply/' . $gambar['gambar_reply']);
            }

            // Menghapus Balasan
            $this->ReplyModel->deleteReply($id_reply);
            //Membuat sebuah sesi baru tenda comment berhasil dibuat
            session()->setFlashdata('success', 'Balasan Berhasil Dihapus');
            // Redirect ke halaman sebelumnya
            return redirect()->back();
        }
        // Jika users secara gabut menulis di url, maka akan mncul halaman 404
        throw new \CodeIgniter\Exceptions\PageNotFoundException();
    }



    // Method deleteAccountPage atau halaman delete akun
    public function deleteAccountPage()
    {
        // Mengembalikan data ke view
        $data['title'] = 'Hapus Akun';
        $data['user'] = $this->UserModel->find(session()->get('id_users'));
        // Mencari jumlah notifikasi jika ada
        $data['notification_all'] = count($this->NotificationModel->where(['id_users-notification' => session()->get('id_users'), 'status_notification' => 0])->get()->getResultArray());
        // Mencari jumlah permintaan teman jika ada
        $data['notification_friend'] = count($this->FriendreqModel->requestFriend(session()->get('id_users')));
        // Mencari jumlah chat yang belum dibaca jika ada
        $data['notification_chat'] = count($this->ChattrueModel->getChattrueNotification(session()->get('id_users')));

        // Jika user tidak ada maka akan terlogout
        if ($data['user'] == null) {
            return redirect()->to(base_url('logout'));
        }

        //Menampilkan view dengan membawa $data
        return view('users/delete_account', $data);
    }



    // Fungsi untuk menghapus akun
    public function deleteAccount($id_users)
    {
        // Jika id users sama dengan id users
        if ($id_users == session()->get('id_users')) {
            // Mengambil data_users
            $data_users = $this->UserModel->where(['id_users' => session()->get('id_users')])->get()->getResultArray();
            // Mengambil data_status
            $data_status = $this->StatusModel->where(['id_users-status' => session()->get('id_users')])->get()->getResultArray();
            // Mengambil data_comment
            $data_comment = $this->CommentModel->where(['id_users-comment' => session()->get('id_users')])->get()->getResultArray();

            // Cek apakah profil berupa gambar default, jika bukan maka profil akan terhapus
            if ($data_users[0]['fotoprofil'] != 'default.png') {
                // Menghapus foto yang lama
                unlink('gambar/foto/' . $data_users[0]['fotoprofil']);
            }

            // Menghapus foto pada status
            foreach ($data_status as $dt_sts) {
                // Jika pada status itu ada gambarnya
                if ($dt_sts['gambar_status']) {
                    // Menghapus gambar status
                    unlink('gambar/gambar_status/' . $dt_sts['gambar_status']);
                }
            }

            // Menghapus foto pada comment
            foreach ($data_comment as $dt_cmt) {
                // Jika pada comment itu ada gambarnya
                if ($dt_cmt['gambar_comment']) {
                    // Menghapus gambar comment
                    unlink('gambar/gambar_comment/' . $dt_cmt['gambar_comment']);
                }
            }

            // Menghapus akun
            $this->UserModel->deleteAccount();
            // Sintaks untuk menghancurkan session
            session()->destroy();
            // Arahkan ke halaman login
            return redirect()->to(base_url('/'));
        }
        // Jika users secara gabut menulis di url, maka akan mncul halaman 404
        throw new \CodeIgniter\Exceptions\PageNotFoundException();
    }



    //Membuat sebuah method bernama logout
    public function logout()
    {
        //Sintaks untuk menghancurkan session
        session()->destroy();
        //Redirect paksa ke halaman / atau Users::index / login page
        return redirect()->to(base_url('/'));
    }
}
