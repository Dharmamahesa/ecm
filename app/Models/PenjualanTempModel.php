<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanTempModel extends Model
{
    protected $table            = 'rb_penjualan_temp';
    protected $primaryKey       = 'id_penjualan_detail';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'session', 
        'id_produk', 
        'jumlah', 
        'diskon', 
        'harga_jual', 
        'satuan', 
        'waktu_order'
    ];

    // Ambil data keranjang berdasarkan session user (Login atau Guest)
    public function getKeranjang($session_id)
    {
        return $this->select('rb_penjualan_temp.*, rb_produk.nama_produk, rb_produk.gambar, rb_produk.produk_seo, rb_produk.berat, rb_produk.satuan')
                    ->join('rb_produk', 'rb_produk.id_produk = rb_penjualan_temp.id_produk')
                    ->where('session', $session_id)
                    ->orderBy('id_penjualan_detail', 'DESC')
                    ->findAll();
    }

    // Hitung total berat belanjaan (untuk ongkir nanti)
    public function getTotalBerat($session_id)
    {
        $items = $this->getKeranjang($session_id);
        $totalBerat = 0;
        foreach($items as $item) {
            $totalBerat += ($item['berat'] * $item['jumlah']);
        }
        return $totalBerat;
    }
    
    // Hitung total harga belanjaan
    public function getTotalBelanja($session_id)
    {
        $items = $this->where('session', $session_id)->findAll();
        $total = 0;
        foreach($items as $item) {
            $total += ($item['harga_jual'] * $item['jumlah']);
        }
        return $total;
    }
}