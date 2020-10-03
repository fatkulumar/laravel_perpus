<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kembali extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kembali';

    protected $fillable = [
        'id_buku',
        'nis',
        'tgl_kembali',
        'tgl_harus_kembali',
    ];

    protected $hidden = ['id_pinjam'];

    protected $table = 'kembalis';
}
