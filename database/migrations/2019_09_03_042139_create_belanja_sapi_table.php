<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateBelanjaSapiTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('belanjasapi',function(Blueprint $table){
            $table->increments("id");
            $table->string("jenis_sapi");
            $table->string("bobot_sapi")->nullable();
            $table->string("harga_p_kg")->nullable();
            $table->string("harga_p_ekor")->nullable();
            $table->string("jumlah")->nullable();
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
        Schema::drop('belanjasapi');
    }

}