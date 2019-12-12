<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBrand extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('code', 10);
            $table->unsignedInteger('created_at');
            $table->unsignedInteger('updated_at')->nullable();
            $table->unsignedTinyInteger('status')->default(1);
            $table->unsignedTinyInteger('is_deleted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brand');
    }
}
