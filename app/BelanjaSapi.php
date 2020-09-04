<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;



class BelanjaSapi extends Model {





    protected $table    = 'belanjasapi';

    protected $fillable = [
          'eartag',
          'jenis_sapi',
          'kandang',
          'bobot_sapi',
          'harga_p_kg',
          'harga_p_ekor',
            'harga_jual_p_kg',
        'total_harga_jual',

        'id_chart',
          'status',
          'tanggal_pembelian'
    ];


    public static function boot()
    {
        parent::boot();

        BelanjaSapi::observe(new UserActionsObserver);
    }
    public function jenissapi()
    {
        return $this->hasOne('App\JenisSapi', 'id', 'jenis_sapi');
    }
    public function kandang()
    {
        return $this->hasOne('App\Kandang', 'id', 'kandang');
    }
    public function sum_total_harga(){
        $sum = BelanjaSapi::select(DB::raw('SUM(harga_p_ekor) as total_harga'))->get();
        return $sum;
    }
    public function sum_sapi(){
        $sum_sapi = BelanjaSapi::count();
        return $sum_sapi;
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
