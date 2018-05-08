<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_admin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45);
            $table->string('icon', 45);
            $table->string('function', 45);
            $table->integer('parent', 3);
            $table->integer('status', 1);
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
