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
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 200)->nullable();
            $table->string('slug', 250)->nullable();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('sku_code', 100)->nullable();
            $table->string('bar_code', 100)->nullable();
            $table->integer('stock_out_limit')->default(0);
            $table->boolean('stock_status')->default(true);
            $table->integer('quantity')->nullable();
            $table->float('purchase_price', 10)->default(0);
            $table->float('final_price', 10)->default(0);
            $table->float('discount', 10)->default(0);
            $table->string('discount_type', 20)->nullable();
            $table->float('regular_price', 10)->default(0);
            $table->timestamp('offer_start_date')->nullable();
            $table->timestamp('offer_end_date')->nullable();
            $table->integer('min_order_quantity')->default(1);
            $table->integer('max_order_quantity')->nullable();
            $table->string('weight_unit', 100)->nullable();
            $table->string('weight_amount', 50)->nullable();
            $table->string('dimensions_unit', 100)->nullable();
            $table->string('dimensions_length', 50)->nullable();
            $table->string('dimensions_width', 50)->nullable();
            $table->string('dimensions_height', 50)->nullable();
            $table->string('weight_per_pices', 100)->nullable();
            $table->float('weight_per_ices', 10, 3)->default(0);
            $table->float('weight_per_quantity', 10)->default(0);
            $table->boolean('variation_status')->default(false);
            $table->boolean('pos_status')->default(false);
            $table->boolean('emi_status')->default(false);
            $table->boolean('digital_status')->default(false);
            $table->boolean('classified_status')->default(false);
            $table->string('product_source', 50)->nullable();
            $table->integer('brand_id')->nullable();
            $table->unsignedBigInteger('view')->default(0);
            $table->string('template', 100)->nullable();
            $table->bigInteger('sell_count')->default(0);
            $table->integer('type')->default(0)->comment('0=Page,1=Post, 2=Product');
            $table->string('seo_title', 191)->nullable();
            $table->text('seo_description')->nullable();
            $table->text('seo_keyword')->nullable();
            $table->text('search_key')->nullable();
            $table->string('status', 10)->default('temp')->comment('temp,active,inactive');
            $table->boolean('fetured')->default(false);
            $table->bigInteger('addedby_id')->nullable();
            $table->bigInteger('editedby_id')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->boolean('bestSale')->default(false);
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
