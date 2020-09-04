<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateIdentitasSapiTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('identitassapi',function(Blueprint $table){
            $table->increments("id");
            $table->string("id_sapi");
            $table->string("jenis_sapi");
            $table->string("bobot_awal");
            $table->string("harga");
            $table->text("catatan")->nullable();
            $table->date("tanggal_masuk");
            $table->integer("belanjasapi_id")->references("id")->on("belanjasapi");
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
        Schema::drop('identitassapi');
    }

}