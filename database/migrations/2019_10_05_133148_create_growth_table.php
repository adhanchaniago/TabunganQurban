<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateGrowthTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('growth',function(Blueprint $table){
            $table->increments("id");
            $table->integer("belanjasapi_id")->references("id")->on("belanjasapi");
            $table->string("bobot");
            $table->text("catatan")->nullable();
            $table->date("tanggal_cek");
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
        Schema::drop('growth');
    }

}