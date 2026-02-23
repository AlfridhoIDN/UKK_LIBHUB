<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table='bukus';
    protected $fillable=[
    'judul',
    'penulis',
    'penerbit',
    'tahun_terbit',
    'cover_image',
    'deskripsi'
    ];
    
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'kategori_buku_relasi', 'buku_id', 'kategori_id');
    }
}
