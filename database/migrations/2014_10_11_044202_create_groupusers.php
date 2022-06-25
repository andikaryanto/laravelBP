<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint as SchemaBlueprint;
use Illuminate\Support\Facades\Schema;
use LaravelCommon\Database\Schema\Blueprint;

class CreateGroupusers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('groupusers', function (SchemaBlueprint $table) {
            $table->id();
            $table->string('group_name');
            $table->string('description');
            $table->string('created_by');
            $table->string('modified_by');
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
        Schema::dropIfExists('groupusers');
    }
}
