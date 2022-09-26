<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use LaravelCommon\System\Database\Schema\Blueprint;

class CreateProductVariants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable(false);
            $table->string('name', Blueprint::STRING_100)->nullable(false);
            $table->decimal('price', 10, 2, true)->nullable(false);
            $table->integer('stock')->nullable(false);
            $table->integer('saleable_stock')->nullable(false);
            $table->string('condition', Blueprint::STRING_25)->nullable(false);
            $table->decimal('weight')->nullable();
            $table->decimal('height')->nullable();
            $table->decimal('width')->nullable();
            $table->decimal('length')->nullable();
            $table->auditable();
            $table->timestamps();

            $table->unique(['product_id', 'name']);

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
        Schema::dropIfExists('product_variants');
    }
}
