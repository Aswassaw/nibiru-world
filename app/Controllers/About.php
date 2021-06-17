<?php

namespace App\Controllers;

//Memanggil semua model yang diperlukan
use App\Models\UserModel;
use App\Models\FriendreqModel;
use App\Models\ChattrueModel;
use App\Models\NotificationModel;

//Membuat class bernama Users yang extends dengan BaseController
class About extends BaseController
{
    //Membuat property
    protected $UserModel;
    protected $FriendreqModel;
    protected $ChattrueModel;
    protected $NotificationModel;


    // Method construct
    public function __construct()
    {
        // Mendefinisikan setiap property sebagai model yang dimaksud
        $this->UserModel = new UserModel;
        $this->FriendreqModel = new FriendreqModel;
        $this->ChattrueModel = new ChattrueModel;
        $this->NotificationModel = new NotificationModel();
    }



    // Membuat method bernama index
    public function index()
    {
        // Membuat sebuah array bernama $data untuk ke view
        $data['title'] = 'About';
        $data['user'] = $this->UserModel->where('id_users', session()->get('id_users'))->first();
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
        return view('about/abouts', $data);
    }
}
