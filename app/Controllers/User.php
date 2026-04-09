<?php

namespace App\Controllers;

class User extends BaseController
{
   public function index()
{
    $db = \Config\Database::connect();

$users = $db->table('users u')
    ->select('u.id, ai.secret as email, gu.group')
    ->join('auth_identities ai', 'ai.user_id = u.id AND ai.type = "email_password"', 'left')
    ->join('auth_groups_users gu', 'gu.user_id = u.id', 'left')
    ->get()
    ->getResultArray();

return view('admin/kelola_anggota/kelola_user', [
    'users' => $users
]);
}

}
