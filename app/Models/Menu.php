<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';

    public $timestamps = false;

    protected $fillable = [
        'nama_menu',
        'deskripsi',
        'harga',
        'gambar',
    ];
}
