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
        Schema::create('media', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('src_id')->nullable();
            $table->boolean('src_type')->nullable()->default(false)->comment('0=media, 1=post, 2=category, 3=attribute, 4=Menus, 5=review, 6=Users 7=General 8=post Attribute');
            $table->boolean('use_Of_file')->nullable()->default(false)->comment('0=media, 1=image, 2=banner, gallery, 4=icon');
            $table->string('file_name')->nullable();
            $table->string('file_rename', 100)->nullable();
            $table->string('mine_type', 100)->nullable();
            $table->string('file_path', 100)->nullable();
            $table->string('alt_text')->nullable();
            $table->string('caption')->nullable();
            $table->text('description')->nullable();
            $table->string('file_url', 191)->nullable();
            $table->string('file_size', 100)->nullable();
            $table->integer('file_type')->default(0)->comment('0=unknown, 1=image, 2=pdf, 3=doc 4=Zip, rar, 5 = Vedio, 6=audio');
            $table->integer('drag')->default(0);
            $table->bigInteger('addedby_id')->nullable();
            $table->bigInteger('editedby_id')->nullable();
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
        Schema::dropIfExists('media');
    }
};
