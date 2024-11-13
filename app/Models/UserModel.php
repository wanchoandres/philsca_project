<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tbl_users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['user_code', 'full_name', 'email', 'username', 'password', 'department_id', 'program_id', 'profile_path', 'user_type', 'is_approve', 'date_created'];

    public function fetchUserList()
    {
        $UserList = $this->findAll();
        return $UserList;
    }
}
