<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;

use Carbon\Carbon; 



class Growth extends Model {

    

    

    protected $table    = 'growth';
    
    protected $fillable = [
          'belanjasapi_id',
          'bobot',
          'catatan',
          'tanggal_cek'
    ];
    

    public static function boot()
    {
        parent::boot();

        Growth::observe(new UserActionsObserver);
    }
    
    public function belanjasapi()
    {
        return $this->hasOne('App\BelanjaSapi', 'id', 'belanjasapi_id');
    }


    
    /**
     * Set attribute to date format
     * @param $input
     */
    public function setTanggalCekAttribute($input)
    {
        if($input != '') {
            $this->attributes['tanggal_cek'] = Carbon::createFromFormat(config('quickadmin.date_format'), $input)->format('Y-m-d');
        }else{
            $this->attributes['tanggal_cek'] = '';
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getTanggalCekAttribute($input)
    {
        if($input != '0000-00-00') {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('quickadmin.date_format'));
        }else{
            return '';
        }
    }


    
}