<?php

namespace App\Models;

use CodeIgniter\Model;

//Membuat sebuah class bernama CommentModel yang extends dengan model
class CommentModel extends Model
{
    //Membuat property table, ini merujuk pada tabel yang akan digunakan pada model ini
    protected $table = 'comment';
    //Membuat property allowedFields, ini merujuk pada field2 mana yang dapat digunakan pada model ini
    protected $allowedFields = ['id_status-comment', 'id_users-comment', 'comment', 'gambar_comment', 'comment-created_at'];
    //Membuat property allowedFields, ini merujuk pada field di tabel yang merupakan primary key
    protected $primaryKey = 'id_comment';


    //Mendapatkan data comment pada halaman comment
    public function getComment($id_status)
    {
        //Joinkan tabel comment dan tabel users dengan hubungan yaitu id_users-comment pada tabel comment dan id pada tabel users, lalu kembalikan data dimana field id_status-comment pada tabel comment memiliki nilai yang sama dengan $id_status
        return $this->db->table('comment')
            ->join('users', 'comment.id_users-comment = users.id_users')
            ->where(['id_status-comment' => $id_status])
            ->get()->getResultArray();
    }



    //Menghapus comment
    public function deleteComment($id_comment)
    {
        // Membuat $data_hapus
        $data_hapus = [
            'comment' => $this->db->table('comment')->delete(array('id_comment' => $id_comment)),
            'likecomment' => $this->db->table('likecomment')->delete(['id_comment-likecomment' => $id_comment]),
            'reply' => $this->db->table('reply')->delete(['id_comment-reply' => $id_comment]),
            'likereply' => $this->db->table('likereply')->delete(['id_comment-likereply' => $id_comment]),
        ];

        // Return untuk menjalankan
        return $data_hapus;
    }
}
