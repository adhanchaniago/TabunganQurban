<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateShowroomTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('showroom',function(Blueprint $table){
            $table->increments("id");
            $table->string("deskripsi");
            $table->string("nilai");
            $table->string("jumlah");
            $table->string("total")->nullable();
            $table->date("tanggal_pembelian");
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
        Schema::drop('showroom');
    }

}