<?php
// File: app/Controllers/TrashReports.php

namespace App\Controllers;

use App\Models\TrashReportModel;
use App\Models\TrashReportPhotoModel;
use App\Models\VisitorReportRecordModel;
use App\Models\CommentModel;
use CodeIgniter\Controller;

class TrashReportPagination extends BaseController
{
    public function index()
    {
        $model = new \App\Models\TrashReportModel();

        $data = [
            'users' => $model->paginate(3),
            'pager' => $model->pager,
        ];

        return view('trash_reports_pagination', $data);
    }
}

