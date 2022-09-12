<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use LaravelCommon\System\Database\Schema\Blueprint;

class CreateProductFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable(false);
            $table->string('name')->nullable(false);
            $table->string('type', Blueprint::STRING_SMALL)->nullable(false);
            $table->string('extension', Blueprint::STRING_EXTRASMALL)->nullable(false);
            $table->unsignedInteger('size')->nullable(false)->default(0);
            $table->auditable();
            $table->timestamps();
            
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_files');
    }
}
