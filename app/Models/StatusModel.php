<?php

namespace App\Models;

use CodeIgniter\Model;

//Membuat sebuah class bernama PostModel yang extends dengan model
class StatusModel extends Model
{
    //Membuat property table, ini merujuk pada tabel yang akan digunakan pada model ini
    protected $table = 'status';
    //Membuat property allowedFields, ini merujuk pada field2 mana yang dapat digunakan pada model ini
    protected $allowedFields = ['id_users-status', 'slug_status', 'status', 'gambar_status', 'type', 'status-created_at'];
    //Membuat property allowedFields, ini merujuk pada field di tabel yang merupakan primary key
    protected $primaryKey = 'id_status';


    //Ini adalah fungsi mengambil semua data status yang akan ditampilkan di halaman home
    public function getDataStatus()
    {
        //Joinkan tabel status dan tabel users dengan hubungan yaitu id_users-status pada tabel status dan id pada tabel users, lalu kembalikan semua data yang ada
        return $this->join('users', 'status.id_users-status = users.id_users')->get()->getResultArray();
    }



    // Fungsi untuk mencari data status
    public function searchStatus($keyword)
    {
        // Kembalikan data dari tabel status yang mirip dengan keyword yang dimasukkan oleh user
        return $this->like(['status' => $keyword])->join('users', 'status.id_users-status = users.id_users')->get()->getResultArray();
    }



    //Ini adalah fungsi mengambil data status yang akan ditampilkan pada halaman profile sebagai semua status milik user
    public function statusUser()
    {
        //kembalikan semua data pada tabel statuses, dimana field id_users memiliki nilai yang sama dengan session(id)
        return $this->where(['id_users-status' => session()->get('id_users')])->get()->getResultArray();
    }



    //Ini adalah fungsi mengambil data status yang akan ditampilkan pada halaman friendPage
    public function statusFriend($id)
    {
        //Kembalikan semua data pada tabel status, dimana field id_users-status memiliki nilai yang sama dengan $id (parameter dari fungsi ini)
        return $this->where(['id_users-status' => $id])->get()->getResultArray();
    }



    //Ini adalah fungsi untuk mengambil data status yang akan tampil di halaman comment
    public function getStatusComment($id_status)
    {
        //Joinkan tabel status dan tabel users dengan hubungan yaitu id_users-status pada tabel status dan id pada tabel users, lalu kembalikan data dimana field id_status pada tabel status memiliki nilai yang sama dengan $id_status
        return $this->join('users', 'status.id_users-status = users.id_users')->where(['id_status' => $id_status])->get()->getResultArray();
    }



    //Ini adalah fungsi untuk menghapus status
    public function deleteStatus($id_status)
    {
        // Membuat data_hapus
        $data_hapus = [
            'status' => $this->db->table('status')->delete(['id_status' => $id_status]),
            'likestatus' => $this->db->table('likestatus')->delete(['id_status-likestatus' => $id_status]),
            'comment' => $this->db->table('comment')->delete(['id_status-comment' => $id_status]),
            'likecomment' => $this->db->table('likecomment')->delete(['id_status-likecomment' => $id_status]),
            'reply' => $this->db->table('reply')->delete(['id_status-reply' => $id_status]),
            'likereply' => $this->db->table('likereply')->delete(['id_status-likereply' => $id_status]),
        ];

        // Mengmabalikan penghapusan
        return $data_hapus;
    }
}
