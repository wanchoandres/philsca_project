<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramModel extends Model
{
    protected $table = 'tbl_program';
    protected $primaryKey = 'program_id';
    protected $allowedFields = ['department_id', 'department_name', 'program_code', 'program_name', 'date_created'];
}
