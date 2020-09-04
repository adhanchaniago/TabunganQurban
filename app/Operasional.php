<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;

use Carbon\Carbon;



class Operasional extends Model {





    protected $table    = 'operasional';

    protected $fillable = [
          'kandang',
          'deskripsi',
          'nilai',
          'jumlah',
          'tanggal_pengeluaran'
    ];


    public static function boot()
    {
        parent::boot();

        Operasional::observe(new UserActionsObserver);
    }
    public function kandang()
    {
        return $this->hasOne('App\Kandang', 'id', 'kandang');
    }


    /**
     * Set attribute to date format
     * @param $input
     */
    public function setTanggalPengeluaranAttribute($input)
    {
        if($input != '') {
            $this->attributes['tanggal_pengeluaran'] = Carbon::createFromFormat(config('quickadmin.date_format'), $input)->format('Y-m-d');
        }else{
            $this->attributes['tanggal_pengeluaran'] = '';
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getTanggalPengeluaranAttribute($input)
    {
        if($input != '0000-00-00') {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('quickadmin.date_format'));
        }else{
            return '';
        }
    }



}
