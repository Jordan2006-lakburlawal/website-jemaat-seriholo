<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'title', 'description'];

    // Relasi utama
    public function images()
    {
        return $this->hasMany(GalleryImage::class);
    }

    // Alias relasi agar tidak error jika dipanggil dengan nama galleryImages
    public function galleryImages()
    {
        return $this->hasMany(GalleryImage::class);
    }
}