<?php

// Mendefinisikan tempat file ini berada
namespace App\Models;
// Memanggil fungsi yang diperlukan
use CodeIgniter\Model;

//Membuat sebuah class bernama FriendModel yang extends dengan model
class FriendreqModel extends Model
{
    //Membuat property table, ini merujuk pada tabel yang akan digunakan pada model ini
    protected $table = 'friendreq';
    //Membuat property allowedFields, ini merujuk pada field2 mana yang dapat digunakan pada model ini
    protected $allowedFields = ['id_users-friendreq', 'id_friend-friendreq', 'friendreq-created_at', 'status'];
    //Membuat property allowedFields, ini merujuk pada field di tabel yang merupakan primary key
    protected $primaryKey = 'id_friendreq';

    // Ini adalah fungsi untuk mendapatkan request permintaan pertemanan
    public function requestFriend($id_users, $id_friend = null)
    {
        // Digunakan di halaman friend
        if ($id_friend == null) {
            $where = "id_friend-friendreq = $id_users AND status = 0";
            return $this->where($where)->join('users', 'friendreq.id_users-friendreq = users.id_users')->get()->getResultArray();
        }
        
        // Muncul di halaman friendPage untuk mengatur button
        else {
            $where = "id_users-friendreq = $id_users AND id_friend-friendreq = $id_friend OR id_users-friendreq = $id_friend AND id_friend-friendreq = $id_users";
            return $this->where($where)->get()->getResultArray();
        }
    }
}
