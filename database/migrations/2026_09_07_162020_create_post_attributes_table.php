<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('src_id')->nullable();
            $table->bigInteger('parent_id')->nullable();
            $table->bigInteger('reff_id')->nullable();
            $table->text('sku_id')->nullable();
            $table->float('price', 10)->default(0);
            $table->boolean('type')->default(false)->comment('0=Category Post, 1=blog Category Post, 2=Blog Tags post, 3=Product Attribute post 4= Product Tags Post, 5=Page Galleries Post 6=Product SKU Post, 7=Coupon Category post');
            $table->string('status', 20)->nullable();
            $table->integer('duration')->nullable();
            $table->string('value_1', 100)->nullable();
            $table->bigInteger('drag')->nullable();
            $table->bigInteger('addedby_id')->nullable();
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
        Schema::dropIfExists('post_attributes');
    }
};
