<?php

namespace App\Controllers;

// Memanggil semua model yang diperlukan
use App\Models\UserModel;
use App\Models\FriendModel;
use App\Models\FriendreqModel;
use App\Models\ChatModel;
use App\Models\ChattrueModel;
use App\Models\NotificationModel;

// Membuat class bernama Chat yang extends dengan BaseController
class Chat extends BaseController
{
    // Membuat 3 Buah property untuk menampung setiap model di atas dan waktu
    protected $UserModel;
    protected $FriendModel;
    protected $FriendreqModel;
    protected $ChatModel;
    protected $ChattrueModel;
    protected $NotificationModel;
    protected $Waktu;


    // Method construct
    public function __construct()
    {
        // Mendefinisikan semuanya
        $this->UserModel = new UserModel;
        $this->FriendModel = new FriendModel;
        $this->FriendreqModel = new FriendreqModel;
        $this->ChatModel = new ChatModel();
        $this->ChattrueModel = new ChattrueModel();
        $this->NotificationModel = new NotificationModel();
        $this->Waktu = date('l, d-m-yy, H:i:s');
    }



    // Membuat method bernama index, ini adalah halaman Chat List
    public function index()
    {
        // Data dikembalikan ke view
        $data['title'] = 'Chat List';
        $data['user'] = $this->UserModel->find(session()->get('id_users'));
        $data['friend'] = $this->ChattrueModel->getUsersChat(session()->get('id_users'));
        $data['friend_list'] = $this->FriendModel->getAllFriend(session()->get('id_users'));
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
        return view('chat/chat_list', $data);
    }



