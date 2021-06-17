<?php

namespace App\Models;

use CodeIgniter\Model;

//Membuat sebuah class bernama CommentModel yang extends dengan model
class ChattrueModel extends Model
{
    //Membuat property table, ini merujuk pada tabel yang akan digunakan pada model ini
    protected $table = 'chattrue';
    //Membuat property allowedFields, ini merujuk pada field2 mana yang dapat digunakan pada model ini
    protected $allowedFields = ['id_users-chattrue', 'id_friend-chattrue', 'id_last-chattrue', 'minichat', 'status_chattrue', 'last'];
    //Membuat property allowedFields, ini merujuk pada field di tabel yang merupakan primary key
    protected $primaryKey = 'id_chattrue';

    // Method untuk mengecek apakah di dalam tabel chattrue sudah ada data yang dimaksud
    public function checkChattrue($id_users, $id_friend)
    {
        // BACA: dimana id_users-chat bla bla bla
        $where = "id_users-chattrue = $id_users AND id_friend-chattrue = $id_friend OR id_users-chattrue = $id_friend AND id_friend-chattrue = $id_users";
        // Kembalikan semuanya
        return $this->where($where)->get()->getResultArray();
    }



    // Method getChattrueNotification untuk mencari jumlah notifikasi pada chat yang belum dibaca
    public function getChattrueNotification($id_users)
    {
        // Menentukan where
        $where = "id_users-chattrue = $id_users OR id_friend-chattrue = $id_users";
        // Kembalikan pada tabel ini dimana id_users-chattrue atau id_friend-cahttrue sama dengan session id_users
        return $this->where($where)->where('id_last-chattrue !=', $id_users)->having('status_chattrue', 0)->get()->getResultArray();
    }



    //Mendapatkan semua data users pada halaman Chat List
    public function getUsersChat($id_users)
    {
        // Baca: dimana bla bla bla
        $where = "id_users-chattrue = $id_users OR id_friend-chattrue = $id_users";
        // Kembalikan data yang diperlukan, join, lalu urutkan
        return $this->db->table('chattrue')
            ->where($where)->join('users', 'chattrue.id_friend-chattrue = users.id_users OR chattrue.id_users-chattrue = users.id_users')->having('id_users !=', $id_users)->orderBy('last', 'DESC')->get()->getResultArray();
    }
}
