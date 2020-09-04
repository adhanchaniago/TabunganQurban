<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateGajiKaryawanTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('gajikaryawan',function(Blueprint $table){
            $table->increments("id");
            $table->string("nama")->nullable();
            $table->string("gaji_p_bln")->nullable();
            $table->string("jumlah_bln")->nullable();
            $table->string("total")->nullable();
            $table->string("tanggal_gaji");
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
        Schema::drop('gajikaryawan');
    }

}