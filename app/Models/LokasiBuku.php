<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiBuku extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_lokasi_buku';

    protected $table = 'lokasi_bukus';
}
