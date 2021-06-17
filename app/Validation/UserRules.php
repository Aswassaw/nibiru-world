<?php

namespace App\Validation;

use App\Models\UserModel;

//Membuat sebuah class bernama UserRules
class UserRules
{
    //Membuat sebuah method untuk memvalidasi user yang login
    public function validateUser(string $str, string $fields, array $data)
    {
        //Mendefinisikan variabel $model sebagai UserModel
        $model = new UserModel();
        // Menambah @ pada username
        $username = $data['username'];
        //Mencari username yang ditulis user dengan yang ada di database
        $user = $model->where('username', $username)->first();

        //Jika tidak ditemukan, maka akan mengembalikan nilai false
        if (!$user) {
            return false;
        }

        //Mencocokkan password dari user dengan password yang ada di database
        return password_verify($data['password'], $user['password']);
    }
}
