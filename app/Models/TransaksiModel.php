<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table            = 'rb_penjualan';  // Nama tabel utama transaksi
    protected $primaryKey       = 'id_penjualan';  // Primary Key
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    // Field yang boleh diisi (Sesuai kolom di ecommerce.sql)
    protected $allowedFields    = [
        'kode_transaksi',
        'id_pmbeli',        // PERHATIAN: Sesuai SQL kamu (id_pmbeli), bukan id_pembeli
        'id_penjual',
        'status_pembeli',   // 'konsumen' atau 'reseller'
        'status_penjual',   // 'admin' atau 'reseller'
        'kurir',
        'service',
        'ongkir',
        'waktu_transakksi', // PERHATIAN: Sesuai SQL kamu (double k)
        'proses'            // '0'=Pending, '1'=Proses, '2'=Selesai (Konfirmasi)
    ];

    // --- Konfigurasi Timestamp ---
    // Kita set false karena nama kolomnya 'waktu_transakksi' (custom)
    protected $useTimestamps = false;

    // --- Method Custom (Fitur Tambahan) ---

    /**
     * Ambil riwayat transaksi milik konsumen tertentu
     * Digunakan di halaman "Riwayat Belanja" member
     */
    public function getRiwayatKonsumen($id_konsumen)
    {
        return $this->select('rb_penjualan.*, rb_penjualan.proses as status_order')
                    ->where('id_pmbeli', $id_konsumen)
                    ->where('status_pembeli', 'konsumen')
                    ->orderBy('waktu_transakksi', 'DESC')
                    ->findAll();
    }

    /**
     * Ambil detail satu transaksi beserta data pembelinya
     * Digunakan untuk halaman Detail Order atau Invoice
     */
    public function getDetailTransaksi($id_penjualan)
    {
        return $this->select('rb_penjualan.*, rb_konsumen.nama_lengkap, rb_konsumen.alamat_lengkap, rb_konsumen.no_telp, rb_kota.nama_kota')
                    ->join('rb_konsumen', 'rb_konsumen.id_konsumen = rb_penjualan.id_pmbeli', 'left')
                    ->join('rb_kota', 'rb_kota.kota_id = rb_konsumen.kota_id', 'left')
                    ->where('rb_penjualan.id_penjualan', $id_penjualan)
                    ->first();
    }

    /**
     * Ambil semua transaksi untuk Halaman Admin
     * Bisa difilter berdasarkan status proses (0/1/2)
     */
    public function getAllTransaksi($status = null)
    {
        $builder = $this->select('rb_penjualan.*, rb_konsumen.nama_lengkap')
                        ->join('rb_konsumen', 'rb_konsumen.id_konsumen = rb_penjualan.id_pmbeli', 'left')
                        ->orderBy('waktu_transakksi', 'DESC');

        if ($status !== null) {
            $builder->where('proses', $status);
        }

        return $builder->findAll();
    }

    /**
     * Generator Kode Transaksi Otomatis
     * Contoh output: TRX-20231129-0001
     */
    public function generateKodeTransaksi()
    {
        $prefix = 'TRX-' . date('Ymd') . '-';
        
        // Ambil transaksi terakhir hari ini
        $last = $this->like('kode_transaksi', $prefix, 'after')
                     ->orderBy('id_penjualan', 'DESC')
                     ->first();

        if ($last) {
            // Ambil nomor urut terakhir, tambah 1
            $lastNo = substr($last['kode_transaksi'], -4);
            $nextNo = sprintf('%04d', intval($lastNo) + 1);
        } else {
            // Jika belum ada hari ini, mulai dari 0001
            $nextNo = '0001';
        }

        return $prefix . $nextNo;
    }
}