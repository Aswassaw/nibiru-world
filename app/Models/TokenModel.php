<?php

// Mendefinisikan tempat file ini berada
namespace App\Models;
// Memanggil fungsi yang diperlukan
use CodeIgniter\Model;

//Membuat sebuah class bernama TokenModel yang extends dengan model
class TokenModel extends Model
{
    //Membuat property table, ini merujuk pada tabel yang akan digunakan pada model ini
    protected $table = 'token';
    //Membuat property allowedFields, ini merujuk pada field2 mana yang dapat digunakan pada model ini
    protected $allowedFields = ['email', 'token', 'token-created_at'];
    //Membuat property primaryKey, ini merujuk pada field di tabel yang merupakan primary key
    protected $primaryKey = 'id_token';
}
