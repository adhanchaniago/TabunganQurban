<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateOperasionalTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('operasional',function(Blueprint $table){
            $table->increments("id");
            $table->string("deskripsi")->nullable();
            $table->string("nilai")->nullable();
            $table->string("jumlah")->nullable();
            $table->date("tanggal_pengeluaran");
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
        Schema::drop('operasional');
    }

}