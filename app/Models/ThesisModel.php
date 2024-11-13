<?php

namespace App\Models;

use CodeIgniter\Model;

class ThesisModel extends Model
{
    protected $table = 'tbl_thesis';
    protected $primaryKey = 'thesis_id';
    protected $allowedFields = ['thesis_code', 'department_id', 'program_id', 'agenda_id', 'thesis_id', 'thesis_title', 'members', 'thesis_date', 'file_path', 'uploaded_by','reject_remark', 'is_approve', 'is_archive', 'date_submitted'];
}
