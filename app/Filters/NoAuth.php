<?php

namespace App\Filters;
//Fungsi Ini digunakan untuk autentikasi ketika user sudah login, user yg sudah login tidak akan bisa mengakses laman login ataupun register

//Memanggil Fungsi Yang diperlukan
use Codeigniter\HTTP\RequestInterface;
use Codeigniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

//Membuat class Noauth yang mengimplementasikan FilterInterface, fci4
class NoAuth implements FilterInterface
{
    public function before(RequestInterface $request)
    {
        //Jika terdapat sebuah sesi dengan nama isLoggedIn, maka user akan dipaksa redirect ke home
        if (session()->get('isLoggedIn')) {
            return redirect()->to('home');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response)
    { }
}
