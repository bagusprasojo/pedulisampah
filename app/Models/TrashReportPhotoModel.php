<?php

namespace App\Models;

use CodeIgniter\Model;

class TrashReportPhotoModel extends Model
{
    protected $table = 'trash_report_photos';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields = ['trash_report_id', 'photo_path'];

    // Validation rules, if needed
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
}
