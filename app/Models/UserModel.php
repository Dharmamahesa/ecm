<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';      // Nama tabel di database
    protected $primaryKey       = 'username';   // Primary key tabel ini
    protected $useAutoIncrement = false;        // False karena username bukan angka auto-increment
    protected $returnType       = 'array';      // Data dikembalikan dalam bentuk array
    protected $useSoftDeletes   = false;        // Tidak ada kolom deleted_at di tabel
    protected $protectFields    = true;         // Keamanan agar field lain tidak sembarang diisi
    
    // Daftar kolom yang boleh diisi/diubah melalui Model ini
    protected $allowedFields    = [
        'username', 
        'password', 
        'nama_lengkap', 
        'email', 
        'no_telp', 
        'level', 
        'blokir', 
        'id_session', 
        'foto'
    ];

    // --- Konfigurasi Waktu (Opsional) ---
    // Karena tabel 'users' di SQL kamu tidak punya kolom created_at/updated_at, kita set false
    protected $useTimestamps = false; 

    // --- Method Tambahan (Custom) ---

    /**
     * Fungsi untuk mengecek login admin/user
     * @param string $username
     * @param string $password
     * @return array|false Data user jika sukses, false jika gagal
     */
    public function cekLogin($username, $password)
    {
        // 1. Cari user berdasarkan username
        $user = $this->where('username', $username)->first();

        // 2. Jika user ditemukan, cek passwordnya
        if ($user) {
            // CATATAN PENTING:
            // Database lama biasanya menggunakan MD5. Kode ini menggunakan MD5 sesuai asumsi database lama.
            // Jika nanti kamu mereset password user lewat CI4, sebaiknya ganti ke password_verify()
            
            if ($user['password'] === md5($password)) {
                return $user;
            }
            
            // Jika nanti ingin menggunakan hash modern (Bcrypt), gunakan ini:
            // if (password_verify($password, $user['password'])) {
            //     return $user;
            // }
        }

        return false; // Login gagal
    }
}