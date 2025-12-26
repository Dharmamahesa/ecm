<?php

namespace App\Controllers;

use App\Models\KonsumenModel;
use App\Models\UserModel;

class Auth extends BaseController
{
    protected $konsumenModel;
    protected $userModel;
    protected $validation;

    public function __construct()
    {
        $this->konsumenModel = new KonsumenModel();
        $this->userModel     = new UserModel(); // Load Model Admin
        $this->validation    = \Config\Services::validation();
    }

    // Menampilkan Halaman Registrasi
    public function register()
    {
        if (session()->get('is_konsumen_logged_in')) return redirect()->to('/');
        
        $data = ['title' => 'Daftar Member Baru'];
        return view('auth/register', $data);
    }

    // Proses Simpan Data Member Baru
    public function registerProcess()
    {
        $rules = [
            'nama_lengkap' => ['rules' => 'required|min_length[3]'],
            'username'     => ['rules' => 'required|alpha_numeric|is_unique[rb_konsumen.username]'],
            'email'        => ['rules' => 'required|valid_email|is_unique[rb_konsumen.email]'],
            'password'     => ['rules' => 'required|min_length[4]'],
            'no_telp'      => ['rules' => 'required|numeric']
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username'       => $this->request->getPost('username'),
            'password'       => md5($this->request->getPost('password')),
            'nama_lengkap'   => $this->request->getPost('nama_lengkap'),
            'email'          => $this->request->getPost('email'),
            'no_telp'        => $this->request->getPost('no_telp'),
            'tanggal_daftar' => date('Y-m-d')
        ];

        $this->konsumenModel->insert($data);
        session()->setFlashdata('success', 'Registrasi Berhasil! Silakan Login.');
        return redirect()->to('/');
    }

    // --- PROSES LOGIN PINTAR (GABUNGAN) ---
    public function loginProcess()
    {
        $userOrEmail = $this->request->getPost('user_email'); // Bisa username atau email
        $password    = $this->request->getPost('password');

        // 1. CEK DULU DI TABEL ADMIN (users)
        $admin = $this->userModel->cekLogin($userOrEmail, $password);
        
        if ($admin) {
            // Jika ketemu di tabel Admin, set session Admin
            session()->set([
                'username'           => $admin['username'],
                'nama'               => $admin['nama_lengkap'],
                'level'              => $admin['level'],
                'is_admin_logged_in' => true
            ]);
            return redirect()->to('admin/dashboard'); // Lempar ke Dashboard Admin
        }

        // 2. JIKA BUKAN ADMIN, CEK DI TABEL MEMBER (rb_konsumen)
        $member = $this->konsumenModel->cekLogin($userOrEmail, $password);

        if ($member) {
            // Jika ketemu di tabel Member, set session Member
            session()->set([
                'id_konsumen'           => $member['id_konsumen'],
                'nama_user'             => $member['nama_lengkap'],
                'email_user'            => $member['email'],
                'is_konsumen_logged_in' => true
            ]);
            return redirect()->back(); // Kembali ke halaman asal
        }

        // 3. JIKA TIDAK KETEMU DI KEDUANYA
        return redirect()->back()->with('error', 'Akun tidak ditemukan atau Password salah!');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}