<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductCategoryShop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('product_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('shop_id');

            $table->foreign('shop_id')
                ->references('id')->on('shops')->onDelete('cascade');

            $table->unique(['name', 'shop_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        ////
        Schema::table('product_categories', function (Blueprint $table) {
            $table->dropUnique(['name', 'shop_id']);
            $table->dropConstrainedForeignId('shop_id');
        });
    }
}
