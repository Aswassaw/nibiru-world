<?php

namespace App\Models;

use CodeIgniter\Model;

//Membuat sebuah class bernama LikereplyModel yang extends dengan model
class LikereplyModel extends Model
{
    //Membuat property table, ini merujuk pada tabel yang akan digunakan pada model ini
    protected $table = 'likereply';
    //Membuat property allowedFields, ini merujuk pada field2 mana yang dapat digunakan pada model ini
    protected $allowedFields = ['id_users-likereply', 'id_status-likereply', 'id_comment-likereply', 'id_reply-likereply', 'likereply-created_at'];
    //Membuat property allowedFields, ini merujuk pada field di tabel yang merupakan primary key
    protected $primaryKey = 'id_likereply';
}
