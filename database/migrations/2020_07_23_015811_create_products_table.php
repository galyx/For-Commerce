<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('product_name');
            $table->string('slug');
            $table->string('short_description');
            $table->string('group');
            $table->string('type_sale')->nullable();
            $table->string('price');
            $table->string('brand')->nullable();
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->string('diameter')->nullable();
            $table->string('weight')->nullable();
            $table->string('free_shipping');
            $table->string('description')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('products');
    }
}
