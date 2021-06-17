<?php

namespace App\Models;

use CodeIgniter\Model;

//Membuat sebuah class bernama ReplyModel yang extends dengan model
class ReplyModel extends Model
{
    //Membuat property table, ini merujuk pada tabel yang akan digunakan pada model ini
    protected $table = 'reply';
    //Membuat property allowedFields, ini merujuk pada field2 mana yang dapat digunakan pada model ini
    protected $allowedFields = ['id_users-reply', 'id_status-reply', 'id_comment-reply', 'reply', 'gambar_reply', 'reply-created_at'];
    //Membuat property allowedFields, ini merujuk pada field di tabel yang merupakan primary key
    protected $primaryKey = 'id_reply';


    //Mendapatkan data comment pada halaman comment
    public function getReply($id_status)
    {
        //Joinkan tabel reply dan tabel users dengan hubungan yaitu id_users-reply pada tabel comment dan id_users pada tabel users, lalu kembalikan data dimana field tersebut memilik $id_status
        return $this->db->table('reply')->join('users', 'reply.id_users-reply = users.id_users')->having('id_status-reply', $id_status)->get()->getResultArray();
    }



    //Menghapus reply
    public function deleteReply($id_reply)
    {
        // Membuat $data_hapus
        $data_hapus = [
            'reply' => $this->db->table('reply')->delete(['id_reply' => $id_reply]),
            'likereply' => $this->db->table('likereply')->delete(['id_reply-likereply' => $id_reply]),
        ];

        // Return untuk menjalankan
        return $data_hapus;
    }
}
