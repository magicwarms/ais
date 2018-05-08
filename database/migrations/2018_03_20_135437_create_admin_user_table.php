<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_admin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 80);
            $table->string('email', 125);
            $table->string('password', 125);
            $table->integer('level', 1);
            $table->dateTime('last_login');
            $table->boolean('status_admin');
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
        Schema::dropIfExists('admin_user');
    }
}
