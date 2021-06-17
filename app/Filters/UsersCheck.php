<?php

namespace App\Filters;
//Fungsi Ini digunakan untuk perlindungan bagian dalam, jadi user tidak akan bisa mengakses halaman misal users/profile yang memiliki segment 2 sebelum login
// Jika lupa, coba hapus isi dari if dibawah, logout, lalu ketik di url users/profile, maka kau akan ingat fungsinya.

//Memanggil Fungsi Yang diperlukan
use Codeigniter\HTTP\RequestInterface;
use Codeigniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

//Membuat class UsersCheck yang mengimplementasikan FilterInterface, fci4
class UsersCheck implements FilterInterface
{
    public function before(RequestInterface $request)
    {
        // Mendapatkan url saat ini
        $uri = service('uri');

        //Jika segment 1 adalah users maka jalankan perintah ini
        if ($uri->getSegment(1) == 'users') {
            //Jika segment 2 adalah '' maka redirect ke halaman /
            if ($uri->getSegment(2) == '')
                $segment = '/';
            else
                $segment = '/' . $uri->getSegment(2);

            //Redirect ke variabel $segment
            return redirect()->to($segment);
        }


        //Jika segment 1 adalah about maka jalankan perintah ini
        if ($uri->getSegment(1) == 'about') {
            //Jika segment 2 adalah '' maka redirect ke halaman /
            if ($uri->getSegment(2) == '')
                $segment = '/';
            else
                $segment = '/';

            //Redirect ke variabel $segment
            return redirect()->to($segment);
        }


        //Jika segment 1 adalah admin maka jalankan perintah ini
        if ($uri->getSegment(1) == 'admin') {
            //Jika segment 2 adalah '' maka redirect ke halaman /
            if ($uri->getSegment(2) == '')
                $segment = '/';
            else
                $segment = '/' . $uri->getSegment(2);

            //Redirect ke variabel $segment
            return redirect()->to($segment);
        }


        //Jika segment 1 adalah login maka jalankan perintah ini
        if ($uri->getSegment(1) == 'login') {
            //Jika segment 2 adalah '' maka redirect ke halaman /
            if ($uri->getSegment(2) == '')
                $segment = '/';
            else
                $segment = '/' . $uri->getSegment(2);

            //Redirect ke variabel $segment
            return redirect()->to($segment);
        }


        //Jika segment 1 adalah chat maka jalankan perintah ini
        if ($uri->getSegment(1) == 'chat') {
            //Jika segment 2 adalah '' maka redirect ke halaman /
            if ($uri->getSegment(2) == '')
                $segment = '/';
            else
                $segment = '/' . $uri->getSegment(2);

            //Redirect ke variabel $segment
            return redirect()->to($segment);
        }


        //Jika segment 1 adalah notification maka jalankan perintah ini
        if ($uri->getSegment(1) == 'notification') {
            //Jika segment 2 adalah '' maka redirect ke halaman /
            if ($uri->getSegment(2) == '')
                $segment = '/';
            else
                $segment = '/' . $uri->getSegment(2);

            //Redirect ke variabel $segment
            return redirect()->to($segment);
        }
    }



    public function after(RequestInterface $request, ResponseInterface $response)
    {
    }
}
