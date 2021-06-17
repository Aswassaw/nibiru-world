<?php

namespace App\Controllers;

// Memanggil semua model yang diperlukan
use App\Models\UserModel;
use App\Models\FriendreqModel;
use App\Models\StatusModel;
use App\Models\CommentModel;
use App\Models\ChattrueModel;
use App\Models\NotificationModel;

// Membuat class bernama Admin yang extends dengan BaseController
class Admin extends BaseController
{
    // Membuat 1 Buah property untuk menampung setiap model di atas
    protected $UserModel;
    protected $FriendreqModel;
    protected $StatusModel;
    protected $CommentModel;
    protected $ChattrueModel;
    protected $NotificationModel;
    protected $Waktu;


    // Ini adalah fungsi construct, yaitu fungsi yang kan berjalan pada setiap kali class miliknya dipanggil
    public function __construct()
    {
        // Mendefinisikan setiap property sebagai model yang dimaksud
        $this->UserModel = new UserModel;
        $this->FriendreqModel = new FriendreqModel;
        $this->StatusModel = new StatusModel;
        $this->CommentModel = new CommentModel;
        $this->ChattrueModel = new ChattrueModel;
        $this->NotificationModel = new NotificationModel();
        $this->Waktu = date('l, d-m-yy, H:i:s');
        // Helper form untuk set_value
        helper(['form']);
    }



