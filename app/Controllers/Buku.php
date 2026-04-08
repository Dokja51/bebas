<?php

namespace App\Controllers;

class Buku extends BaseController
{
    public function index(): string
    {
        $bukuModel = new \App\Models\Buku();
        $data['buku'] = $bukuModel->getBukuWithKategori();
        return view('admin/kelola_buku', $data);
    }

}
