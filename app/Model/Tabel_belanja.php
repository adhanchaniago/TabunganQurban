<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tabel_belanja extends Model
{
    //
    protected $table    = 'tabel_belanja';

    protected $fillable = [
        'id',
        'id_chart',
        'nama_pembeli',
        'no_tlpn',
        'alamat',
        'total_belanja',
        'bayar',
        'keterangan',
        'status',
        'status_bayar',
    ];
}
