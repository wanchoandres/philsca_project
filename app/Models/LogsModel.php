<?php

namespace App\Models;

use CodeIgniter\Model;

class LogsModel extends Model
{
    protected $table = 'tbl_logs';
    protected $primaryKey = 'log_id';
    protected $allowedFields = ['user_id', 'user_type', 'full_name', 'thesis_id', 'thesis_code', 'description', 'status', 'date_created'];
}
