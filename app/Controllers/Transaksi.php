<?php

namespace App\Controllers;

class Transaksi extends BaseController
{
    public function index(): string
    {
        $db = \Config\Database::connect();

        $transaksi = $db->table('transaksi')
            ->select('
                transaksi.id,
                users.username as nama_siswa,
                buku.judul,
                kategori.nama_kategori,
                transaksi.tanggal_pinjam,
                transaksi.status
            ')
            ->join('users', 'users.id = transaksi.user_id')
            ->join('buku', 'buku.id = transaksi.buku_id')
            ->join('kategori', 'kategori.id = buku.kategori_id')
            ->get()
            ->getResultArray();

        return view('admin/transaksi/transaksi', [
            'transaksi' => $transaksi
        ]);
    }
}