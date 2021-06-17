<?php

// Mendefinisikan tempat file ini berada
namespace App\Models;
// Memanggil fungsi yang diperlukan
use CodeIgniter\Model;

//Membuat sebuah class bernama FriendModel yang extends dengan model
class FriendModel extends Model
{
    //Membuat property table, ini merujuk pada tabel yang akan digunakan pada model ini
    protected $table = 'friend';
    //Membuat property allowedFields, ini merujuk pada field2 mana yang dapat digunakan pada model ini
    protected $allowedFields = ['id_users-friend', 'id_friend-friend', 'friendreq-created_at'];
    //Membuat property allowedFields, ini merujuk pada field di tabel yang merupakan primary key
    protected $primaryKey = 'id_friend';


    // Mengambil 5 daftar teman
    public function demoFriend($id_users)
    {
        $where = "id_users-friend = $id_users";
        return $this->where($where)->orderBy('id_friend', 'DESC')->limit(4)->join('users', 'friend.id_friend-friend = users.id_users')->get()->getResultArray();
    }



    // Mengambil semua daftar teman
    public function getAllFriend($id_users)
    {
        $where = "id_users-friend = $id_users";
        return $this->where($where)->orderBy('id_friend', 'DESC')->join('users', 'friend.id_friend-friend = users.id_users')->get()->getResultArray();
    }



    // Fungsi untuk mencari data teman
    public function searchFriend($keyword, $id_users)
    {
        // Jika pada huruf awal dari keyword terdapat karakter @u
        if (substr($keyword, 0, 1) == '@') {
            // Karakter @ akan dihapus
            $keyword_final = substr($keyword, 1);
        } else {
            // Tidak ada perubahan
            $keyword_final = $keyword;
        }

        return $this->db->table('users')->like(array('firstname' => $keyword_final))->orLike(array('lastname' => $keyword_final))->orLike(array('username' => $keyword_final))->join('friend', 'users.id_users = friend.id_friend-friend')->having('id_users-friend', $id_users)->orderBy('id_friend', 'DESC')->get()->getResultArray();
    }
}
