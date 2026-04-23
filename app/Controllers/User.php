<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Entities\User as UserEntity;

class User extends BaseController
{
    protected $db;
    protected $users;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->users = new UserModel();
    }

    // LIST USER
    public function index()
    {
        $users = $this->db->table('users u')
            ->select('u.id, u.username, ai.secret as email, gu.group')
            ->join('auth_identities ai', 'ai.user_id = u.id AND ai.type = "email_password"', 'left')
            ->join('auth_groups_users gu', 'gu.user_id = u.id', 'left')
            ->get()
            ->getResultArray();

        return view('admin/kelola_anggota/kelola_user', [
            'users' => $users
        ]);
    }

    public function delete($id)
{
    $this->users->delete($id, true);

    return redirect()->back()->with('success', 'User berhasil dihapus');
}
    public function edit($id)
    {
        $user = $this->db->table('users u')
            ->select('u.id, u.username, ai.secret as email, gu.group')
            ->join('auth_identities ai', 'ai.user_id = u.id AND ai.type = "email_password"', 'left')
            ->join('auth_groups_users gu', 'gu.user_id = u.id', 'left')
            ->where('u.id', $id)
            ->get()
            ->getRowArray();

        return view('admin/kelola_anggota/edit_user', [
            'user' => $user
        ]);
    }

    public function update($id)
    {
        $email = $this->request->getPost('email');
        $group = $this->request->getPost('group');

        $this->db->table('auth_identities')
            ->where('user_id', $id)
            ->where('type', 'email_password')
            ->update(['secret' => $email]);

        $this->db->table('auth_groups_users')
            ->where('user_id', $id)
            ->delete();

        $this->db->table('auth_groups_users')
            ->insert([
                'user_id' => $id,
                'group'   => $group
            ]);

        return redirect()->to('/user')->with('success', 'User berhasil diupdate');
    }

    public function create()
{
    return view('admin/kelola_anggota/tambah_user');
}

    public function store()
{
    $users = new UserModel();

    // ambil data dari form
    $username = $this->request->getPost('username');
    $email    = $this->request->getPost('email');
    $password = $this->request->getPost('password');
    $group    = $this->request->getPost('group');

    // buat entity user
    $user = new UserEntity([
        'username' => $username,
        'email'    => $email,
        'password' => $password, // otomatis di-hash oleh Shield
    ]);

    // simpan user
    $users->save($user);

    // ambil user yang baru dibuat
    $user = $users->findById($users->getInsertID());

    // masukin ke group (role)
    $user->addGroup($group);

    return redirect()->to('/user')->with('success', 'User berhasil ditambahkan');
}


}