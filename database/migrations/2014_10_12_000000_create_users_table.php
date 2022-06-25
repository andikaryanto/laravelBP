<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('groupuser_id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('photo');
            $table->boolean('is_active');
            $table->string('created_by');
            $table->string('modified_by');
            $table->timestamps();

            $table->foreign('groupuser_id')
                ->references('id')->on('groupusers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
