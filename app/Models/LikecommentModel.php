<?php

namespace App\Models;

use CodeIgniter\Model;

//Membuat sebuah class bernama CommentModel yang extends dengan model
class LikecommentModel extends Model
{
    //Membuat property table, ini merujuk pada tabel yang akan digunakan pada model ini
    protected $table = 'likecomment';
    //Membuat property allowedFields, ini merujuk pada field2 mana yang dapat digunakan pada model ini
    protected $allowedFields = ['id_users-likecomment', 'id_status-likecomment','id_comment-likecomment', 'likecomment-created_at'];
    //Membuat property allowedFields, ini merujuk pada field di tabel yang merupakan primary key
    protected $primaryKey = 'id_likecomment';
}
