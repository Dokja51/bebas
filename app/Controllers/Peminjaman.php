<?php

namespace App\Controllers;

class Peminjaman extends BaseController
{
    public function index()
{
    $peminjamanModel = new \App\Models\Peminjaman();
    $user = auth()->user(); // ambil user login

    // Ambil semua peminjaman user, join dengan tabel buku & kategori
    $data['peminjaman'] = $peminjamanModel
    ->select('transaksi.*, buku.judul, buku.penulis, buku.penerbit, buku.tahun_terbit, kategori.nama_kategori')
    ->join('buku', 'buku.id = transaksi.buku_id')
    ->join('kategori', 'kategori.id = buku.kategori_id')
    ->where('transaksi.user_id', $user->id)
    ->orderBy('transaksi.tanggal_pinjam', 'DESC')
    ->findAll();

    return view('user/daftar_peminjaman', $data);
}

    public function create()
    {
        $bukuModel = new \App\Models\Buku();
        $data['buku'] = $bukuModel->findAll();
        return view('admin/peminjaman/create_peminjaman', $data);
    }

    public function store()
{
    $peminjamanModel = new \App\Models\Peminjaman();

    $user = auth()->user(); // Ambil user yang login

    $peminjamanModel->save([
        'user_id'        => $user->id, // ID dari user login
        'buku_id'        => $this->request->getPost('buku_id'),
        'tanggal_pinjam' => date('Y-m-d'),
        'status'         => 'dipinjam'
    ]);

    return redirect()->to('/daftar_peminjaman')->with('success', 'Buku berhasil dipinjam');
}

    public function kembalikan()
{
    $transaksi_id = $this->request->getPost('transaksi_id');  // ambil transaksi_id
    $peminjamanModel = new \App\Models\Peminjaman();

    $peminjaman = $peminjamanModel->find($transaksi_id); // cari transaksi

    if (!$peminjaman) {
        return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
    }

    $peminjamanModel->update($transaksi_id, [
        'tanggal_kembali' => date('Y-m-d'),
        'status' => 'dikembalikan'
    ]);

    return redirect()->back()->with('success', 'Buku berhasil dikembalikan.');
}
}