<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Penerbit as PenerbitModel;

class Penerbit extends BaseController
{
    protected $penerbitModel;

    public function __construct()
    {
        $this->penerbitModel = new PenerbitModel(); // FIX DI SINI
    }

    public function index()
    {
        return view('admin/penerbit/kelola_penerbit', [
            'penerbit' => $this->penerbitModel->findAll()
        ]);
    }

    public function create()
    {
        return view('admin/penerbit/create_penerbit');
    }

    public function store()
    {
        $nama   = $this->request->getPost('nama_penerbit');

        if (!$nama) {
            return redirect()->back()->with('error', 'Nama penerbit wajib diisi');
        }

        $this->penerbitModel->save([
            'nama_penerbit' => $nama,
            'alamat'        => $alamat,
            'telepon'       => $telp,
        ]);

        return redirect()->to('/kelola_penerbit')
            ->with('success', 'Penerbit berhasil ditambahkan');
    }

    public function edit($id)
    {
        return view('admin/penerbit/edit_penerbit', [
            'penerbit' => $this->penerbitModel->find($id)
        ]);
    }

    public function update($id)
    {
        $this->penerbitModel->update($id, [
            'nama_penerbit' => $this->request->getPost('nama_penerbit'),
            'alamat'        => $this->request->getPost('alamat'),
            'telepon'       => $this->request->getPost('telepon'),
        ]);

        return redirect()->to('/kelola_penerbit')
            ->with('success', 'Penerbit berhasil diupdate');
    }

    public function delete($id)
    {
        $this->penerbitModel->delete($id);

        return redirect()->to('/kelola_penerbit')
            ->with('success', 'Penerbit berhasil dihapus');
    }
}