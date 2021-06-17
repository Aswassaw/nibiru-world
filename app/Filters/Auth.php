<?php

namespace App\Filters;
//Fungsi Ini digunakan untuk autentikasi ketika user belum login, user yg sudah login tidak akan bisa mengakses laman home atau profile

//Memanggil Fungsi Yang diperlukan
use Codeigniter\HTTP\RequestInterface;
use Codeigniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

//Membuat class Auth yang mengimplementasikan FilterInterface, fci4
class Auth implements FilterInterface
{
    public function before(RequestInterface $request)
    {
        //Jika tidak terdapat sebuah sesi dengan nama isLoggedIn, maka user akan dipaksa redirect ke / atau login page
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response)
    { }
}
