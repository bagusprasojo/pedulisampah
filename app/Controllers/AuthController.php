<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login(){
        if ($this->request->getMethod() === 'get') {
            return view('login');
        }

        $login = esc($this->request->getPost('login')); // Mengambil inputan dari form (username atau email)
        $password = esc($this->request->getPost('password'));

        $userModel = new UserModel();

        // Mencari pengguna berdasarkan username atau email
        $user = $userModel->where('username', $login)
                        ->orWhere('email', $login)
                        ->first();

        if ($user && password_verify($password, $user['password'])) {
            $session = session();
            $userData = [
                'user_id' => $user['id'],
                'username' => $user['username'],
                'name' => $user['name'],
                // Tambahkan data lain yang Anda perlukan untuk sesi login
            ];
            $session->set($userData);

            $previousURL = $session->get('previous_url');

            return redirect()->to($previousURL ?? '/user_dashboard');
        } else {
            // Proses login gagal
            session()->setFlashdata('errors', ['User atau password salah !']);
            return redirect()->back();
        }
    }
    public function register()
    {
        if ($this->request->getMethod() === 'get') {
            return view('register');
        }
        // Validasi input dari form pendaftaran pengguna
        
        if ($this->request->getMethod() === 'post') {
            $validation = \Config\Services::validation();

            if (esc($this->request->getPost('password')) != esc($this->request->getPost('konf_password'))){
                $password_files = [
                    'Password' => 'Password dan konfirmasi password tidak sama',
                ];

                session()->setFlashdata('errors', $password_files);
                session()->setFlashdata('old', $this->request->getPost());
                return redirect()->back();
            }
        
            $userModel = new UserModel();
            
            if (!$this->validate($userModel->validationRules, $userModel->validationMessages)) {
                session()->setFlashdata('errors', $validation->getErrors());
                session()->setFlashdata('old', $this->request->getPost());
                return redirect()->back();
                // ... lakukan sesuatu dengan pesan kesalahan, seperti kirim kembali ke form dengan pesan error
            } else {
                // Tangkap data dari form pendaftaran
                $userData = [
                    'username' => esc($this->request->getPost('username')),
                    'email' => esc($this->request->getPost('email')),
                    'password' => password_hash(esc($this->request->getPost('password')), PASSWORD_DEFAULT),
                    'name' => esc($this->request->getPost('name')), // Menangkap data nama
                    'address' => esc($this->request->getPost('alamat')) // Menangkap data alamat
                    // Tambahan data lain jika ada
                ];

                // Simpan data ke database menggunakan model
                $userModel->insert($userData);

                // Redirect ke halaman login atau halaman lainnya
                return redirect()->to('/login')->with('success', 'Pendaftaran berhasil. Silakan login !');
            }            
        }
    }

    public function user_dashboard(){
        echo 'User Dashboard';
    }
    public function logout()
    {
        $session = session();
        $session->destroy(); // Menghapus semua data session

        return redirect()->to('/trash-reports'); // Redirect ke halaman daftar laporan sampah
    }

}
