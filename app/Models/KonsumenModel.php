<?php

namespace App\Models;

use CodeIgniter\Model;

class KonsumenModel extends Model
{
    protected $table            = 'rb_konsumen'; // Nama tabel di database
    protected $primaryKey       = 'id_konsumen'; // Primary key
    protected $useAutoIncrement = true;          // ID Auto Increment (int)
    protected $returnType       = 'array';       // Return data dalam bentuk array
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    // Field yang boleh diisi/diupdate oleh aplikasi
    protected $allowedFields    = [
        'username',
        'password',
        'nama_lengkap',
        'email',
        'jenis_kelamin',
        'tanggal_lahir',
        'tempat_lahir',
        'alamat_lengkap',
        'kecamatan',
        'kota_id',
        'no_telp',
        'foto',
        'tanggal_daftar'
    ];

    // --- Konfigurasi Timestamp ---
    // Karena di SQL tabel 'rb_konsumen' kolomnya 'tanggal_daftar' (bukan created_at), 
    // kita set timestamps ke false dan atur manual atau mapping, 
    // tapi untuk simpelnya kita set false dulu agar tidak error.
    protected $useTimestamps = false;

    // --- Method Tambahan (Custom) ---

    /**
     * Cek Login Konsumen
     * Bisa login pakai Username atau Email
     */
    public function cekLogin($userOrEmail, $password)
    {
        // Cari data berdasarkan username ATAU email
        $konsumen = $this->groupStart()
                         ->where('username', $userOrEmail)
                         ->orWhere('email', $userOrEmail)
                         ->groupEnd()
                         ->first();

        // Jika user ditemukan
        if ($konsumen) {
            // Verifikasi Password
            // Catatan: Asumsi database lama pakai MD5. 
            // Jika project baru, disarankan ganti ke password_verify() (Bcrypt)
            if ($konsumen['password'] === md5($password)) {
                // Hapus password dari array sebelum dikembalikan (untuk keamanan session)
                unset($konsumen['password']);
                return $konsumen;
            }
        }

        return false;
    }

    /**
     * Ambil Detail Profil dengan Nama Kota (Join Table)
     * Berguna untuk halaman profil agar muncul nama kota, bukan cuma ID
     */
    public function getProfilLengkap($id_konsumen)
    {
        return $this->select('rb_konsumen.*, rb_kota.nama_kota, rb_provinsi.nama_provinsi')
                    ->join('rb_kota', 'rb_kota.kota_id = rb_konsumen.kota_id', 'left')
                    ->join('rb_provinsi', 'rb_provinsi.provinsi_id = rb_kota.provinsi_id', 'left')
                    ->where('rb_konsumen.id_konsumen', $id_konsumen)
                    ->first();
    }
}