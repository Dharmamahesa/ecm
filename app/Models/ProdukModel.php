<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table            = 'rb_produk';  // Nama tabel
    protected $primaryKey       = 'id_produk';  // Primary key
    protected $useAutoIncrement = true;         // Auto increment
    protected $returnType       = 'array';      // Return array
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    // Field yang boleh diisi (sesuai struktur tabel ecommerce.sql)
    protected $allowedFields    = [
        'id_produk_perusahaan',
        'id_kategori_produk',
        'id_kategori_produk_seo',
        'id_reseller',
        'nama_produk',
        'produk_seo',
        'satuan',
        'harga_beli',
        'harga_reseller',
        'harga_konsumen',
        'berat',
        'gambar',
        'keterangan',
        'username',
        'waktu_input'
    ];

    // --- Konfigurasi Timestamp ---
    // Kita set false karena nama kolomnya 'waktu_input' (bukan created_at default CI4)
    protected $useTimestamps = false;

    // --- Method Custom (Fitur Tambahan) ---

    /**
     * Ambil semua produk beserta nama kategorinya
     * (Berguna untuk halaman admin atau list produk)
     */
    public function getProdukLengkap()
    {
        return $this->select('rb_produk.*, rb_kategori_produk.nama_kategori')
                    ->join('rb_kategori_produk', 'rb_kategori_produk.id_kategori_produk = rb_produk.id_kategori_produk', 'left')
                    ->orderBy('rb_produk.waktu_input', 'DESC')
                    ->findAll();
    }

    /**
     * Ambil detail satu produk berdasarkan SEO (Slug)
     * (Berguna untuk halaman detail produk di frontend)
     */
    public function getDetailBySeo($seo)
    {
        return $this->select('rb_produk.*, rb_kategori_produk.nama_kategori')
                    ->join('rb_kategori_produk', 'rb_kategori_produk.id_kategori_produk = rb_produk.id_kategori_produk', 'left')
                    ->where('rb_produk.produk_seo', $seo)
                    ->first();
    }

    /**
     * Ambil produk terbaru (Limit)
     * (Berguna untuk Widget "Produk Terbaru" di Homepage)
     */
    public function getProdukTerbaru($limit = 6)
    {
        return $this->select('rb_produk.*, rb_kategori_produk.nama_kategori')
                    ->join('rb_kategori_produk', 'rb_kategori_produk.id_kategori_produk = rb_produk.id_kategori_produk', 'left')
                    ->orderBy('waktu_input', 'DESC')
                    ->findAll($limit);
    }
}