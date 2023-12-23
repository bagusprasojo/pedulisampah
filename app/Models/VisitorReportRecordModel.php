<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitorReportRecordModel extends Model
{
    protected $table = 'visitor_report_records'; // Ganti dengan nama tabel yang sesuai
    protected $primaryKey = 'id'; // Ganti dengan nama primary key yang sesuai
    protected $allowedFields = ['visitor_id', 'report_id']; // Field yang diizinkan untuk diisi
    protected $useAutoIncrement = true;

    // Atur timestamp jika diperlukan
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
