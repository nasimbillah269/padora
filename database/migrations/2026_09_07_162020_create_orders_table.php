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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('invoice')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('company', 100)->nullable();
            $table->string('mobile', 20)->nullable();
            $table->string('email', 50)->nullable();
            $table->integer('division')->nullable();
            $table->integer('district')->nullable();
            $table->integer('city')->nullable();
            $table->string('city_name', 100)->nullable();
            $table->text('address')->nullable();
            $table->text('postal_code')->nullable();
            $table->boolean('shipping_address_status')->default(false);
            $table->string('shipping_name', 100)->nullable();
            $table->string('shipping_last_name', 100)->nullable();
            $table->string('shipping_company', 100)->nullable();
            $table->string('shipping_mobile', 20)->nullable();
            $table->string('shipping_email', 100)->nullable();
            $table->integer('shipping_division')->nullable();
            $table->integer('shipping_district')->nullable();
            $table->integer('shipping_city')->nullable();
            $table->string('shipping_city_name', 100)->nullable();
            $table->string('shipping_postal_code', 100)->nullable();
            $table->text('shipping_address')->nullable();
            $table->string('order_status', 20)->default('pending')->comment('temp, pending, confirmed, on delivery, completed, cancel, return');
            $table->string('return_status', 20)->default('pending')->comment('pending, confirmed, on delivery, completed, cancel');
            $table->float('return_amount', 10)->default(0);
            $table->string('payment_status', 10)->nullable()->default('unpaid')->comment('unpaid, partial, paid');
            $table->string('payment_method', 50)->nullable();
            $table->string('transection', 100)->nullable();
            $table->boolean('emi_status')->default(false);
            $table->string('order_type', 15)->default('customer_order')->comment('customer_order, pos_order, purchase_order, quotation_order');
            $table->float('total_price', 10)->default(0);
            $table->integer('total_items')->default(0);
            $table->integer('total_qty')->nullable()->default(0);
            $table->float('shipping_charge', 10)->default(0);
            $table->float('tax', 10)->default(0);
            $table->string('discount_type', 20)->nullable()->comment('Percantage, Flat');
            $table->float('discount', 10)->default(0);
            $table->float('discount_price', 10)->default(0);
            $table->float('coupon_discount', 10)->default(0);
            $table->float('grand_total', 10)->default(0);
            $table->float('paid_amount', 10)->default(0);
            $table->float('due_amount', 10)->default(0);
            $table->float('extra_amount', 10)->default(0);
            $table->integer('order_delivery_By')->nullable();
            $table->integer('coupon_id')->nullable();
            $table->string('search_key', 450)->nullable();
            $table->text('note')->nullable();
            $table->timestamp('pending_at')->nullable();
            $table->integer('pending_by')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->integer('confirmed_by')->nullable();
            $table->text('confirmed_msg')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->integer('shipped_by')->nullable();
            $table->text('shipped_msg')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->integer('delivered_by')->nullable();
            $table->text('delivered_msg')->nullable();
            $table->timestamp('cancel_at')->nullable();
            $table->integer('cancel_by')->nullable();
            $table->string('cancel_reason', 100)->nullable();
            $table->text('cancel_msg')->nullable();
            $table->timestamp('return_at')->nullable();
            $table->integer('return_by')->nullable();
            $table->text('return_msg')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
