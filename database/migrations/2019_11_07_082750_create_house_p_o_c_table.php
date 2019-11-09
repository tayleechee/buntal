<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHousePOCTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_p_o_c', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('house_id')->unsigned();
            $table->bigInteger('villager_id')->unsigned();

            $table->foreign('house_id')->references('id')->on('houses')->onDelete('cascade');
            $table->foreign('villager_id')->references('id')->on('villagers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('house_p_o_c');
    }
}
