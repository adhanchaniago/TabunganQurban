<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateBelanjaPakanTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('belanjapakan',function(Blueprint $table){
            $table->increments("id");
            $table->string("jenis_pakan");
            $table->string("jumlah")->nullable();
            $table->string("harga")->nullable();
            $table->string("total_harga")->nullable();
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
        Schema::drop('belanjapakan');
    }

}