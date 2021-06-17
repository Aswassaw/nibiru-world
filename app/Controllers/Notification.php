<?php

namespace App\Controllers;

//Memanggil semua model yang diperlukan
use App\Models\UserModel;
use App\Models\StatusModel;
use App\Models\CommentModel;
use App\Models\FriendreqModel;
use App\Models\ChattrueModel;
use App\Models\NotificationModel;

//Membuat class bernama Notification yang extends dengan BaseController
class Notification extends BaseController
{
    //Membuat property yang diperlukan
    protected $UserModel;
    protected $StatusModel;
    protected $CommentModel;
    protected $FriendreqModel;
    protected $NotificationModel;
    protected $ChattrueModel;
    protected $Waktu;


    // Fungsi construct
    public function __construct()
    {
        // Mendefinisikan setiap property sebagai fungsi yang sesuai
        $this->UserModel = new UserModel;
        $this->StatusModel = new StatusModel;
        $this->CommentModel = new CommentModel;
        $this->FriendreqModel = new FriendreqModel;
        $this->NotificationModel = new NotificationModel();
        $this->ChattrueModel = new ChattrueModel();
        $this->Waktu = date('l, d-m-yy, H:i:s');
        // helper form untuk fungsi set_value
        helper(['form']);
    }


    // Method index untuk laman notifikasi
    public function index()
    {
        // Mengembalikan data ke view
        $data['title'] = 'Hapus Akun';
        $data['user'] = $this->UserModel->find(session()->get('id_users'));
        $data['notification'] = $this->NotificationModel->getNotification();
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
        return view('notification/notification', $data);
    }



    // Method toNotification untuk pergi ke link yang dituju pada notification
    public function toNotification($id_notification)
    {
        // Mencari notifikasi yang dimaksud
        $notification = $this->NotificationModel->find($id_notification);

        // Jika notifikasi tersebut bukanlah miliknya
        if ($notification['id_users-notification'] != session()->get('id_users')) {
            // Munculkan halaman 404
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Menentukan notifikasi macam apa ini
        if ($notification['routes_notification'] == 'request-friend' or $notification['routes_notification'] == 'accept-friend') {
            // Dapatkan data users
            $users = $this->UserModel->find($notification['key_notification']);
            // membuat link
            $link = 'friendPage/' . $users['slug_users'];
        } elseif ($notification['routes_notification'] == 'new-status' or $notification['routes_notification'] == 'like-status' or $notification['routes_notification'] == 'new-comment' or $notification['routes_notification'] == 'like-comment' or $notification['routes_notification'] == 'new-reply' or $notification['routes_notification'] == 'like-reply') {
            // Dapatkan data status
            $status = $this->StatusModel->find($notification['key_notification']);
            // membuat link
            $link = 'comment/' . $status['slug_status'];
        } else {
            // Jika users secara gabut menulis di url, maka akan mncul halaman 404
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Jika notifikasi belum pernah di klik
        if ($notification['status_notification'] == 0) {
            // Mengupdate status notifikasi menjadi telah dibaca
            $data = [
                'id_notification' => $id_notification,
                'status_notification' => 1,
            ];
            $this->NotificationModel->save($data);
        }

        // Redirect ke link yang dituju
        return redirect()->to(base_url($link));
    }
}
