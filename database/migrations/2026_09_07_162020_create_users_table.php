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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('permission_id')->nullable();
            $table->string('name', 100)->nullable();
            $table->string('email', 100)->nullable()->unique();
            $table->string('mobile', 20)->nullable()->unique('mobile');
            $table->text('profile')->nullable();
            $table->text('address_line1')->nullable();
            $table->text('address_line2')->nullable();
            $table->string('postal_address', 250)->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->integer('city')->nullable();
            $table->integer('district')->nullable();
            $table->integer('division')->nullable();
            $table->integer('country')->nullable();
            $table->timestamp('dob')->nullable();
            $table->string('gender', 10)->nullable();
            $table->boolean('status')->default(true)->comment('0=Inactive, 1=Active, 2=draft');
            $table->boolean('fetured')->default(false)->comment('0=no fetured, 1=Fetured');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('password_show', 191)->nullable();
            $table->rememberToken();
            $table->string('api_token', 100)->nullable();
            $table->string('device_key')->nullable();
            $table->string('verify_code', 100)->nullable();
            $table->boolean('verify_code_status')->default(false);
            $table->string('designation', 200)->nullable();
            $table->float('balance', 10)->default(0);
            $table->boolean('subscriber')->default(false);
            $table->boolean('customer')->default(true);
            $table->boolean('business')->default(false);
            $table->boolean('employee')->default(false);
            $table->boolean('admin')->default(false);
            $table->bigInteger('addedby_id')->nullable();
            $table->timestamp('addedby_at')->nullable();
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
        Schema::dropIfExists('users');
    }
};
