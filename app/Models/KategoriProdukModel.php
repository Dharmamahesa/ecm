<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriProdukModel extends Model
{
    protected $table            = 'rb_kategori_produk';
    protected $primaryKey       = 'id_kategori_produk';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['nama_kategori', 'kategori_seo'];

    public function getKategori($slug = false)
    {
        if ($slug === false) {
            return $this->findAll();
        }
        return $this->where('kategori_seo', $slug)->first();
    }
}