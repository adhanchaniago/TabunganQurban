<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;

use Carbon\Carbon; 



class IdentitasSapi extends Model {

    

    

    protected $table    = 'identitassapi';
    
    protected $fillable = [
          'id_sapi',
          'jenis_sapi',
          'bobot_awal',
          'harga',
          'catatan',
          'tanggal_masuk',
          'belanjasapi_id'
    ];
    

    public static function boot()
    {
        parent::boot();

        IdentitasSapi::observe(new UserActionsObserver);
    }
    
    public function belanjasapi()
    {
        return $this->hasOne('App\BelanjaSapi', 'id', 'belanjasapi_id');
    }


    
    /**
     * Set attribute to date format
     * @param $input
     */
    public function setTanggalMasukAttribute($input)
    {
        if($input != '') {
            $this->attributes['tanggal_masuk'] = Carbon::createFromFormat(config('quickadmin.date_format'), $input)->format('Y-m-d');
        }else{
            $this->attributes['tanggal_masuk'] = '';
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getTanggalMasukAttribute($input)
    {
        if($input != '0000-00-00') {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('quickadmin.date_format'));
        }else{
            return '';
        }
    }


    
}