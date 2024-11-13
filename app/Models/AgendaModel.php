<?php

namespace App\Models;

use CodeIgniter\Model;

class AgendaModel extends Model
{
    protected $table = 'tbl_agenda';
    protected $primaryKey = 'agenda_id';
    protected $allowedFields = ['agenda_code', 'program_id', 'program_code', 'agenda_name', 'date_created'];
}
