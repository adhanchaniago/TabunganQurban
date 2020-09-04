<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;




class JenisSapi extends Model {

    

    

    protected $table    = 'jenissapi';
    
    protected $fillable = ['jenis_sapi'];
    

    public static function boot()
    {
        parent::boot();

        JenisSapi::observe(new UserActionsObserver);
    }
    
    
    
    
}