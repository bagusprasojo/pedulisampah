<?php
// File: app/Controllers/TrashReports.php

namespace App\Controllers;

use App\Models\TrashReportModel;
use App\Models\TrashReportPhotoModel;
use App\Models\VisitorReportRecordModel;
use App\Models\CommentModel;
use CodeIgniter\Controller;
use Config\App;

class TrashReports extends Controller
{    
    // private $VisitorReportRecordModel;
    public function __construct()
    {
        helper('auth'); // Panggil helper 'auth' yang telah Anda buat
        // $VisitorReportRecordModel = new VisitorReportRecordModel();
    }
    
    public function index()
    {
        // Load model untuk mengakses data laporan
        $reportModel = new TrashReportModel();
        $commentModel = new CommentModel();

        $nilai_search = '';
        if (isset($_GET['search'])) {
            $nilai_search = esc($_GET['search']);
        }
        
        if ($nilai_search == ''){
            $latestReports = $reportModel->select('trashreports.*,left(description,250) as desc250, users.username, users.name')
            ->join('users', 'users.id = trashreports.user_id')
            ->orderBy('trashreports.created_at', 'DESC')
            ->paginate(6);
        } else {
            $latestReports = $reportModel->select('trashreports.*,left(description,250) as desc250, users.username, users.name')
            ->join('users', 'users.id = trashreports.user_id')
            ->where("trashreports.description like '%" . $nilai_search . "%'")
            ->orwhere("trashreports.title like '%" . $nilai_search . "%'")
            ->orderBy('trashreports.created_at', 'DESC')
            ->paginate(6);

        }

        foreach ($latestReports as &$report) {
            $commentCount = $commentModel->where('trash_report_id', $report['id'])->countAllResults();
            $report['comment_count'] = $commentCount;
        }

        $pager = $reportModel->pager;

        // Kirim data ke view
        return view('trash_reports', ['latestReports' => $latestReports, 'pager' => $pager]);
    }

    public function tambahLaporan()
    {
        $session = session();
        if (!is_logged_in()) {
            $session->set('previous_url', current_url());
            return redirect()->to(site_url('login'))->with('error', 'Anda harus login untuk membuat laporan');
        }

        if ($this->request->getMethod() === 'get') {
            return view('tambah_laporan');
        }
        
        
        $photoPaths = []; // Simpan paths foto-foto yang diupload
        $files = $this->request->getFiles();
        $nama_photo_depan = '';
        $is_photo_valid = false;
        foreach ($files['photos'] as $photo) {
            if ($photo->isValid() && !$photo->hasMoved()) {
                $is_photo_valid = true;
                $newName = $photo->getRandomName();
                $photo->move(ROOTPATH . 'public/uploads', $newName);
                $photoPaths[] = $newName;

                if ($nama_photo_depan == ''){
                    $nama_photo_depan = $newName;
                }
            }
        }

        if (!$is_photo_valid) {
            $error_files = [
                'Image' => 'File image masih kosong',
            ];
            session()->setFlashdata('errors', $error_files);  
            session()->setFlashdata('old', $this->request->getPost());          
            return redirect()->back()->withInput()->with('errors', $error_files);
        }

        

        // Dapatkan data yang dikirim dari form tambah laporan
        $data = [
            'user_id' => $session->get('user_id'),
            'location' => esc($this->request->getPost('location')),
            'title' => esc($this->request->getPost('title')),
            // 'desc_preview' => esc(substr($this->request->getPost('description'),250)),
            'description' => $this->request->getPost('description'),
            'photo' => $nama_photo_depan,
            // ... dan seterusnya, sesuai dengan struktur data laporan Anda
        ];


        // Lakukan validasi data
        $validation = \Config\Services::validation();
        $reportModel = new TrashReportModel();

        if ($this->validate($reportModel->validationRules, $reportModel->validationMessages)) {
                
            $reportModel->save($data);
            $reportId = $reportModel->getInsertID();
        
            // Simpan foto-foto terkait laporan
            foreach ($photoPaths as $path) {
                $reportModel->addPhoto($reportId, $path);
            }
            return redirect()->to(site_url('trash-reports'))->with('success', 'Laporan berhasil ditambahkan');
        } else {
            session()->setFlashdata('errors', $validation->getErrors());  
            session()->setFlashdata('old', $this->request->getPost());          
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
    }

    public function fullTrashReport($slug)
    {
        $reportModel = new TrashReportModel();
        $commentModel = new CommentModel();
        $photoModel = new TrashReportPhotoModel();

        $report = $reportModel
            ->select('trashreports.*, users.username, users.name')
            ->join('users', 'users.id = trashreports.user_id')
            ->where('slug', $slug)->first();

        $reportId = $report['id'];

        // var_dump($report);
        // die();
        $commentCount = $commentModel->where('trash_report_id', $reportId)->countAllResults();

        // Mendapatkan ID pengguna atau identifikasi unik pengunjung (gunakan session atau cookies)
        $visitorId = session()->get('visitor_id'); // Contoh menggunakan session, sesuaikan dengan kebutuhan

        // Cek apakah pengunjung sudah melihat laporan ini sebelumnya
        if (!$this->hasVisitedReport($visitorId, $reportId)) {
            // Jika belum, tambahkan jumlah klik pada laporan
            $this->incrementClickCount($reportId);

            // Simpan informasi bahwa pengunjung telah melihat laporan ini
            $this->markReportAsVisited($visitorId, $reportId);
        }

        $photos     = $photoModel->where('trash_report_id', $reportId)->findAll();
        $comments   = $commentModel->select('comments.*, users.username, users.name')
                                   ->join('users', 'users.id = comments.user_id')
                                   ->where('trash_report_id', $reportId)
                                   ->orderBy('comments.created_at', 'DESC') 
                                   ->findAll();
        // $photos = $report->photos()->findAll();



        return view('full_trash_report',[
                                            'report' => $report, 
                                            'commentCount' => $commentCount,
                                            'photos' => $photos,
                                            'comments' => $comments
                                        ]);
    }

    private function markReportAsVisited($visitorId, $reportId)
    {
        $visitorReportModel = new VisitorReportRecordModel();

        $data = [
            'visitor_id' => $visitorId,
            'report_id' => $reportId
        ];
        
        $visitorReportModel->insert($data);
    }

    private function incrementClickCount($reportId)
    {
        // Lakukan penambahan klik pada laporan dengan menggunakan model laporan sampah
        $reportModel = new TrashReportModel();
        $report = $reportModel->find($reportId);

        if ($report) {
            $currentClickCount = $report['click_count']; // Mendapatkan jumlah klik saat ini
            $newClickCount = $currentClickCount + 1;

            $data = [
                'click_count' => $newClickCount
            ];
            
            $builder = $reportModel->builder();
            $builder->where('id', $reportId);
            $builder->update($data);
        }
    }

    private function hasVisitedReport($visitorId, $reportId)
    {
        // Lakukan pengecekan di database atau session
        // Misalnya, jika menggunakan database
        $visitorReportModel = new VisitorReportRecordModel();
        $visitorRecord = $visitorReportModel
            ->where('visitor_id', $visitorId)
            ->where('report_id', $reportId)
            ->first();

        return ($visitorRecord !== null);
    }

    
}
