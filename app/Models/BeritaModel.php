<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaModel extends Model
{
    protected $table            = 'tb_berita';  // Nama tabel di database
    protected $primaryKey       = 'id_berita';  // Primary key
    protected $useAutoIncrement = true;         // Auto increment
    protected $returnType       = 'array';      // Return array
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    // Field yang boleh diisi (sesuai tabel ecommerce.sql)
    protected $allowedFields    = [
        'id_kategori',
        'username',
        'judul',
        'sub_judul',
        'youtube',
        'judul_seo',
        'headline',
        'aktif',
        'utama',
        'isiberita',
        'keterangan_gambar',
        'hari',
        'tanggal',
        'jam',
        'gambar',
        'dibaca',
        'tag',
        'status'
    ];

    // --- Konfigurasi Timestamp ---
    // Tabel tb_berita menggunakan kolom manual (hari, tanggal, jam), 
    // jadi kita matikan fitur timestamp otomatis CI4.
    protected $useTimestamps = false;

    // --- Method Custom ---

    /**
     * Ambil berita lengkap dengan nama kategori dan nama penulis
     * Bisa untuk semua berita atau satu berita spesifik (berdasarkan slug)
     */
    public function getBerita($slug = false)
    {
        $builder = $this->select('tb_berita.*, tb_kategori.nama_kategori, users.nama_lengkap')
                        ->join('tb_kategori', 'tb_kategori.id_kategori = tb_berita.id_kategori', 'left')
                        ->join('users', 'users.username = tb_berita.username', 'left');

        if ($slug === false) {
            // Ambil semua berita (diurutkan dari yang terbaru)
            return $builder->orderBy('id_berita', 'DESC')->findAll();
        }

        // Ambil satu berita detail
        return $builder->where('judul_seo', $slug)->first();
    }

    /**
     * Ambil berita terbaru untuk Widget atau Homepage
     * @param int $limit Jumlah berita yang diambil
     */
    public function getBeritaTerbaru($limit = 5)
    {
        return $this->select('tb_berita.*, tb_kategori.nama_kategori')
                    ->join('tb_kategori', 'tb_kategori.id_kategori = tb_berita.id_kategori', 'left')
                    ->where('status', 'Y') // Hanya yang status publish (Y)
                    ->orderBy('id_berita', 'DESC')
                    ->findAll($limit);
    }

    /**
     * Ambil berita Headline (Utama)
     * Biasanya untuk slider di halaman depan
     */
    public function getHeadline()
    {
        return $this->select('tb_berita.*, tb_kategori.nama_kategori')
                    ->join('tb_kategori', 'tb_kategori.id_kategori = tb_berita.id_kategori', 'left')
                    ->where('headline', 'Y')
                    ->where('status', 'Y')
                    ->orderBy('id_berita', 'DESC')
                    ->findAll(); // Bisa findAll() atau first() tergantung desain slider kamu
    }
    
    /**
     * Update counter pembaca (Hits)
     * Dipanggil saat detail berita dibuka
     */
    public function tambahDibaca($id)
    {
        // Query manual agar lebih efisien daripada ambil data dulu baru update
        $this->db->query("UPDATE tb_berita SET dibaca = dibaca + 1 WHERE id_berita = ?", [$id]);
    }
}