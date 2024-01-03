<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\TrashReportModel;
use App\Models\CommentModel;
use App\Models\VisitorReportRecordModel;

class DashboardController extends BaseController
{
    public function __construct() {
        helper('auth');

        
    }

    public function index()
    {
        $session = session();
        if (!is_logged_in()) {
            $session->set('previous_url', current_url());
            return redirect()->to('/login')->with('error', 'Anda harus login untuk membuat komentar');
        }
        // Add your code here.

        // Disini Anda dapat mengakses data-data pribadi user

        $user_id = $session->get('user_id');

        $userModel = new UserModel();
        $user = $userModel->where('id', $user_id)
                        ->first();

        $userData = [
            'username' => $user['username'],
            'name' => $user['name'],
            'email' => $user['email'],
            'address' => $user['address']
            // Dan lain sebagainya
        ];

        // Mengakses model yang diperlukan
        $trashReportModel = new TrashReportModel();
        $commentModel = new CommentModel();
        $visitorRecordModel = new VisitorReportRecordModel();

        
        $jumlah_laporan = $trashReportModel->where('user_id', $user_id)->countAllResults();
        $jumlah_komentar_keluar = $commentModel->where('user_id', $user_id)->countAllResults();
        $jumlah_komentar_masuk = $commentModel->where('trashreports.user_id', $user_id)
                                              ->join('trashreports', 'trash_report_id = trashreports.id')
                                              ->countAllResults();

        $jumlah_view = $visitorRecordModel->where('trashreports.user_id', $user_id)
                                          ->join('trashreports','trashreports.id = report_id')
                                          ->countAllResults();
        

        $statistics = [
            'jumlah_laporan' => $jumlah_laporan,
            'jumlah_komentar_masuk' => $jumlah_komentar_masuk,
            'jumlah_komentar_keluar' => $jumlah_komentar_keluar,
            'jumlah_view' => $jumlah_view
        ];

        $latestReports = $trashReportModel->where('user_id', $user_id)        
        ->orderBy('created_at', 'DESC')
        ->paginate(5);

        $pager = $trashReportModel->pager;



        return view('dashboard', [
            'userData' => $userData,
            'statistics' => $statistics,
            'latestReports'=>$latestReports,
            'pager'=>$pager
        ]);
    }

    public function public_profile($username)
    {
        $user_profile = new UserModel();
        $user_id = $user_profile->where('username', $username)->first()['id'];

        $userModel = new UserModel();
        $user = $userModel->where('id', $user_id)
                        ->first();

        $userData = [
            'username' => $user['username'],
            'name' => $user['name'],
            'email' => $user['email'],
            'address' => $user['address']
            // Dan lain sebagainya
        ];

        // Mengakses model yang diperlukan
        $trashReportModel = new TrashReportModel();
        $commentModel = new CommentModel();
        $visitorRecordModel = new VisitorReportRecordModel();

        
        $jumlah_laporan = $trashReportModel->where('user_id', $user_id)->countAllResults();
        $jumlah_komentar_keluar = $commentModel->where('user_id', $user_id)->countAllResults();
        $jumlah_komentar_masuk = $commentModel->where('trashreports.user_id', $user_id)
                                              ->join('trashreports', 'trash_report_id = trashreports.id')
                                              ->countAllResults();

        $jumlah_view = $visitorRecordModel->where('trashreports.user_id', $user_id)
                                          ->join('trashreports','trashreports.id = report_id')
                                          ->countAllResults();
        

        $statistics = [
            'jumlah_laporan' => $jumlah_laporan,
            'jumlah_komentar_masuk' => $jumlah_komentar_masuk,
            'jumlah_komentar_keluar' => $jumlah_komentar_keluar,
            'jumlah_view' => $jumlah_view
        ];

        $latestReports = $trashReportModel->where('user_id', $user_id)        
        ->orderBy('created_at', 'DESC')
        ->paginate(5);

        $pager = $trashReportModel->pager;



        return view('public_profile', [
            'userData' => $userData,
            'statistics' => $statistics,
            'latestReports'=>$latestReports,
            'pager'=>$pager
        ]);
    }
}
