<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;




class GajiKaryawan extends Model {





    protected $table    = 'gajikaryawan';

    protected $fillable = [
        'kandang',
          'nama',
          'gaji_p_bln',
          'jumlah_bln',
          'total',
          'tanggal_gaji'
    ];


    public static function boot()
    {
        parent::boot();

        GajiKaryawan::observe(new UserActionsObserver);
    }
    public function kandang()
    {
        return $this->hasOne('App\Kandang', 'id', 'kandang');
    }





}
