<?php

namespace App\Models;

use CodeIgniter\Model;

//Membuat sebuah class bernama CommentModel yang extends dengan model
class ChatModel extends Model
{
    //Membuat property table, ini merujuk pada tabel yang akan digunakan pada model ini
    protected $table = 'chat';
    //Membuat property allowedFields, ini merujuk pada field2 mana yang dapat digunakan pada model ini
    protected $allowedFields = ['id_users-chat', 'id_friend-chat', 'chat', 'chat-created_at'];
    //Membuat property allowedFields, ini merujuk pada field di tabel yang merupakan primary key
    protected $primaryKey = 'id_chat';


    // Mengambil data chat limit 4
    public function getDataChat($id_users, $id_friend)
    {
        $where = "id_users-chat = $id_users AND id_friend-chat = $id_friend OR id_users-chat = $id_friend AND id_friend-chat = $id_users";
        return $this->where($where)->orderBy('id_chat', 'DESC')->limit(4)->get()->getResultArray();
    }



    // Mengambil semua data chat tanpa limit
    public function getDataChatAll($id_users, $id_friend)
    {
        // Baca: dimana id_users-chat memiliki nilai yang sama dengan $id DAN id_friend-chat sama dengan $id_friend ATAU penanda samanya dibalik
        $where = "id_users-chat = $id_users AND id_friend-chat = $id_friend OR id_users-chat = $id_friend AND id_friend-chat = $id_users";
        // Kembalikan semua data sesuai dnegan where diurutkan dari id_chat secara DESC
        return $this->where($where)->orderBy('id_chat', 'DESC')->get()->getResultArray();
    }
}
