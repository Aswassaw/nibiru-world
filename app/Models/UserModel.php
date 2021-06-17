<?php

// Mendefinisikan tempat file ini berada
namespace App\Models;
// Memanggil fungsi yang diperlukan
use CodeIgniter\Model;

//Membuat sebuah class bernama UserModel yang extends dengan model
class UserModel extends Model
{
    //Membuat property table, ini merujuk pada tabel yang akan digunakan pada model ini
    protected $table = 'users';
    //Membuat property allowedFields, ini merujuk pada field2 mana yang dapat digunakan pada model ini
    protected $allowedFields = ['username', 'firstname', 'lastname', 'slug_users', 'email', 'password', 'fotoprofil', 'description', 'users-created_at', 'users-updated_at', 'level', 'is_active'];
    //Membuat property allowedFields, ini merujuk pada field di tabel yang merupakan primary key
    protected $primaryKey = 'id_users';


    // Fungsi untuk mencari data user
    public function searchUser($keyword, $type = 'biasa')
    {
        // Jika pada huruf awal dari keyword terdapat karakter @
        if (substr($keyword, 0, 1) == '@') {
            // Karakter @ akan dihapus
            $keyword_final = substr($keyword, 1);
        } else {
            // Tidak ada perubahan
            $keyword_final = $keyword;
        }

        if ($type == 'paginate') {
            // Kembalikan data pada tabel username, firstname atau lastname yang mirip dengan keyword yang dimasukkan oleh user dengan syarat is_active adalah 1
            return $this->like(array('firstname' => $keyword_final))->orLike(array('lastname' => $keyword_final))->orLike(array('username' => $keyword_final));
        } else {
            // Kembalikan data pada tabel username, firstname atau lastname yang mirip dengan keyword yang dimasukkan oleh user dengan syarat is_active adalah 1
            return $this->like(array('firstname' => $keyword_final))->orLike(array('lastname' => $keyword_final))->orLike(array('username' => $keyword_final))->get()->getResultArray();
        }
    }



    // Fungsi untuk menghapus akun
    public function deleteAccount($id_friend = null)
    {
        // Jika yang menghapus akun adalah user itu sendiri
        if ($id_friend == null) {
            // Mencari id_users dari sesi
            $id_users = session()->get('id_users');
            // Menentukan spesifikasi tabel chat
            $where_chat = "id_users-chat = $id_users OR id_friend-chat = $id_users";
            // Menentukan spesifikasi tabel chattrue
            $where_chattrue = "id_users-chattrue = $id_users OR id_friend-chattrue = $id_users";
            // Menentukan spesifikasi tabel friendreq
            $where_friendreq = "id_users-friendreq = $id_users OR id_friend-friendreq = $id_users";
            // Menentukan spesifikasi tabel friendreq
            $where_friend = "id_users-friend = $id_users OR id_friend-friend = $id_users";

            // Untuk menghapus token jika ada
            $data_users = $this->find($id_users);

            // Membuat data_hapus
            $data_hapus = [
                'users' => $this->delete(['id_users' => session()->get('id_users')]),
                'status' => $this->db->table('status')->delete(['id_users-status' => session()->get('id_users')]),
                'likestatus' => $this->db->table('likestatus')->where(['id_users-likestatus' => session()->get('id_users')])->delete(),
                'comment' => $this->db->table('comment')->delete(['id_users-comment' => session()->get('id_users')]),
                'likecomment' => $this->db->table('likecomment')->where(['id_users-likecomment' => session()->get('id_users')])->delete(),
                'reply' => $this->db->table('reply')->delete(array('id_users-reply' => session()->get('id_users'))),
                'likereply' => $this->db->table('likereply')->where(['id_users-likereply' => session()->get('id_users')])->delete(),
                'chat' => $this->db->table('chat')->where($where_chat)->delete(),
                'chattrue' => $this->db->table('chattrue')->where($where_chattrue)->delete(),
                'friendreq' => $this->db->table('friendreq')->where($where_friendreq)->delete(),
                'friend' => $this->db->table('friend')->where($where_friend)->delete(),
                'token' => $this->db->table('token')->delete(['email' => $data_users['email']]),
            ];

            // Menjalankan array di atas
            return $data_hapus;
        }

        // Jika yang menghapus akun adalah admin
        elseif ($id_friend != null) {
            // Menentukan spesifikasi tabel chat
            $where_chat = "id_users-chat = $id_friend OR id_friend-chat = $id_friend";
            // Menentukan spesifikasi tabel chattrue
            $where_chattrue = "id_users-chattrue = $id_friend OR id_friend-chattrue = $id_friend";
            // Menentukan spesifikasi tabel friendreq
            $where_friendreq = "id_users-friendreq = $id_friend OR id_friend-friendreq = $id_friend";
            // Menentukan spesifikasi tabel friendreq
            $where_friend = "id_users-friend = $id_friend OR id_friend-friend = $id_friend";

            // Untuk menghapus token jika ada
            $data_friend = $this->find($id_friend);

            // Membuat data_hapus
            $data_hapus = [
                'users' => $this->delete(['id_users' => $id_friend]),
                'status' => $this->db->table('status')->delete(['id_users-status' => $id_friend]),
                'likestatus' => $this->db->table('likestatus')->delete(['id_users-likestatus' => $id_friend]),
                'comment' => $this->db->table('comment')->delete(['id_users-comment' => $id_friend]),
                'likecomment' => $this->db->table('likecomment')->delete(['id_users-likecomment' => $id_friend]),
                'reply' => $this->db->table('reply')->delete(['id_users-reply' => $id_friend]),
                'likereply' => $this->db->table('likereply')->delete(['id_users-likereply' => $id_friend]),
                'chat' => $this->db->table('chat')->where($where_chat)->delete(),
                'chattrue' => $this->db->table('chattrue')->where($where_chattrue)->delete(),
                'friendreq' => $this->db->table('friendreq')->where($where_friendreq)->delete(),
                'friend' => $this->db->table('friend')->where($where_friend)->delete(),
                'token' => $this->db->table('token')->delete(['email' => $data_friend['email']]),
            ];

            // Menjalankan array di atas
            return $data_hapus;
        }
    }
}
