<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;




class DataTabunganQurban extends Model {

    

    

    protected $table    = 'datatabunganqurban';
    
    protected $fillable = [
          'nama',
          'tlpn',
          'alamat'
    ];
    

    public static function boot()
    {
        parent::boot();

        DataTabunganQurban::observe(new UserActionsObserver);
    }
    
    
    
    
}