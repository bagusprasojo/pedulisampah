<?php

namespace App\Controllers;

use App\Models\CommentModel;
use App\Models\TrashReportModel;

class CommentController extends BaseController
{
    public function __construct()
    {
        helper('auth'); // Panggil helper 'auth' yang telah Anda buat
    }

    public function addComment($slug)
    {
        // Pastikan pengguna login sebelum menambahkan komentar
        // Contoh: periksa sesi login atau autentikasi pengguna

        // Validasi apakah pengguna sudah login
        $session = session();
        if (!is_logged_in()) {
            $session->set('previous_url', current_url());
            return redirect()->to('/login')->with('error', 'Anda harus login untuk membuat komentar');
        }

        $report = new TrashReportModel();
        $data = $report->select('*')->where('slug', $slug)->first();
        $trashReportId = $data['id'];
        
        if ($this->request->getMethod() === 'get') {
            return view('add_comment', ['slug' => $slug]);
        }

        // Ambil data dari formulir atau request
        $commentText = $this->request->getPost('comment_text');

        // Validasi input jika diperlukan

        // Simpan komentar ke dalam database
        $commentModel = new CommentModel();
        $commentData = [
            'user_id' => session()->get('user_id'), // Ganti dengan cara Anda menyimpan ID pengguna saat login
            'trash_report_id' => $trashReportId,
            'comment_text' => $commentText,
        ];
        $commentModel->insert($commentData);

        // Redirect ke halaman laporan sampah setelah menambahkan komentar
        return redirect()->to("/full-trash-report/{$slug}"); // Ganti '/trash_reports/view/{$trashReportId}' dengan rute yang sesuai
    }
}