    //Membuat method bernama chatPage, ini adalah halaman Chat Page
    public function chatPage($slug_users)
    {
        // Mengambil data user
        $data_user = $this->UserModel->where(['slug_users' => $slug_users])->first();
        // Jika data user tidak ada maka pindah ke home
        if ($data_user == null) {
            // Jika akun tidak ada maka akan muncul halaman 404
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        //Jika sesi milik  user yang akan diajak chat sama dengan id dari pemilik profil, maka jalankan perintah ini
        if ($data_user['id_users'] == session()->get('id_users')) {
            //Redirect ke halaman users::profile
            return redirect()->to(base_url('profile'));
        }

        // Mencari id_users
        $id_users = session()->get('id_users');
        // Mencari id_friend
        $id_friend = $data_user['id_users'];

        //Jika terdapat sebuah request dengan method POST pada form chat maka jalankan perintah ini
        if ($this->request->getMethod() == 'post') {
            //Fungsi validasi, ini digunakan untuk membatasi apa-apa saja yang boleh dituliskan oleh user
            $rules = [
                // Validasi untuk status
                'chat' => [
                    'label' => 'Pesan',
                    'rules' => 'required|max_length[2500]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'max_length' => '{field} terlalu panjang, batas karakter hanya 2500',
                    ]
                ],
            ];

            //Jika terdapat kesalahan saat validasi, jalankan perintah ini
            if (!$this->validate($rules)) {
                session()->setFlashdata('danger', 'Gagal menambahkan pesan, pastikan pesan yang anda masukkan benar.');
                $data['validation'] = $this->validator;
            }

            //Jika tidak terdapat kesalahan saat validasi, jalankan perintah ini
            else {
                //Membuat Array baru yang akan dimasukkan ke database pesan status baru
                $data = [
                    // id dari pembuat pesan
                    'id_users-chat' => session()->get('id_users'),
                    // id dari pengirim pesan
                    'id_friend-chat' => $id_friend,
                    // data pesan
                    'chat' => nl2br(htmlspecialchars($this->request->getVar('chat'))),
                    // tanggal pesan dibuat
                    'chat-created_at' => $this->Waktu,
                ];

                // Variabel $sudah berisi pencarian di tabel Chattrue, ini adalah tahap awal agar user yang tanmpil di halaman ChatList adalah user yang sudah pernah diajak chat sebelumnya
                $sudah = $this->ChattrueModel->checkChattrue(session()->get('id_users'), $id_friend);

                // JIka $sudah berisi null/hasil pencarian berisi tidak ditemukannya data
                if ($sudah == null) {
                    // Menyiapkan data unruk masuk ke halaman chattrue
                    $datatrue = [
                        // Id users
                        'id_users-chattrue' => session()->get('id_users'),
                        // Id friend
                        'id_friend-chattrue' => $id_friend,
                        // Id users yang terakhir kali chat
                        'id_last-chattrue' => session()->get('id_users'),
                        // Minichat yang akan tampil di halaman chatlist
                        'minichat' => nl2br(htmlspecialchars($this->request->getVar('chat'))),
                        // Tanggal dibuat dan diupdate untuk mengurutkan ketikaada di halaman ChatList
                        'last' => time(),
                    ];
                    // Save data
                    $this->ChattrueModel->save($datatrue);
                } else {
                    // Mendefinisikan where dalam variabel, bacanya: dimana id_users-chattrue sama dengan $id DAN id_friend-chattrue sama dengan $id_friend ATAU id_users-chattrue sama dengan $id_friend DAN id_friend-chattrue = $id
                    $where = "id_users-chattrue = $id_users AND id_friend-chattrue = $id_friend OR id_users-chattrue = $id_friend AND id_friend-chattrue = $id_users";
                    // Pilih Row id_chattrue berdasarkan $where di atas
                    $code = $this->ChattrueModel->select('id_chattrue')->where($where)->get()->getRowArray();
                    // Data untuk update
                    $datatrue = [
                        // Menentukan Id_chattrue
                        'id_chattrue' => $code,
                        // Id users yang terakhir kali chat
                        'id_last-chattrue' => session()->get('id_users'),
                        // Update minichat
                        'minichat' => nl2br(htmlspecialchars($this->request->getVar('chat'))),
                        // Update status
                        'status_chattrue' => 0,
                        // Update last
                        'last' => time(),
                    ];
                    // update data chattrue
                    $this->ChattrueModel->save($datatrue);
                }

                //Memanggil fungsi save dari ChatModel yang diberikan paramater array $data
                $this->ChatModel->save($data);
                // Redirect
                return redirect()->to(base_url('chatPage/' . $data_user['slug_users']));
            }
        }

        // Menentukan apakah kedua user ini sudah pernah chat sebelumnya
        $sudah = $this->ChattrueModel->checkChattrue(session()->get('id_users'), $id_friend);

        // Jika sudah pernah
        if ($sudah) {
            // Jika pengirim pesan terakhir bukanlah user
            if ($sudah[0]['id_last-chattrue'] != session()->get('id_users')) {
                // Mendefinisikan where dalam variabel, bacanya: dimana id_users-chattrue sama dengan $id DAN id_friend-chattrue sama dengan $id_friend ATAU id_users-chattrue sama dengan $id_friend DAN id_friend-chattrue = $id
                $where = "id_users-chattrue = $id_users AND id_friend-chattrue = $id_friend OR id_users-chattrue = $id_friend AND id_friend-chattrue = $id_users";
                // Pilih Row id_chattrue berdasarkan $where di atas
                $code = $this->ChattrueModel->select('id_chattrue')->where($where)->get()->getRowArray();
                // Data untuk update
                $datatrue = [
                    // Menentukan Id_chattrue
                    'id_chattrue' => $code,
                    // Update status
                    'status_chattrue' => 1,
                ];
                // update data chattrue
                $this->ChattrueModel->save($datatrue);
            }
        }

        // Data yang akan dikembalikan ke view
        $data['title'] = 'Chat';
        $data['user'] = $this->UserModel->find(session()->get('id_users'));
        $data['friend'] = $this->UserModel->find($id_friend);
        $data['chat'] = $this->ChatModel->getDataChat(session()->get('id_users'), $id_friend);
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
        return view('chat/chat_page', $data);
    }



    //Membuat method bernama index, ini adalah halaman Home
    public function chatPageAll($slug_users)
    {
        // Mengambil data user
        $data_user = $this->UserModel->where(['slug_users' => $slug_users])->first();
        // Jika data user tidak ada maka pindah ke home
        if ($data_user == null) {
            // Jika akun tidak ada maka akan muncul halaman 404
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        //Jika sesi milik  user yang akan diajak chat sama dengan id dari pemilik profil, maka jalankan perintah ini
        if ($data_user['id_users'] == session()->get('id_users')) {
            //Redirect ke halaman users::profile
            return redirect()->to(base_url('profile'));
        }

        $data['title'] = 'Chat';
        $data['user'] = $this->UserModel->where('id_users', session()->get('id_users'))->first();
        $data['friend'] = $this->UserModel->where('id_users', $data_user['id_users'])->first();
        $data['chat'] = $this->ChatModel->getDataChatAll(session()->get('id_users'), $data_user['id_users']);
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
        return view('chat/chat_page', $data);
    }
}
