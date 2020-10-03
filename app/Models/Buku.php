<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_buku';

    protected $table = 'bukus';

    public function pinjam()
    {
        return $this->hasOne(Pinjam::class);
    }
}
