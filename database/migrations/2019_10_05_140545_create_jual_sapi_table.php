<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateJualSapiTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('jualsapi',function(Blueprint $table){
            $table->increments("id");
            $table->integer("belanjasapi_id")->references("id")->on("belanjasapi");
            $table->string("harga_p_kg");
            $table->string("total_harga")->nullable();
            $table->string("nama_pembeli");
            $table->string("no_tlpn");
            $table->string("status_bayar");
            $table->string("bayar");
            $table->text("keterangan")->nullable();
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
        Schema::drop('jualsapi');
    }

}