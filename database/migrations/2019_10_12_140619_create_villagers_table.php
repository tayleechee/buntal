<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVillagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('villagers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('house_id')->unsigned();
            $table->string('name');
            $table->string('ic');
            $table->string('phone')->nullable();
            $table->char('gender', 1);
            $table->date('dob');
            $table->string('race');
            $table->string('marital_status');
            $table->string('education_level');
            $table->string('occupation')->nullable();
            $table->boolean('is_property_owner');
            $table->boolean('is_active');
            $table->string('death_date')->nullable();

            $table->foreign('house_id')->references('id')->on('houses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('villagers');
    }
}
