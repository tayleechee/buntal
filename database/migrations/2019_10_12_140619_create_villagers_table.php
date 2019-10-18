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
            $table->bigInteger('house_id');
            $table->string('name');
            $table->string('ic');
            $table->char('gender', 1);
            $table->date('dob');
            $table->string('race');
            $table->string('marital_status');
            $table->string('education_level');
            $table->string('occupation');
            $table->boolean('is_property_owner');
            $table->boolean('is_active');
            $table->string('death_date')->nullable();
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
