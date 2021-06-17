<?php

namespace App\Models;

use CodeIgniter\Model;

//Membuat sebuah class bernama CommentModel yang extends dengan model
class NotificationModel extends Model
{
    //Membuat property table, ini merujuk pada tabel yang akan digunakan pada model ini
    protected $table = 'notification';
    //Membuat property allowedFields, ini merujuk pada field2 mana yang dapat digunakan pada model ini
    protected $allowedFields = ['id_users-notification', 'notification', 'routes_notification', 'key_notification', 'status_notification', 'notification-created_at'];
    //Membuat property allowedFields, ini merujuk pada field di tabel yang merupakan primary key
    protected $primaryKey = 'id_notification';


    // Fungsi untuk mengambil notifikasi yang akan muncul di halaman notifikasi
    public function getNotification()
    {
        //kembalikan semua data pada tabel notifikasi, dimana field id_users-notification memiliki nilai yang sama dengan session(id)
        return $this->where(['id_users-notification' => session()->get('id_users')])->orderBy('id_notification', 'DESC')->get()->getResultArray();
    }
}
