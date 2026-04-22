<?php

namespace App\Controllers;

class User extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    // ✅ TAMPILKAN DATA
    public function index()
    {
        $users = $this->db->table('users u')
            ->select('u.id, ai.secret as email, gu.group')
            ->join('auth_identities ai', 'ai.user_id = u.id AND ai.type = "email_password"', 'left')
            ->join('auth_groups_users gu', 'gu.user_id = u.id', 'left')
            ->get()
            ->getResultArray();

        return view('admin/kelola_anggota/kelola_user', [
            'users' => $users
        ]);
    }

    // ✅ HAPUS USER
    public function delete()
{
    $id = $this->request->getPost('id');

    // DEBUG dulu
    // dd($id);

    // Hapus relasi (semua role user ini)
    $this->db->table('auth_groups_users')
        ->where('user_id', $id)
        ->delete();

    $this->db->table('auth_identities')
        ->where('user_id', $id)
        ->delete();

    $this->db->table('users')
        ->where('id', $id)
        ->delete();

    return redirect()->back()->with('success', 'User berhasil dihapus');
}

    // ✅ FORM EDIT
    public function edit($id)
    {
        $user = $this->db->table('users u')
            ->select('u.id, ai.secret as email, gu.group')
            ->join('auth_identities ai', 'ai.user_id = u.id AND ai.type = "email_password"', 'left')
            ->join('auth_groups_users gu', 'gu.user_id = u.id', 'left')
            ->where('u.id', $id)
            ->get()
            ->getRowArray();

        return view('admin/kelola_anggota/edit_user', [
            'user' => $user
        ]);
    }

    // ✅ UPDATE USER
    public function update($id)
    {
        $email = $this->request->getPost('email');
        $group = $this->request->getPost('group');

        // Update email
        $this->db->table('auth_identities')
            ->where('user_id', $id)
            ->update(['secret' => $email]);

        // Update role/group
        $this->db->table('auth_groups_users')
            ->where('user_id', $id)
            ->update(['group' => $group]);

        return redirect()->to('/user')->with('success', 'User berhasil diupdate');
    }
}