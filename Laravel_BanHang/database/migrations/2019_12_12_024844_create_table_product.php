<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('brand_id');
            $table->string('description');
            $table->text('content');
            $table->float('price');
            $table->text('image');
            $table->float('rate');
            $table->unsignedTinyInteger('status')->default(1);
            $table->unsignedTinyInteger('is_deleted')->default(0);
            $table->unsignedInteger('created_at');
            $table->unsignedInteger('updated_at')->nullable();
            $table->foreign('category_id', 'fk_product_to_category')->references('id')->on('category');
            $table->foreign('brand_id', 'fk_product_to_brand')->references('id')->on('brand');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
