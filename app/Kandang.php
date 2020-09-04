<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;

use Carbon\Carbon;



class Kandang extends Model {





    protected $table    = 'kandang';

    protected $fillable = [
          'nama',
          'lokasi',
          'tanggal_berdiri'
    ];


    public static function boot()
    {
        parent::boot();

        Kandang::observe(new UserActionsObserver);
    }
    public function kandang()
    {
        return $this->hasOne('App\Kandang', 'id', 'kandang');
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setTanggalBerdiriAttribute($input)
    {
        if($input != '') {
            $this->attributes['tanggal_berdiri'] = Carbon::createFromFormat(config('quickadmin.date_format'), $input)->format('Y-m-d');
        }else{
            $this->attributes['tanggal_berdiri'] = '';
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getTanggalBerdiriAttribute($input)
    {
        if($input != '0000-00-00') {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('quickadmin.date_format'));
        }else{
            return '';
        }
    }



}
