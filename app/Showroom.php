<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;

use Carbon\Carbon;



class Showroom extends Model {





    protected $table    = 'showroom';

    protected $fillable = [
          'kandang',
          'deskripsi',
          'nilai',
          'jumlah',
          'total',
          'tanggal_pembelian'
    ];


    public static function boot()
    {
        parent::boot();

        Showroom::observe(new UserActionsObserver);
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
