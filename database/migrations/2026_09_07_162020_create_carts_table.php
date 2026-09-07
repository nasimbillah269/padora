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
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('trans_date')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->boolean('product_type')->nullable()->default(false);
            $table->string('color', 100)->nullable();
            $table->string('size', 100)->nullable();
            $table->text('sku_id')->nullable();
            $table->text('sku_ids')->nullable();
            $table->text('cookie')->nullable();
            $table->integer('quantity')->default(0);
            $table->boolean('emi')->default(false);
            $table->integer('coupon_id')->nullable();
            $table->integer('address')->nullable();
            $table->unsignedBigInteger('addedby_id')->nullable();
            $table->unsignedBigInteger('editedby_id')->nullable();
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
        Schema::dropIfExists('carts');
    }
};
