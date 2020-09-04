<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;

use Carbon\Carbon;



class BelanjaPakan extends Model {





    protected $table    = 'belanjapakan';

    protected $fillable = [
          'kandang',
          'jenis_sapi',
          'jenis_pakan',
          'jumlah',
          'harga',
          'bulan',
          'total_harga',
          'tanggal_pembelian'
    ];


    public static function boot()
    {
        parent::boot();

        BelanjaPakan::observe(new UserActionsObserver);
    }
    public function jenissapi()
    {
        return $this->hasOne('App\JenisSapi', 'id', 'jenis_sapi');
    }
    public function kandang()
    {
        return $this->hasOne('App\Kandang', 'id', 'kandang');
    }


    /**
     * Set attribute to date format
     * @param $input
     */
    public function setTanggalPembelianAttribute($input)
    {
        if($input != '') {
            $this->attributes['tanggal_pembelian'] = Carbon::createFromFormat(config('quickadmin.date_format'), $input)->format('Y-m-d');
        }else{
            $this->attributes['tanggal_pembelian'] = '';
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getTanggalPembelianAttribute($input)
    {
        if($input != '0000-00-00') {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('quickadmin.date_format'));
        }else{
            return '';
        }
    }



}
