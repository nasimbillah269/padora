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
        Schema::create('order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id')->nullable();
            $table->bigInteger('invoice')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('seller_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->string('product_name', 250)->nullable();
            $table->integer('quantity')->default(0);
            $table->string('color', 100)->nullable();
            $table->string('size', 100)->nullable();
            $table->text('sku_id')->nullable();
            $table->text('sku_ids')->nullable();
            $table->float('price', 10)->default(0);
            $table->float('total_coupon_discount', 10)->default(0);
            $table->float('total_deal_discount', 10)->default(0);
            $table->float('total_price', 10)->default(0);
            $table->float('final_price', 10)->default(0);
            $table->float('shipping_cost', 10)->default(0);
            $table->integer('total_weight')->default(0);
            $table->integer('total_return')->default(0);
            $table->string('status', 20)->nullable()->comment('Pending, Confirmed, Runing, Cancel');
            $table->string('order_status', 30)->nullable();
            $table->integer('customer_delivery_user')->nullable();
            $table->timestamp('pending_at')->nullable();
            $table->integer('pending_by')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->integer('confirmed_by')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->integer('cancelled_by')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->integer('shipped_by')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->integer('delivered_by')->nullable();
            $table->string('payment_status', 20)->nullable()->default('unpaid');
            $table->timestamp('return_cancel_at')->nullable();
            $table->integer('return_cancel_by')->nullable();
            $table->text('return_cancel_msg')->nullable();
            $table->integer('addedby_id')->nullable();
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
        Schema::dropIfExists('order_items');
    }
};
