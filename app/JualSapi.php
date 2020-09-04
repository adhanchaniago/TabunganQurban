<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;




class JualSapi extends Model {

    

    

    protected $table    = 'jualsapi';
    
    protected $fillable = [
          'belanjasapi_id',
          'harga_p_kg',
          'total_harga',
          'nama_pembeli',
          'no_tlpn',
          'status_bayar',
          'bayar',
          'keterangan'
    ];
    

    public static function boot()
    {
        parent::boot();

        JualSapi::observe(new UserActionsObserver);
    }
    
    public function belanjasapi()
    {
        return $this->hasOne('App\BelanjaSapi', 'id', 'belanjasapi_id');
    }


    
    
    
}