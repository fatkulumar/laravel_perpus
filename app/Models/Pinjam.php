<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_buku';

    protected $table = 'pinjams';

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