    public function index()
    {
        // Jika terdapat request post
        if ($this->request->getMethod() == 'post') {
            // Mengambil keyword
            $keyword = $this->request->getVar('keyword');
            // Mencari data
            $friend = $this->UserModel->searchUser($keyword, 'paginate')->paginate(5, 'users');
            $status = [
                'jumlah_users' => count($this->UserModel->searchUser($keyword)),
                'type' => 'cari',
            ];

            // Jika kosong maka akan diisi string kosong
            if ($friend == null) {
                $friend = ['kosong'];
            }
        }

        // Jika tidak ada request pencarian
        else {
            // Mengambalikan semua
            $friend = $this->UserModel->paginate(5, 'users');
            $status = [
                'jumlah_users' => count($this->UserModel->findAll()),
                'type' => 'biasa',
            ];
        }

        // Jika current_page tidak ada angkanya, maka itu halaman 1
        $current_page = $this->request->getVar('page_users') ? $this->request->getVar('page_users') : 1;

        // Membuat sebuah array bernama $data untuk dikembalikan ke view
        $data['title'] = 'Admin';
        $data['user'] = $this->UserModel->find(session()->get('id_users'));
        $data['friend'] = $friend;
        $data['pager'] = $this->UserModel->pager;
        $data['current_page'] = $current_page;
        $data['status'] = $status;
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

        // Jika user memiliki level 3
        if ($data['user']['level'] == 3) {
            // 404
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        //Menampilkan view dengan membawa $data
        return view('admin/admins', $data);
    }



    // Method edit untuk mengedit data users
    public function edit($slug_users)
    {
        // Mengambil data milik user
        $data_user = $this->UserModel->find(session()->get('id_users'));
        // Mengambil data friend
        $data_friend = $this->UserModel->where(['slug_users' => $slug_users])->first();

        // Jika friend tidak ada
        if ($data_friend == null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Mendapatkan hak untuk menghapus
        if ($data_friend['level'] == 1) {
            if ($data_user['level'] == 1) {
                $hak = true;
            } else {
                $hak = false;
            }
        } elseif ($data_friend['level'] == 2) {
            if ($data_user['level'] == 1) {
                $hak = true;
            } elseif ($data_user['id_users'] == session()->get('id_users')) {
                $hak = true;
            } else {
                $hak = false;
            }
        } elseif ($data_friend['level'] == 3) {
            if ($data_user['level'] != 3) {
                $hak = true;
            } else {
                $hak = false;
            }
        }

        if ($hak != true) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        if ($this->request->getMethod() == 'post') {
            // Jika username adalah username lama maka tidak ada is_unique
            if ($data_friend['username'] == $this->request->getVar('username')) {
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
                // Validasi untuk gambar
                'foto' => [
                    'label' => 'Gambar',
                    'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Ukuran {field} terlalu besar (max: 1024 kb)',
                        'is_image' => '{field} yang anda pilih bukanlah gambar',
                        'mime_in' => '{field} yang anda pilih bukanlah gambar',
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

            // Jika terdapat kesalahan pada validasi
            if (!$this->validate($rules)) {
                // Mengembalikan flash data berisi kesalahan
                session()->setFlashdata('danger', 'Data gagal diperbarui, pastikan data yang anda masukkan benar.');
                // Mengisi $data dengan semua kesalahan
                $data['validation'] = $this->validator;
            }

            //Jika tidak terdapat kesalahan saat validasi
            else {
                // Membuat variabel $image yang menampung file gambar yang dimasukkan oleh user
                $image = $this->request->getFile('foto');
                // Jika ada gambar
                if ($image->getError() != 4) {
                    //Membuat nama random untuk foto
                    $name = $image->getRandomName();
                    // Mencari nama foto lama untuk dihapus nanti
                    $foto_lama = $this->UserModel->find($data_friend['id_users']);
                    // Cek apakah foto lama berupa gambar default, ini agar gambar default tidak ikut terhapus
                    if ($foto_lama['fotoprofil'] != 'default.png') {
                        // Menghapus foto yang lama
                        unlink('gambar/foto/' . $foto_lama['fotoprofil']);
                    }
                    // Memindahkan file gambar yang diupload user ke dalam folder foto
                    $image->move('gambar/foto', $name);
                }

                // Mengisi deskripsi agar tidak kosong
                if ($this->request->getVar('description') == '') {
                    $description = 'Tidak ada deskripsi';
                } else {
                    $description = $this->request->getVar('description');
                }

                // Membuat variabel data untuk menampung data baru
                $data = [
                    'id_users' => $data_friend['id_users'],
                    'username' => htmlspecialchars($this->request->getVar('username')),
                    'slug_users' => htmlspecialchars(url_title($this->request->getVar('username'), '-', true)),
                    'firstname' => htmlspecialchars($this->request->getVar('firstname')),
                    'lastname' => htmlspecialchars($this->request->getVar('lastname')),
                    'description' => htmlspecialchars($description),
                    'users-updated_at' => $this->Waktu,
                ];

                // Jika ada gambar
                if ($image->getError() != 4) {
                    $data['fotoprofil'] = $name;
                }

                // Menyimpan data baru
                $this->UserModel->save($data);
                // Membuat sebuah flash data pesan berhasil
                session()->setFlashdata('success', 'Data berhasil diperbarui.');
                // Arahkan ke admin
                return redirect('admins');
            }
        }

        // Membuat sebuah array bernama $data untuk dikembalikan ke view
        $data['title'] = 'Admin';
        $data['user'] = $this->UserModel->find(session()->get('id_users'));
        $data['friend'] = $data_friend;
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

        // Jika user memiliki level 3
        if ($data['user']['level'] == 3) {
            // 404
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        //Menampilkan view dengan membawa $data
        return view('admin/edit', $data);
    }



    // Method deleteAccountAdmin untuk menghapusdata sebagai admin
    public function deleteAccountAdmin($id_friend)
    {
        // Mengambil data milik user
        $data_user = $this->UserModel->find(session()->get('id_users'));
        // Mengambil data milik user yang akan dihapus
        $data_friend = $this->UserModel->find($id_friend);

        // Jika status yang dimaksud tidak ada di dalam database
        if ($data_friend == null) {
            // 404
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Mendapatkan hak untuk menghapus
        if ($data_friend['level'] == 1) {
            if ($data_user['level'] == 1) {
                $hak = true;
            } else {
                $hak = false;
            }
        } elseif ($data_friend['level'] == 2) {
            if ($data_user['level'] == 1) {
                $hak = true;
            } elseif ($data_user['id_users'] == session()->get('id_users')) {
                $hak = true;
            } else {
                $hak = false;
            }
        } elseif ($data_friend['level'] == 3) {
            if ($data_user['level'] != 3) {
                $hak = true;
            } else {
                $hak = false;
            }
        }

        if ($hak == true) {
            // Mengambil data_users
            $data_users = $this->UserModel->where(['id_users' => $id_friend])->get()->getResultArray();
            // Mengambil data_status
            $data_status = $this->StatusModel->where(['id_users-status' => $id_friend])->get()->getResultArray();
            // Mengambil data_comment
            $data_comment = $this->CommentModel->where(['id_users-comment' => $id_friend])->get()->getResultArray();

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

            $this->UserModel->deleteAccount($id_friend);
            session()->setFlashdata('success', 'User berhasil dihapus.');
            return redirect()->back();
        }
        // Jika users secara gabut menulis di url, maka akan mncul halaman 404
        throw new \CodeIgniter\Exceptions\PageNotFoundException();
    }



    // Method untuk merubah level user menjadi admin
    public function changeLevelUp($id_friend)
    {
        // Mengambil data milik user
        $data_user = $this->UserModel->find(session()->get('id_users'));
        // Mengambil data milik comment yang akan dihapus
        $data_friend = $this->UserModel->find($id_friend);

        // Jika status yang dimaksud tidak ada di dalam database
        if ($data_friend == null) {
            // 404
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Mendapatkan hak untuk menghapus
        if ($data_friend['level'] == 1) {
            if ($data_user['level'] == 1) {
                $hak = true;
            } else {
                $hak = false;
            }
        } elseif ($data_friend['level'] == 2) {
            if ($data_user['level'] == 1) {
                $hak = true;
            } elseif ($data_user['id_users'] == session()->get('id_users')) {
                $hak = true;
            } else {
                $hak = false;
            }
        } elseif ($data_friend['level'] == 3) {
            if ($data_user['level'] != 3) {
                $hak = true;
            } else {
                $hak = false;
            }
        }

        if ($hak == true) {
            $data = [
                'id_users' => $id_friend,
                'level' => 2,
            ];

            // Membuat notifikasi
            $notification = [
                'id_users-notification' => $id_friend,
                'notification' => '@' . $data_user['username'] . ' telah mengubah akun anda menjadi Admin',
                'routes_notification' => 'to-admin',
                'key_notification' => 0,
                'notification-created_at' => $this->Waktu,
            ];
            
            // Menyimpan data baru
            $this->UserModel->save($data);
            // Menyimpan notifikasi
            $this->NotificationModel->save($notification);
            session()->setFlashdata('success', 'User tersebut telah menjadi Admin.');
            return redirect()->back();
        }
        // Jika users secara gabut menulis di url, maka akan mncul halaman 404
        throw new \CodeIgniter\Exceptions\PageNotFoundException();
    }



    // Method untuk merubah level admin menjadi user
    public function changeLevelDown($id_friend)
    {
        // Mengambil data milik user
        $data_user = $this->UserModel->find(session()->get('id_users'));
        // Mengambil data milik comment yang akan dihapus
        $data_friend = $this->UserModel->find($id_friend);

        // Jika sttaus yang dimaksud tidak ada di dalam database
        if ($data_friend == null) {
            // 404
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Mendapatkan hak untuk menghapus
        if ($data_friend['level'] == 1) {
            if ($data_user['level'] == 1) {
                $hak = true;
            } else {
                $hak = false;
            }
        } elseif ($data_friend['level'] == 2) {
            if ($data_user['level'] == 1) {
                $hak = true;
            } elseif ($data_user['id_users'] == session()->get('id_users')) {
                $hak = true;
            } else {
                $hak = false;
            }
        } elseif ($data_friend['level'] == 3) {
            if ($data_user['level'] != 3) {
                $hak = true;
            } else {
                $hak = false;
            }
        }

        if ($hak == true) {
            $data = [
                'id_users' => $id_friend,
                'level' => 3,
            ];

            // Menyimpan data baru
            $this->UserModel->save($data);
            session()->setFlashdata('success', 'Admin tersebut telah menjadi User.');
            return redirect()->back();
        }
        // Jika users secara gabut menulis di url, maka akan mncul halaman 404
        throw new \CodeIgniter\Exceptions\PageNotFoundException();
    }
}
