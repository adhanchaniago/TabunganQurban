<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateAnggaranPakanTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('anggaranpakan',function(Blueprint $table){
            $table->increments("id");
            $table->date("tanggal_awal")->nullable();
            $table->date("tanggal_akhir")->nullable();
            $table->string("jumlah_anggaran")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('anggaranpakan');
    }

}